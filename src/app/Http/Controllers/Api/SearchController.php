<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Item;
use Illuminate\Http\Request;
use Spatie\QueryBuilder\QueryBuilder;
use Spatie\QueryBuilder\AllowedFilter;


class SearchController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function indexItem()
    {
        $item = QueryBuilder::for(Item::class)
            // ->join('types', 'items.type_id', 'types.id')
            ->allowedFilters(['name'])
            ->get();

        if ($item->isEmpty()) {
            return response()->json([
                'message' => 'Item list is empty.',
                'data'    => $item
            ], 200);
        }

        // $store = $item->store()->get();
        // $type = $item->type()->get();
        // $plant = $item->plant()->get();
        // $plantPart = $item->plantPart()->get();

        // $item['store_id'] = $store;
        // $item['type_id'] = $type;
        // $item['plants'] = $plant;
        // $item['plant_parts'] = $plantPart;

        // $items = Item::with('plant') ->where('user_id', $user->id) ->get() ;

        return response()->json([
            'message' => 'Item list fetched successfully.',
            'data'    => $item
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
