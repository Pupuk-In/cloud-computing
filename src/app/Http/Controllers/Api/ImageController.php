<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Google\Cloud\Storage\StorageClient;
use Illuminate\Support\Facades\Storage;
use Exception;
use Google\Cloud\SecretManager\V1\SecretManagerServiceClient;


class ImageController extends Controller
{
    public function store(Request $request)
    {
        if ($request->hasFile('picture')) {
            try {
                $projectId = env('GCP_PROJECT_ID');
                $secretedName = env('SERVICE_ACCOUNT_SECRET_NAME');
                $secretManager = new SecretManagerServiceClient();
                $secretName = 'projects/'.$projectId.'/secrets/'.$secretedName.'/versions/latest';

                $response = $secretManager->accessSecretVersion($secretName);
                $payload = $response->getPayload();
                $jsonKeyData = $payload->getData();

                // Create a StorageClient instance using the JSON key data from the secret
                $storage = new StorageClient([
                    'keyFile' => json_decode($jsonKeyData, true)
                ]);
                
                $bucketName = env('GOOGLE_CLOUD_BUCKET');
                $bucket = $storage->bucket($bucketName);
 
                //get filename with extension
                $filenamewithextension = $request->file('picture')->getClientOriginalName();
 
                $filenamewithextension = str_replace(' ', '_', $filenamewithextension);

                //get filename without extension
                $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
 
                //get file extension
                $extension = $request->file('picture')->getClientOriginalExtension();
 
                //filename to store
                $filenametostore = $filename.'_'.uniqid().'.'.$extension;
 
                Storage::put('public/uploads/'. $filenametostore, fopen($request->file('picture'), 'r+'));
 
                $filepath = storage_path('app/public/uploads/'.$filenametostore);
 
                $object = $bucket->upload(
                    fopen($filepath, 'r'),
                    [
                        'predefinedAcl' => 'publicRead'
                    ]
                );
 
                // delete file from local disk
                Storage::delete('public/uploads/'. $filenametostore);

                $fileUrl = "https://storage.googleapis.com/$bucketName/$filenametostore";

                $file['name'] = $filenametostore;
                $file['url'] = $fileUrl;
 
                return response()->json([
                    "message" => "File uploaded successfully.",
                    "file" => $file,
                ], 200);
 
            } catch(Exception $e) {
                return response()->json([
                    "message" => $e->getMessage(),
                ], 404);
            }
        }
    }

    public function destroy(Request $request)
    {
        try {
            $file = $request->picture;

            if (strpos($file, 'https://storage.googleapis.com/pupukin-bucket/') !== false) {
                $file = str_replace('https://storage.googleapis.com/pupukin-bucket/', '', $file);
            }

            $storage = new StorageClient([
                'keyFilePath' => base_path(). '/serviceaccountkey.json',
            ]);
        
            $bucket = $storage->bucket(env('GOOGLE_CLOUD_BUCKET'));
            $object = $bucket->object($file);
        
            $object->delete();

            return response()->json([
                "message" => "File deleted successfully.",
                "name" => $file
            ], 200);
        } catch(Exception $e) {
            return response()->json([
                "message" => $e->getMessage()
            ], 404);
        }
    }
}
