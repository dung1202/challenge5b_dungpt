<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Exercise;
use App\Models\SubmitExercise;
use Illuminate\Support\Facades\DB;

class ExerciseController extends Controller
{
    public function create()
    {
        if(auth()->user()->isRole('student')){
            return abort(401);
        }
        $users = User::all();
        $students = new \Illuminate\Database\Eloquent\Collection([]);
        foreach ($users as $user) {
            if($user->isRole('student')) {
                $students->push($user);
            }
        }
        return view('exercise.add_exercise', compact('students'));
    }
    public function store(Request $request)
    {
        if(auth()->user()->isRole('student')){
            return abort(401);
        }

            $request->validate([
                'exercise_name' => 'required',
                'description' => 'required',
                'exercise_file' => 'required',
                'exercise_file.*' => 'max:2048|mimes:doc,docx,txt,pdf',
            ], [
                'exercise_name.required' => 'Tên bài tập không được để trống',
                'description.required' => 'Mô tả bài tập không được để trống',
                'exercise_file.required' => 'Chưa chọn file bài tập',
                'exercise_file.*.max' => 'File max 2M',
                'exercise_file.*.mimes' => 'File được upload: .doc , .docx , .txt , .pdf',
            ]);
            $data = [
                'name' => $request->exercise_name,
                'description' => $request->description,
            ];
            if ($request->hasFile('exercise_file')) {
                $files = $request->exercise_file;

                $folderTeacher = $this->convert_name(auth()->user()->name);
                $data['file'] = [];
                foreach ($files as $file) {
                    $link = $file->move('upload/teacher/' . $folderTeacher, str_replace(' ', '_', $file->getClientOriginalName()));
                    $data['file'][] = str_replace('\\', '/', $link -> getPathName());
                }
                $data['file'] = json_encode($data['file']);
            };
            DB::beginTransaction();
            $exerciseNew = Exercise::create($data);
            $exerciseNew->users()->attach($request->students);
            DB::commit();
            return redirect('/');
  
    }
    public function show($id)
    {
        if(auth()->user()->isRole('student')){
            return abort(401);
        }
        $exercise = Exercise::find($id);
        $exercise->file = json_decode($exercise->file, true);
        $submits = $exercise->submitExercises()->get();
        return view('exercise.show_exercise', compact('exercise', 'submits'));
    }
    public function edit($id)
    {
        if(auth()->user()->isRole('student')){
            return abort(401);
        }
        $exercise = Exercise::find($id);
        $exercise->file = json_decode($exercise->file, true);
        $users = User::all();
        $students = new \Illuminate\Database\Eloquent\Collection([]);
        foreach ($users as $user) {
            if($user->isRole('student')) {
                $students->push($user);
            }
        };
        $studentsExercise = DB::table('exercise_user')->where('exercise_id', $id)->pluck('user_id');
        return view('exercise.edit_exercise', compact('exercise', 'students', 'studentsExercise'));
    }
    public function update(Request $request, $id)
    {
        if(auth()->user()->isRole('student')){
            return abort(401);
        }

            $request->validate([
                'exercise_name' => 'required',
                'description' => 'required',
            ], [
                'exercise_name.required' => 'Tên bài tập không được để trống',
                'description.required' => 'Mô tả bài tập không được để trống',
            ]);
            $data = [
                'name' => $request->exercise_name,
                'description' => $request->description,
            ];
            if ($request->hasFile('exercise_file')) {
                $request->validate([
                    'exercise_file.*' => 'max:2048|mimes:doc,docx,txt,pdf',
                ], [
                    'exercise_file.*.max' => 'File max 2M',
                    'exercise_file.*.mimes' => 'File được upload: .doc , .docx , .txt , .pdf',
                ]);
                $files = $request->exercise_file;
                $folderTeacher = $this->convert_name(auth()->user()->name);
                $data['file'] = [];
                foreach ($files as $file) {
                    $link = $file->move('upload/teacher/' . $folderTeacher, str_replace(' ', '_', $file->getClientOriginalName()));
                    $data['file'][] = str_replace('\\', '/', $link -> getPathName());
                }
                $data['file'] = json_encode($data['file']);
            };
            DB::beginTransaction();
            Exercise::where('id', $id)->update($data);
            DB::table('exercise_user')->where('exercise_id', $id)->delete();
            $exerciseNew = Exercise::find($id);
            $exerciseNew->users()->attach($request->students);
            DB::commit();
            return redirect('/');
 
    }
    public function destroy($id)
    {
        if(auth()->user()->isRole('student')){
            return abort(401);
        }

            DB::beginTransaction();
            $exerciseNew = Exercise::find($id);
            $exerciseNew->delete();
            $exerciseNew->users()->detach();
            DB::commit();
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
