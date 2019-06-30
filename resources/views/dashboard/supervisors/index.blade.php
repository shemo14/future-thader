@section('styles')
@endsection

@extends('dashboard.index')
@section('title')
    المشرفين
@endsection
@section('content')

    <div class="btn-group btn-group-justified m-b-10">
        <a href="#add" class="btn btn-success waves-effect btn-lg waves-light" data-animation="fadein" data-plugin="custommodal"
            data-overlaySpeed="100" data-overlayColor="#36404a">اضافة مشرف <i class="fa fa-plus"></i> </a>
        <a href="#deleteAll" class="btn btn-danger waves-effect btn-lg waves-light delete-all" data-animation="blur" data-plugin="custommodal"
            data-overlaySpeed="100" data-overlayColor="#36404a">حذف المحدد <i class="fa fa-trash"></i> </a>
        <a class="btn btn-primary waves-effect btn-lg waves-light" onclick="window.location.reload()" role="button">تحديث الصفحة <i class="fa fa-refresh"></i> </a>
    </div>

    <div class="row">

        <div class="col-sm-12">
            <div class="card-box table-responsive boxes">

                <table id="datatable" class="table table-bordered table-responsives">
                    <thead>
                    <tr>
                        <th>
                            <label class="custom-control material-checkbox" style="margin: auto">
                                <input type="checkbox" class="material-control-input" id="checkedAll">
                                <span class="material-control-indicator"></span>
                            </label>
                        </th>
                        <th>الصورة</th>
                        <th>الاسم</th>
                        <th>البريد</th>
                        <th>رقم الهاتف</th>
                        <th>الصلاحية</th>
                        <th>الحالة</th>
                        <th>التفعيل</th>
                        <th>التاريخ</th>
                        <th>التحكم</th>
                    </tr>
                    </thead>
                    <tbody class="text-center">
                    @foreach($users as $user)
                        <tr>
                            <td>
                                <label class="custom-control material-checkbox" style="margin: auto">
                                    <input type="checkbox" class="material-control-input checkSingle" id="{{$user->id}}">
                                    <span class="material-control-indicator"></span>
                                </label>
                            </td>
                            <td><img src="{{appPath()}}/images/users/{{$user->avatar}}" alt="user-img" width="60px" title="Mat Helme" class="img-circle img-thumbnail img-responsive"></td>
                            <td>{{$user->name}}</td>
                            <td>{{$user->email}}</td>
                            <td>{{$user->phone}}</td>
                            <td>{{$user->Role->role}}</td>
                            <td>
                                @if($user->active == 0)
                                    <span class="label label-danger">غير متصل</span>
                                @else
                                    <span class="label label-success">متصل</span>
                                @endif
                            </td>
                            <td>
                                @if($user->checked == 0)
                                    <span class="label label-danger">غير نشط</span>
                                @else
                                    <span class="label label-success">نشط</span>
                                @endif
                            </td>
                            <td>{{$user->created_at->diffForHumans()}}</td>
                            <td>
                                <div class="btn-group" role="group" aria-label="Basic example">
                                    <a class="edit btn btn-success" data-toggle="modal" data-target="#edit_{{ $user->id }}">
                                        <i class="fa fa-cogs"></i>
                                    </a>
                                    <a href="#contact" class="contact btn btn-warning" style="color: #79c842; font-weight: bold;" data-animation="sign" data-plugin="custommodal"
                                               data-overlaySpeed="100" data-overlayColor="#36404a"
                                               data-user_id = "{{$user->id}}"
                                            > <i class="fa fa-comment" style="margin-left: 3px;"></i> </a>
                                    <a href="#delete" class="delete btn btn-danger" data-animation="blur" data-plugin="custommodal"
                                        data-overlaySpeed="100" data-overlayColor="#36404a"
                                        data-id = "{{$user->id}}"
                                    >
                                        <i class="fa fa-trash"></i>
                                    </a>
                                </div>
                            </td>
                        </tr>

                        <!-- edit user modal -->
                        <div id="edit_{{ $user->id }}" class="modal fade">
                            <div class="modal-dialog">
                                <h4 class="custom-modal-title" style="background-color: #36404a">
                                    تعديل <span > {{ $user->name }} </span>
                                </h4>

                                <div class="card-box card-tabs">
                                    <ul class="nav nav-pills pull-right" style="width: 100%">
                                        <li class="active" style="width: 49%">
                                            <a href="#editSupervisor_{{ $user->id }}" data-toggle="tab" aria-expanded="true">تعديل الشرف</a>
                                        </li>
                                        <li class="" style="width: 49%">
                                            <a href="#supervisorEmployees_{{ $user->id }}" data-toggle="tab" aria-expanded="true">اضافة موظفين</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div id="editSupervisor_{{ $user->id }}" class="tab-pane fade in active">
                                            <form action="{{route('updateSupervisor')}}" method="post" autocomplete="off" enctype="multipart/form-data" style="margin-top: 30px">
                                                {{csrf_field()}}
                                                <input type="hidden" name="id" value="{{ $user->id }}">
                                                <div class="modal-body">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-1" class="control-label">الاسم</label>
                                                                <input type="text" autocomplete="nope" name="edit_name" value="{{ $user->name }}" required class="form-control" placeholder="اسم المشرف">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-2" class="control-label">رقم الهاتف</label>
                                                                <input type="text" autocomplete="nope" name="edit_phone" value="{{ $user->phone }}" required class="phone form-control" id="phone" placeholder="رقم الهاتف">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">البريد الالكتروني</label>
                                                                <input type="email" autocomplete="nope" name="edit_email" value="{{ $user->phone }}" required class="form-control" placeholder="email@exmaple.com">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="field-3" class="control-label">كلمة السر</label>
                                                                <input type="password" autocomplete="nope" name="password" class="form-control">
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <div class="row" style="margin-top: 15px;">
                                                        <div class="col-md-12">
                                                            <div class="form-group">
                                                                <div class="col-sm-12">
                                                                    <label class="col-sm-4 control-label">الصورة الشخصية</label>
                                                                    <input type="file" name="avatar" class="dropify" data-max-file-size="1M">
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">تعديل</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
                                                </div>
                                            </form>
                                        </div>
                                        <div id="supervisorEmployees_{{ $user->id }}" class="tab-pane fade">
                                            <form action="{{ route('setEmployees') }}" method="post" style="margin-top: 50px">
                                                {{ csrf_field() }}
                                                <input type="hidden" name="supervisor" value="{{ $user->id }}">
                                                <div class="row">
                                                    @foreach(employees($user->id) as $employee)
                                                        <div class="col-sm-6" style="background-color: #eee; border-radius: 6px; border: 1px solid #ddd; margin: 5px; width: 46%;">
                                                            <h5 style="display: inline-block"> {{ $employee->name }}</h5>
                                                            <div style="display: inline-block; position: absolute; left: 15px !important; top: 8px !important;">
                                                                <label class="custom-control material-checkbox" for="employee_{{ $user->id . '_' . $employee->id }}">
                                                                    <input type="checkbox" {{ in_array($employee->id, $supervisorEmployees) ? 'checked' : '' }} class="pull-right material-control-input checkSingle" name="employees[]" id="employee_{{ $user->id . '_' . $employee->id }}" value="{{ $employee->id }}" data-size="small" data-color="rgb(12, 105, 140)"/>
                                                                    <span class="material-control-indicator "></span>
                                                                </label>
                                                            </div>
                                                        </div>
                                                    @endforeach
                                                </div>
                                                <div class="modal-footer">
                                                    <button type="submit" class="btn btn-success waves-effect waves-light">تعديل</button>
                                                    <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
                                                </div>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    @endforeach
                    </tbody>
                </table>
            </div>
        </div><!-- end col -->

    </div>

    <!-- add user modal -->
    <div id="add" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">
            اضافة مشرف
        </h4>
        <form action="{{route('addSupervisor')}}" method="post" autocomplete="off" enctype="multipart/form-data">
            {{csrf_field()}}
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-1" class="control-label">الاسم</label>
                            <input type="text" autocomplete="nope" name="name" required class="form-control" placeholder="اسم المشرف">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-2" class="control-label">رقم الهاتف</label>
                            <input type="text" autocomplete="nope" name="phone" required class="form-control phone" placeholder="رقم الهاتف">
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">البريد الالكتروني</label>
                            <input type="email" autocomplete="nope" name="email" required class="form-control" placeholder="email@exmaple.com">
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group">
                            <label for="field-3" class="control-label">كلمة السر</label>
                            <input type="password" autocomplete="nope" name="password" required class="form-control">
                        </div>
                    </div>
                </div>

                <div class="row" style="margin-top: 15px;">
                    <div class="col-md-12">
                        <div class="form-group">
                            <div class="col-sm-12">
                                <label class="col-sm-4 control-label">الصورة الشخصية</label>
                                <input type="file" name="avatar" class="dropify" data-max-file-size="1M">
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-success waves-effect waves-light">اضافة</button>
                <button type="button" class="btn btn-danger waves-effect" data-dismiss="modal" onclick="Custombox.close();">رجوع</button>
            </div>
        </form>
    </div>

    <!-- contact user modal -->
    <div id="contact" class="modal-demo">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title" style="background-color: #36404a">التواصل مع المشرف</h4>
        <div class="modal-content p-0">
            <ul class="nav nav-tabs navtab-bg nav-justified">
                <li class="active">
                    <a href="#email" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-home"></i></span>
                        <span class="hidden-xs">بريد</span>
                    </a>
                </li>
                <li class="">
                    <a href="#sms" data-toggle="tab" aria-expanded="false">
                        <span class="visible-xs"><i class="fa fa-user"></i></span>
                        <span class="hidden-xs">رسالة SMS</span>
                    </a>
                </li>
                <li class="">
                    <a href="#notify" data-toggle="tab" aria-expanded="true">
                        <span class="visible-xs"><i class="fa fa-envelope-o"></i></span>
                        <span class="hidden-xs">اشعار</span>
                    </a>
                </li>
            </ul>
            <div class="tab-content">
                <div class="tab-pane active" id="email">
                    <div>
                        <form action="">
                            <textarea class="form-control" rows="15" placeholder="نص رسالة البريد الإلكتروني"></textarea>
                            <button type="button" class="btn btn-success btn-block btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">ارسال</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="sms">
                    <div>
                        <form action="">
                            <textarea class="form-control" rows="15" placeholder="نص رسالة الـ SMS"></textarea>
                            <button type="button" class="btn btn-success btn-block btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">ارسال</button>
                        </form>
                    </div>
                </div>
                <div class="tab-pane" id="notify">
                    <div>
                        <form action="{{route('send-fcm')}}" method="post">
                            {{csrf_field()}}
                            <input type="hidden" name="user_id" value="">
                            <textarea id="textarea" class="form-control" rows="15" name="message" placeholder="نص الاشعار"></textarea>
                            <button type="submit" class="btn btn-success btn-block btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">ارسال</button>
                        </form>
                    </div>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

    <div id="delete" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف المشرف</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <form action="{{route('deleteSupervisor')}}" method="post">
                        {{csrf_field()}}
                        <input type="hidden" name="delete_id" value="">
                        <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5" style="margin-top: 19px">حـذف</button>
                    </form>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

    <div id="deleteAll" class="modal-demo" style="position:relative; right: 32%">
        <button type="button" class="close" onclick="Custombox.close();" style="opacity: 1">
            <span>&times</span><span class="sr-only" style="color: #f7f7f7">Close</span>
        </button>
        <h4 class="custom-modal-title">حذف المحدد</h4>
        <div class="custombox-modal-container" style="width: 400px !important; height: 160px;">
            <div class="row">
                <div class="col-sm-12">
                    <h3 style="margin-top: 35px">
                        هل تريد مواصلة عملية الحذف ؟
                    </h3>
                </div>
            </div>
            <div class="row">
                <div class="col-sm-12">
                    <button style="margin-top: 35px" type="submit" class="btn btn-danger btn-rounded w-md waves-effect waves-light m-b-5 send-delete-all" style="margin-top: 19px">حـذف</button>
                </div>
            </div>
        </div><!-- /.modal-content -->
    </div>

@endsection

@section('script')

    <script>

		$(".contact").on('click', function () {
			let id = $(this).data('user_id');
			console.log(id);
			$("input[name='user_id']").val(id);
		});

		$('.delete').on('click',function(){

			let id         = $(this).data('id');

			$("input[name='delete_id']").val(id);

		});

		$("#checkedAll").change(function(){
			if(this.checked){
				$(".checkSingle").each(function(){
					this.checked=true;
				})
			}else{
				$(".checkSingle").each(function(){
					this.checked=false;
				})
			}
		});

		$(".checkSingle").click(function () {
			if ($(this).is(":checked")){
				var isAllChecked = 0;
				$(".checkSingle").each(function(){
					if(!this.checked)
						isAllChecked = 1;
				})
				if(isAllChecked == 0){ $("#checkedAll").prop("checked", true); }
			}else {
				$("#checkedAll").prop("checked", false);
			}
		});

		$('.send-delete-all').on('click', function (e) {

			var usersIds = [];
			$('.checkSingle:checked').each(function () {
				var id = $(this).attr('id');
				usersIds.push({
					id: id,
				});
			});
			var requestData = JSON.stringify(usersIds);
			// console.log(requestData);
			if (usersIds.length > 0) {
				e.preventDefault();
				$.ajax({
					type: "POST",
					url: "{{route('deleteSupervisors')}}",
					data: {data: requestData, _token: '{{csrf_token()}}'},
					success: function( msg ) {
						if (msg == 'success') {
							location.reload()
						}
					}
				});
			}
		});
    </script>
@endsection
