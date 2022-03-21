<?php

namespace App\Http\Controllers;

use App\Area;
use App\Item;
use Illuminate\Http\Request;

class ItemController extends Controller
{
    public function index()
    {
        $data = [];
        $data['area'] = Area::all();
        $data['item'] = Item::all();
        return view('control',compact(['data']));
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

    public function edit($id)
    {
    }

    public function update(Request $request, $id)
    {
        $item = Item::find($id);
        $time = time(). $request['img']->getClientOriginalName();
        $input = [
            'areas_id' => $item->areas_id,
            'item' => $request['item'],
            'img' => './public/data/img/'.$time
        ];
        $request['img']->move(base_path('./public/data/img/'),$time);
        $item->update($input);
        return redirect(route('item.index'));
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
    public function view(){
        $data = [];
        $data['area'] = Area::all();
        $data['item'] = Item::all();
        return view('view',compact(['data']));
    }
}
