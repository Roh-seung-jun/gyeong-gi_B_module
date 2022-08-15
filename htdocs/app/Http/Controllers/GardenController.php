<?php

namespace App\Http\Controllers;

use App\Disable;
use App\Garden;
use DateTime;
use Illuminate\Http\Request;

class GardenController extends Controller
{
    public function guidePage($type = null){

        $data = Garden::all();
        return view('garden',compact(['data']));
    }

    public function viewPage($id){
        $data = [];
        $data['garden'] = Garden::find($id);
        return view('garden_view',compact(['data']));
    }


    public function calendarPage($id){
        if( !auth()->user() || auth()->user()->type !== 'normal') return redirect('/')->with('msg','일반회원만 이용가능한 페이지입니다.');
        $data = [];
        $data['garden'] = Garden::find($id);
        return view('calendar',compact(['data']));
    }

    public function calendar(Request $request){

    }

    public function check(Request $request){
        $find = Disable::where('garden_id',$request['id'])->where('date','>',$request['start'])->where('date','<',$request['end'])->get()->count();

        if($find !== 0){
            return '해당 날짜는 신청이 불가능합니다.';
        }
        $first = new DateTime($request['start']);
        $second = new DateTime($request['end']);

        $day = ($first->diff($second))->days;
        return $day;



    }
}
