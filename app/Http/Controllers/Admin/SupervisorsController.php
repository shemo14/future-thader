<?php

namespace App\Http\Controllers\Admin;

use App\Helpers\UploadFile;
use App\User;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\File;
use Illuminate\Support\Facades\Session;
use Illuminate\Support\Facades\Validator;
use App\Models\SupervisorEmployees;

class SupervisorsController extends Controller
{
    public function index(Request $request){
        $users                  = User::where('role', 2)->get();
        $supervisorEmployees    = SupervisorEmployees::pluck('employee')->toArray();
        return view('dashboard.supervisors.index', compact('users', 'supervisorEmployees'));
    }

    public function addSupervisor(Request $request)
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
            'role'      => 2,
            'password'  => $request['password'],
            'avatar'    => $avatar,
        ]);

        $ip = $request->ip();

        addReport(auth()->user()->id, 'باضافة المشرف جديد', $ip);
        Session::flash('success', 'تم اضافة المشرف بنجاح');
        return back();
    }

    public function updateSupervisor(Request $request)
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
        $user->role     = 2;
        $user->phone    = convert2english($request->edit_phone);
        $user->email    = $request->edit_email;
        $user->save();

        $ip             = $request->ip();

        addReport(auth()->user()->id, 'بتعديل بيانات المشرف', $ip);
        Session::flash('success', 'تم تعديل العضو بنجاح');
        return back();
    }

    public function deleteSupervisor(Request $request)
    {
        User::findOrFail($request->delete_id)->delete();
        addReport(auth()->user()->id, 'بحذف المشرف', $request->ip());
        Session::flash('success', 'تم حذف المشرف بنجاح');
        return back();
    }

    public function deleteSupervisors(Request $request)
    {
        $requestIds = json_decode($request->data);
        foreach ($requestIds as $id) {
            $ids[] = $id->id;
        }
        if (User::whereIn('id', $ids)->delete()) {
            addReport(auth()->user()->id, 'قام بحذف العديد من المشرفين', $request->ip());
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

    public function setEmployees(Request $request){
        $employees = $request['employees'];
        SupervisorEmployees::where('supervisor', $request['supervisor'])->delete();
        foreach ($employees as $employee) {
            $add                = new SupervisorEmployees();
            $add->supervisor    = $request['supervisor'];
            $add->employee      = $employee;
            $add->save();
        }

        $name = User::find($request['supervisor'])->name;

        addReport(auth()->user()->id,  $name . 'تم تعديل قائمة الموظفين لدي المشرف ', $request->ip());
        Session::flash('success', 'تم التعديل بنجاح');
        return back();
    }
}
