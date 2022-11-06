<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class UserSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        //
        DB::table('users')->insert([
            [
                'username' => 'teacher1',
                'email' => 'teacher1@gmail.com',
                'password' => bcrypt('123456a@A'),
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'Pham Van Khanh',
                'sdt' => '01234356789',
                'avatar' => 'auto.png',
                'gender' => 1
            ],
            [
                'username' => 'teacher2',
                'email' => 'teacher2@gmail.com',
                'password' => bcrypt('123456a@A'),
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'Nguyen Xuan Hoang',
                'sdt' => '0987654321',
                'avatar' => 'auto.png',
                'gender' => 1
            ],
            [
                'username' => 'student1',
                'email' => 'student1@gmail.com',
                'password' => bcrypt('123456a@A'),
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'Pham Tien Dung',
                'avatar' => 'auto.png',
                'sdt' => '0734858939',
                'gender' => 0
            ],
            [
                'username' => 'student2',
                'email' => 'student2@gmail.com',
                'password' => bcrypt('123456a@A'),
                'created_at' => now(),
                'updated_at' => now(),
                'name' => 'Nguyen Van Xuan',
                'avatar' => 'auto.png',
                'sdt' => '0135792468',
                'gender' => 0
            ],
        ]);
        
        DB::table('permissions')->insert([
            [
                'name' => 'view_role',
                'display_name' => 'Danh sách vai trò',
            ],
            [
                'name' => 'add_role',
                'display_name' => 'Thêm vai trò',
            ],
            [
                'name' => 'edit_role',
                'display_name' => 'Sửa vai trò',
            ],
            [
                'name' => 'delete_role',
                'display_name' => 'Xoá vai trò',
            ],
            [
                'name' => 'view_user',
                'display_name' => 'Danh sách user',
            ],
            [
                'name' => 'add_user',
                'display_name' => 'Thêm user',
            ],
            [
                'name' => 'edit_user',
                'display_name' => 'Sửa user',
            ],
            [
                'name' => 'delete_user',
                'display_name' => 'Xoá user',
            ],
        ]);
        
        DB::table('roles')->insert([
            [
                'name' => 'admin',
                'display_name' => 'admin',
            ],
            [
                'name' => 'teacher',
                'display_name' => 'Giáo viên',
            ],
            [
                'name' => 'student',
                'display_name' => 'Học sinh',
            ],
        ]);
        DB::table('role_user')->insert([
            [
                'role_id' => 2,
                'user_id' => 1,
            ],
            [
                'role_id' => 2,
                'user_id' => 2,
            ],
            [
                'role_id' => 3,
                'user_id' => 3,
            ],
            [
                'role_id' => 3,
                'user_id' => 4,
            ],
        ]);
        DB::table('permission_role')->insert([
            ['permission_id' => 1, 'role_id' => 1],
            ['permission_id' => 2, 'role_id' => 1],
            ['permission_id' => 3, 'role_id' => 1],
            ['permission_id' => 4, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 1],
            ['permission_id' => 6, 'role_id' => 1],
            ['permission_id' => 7, 'role_id' => 1],
            ['permission_id' => 8, 'role_id' => 1],
            ['permission_id' => 5, 'role_id' => 2],
            ['permission_id' => 6, 'role_id' => 2],
            ['permission_id' => 7, 'role_id' => 2],
            ['permission_id' => 8, 'role_id' => 2],
        ]);
    }
}
