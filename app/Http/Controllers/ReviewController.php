<?php

namespace App\Http\Controllers;

use App\File;
use App\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ReviewController extends Controller
{
    public function index()
    {

        $data = [];
//        $data['list'] = Review::orderByDESC('id','desc')->get();
        $data['list'] = Review::orderBy('id','desc')->paginate(10);
        return view('review',compact(['data']));
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

    public function store(Request $request)
    {
        $input = $request->only(['name','product','score','shop','contents','purchase-date']);
        Review::create($input);
        $id = DB::table('reviews')->max('id');
        forEach($request['file'] as $idx => $file){
            $submit = explode(',',$file);
            $link = './public/data/img/'.time().'_'. $idx.'image.jpg';
            file_put_contents($link,base64_decode($submit[1]));
            $input = [
                'review_id' => $id,
                'file_name' => $link
            ];
            File::create($input);
        }
    }

    public function show($id)
    {

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

    }
    public function search(Request $request){
        $data = Review::orderBy('id','desc')->paginate(intval($request['last-key']));
        if($data->count() <= 0 ){
            return print_r('오류가 발행했습니다. 다시 시도해 주세요.');
        }
        return $data;
    }
    public function plus(Request $request){
        return Review::orderBy('id','desc')->paginate(10);
    }
}
