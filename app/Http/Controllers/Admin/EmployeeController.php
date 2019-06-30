<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\User;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;

class EmployeeController extends Controller
{
    public function index(Request $request){
        $employees = User::where('role', 3)->get();
        return view('dashboard.employees.index', compact('employees'));
    }

    public function addEmployee(Request $request)
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
            'role'      => 3,
            'password'  => bcrypt($request['password']),
            'avatar'    => $avatar,
        ]);

        $ip = $request->ip();

        addReport(auth()->user()->id, 'باضافة عضو جديد', $ip);
        Session::flash('success', 'تم اضافة العضو بنجاح');
        return back();
    }

    public function updateEmployee(Request $request)
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
        $user->role     = 3;
        $user->phone    = convert2english($request->edit_phone);
        $user->email    = $request->edit_email;
        $user->save();

        $ip             = $request->ip();

        addReport(auth()->user()->id, 'بتعديل بيانات العضو', $ip);
        Session::flash('success', 'تم تعديل العضو بنجاح');
        return back();
    }

    public function deleteEmployee(Request $request)
    {
        User::findOrFail($request->delete_id)->delete();
        addReport(auth()->user()->id, 'بحذف العضو', $request->ip());
        Session::flash('success', 'تم حذف العضو بنجاح');
        return back();
    }

    public function deleteEmployees(Request $request)
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
