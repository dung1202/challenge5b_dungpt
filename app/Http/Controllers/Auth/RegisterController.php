<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use App\Models\User;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
// use DB;

class RegisterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('auth.register');
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
        $data = $request->all();
        unset($data['_token']);
        $data['password'] = bcrypt($data['password']);
        $request->validate([
            'name' => 'required|max:255',
            'email' => 'required|email|max:255|unique:users',
            'username' => 'required|max:16|unique:users',
            'password' => 'required|min:6|confirmed',
            'gender' => 'required',
            'sdt' => 'required|regex:/(0)[0-9]{9}/|unique:users'
        ], [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá dài',
            'email.required' => 'Email không được để trống',
            'email.email' => 'Email không đúng định dạng',
            'email.max' => 'Email không được quá dài',
            'email.unique' => 'Email đã được sử dụng',
            'username.required' => 'Username không được để trống',
            'username.max' => 'Username không được quá dài',
            'username.unique' => 'Username đã tồn tại',
            'password.required' => 'Password không được để trống',
            'password.min' => 'Password phải dài hơn 6 ký tự',
            'password.confirmed' => 'Password không trùng nhau',
            'gender.required' => 'Giới tính chưa chọn',
            'sdt.required' => 'Sđt không được để trống',
            'sdt.regex' => 'Sđt không đúng định dạng',
            'sdt.unique' => 'Sdt đã được sử dụng',
        ]);
        
            DB::beginTransaction();
            $user = User::create($data);
            $user->roles()->attach(12);
            DB::commit();
            Auth::login($user);
            return redirect('/');
         
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
