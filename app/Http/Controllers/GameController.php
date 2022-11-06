<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Game;

class GameController extends Controller
{
    //
    public function create()
    {
        if (auth()->user()->isRole('student')) {
            return abort(401);
        }
        return view('game.add_game');
    }
    public function store(Request $request)
    {
        if (auth()->user()->isRole('student')) {
            return abort(401);
        }
        $request->validate([
            'game_name' => 'required',
            'game_desc' => 'required',
        ], [
            'game_name.required' => 'Tên bài tập không được để trống',
            'game_desc.required' => 'Mô tả bài tập không được để trống',
        ]);
        $data = [
            'name' => $request->game_name,
            'description' => $request->game_desc,
        ];
        if ($request->hasFile('game_file')) {
            $request->validate([
                'game_file' => 'required|max:2048|mimes:txt',
            ], [
                'game_file.max' => 'File max 2M',
                'game_file.required' => 'File không được bỏ trống',
                'game_file.mimes' => 'File được upload: .txt',
            ]);
            $game = Game::create($data);
            $file = $request->game_file;
            $link = $file->move('upload/game/game-' . $game->id, mb_strtolower($this->convert_name( $file->getClientOriginalName() )));
        };
        if (isset($link)) {
            return redirect('/');
        }
    
    }
    public function show($id)
    {
        $game = Game::find($id);
        return view('game.play_game', compact('game'));
    }
    public function update(Request $request, $id)
    {
        if (auth()->user()->isRole('student')) {
            return abort(401);
        }
        $request->validate([
            'hint' => 'required',
            'content' => 'required',
        ], [
            'hint.required' => 'Gợi ý không được bỏ trống',
            'content.required' => 'Nội dung không được bỏ trống',
        ]);
        $data['description'] = $request->hint;
        $content = $request->content;
        $result = $request->result;
        $temp_files = glob( public_path('upload/game/game-' . $id . '/*.*') );
        foreach ($temp_files as $file) {
            file_put_contents($file, $content);
            rename( $file, mb_strtolower(public_path('upload/game/game-' . $id . '/' . $this->convert_name($result) . '.txt')) );
        }
        Game::where('id', $id)->update($data);
        return redirect('/');
    }
    public function play(Request $request, $id)
    {
        $submit = $this->convert_name($request->play_name);
        $a = public_path('upload/game/game-' . $id . '/' . mb_strtolower($submit) . '.txt');
    
        if ( file_exists( public_path('upload/game/game-' . $id . '/' . mb_strtolower($submit) . '.txt') ) ) {
            $reply = file_get_contents( public_path('upload/game/game-' . $id . '/' . mb_strtolower($submit) . '.txt') );
            return view('game.success_game', compact('reply'));
        }
        $game = Game::find($id);
        return view('game.play_game', [
            'error' => $a,
            'game' => $game,
        ]);
    }
    public function destroy($id)
    {
        if (auth()->user()->isRole('student')) {
            return abort(401);
        }
        Game::where('id', $id)->delete();
        array_map('unlink', glob( public_path('upload/game/game-' . $id . "/*.*") ));
        if (is_dir( public_path('upload/game/game-' . $id ) )) {
            rmdir(public_path('upload/game/game-' . $id ));
        }
        return redirect()->back();
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
