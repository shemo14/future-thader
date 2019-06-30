<?php

use Illuminate\Support\Facades\Route;
use App\User;
use App\Models\Role;
//use App\Html;
//use App\Contact;
//use App\SmsEmailNotification;
use App\Models\Permission;
use App\Models\Report;
use App\Models\SupervisorEmployees;

function Home()
{
	
    $colors = [
        '#8cc759','#8c6daf','#ef5d74','#f9a74b','#60beeb','#fbef5a','#FC600A','#0247FE','#FCCB1A',
        '#EA202C','#448D76','#AE0D7A','#7FBD32','#FD4D0C','#66B032','#091534','#8601AF','#C21460',
        '#FFA500','#800080','#008000','#964B00','#D2B48C','#f5f5dc','#4281A4','#48A9A6',
    ];
    $home =[
        [
        'name'=>'الاعضاء',
        'count'=>User::count() -1,
        'icon'=>'<i style="font-size: 90px;" class="fa fa-users"></i>',
        'color'=>$colors[array_rand($colors)],
        ],
        [
            'name'=>'المشرفين',
            'count'=>User::where('role', '>', 0)->count(),
            'icon'=>'<i style="font-size: 90px;" class="fa fa-user-circle"></i>',
            'color'=>$colors[array_rand($colors)],
        ],
        [
            'name'=>'التقارير',
            'count'=>Report::count(),
            'icon'=>'<i style="font-size: 90px" class="fa fa-flag-checkered"></i>',
            'color'=>$colors[array_rand($colors)],
        ],
    ];

    return $blocks[]=$home; 
}

#role name
function Role()
{
    $role = Role::findOrFail(Auth::user()->role);
    if(count($role) > 0)
    {
        return $role->role;
    }else{
        return 'عضو';
    }
}

function reports () {
    $reports = Report::orderBy('id', 'desc')->take(8)->get();

    return $reports;
}
#report
function addReport($user_id,$event, $ip)
{
    if ($ip == "127.0.0.1") {
        $ip = "".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255).".".mt_rand(0,255);
    }

    $location = \Location::get($ip);
	$report = new Report;
	$user = User::findOrFail($user_id);
    if($user->role > 0)
    {
        $report->user_id = $user->id;
        $report->event   = 'قام '.$user->name .' '.$event;
        $report->supervisor = 1;
        $report->ip = $ip;
        $report->country = ($location->countryCode != null) ? $location->countryCode : '';
        $report->area = ($location->regionName != null) ? $location->regionName : '';
        $report->city = ($location->cityName != null) ? $location->cityName : '';
        $report->save();
    }else
    {
        $report->user_id = $user->id;
        $report->event   = 'قام '.$user->name .' '.$event;
        $report->supervisor = 0;
        $report->ip = $ip;
        $report->country = ($location->countryName != null) ? $location->countryName : 'localhost';
        $report->area = ($location->regionName != null) ? $location->regionName : 'localhost';
        $report->city = ($location->cityName != null) ? $location->cityName : 'localhost';
        $report->save();
    }

}

#current route
function currentRoute()
{
    $routes = Route::getRoutes();
    foreach ($routes as $value)
    {
        if($value->getName() === Route::currentRouteName()) 
        {
            echo $value->getAction()['title'] ;
        }
    }
}

function convert2english($string) {
    $newNumbers = range(0, 9);
    $arabic = array('٠', '١', '٢', '٣', '٤', '٥', '٦', '٧', '٨', '٩');
    $string =  str_replace($arabic, $newNumbers, $string);
    return $string;
}

function is_unique($key,$value){
    $user                = User::where($key , $value)->first();
    if(  $user   )
    {
        return 1;
    }
    return 0;
}

function generate_code() {
    $characters = '0123456789';
    $charactersLength = strlen($characters);
    $token = '';
    $length = 6;
    for ($i = 0; $i < $length; $i++) {
        $token .= $characters[rand(0, $charactersLength - 1)];
    }
    return $token;
}

function appPath() {
    return url('/');
}

function settings($key)
{
    return \App\Models\AppSetting::where('key', $key)->first()->value;
}

function employees($id){
    $employeesIds = SupervisorEmployees::where('supervisor', '!=', $id)->distinct()->get(['employee']);
    $users        = User::where('role', 3)->whereNotIn('id', $employeesIds)->get();
    return $users;
}