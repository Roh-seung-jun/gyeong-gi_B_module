<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Review;
use App\Review_file;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    public function review(Request $request){
        $request->validate([
            'contents' => 'required',
            'file' => 'max:4',
            'file.*' => 'mimes:jpg,png,jpeg|max:5012',
        ],[
            'contents.required' => '내용은 필수값입니다.',
            'file.max' => '사진은 4장까지 가능합니다.',
            'file.*' => '이미지 파일만 가능하며 5MB 이하여야합니다.',
        ]);

        $input = $request->only(['garden_id','contents','score','calendar_id']);
        $input['user_id'] = auth()->user()->id;
        $id = Review::create($input);
        if($request['file']){
            foreach($request['file'] as $file){
                $file_name = time().'_'.$file->getClientOriginalName();
                $file->move(base_path('/review_file'),$file_name);
                Review_file::create([
                    'review_id' => $id['id'],
                    'file' => $file_name
                ]);
            }
        }

        return back()->with('msg','후기가 등록되었습니다.');

    }
}
