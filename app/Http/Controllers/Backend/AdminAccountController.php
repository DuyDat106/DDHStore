<?php

namespace App\Http\Controllers\Backend;

use App\Http\Controllers\Controller;
use App\Http\Requests\UserRequest;
use App\Mail\SendEmailRegisterUser;
use App\Models\Admin;
use App\Models\User;
use App\Models\UserHasType;
use App\Models\UserType;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Mail;
use Spatie\Permission\Models\Role;

class AdminAccountController extends Controller
{
    public function index(Request $request)
    {
        $users = Admin::whereRaw(1);
        if ($n = $request->n) $users->where('name', 'like', '%' . $n . '%');

        $users = $users->orderByDesc('id')
            ->paginate(20);

        $viewData = [
            'users' => $users,
            'query' => $request->query()
        ];

        return view('backend.account.index', $viewData);
    }

    public function create()
    {
        $roles      = Role::all();
        $roleActive = $userHasType = [];

        return view('backend.account.create', compact( 'roles', 'roleActive', 'userHasType'));
    }

    public function store(Request $request)
    {
        try {
            $data                      = $request->except('_token', 'avatar', 'user_type', 'roles');
            $data['created_at']        = Carbon::now();
            $data['email_verified_at'] = Carbon::now();
            $data['password']          = bcrypt($request->password);
            $data['status']            = $request->status ?? 1;

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }

            $user = Admin::create($data);
            if ($user) {
                if ($request->roles)
                    $user->assignRole($request->roles);
            }
        } catch (\Exception $exception) {
            toastr()->error('Thêm mới thất bại!', 'Thông báo');
            Log::error("ERROR => UserController@store => " . $exception->getMessage());
            return redirect()->back();
        }

        toastr()->success('Thêm mới thành công!', 'Thông báo');
        return redirect()->route('get_admin.account_admin.index');
    }

    public function edit($id)
    {
        $user        = Admin::findOrFail($id);
        $roles       = Role::all();
        $roleActive  = DB::table('model_has_roles')->where('model_id', $id)->pluck('role_id')->toArray();
        return view('backend.account.update', compact('user', 'roles', 'roleActive'));
    }


    public function update(Request $request, $id)
    {
        try {
            $data               = $request->except('_token', 'avatar', 'user_type', 'roles');
            $data['updated_at'] = Carbon::now();

            if ($request->avatar) {
                $file = upload_image('avatar');
                if (isset($file['code']) && $file['code'] == 1) $data['avatar'] = $file['name'];
            }
            if ($request->password) $data['password'] = bcrypt($request->password);
            $update = Admin::find($id)->update($data);
            if ($update) {
                $user = Admin::find($id);

                if ($request->roles) {
                    $roleActive = DB::table('model_has_roles')->where('model_id', $id)->pluck('role_id')->toArray();
                    if (!empty($roleActive)) {
                        foreach ($roleActive as $item)
                            $user->removeRole($item);
                    }

                    $user->assignRole($request->roles);
                }

            }
        } catch (\Exception $exception) {
            Log::error("ERROR => UserController@store => " . $exception->getMessage());
            toastr()->error('Update thất bại!', 'Thông báo');
            return redirect()->route('get_admin.account_admin.update', $id);
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.account_admin.index');
    }

    public function delete(Request $request, $id)
    {
        try {
            $user = Admin::findOrFail($id);
            if ($user) {
                $user->delete();
            }

        } catch (\Exception $exception) {
            toastr()->error('Update thất bại!', 'Thông báo');
            Log::error("ERROR => UserController@delete => " . $exception->getMessage());
            return redirect()->route('get_admin.account_admin.index');
        }

        toastr()->success('Update thành công!', 'Thông báo');
        return redirect()->route('get_admin.account_admin.index');
    }
}
