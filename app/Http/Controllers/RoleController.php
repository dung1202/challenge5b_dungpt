<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Role;
use App\Models\Permission;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;



class RoleController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        $roles = Role::all();
        return view('block.view_role', compact('roles'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
        $permissions = Permission::all();
        return view('block.add_role', compact('permissions'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     * 
     */
    public function store(Request $request)
    {
        //
        $data = [
            'name' => $request->name,
            'display_name' => $request->display_name,
        ];
        $request->validate([
            'name' => 'required|max:255',
            'display_name' => 'required|max:255',
        ], [
            'name.required' => 'Tên không được để trống',
            'name.max' => 'Tên không được quá dài',
            'display_name.required' => 'Tên hiển thị không được để trống',
            'display_name.max' => 'Tên hiển thị không được quá dài',
        ]);
       
            DB::beginTransaction();
            $role = Role::create($data);
            $role->permissions()->attach($request->permissions);
            DB::commit();
            return redirect('role');
        
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
        $role = Role::findOrFail($id);
        $permissions = Permission::all();
        $listPermissionsOfRole = $permissions->pluck('id');
        $listPermissions = DB::table('permission_role')->where('role_id', $id)->pluck('permission_id');
        return view('block.edit_role', compact('role', 'permissions', 'listPermissions', 'listPermissionsOfRole'));
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

            DB::beginTransaction();
            Role::where('id', $id)->update([
                'name' => $request->name,
                'display_name' => $request->display_name,
            ]);
            DB::table('permission_role')->where('role_id', $id)->delete();
            $roleUpdate = Role::find($id);
            $roleUpdate->permissions()->attach($request->permissions);
            DB::commit();
            return redirect('role');
       
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
     
            DB::beginTransaction();
            $role = Role::find($id);
            $role->delete();
            $role->permissions()->detach();
            DB::commit();
            return redirect('role');
      
    }
}
