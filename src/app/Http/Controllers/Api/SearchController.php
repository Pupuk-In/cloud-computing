<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $itemQuery = Item::with('picture', 'store', 'type', 'plant', 'plantPart');

        // FILTER
        // by name (partial)
        if($request->search){
            $itemQuery->where('name', 'LIKE', '%'.$request->search.'%')
                ->orWhereHas('type', function($query) use($request){
                    $query->where('name', 'LIKE', '%'.$request->search.'%');
                });
        }
        // by relation type (exact)
        if($request->type){
            $itemQuery->whereHas('type', function($query) use($request){
                $query->where('id', $request->type);
            });
        }
        // by relation plant (exact)
        if($request->plant){
            $itemQuery->whereHas('plant', function($query) use($request){
                $query->where('id', $request->plant);
            });
        }
        // by relation plant (exact)
        if($request->part){
            $itemQuery->whereHas('plantPart', function($query) use($request){
                $query->where('id', $request->part);
            });
        }
        // by price (range)
        if ($request->input('price')) {
            $priceRange = explode('-', $request->input('price'));

            if (count($priceRange) === 2) {
                $lowerLimit = $priceRange[0];
                $upperLimit = $priceRange[1];

                $itemQuery->whereBetween('price', [$lowerLimit, $upperLimit]);
            }
        }

        // SORT
        if($request->sort){
            $sortColumn = $request->sort;
            $sortOrder = $request->order === 'desc' ? 'desc' : 'asc';
            $itemQuery->orderBy($sortColumn, $sortOrder);
        } else {
            $itemQuery->orderBy('created_at', 'desc');
        }

        // PAGINATE
        if($request->perPage){
            $item = $itemQuery->paginate($request->perPage);
        } else {
            $item = $itemQuery->paginate(10);
        }



        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'Item list is empty.',
                'item'    => $item
            ], 200);
        }

        return response()->json([
            'message' => 'Item fetched successfully.',
            'item'    => $request->all(),
        ], 200);
    }

    public function indexSort()
    {
        $item = DB::table('items')
            ->join('stores', 'items.store_id', '=', 'stores.id')
            ->select('items.*', 'stores.name as store_name', 'stores.latitude as latitude', 'stores.longitude as longitude')
            ->selectRaw('6371 * acos(cos(radians(37)) * cos(radians(stores.latitude)) * cos(radians(stores.longitude) - radians(-122)) + sin(radians(37)) * sin(radians(stores.latitude))) AS distance')
            ->orderBy('distance')
            ->get();

        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'Item list is empty.',
                'item'    => $item
            ], 200);
        }

        return response()->json([
            'message' => 'Item list fetched successfully.',
            'item'    => $item
        ], 200);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
