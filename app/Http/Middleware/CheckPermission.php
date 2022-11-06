<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;


class CheckPermission
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle(Request $request, Closure $next, $permission)
    {
        //Lấy role
        $roles = DB::table('users')
            ->join('role_user', 'users.id', '=', 'role_user.user_id')
            ->join('roles', 'roles.id', '=', 'role_user.role_id')
            ->where('users.id', auth()->user()->id)
            ->select('roles.*')
            ->pluck('id')->toArray();
        //Lấy quyền
        $permissionsOfRole = DB::table('roles')
            ->join('permission_role', 'roles.id', '=', 'permission_role.role_id')
            ->join('permissions', 'permissions.id', '=', 'permission_role.permission_id')
            ->whereIn('roles.id', $roles)
            ->select('permissions.*')
            ->pluck('id')->unique();
        //Check DB
        $userPermission = DB::table('permissions')->where('name', $permission)->value('id');
        if( $permissionsOfRole->contains($userPermission) ) {
            return $next($request);
        }
        return abort(401);
    }
}
