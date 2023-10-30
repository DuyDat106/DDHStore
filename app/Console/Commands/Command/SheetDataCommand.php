<?php

namespace App\Console\Commands\Command;

use App\Models\Admin;
use Carbon\Carbon;
use Illuminate\Console\Command;
use Illuminate\Support\Facades\DB;
use Spatie\Permission\Models\Permission;
use Spatie\Permission\Models\Role;

class SheetDataCommand extends Command
{
    /**
     * The name and signature of the console command.
     *
     * @var string
     */
    protected $signature = 'permission:init';

    /**
     * The console command description.
     *
     * @var string
     */
    protected $description = 'Command description';

    /**
     * Create a new command instance.
     *
     * @return void
     */
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * Execute the console command.
     *
     * @return int
     */
    public function handle()
    {
        DB::statement('SET FOREIGN_KEY_CHECKS=0;');
        DB::table('model_has_permissions')->truncate();
        DB::table('model_has_roles')->truncate();
        DB::table('role_has_permissions')->truncate();
        DB::table('roles')->truncate();
        DB::table('permissions')->truncate();
        DB::statement('SET FOREIGN_KEY_CHECKS=1;');
        $permissions = json_decode(file_get_contents(public_path('permission.json')), true);
        foreach ($permissions as $permission) {
            $permissionData = Permission::where('name', $permission['name'])->first();
            if (!$permissionData) {
                $permissionData = Permission::create($permission);
            }
        }

        $roles = [
            [
                'id' => 1,
                'description' => 'Toàn quyền',
                'name' => 'Supper Admin',
                'guard_name' => 'admins',
            ]
        ];

        foreach ($roles as $role) {
            $role['created_at'] = Carbon::now();
            $roleData = Role::create($role);

            $roleData->givePermissionTo([1]);
        }

        $admins = [
            [
                'name' => 'Admin',
                'email' => 'doantotnghiep@gmail.com',
                'phone' => '0986420994',
                'password' => bcrypt('123456789')
            ]
        ];

        foreach ($admins as $item) {

            $user = Admin::where('email', $item['email'])->first();
            if (!$user) {
                $user = Admin::create($item);
            }

            $user->assignRole([1]);
        }
    }
}
