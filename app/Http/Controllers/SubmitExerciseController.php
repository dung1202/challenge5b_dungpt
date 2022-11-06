<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Exercise;
use App\Models\SubmitExercise;

class SubmitExerciseController extends Controller
{
    //
    public function create($id)
    {
        $exercise = Exercise::find($id);
        $exercise->file = json_decode($exercise->file, true);
        return view('submit.add_submit', compact('exercise'));
    }
    public function store(Request $request, $id)
    {
        $request->validate([
            'submit_file' => 'required',
            'submit_file.*' => 'max:2048|mimes:doc,docx,txt,pdf',
        ], [
            'submit_file.required' => 'Chưa chọn file bài tập',
            'submit_file.*.max' => 'File max 2M',
            'submit_file.*.mimes' => 'File được upload: .doc , .docx , .txt , .pdf', 
        ]);
        if($request->hasFile('submit_file')){
            $folderStudent = $this->convert_name(auth()->user()->name);
            $data['file_submit'] = [];
            foreach($request->submit_file as $file){
                $link = $file->move('upload/student/' . $folderStudent, str_replace(' ', '_', $file->getClientOriginalName()));
                $data['file_submit'][] = str_replace('\\', '/', $link -> getPathName());
            }
            $data['file_submit'] = json_encode($data['file_submit']);
        }
        $data['exercise_id'] = $id;
        $data['user_id'] = auth()->user()->id;
        $exerciseNew = SubmitExercise::create($data);
        return redirect('/');
    }

    public function convert_name($str) {
		$str = preg_replace("/(à|á|ạ|ả|ã|â|ầ|ấ|ậ|ẩ|ẫ|ă|ằ|ắ|ặ|ẳ|ẵ)/", 'a', $str);
		$str = preg_replace("/(è|é|ẹ|ẻ|ẽ|ê|ề|ế|ệ|ể|ễ)/", 'e', $str);
		$str = preg_replace("/(ì|í|ị|ỉ|ĩ)/", 'i', $str);
		$str = preg_replace("/(ò|ó|ọ|ỏ|õ|ô|ồ|ố|ộ|ổ|ỗ|ơ|ờ|ớ|ợ|ở|ỡ)/", 'o', $str);
		$str = preg_replace("/(ù|ú|ụ|ủ|ũ|ư|ừ|ứ|ự|ử|ữ)/", 'u', $str);
		$str = preg_replace("/(ỳ|ý|ỵ|ỷ|ỹ)/", 'y', $str);
		$str = preg_replace("/(đ)/", 'd', $str);
		$str = preg_replace("/(À|Á|Ạ|Ả|Ã|Â|Ầ|Ấ|Ậ|Ẩ|Ẫ|Ă|Ằ|Ắ|Ặ|Ẳ|Ẵ)/", 'A', $str);
		$str = preg_replace("/(È|É|Ẹ|Ẻ|Ẽ|Ê|Ề|Ế|Ệ|Ể|Ễ)/", 'E', $str);
		$str = preg_replace("/(Ì|Í|Ị|Ỉ|Ĩ)/", 'I', $str);
		$str = preg_replace("/(Ò|Ó|Ọ|Ỏ|Õ|Ô|Ồ|Ố|Ộ|Ổ|Ỗ|Ơ|Ờ|Ớ|Ợ|Ở|Ỡ)/", 'O', $str);
		$str = preg_replace("/(Ù|Ú|Ụ|Ủ|Ũ|Ư|Ừ|Ứ|Ự|Ử|Ữ)/", 'U', $str);
		$str = preg_replace("/(Ỳ|Ý|Ỵ|Ỷ|Ỹ)/", 'Y', $str);
		$str = preg_replace("/(Đ)/", 'D', $str);
		$str = preg_replace("/(\“|\”|\‘|\’|\,|\!|\&|\;|\@|\#|\%|\~|\`|\=|\_|\'|\]|\[|\}|\{|\)|\(|\+|\^)/", '-', $str);
		$str = preg_replace("/( )/", '-', $str);
		return $str;
	}
}
