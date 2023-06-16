<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;

class TestController extends Controller
{
    public function index(Request $request)
    {
        try {
            $response = Http::post('https://search-relevance-ml-l6hx3dk4bq-et.a.run.app/calculate', [
                'query' => $request->query,
                'item' => $request->item,
            ]);

            if ($response->successful()) {
                $responseData = $response->json();

                if (!is_null($responseData)) {
                    return response()->json([
                        'message' => 'Item list fetched successfully.',
                        'data' => $responseData,
                    ], 200);
                } else {
                    return response()->json([
                        'message' => 'Empty response received from the API.',
                    ], 200);
                }
            } else {
                // Handle API response failure
                $errorMessage = $response->json()['message'];
                return response()->json([
                    'message' => 'Failed to fetch item list.',
                    'error' => $errorMessage,
                ], 500);
            }
        } catch (\Exception $e) {
            // Handle exception if the API request fails
            return response()->json([
                'message' => 'Failed to fetch item list.',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
