<?php

namespace App\Http\Controllers;

use App\Event;
use DateTime;
use Illuminate\Http\Request;

class EventController extends Controller
{
    public function index()
    {
        return view('card');
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
        dd('a');
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
    public function check(Request $request){
        $time = date('Y-m-d');
        $data = Event::where('phone',$request['phone'])->where('date',$time)->get();
        if($data->count() > 0) return back()->with('msg','하루에 한번만 참여가능합니다.');
        $data = Event::where('phone',$request['phone'])->get();
        $input = $request->only(['name','phone','score']);
        if($data->count() <= 1){
            $first = new DateTime($data[0]['date']);
            $second = new DateTime($time);
            $dd = $first->diff($second);
            $data[0]->update([
                'date' => $time,
                'cnt' => $data[0]['cnt']+1,
                'score' => $data[0]['score'] + $request['score']
            ]);
        }else{
            $input['cnt'] = 1;
            Event::create($input);
        }
        return back()->with('msg','이벤트 참여가 완료되었습니다.');

    }
    public function view($phone){
        $data = Event::where('phone',$phone)->get();
        return $data[0]['cnt'];
    }
    public function control(){
        $data = [];
        $data['list'] = Event::all();
        return view('eventcontrol',compact(['data']));
    }
}
