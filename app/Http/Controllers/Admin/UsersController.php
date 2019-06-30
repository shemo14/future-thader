<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\Models\Role;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class UsersController extends Controller
{
    // ============= Users ==============

    /**
     * All Users
     *
     * @param User $user
     * @param Role $role
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     *          view => dashboard/users/index.blade.php
     */
    public function index(User $user, Role $role)
    {
        $users = $user->latest()->get();
        $roles = $role->latest()->get();
        return view('dashboard.users.index', compact('users', 'roles'));
    }

    /**
     * Add new User
     *
     * @param Request $request
     * @return \Illuminate\Http\RedirectResponse
     */
    public function store(Request $request)
    {
        // Validation rules
        $rules = [
            'name'      => 'required|min:2|max:190',
            'phone'     => 'required|unique:users,phone',
            'email'     => 'required|email|unique:users,email',
            'password'  => 'required',
            'avatar'    => 'nullable|image'
        ];
        // Validation
        $validator = validator($request->all(), $rules);

        // If failed
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }
        if ($request->hasFile('avatar')) {
            $avatar = UploadFile::uploadImage($request->file('avatar'), 'users');
        } else {
            $avatar = 'default.png';
        }

        // Save User
        User::create([
            'name'      => $request['name'],
            'phone'     => convert2english($request['phone']),
            'email'     => $request['email'],
            'role'      => $request['role'],
            'password'  => bcrypt($request['password']),
            'avatar'    => $avatar,
        ]);

        $ip = $request->ip();

        addReport(auth()->user()->id, 'باضافة عضو جديد', $ip);
        Session::flash('success', 'تم اضافة العضو بنجاح');
        return back();
    }

    public function update(Request $request)
    {

        // Validation rules
        $rules = [
            'edit_name'     => 'required|min:2|max:190',
            'edit_phone'    => 'required|unique:users,phone,' . $request->id,
            'edit_email'    => 'required|email|unique:users,email,' . $request->id,
            'avatar'        => 'nullable'
        ];

        // Validation
        $validator = Validator::make($request->all(), $rules);

        // If failed
        if ($validator->fails()) {
            return back()->withErrors($validator);
        }

        $user = User::findOrFail($request->id);

        if ($request->has('avatar')) {
            if ($user->avatar != 'default.png') {
                File::delete(public_path('images/users/' . $user->avatar));
            }

            $user->avatar = UploadFile::uploadImage($request->file('avatar'), 'users');
        }
        if (isset($request->password) || $request->password != null) {
            $user->password = bcrypt($request->password);
        }

        $user->name     = $request->edit_name;
        $user->lat      = $request->edit_lat;
        $user->role     = $request->edit_role;
        $user->phone    = convert2english($request->edit_phone);
        $user->email    = $request->edit_email;
        $user->save();

        $ip             = $request->ip();

        addReport(auth()->user()->id, 'بتعديل بيانات العضو', $ip);
        Session::flash('success', 'تم تعديل العضو بنجاح');
        return back();
    }

    public function delete(Request $request)
    {
        User::findOrFail($request->delete_id)->delete();
        addReport(auth()->user()->id, 'بحذف العضو', $request->ip());
        Session::flash('success', 'تم حذف العضو بنجاح');
        return back();
    }

    public function deleteAll(Request $request)
    {
        $requestIds = json_decode($request->data);
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (User::whereIn('id', $ids)->delete()) {
            addReport(auth()->user()->id, 'قام بحذف العديد من الاعضاء', $request->ip());
            Session::flash('success', 'تم الحذف بنجاح');
            return response()->json('success');
        } else {
            return response()->json('failed');
        }
    }

    public function sendNotify(Request $request)
    {
        addReport(auth()->user()->id, 'قام بارسال اشعار', $request->ip());
        Session::flash('success', 'تم الارسال بنجاح');
        return back();
    }
}
