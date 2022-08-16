<?php

namespace App\Http\Controllers;

use App\Calendar;
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
        $find = Disable::where('garden_id',$request['id'])->where('date','>',$request['start_date'])->where('date','<',$request['end_date'])->get()->count();
        if($find !== 0){
            return back()->with('msg','해당 날짜는 신청이 불가능합니다.');
        }
        $input = $request->only(['people','start_date','end_date','garden_id']);

        $first = new DateTime($request['start']);
        $second = new DateTime($request['end']);

        $input['price'] = (int)($first->diff($second))->days * (int)$request['people'];
        $input['user_id'] = auth()->user()->id;
        Calendar::create($input);
        return redirect('/history');
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

    public function history(){
        if(!auth()->user()) return back()->with('msg','로그인한 회원만 사용가능합니다.');
        return view('history');
    }

    public function cancel($id){
        $find = Calendar::find($id);
        $find->update(['state'=>'cancel']);
        return back()->with('msg','일정이 취소되었습니다.');
    }

    public function setting(Request $request){
        $garden = auth()->user()->admin->id;
        $data = Disable::where('garden_id',$garden)->where('date',$request['date'])->get();
        if($data->count() !== 0){
            foreach ($data as $item){
                $item->delete();
            }
        }else{
            Disable::create([
                'garden_id'=>auth()->user()->admin->id,
                'date'=> $request['date'],
            ]);
        }
        return back()->with('msg','일정이 수정되었습니다.');
    }

    public function noticePage($page = 0){
        return view('notice');
    }
}
