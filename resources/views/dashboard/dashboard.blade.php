@extends('dashboard.index')
@section('title')
الرئيسية
@endsection
@section('content')

    <div class="row">

        <div class="col-lg-4 col-xs-6">
            <div class="small-box smallBoxCustom bg-aqua">
                <div class="inner">
                    <h3>{{$users}}</h3>
                    <p> عدد المستخدمين</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user"></i>
                </div>
                <a href="{{route('users')}}" class="small-box-footer"> الذهاب <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>

        <div class="col-lg-4 col-xs-6">
            <div class="small-box smallBoxCustom bg-red">
                <div class="inner">
                    <h3>{{$admins}}</h3>
                    <p> عدد المشرفين</p>
                </div>
                <div class="icon">
                    <i class="fa fa-user-secret"></i>
                </div>
                <a href="{{route('admins')}}" class="small-box-footer"> الذهاب <i class="fa fa-arrow-circle-left"></i></a>
            </div>
        </div>


    </div>

@endsection