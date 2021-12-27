@extends('layouts.simple.master')

@section('title', 'Trang chủ')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/dropzone.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Trang chủ</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Trang chủ</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Thời khóa biểu</h5>
					<span>Hiển thị thời khóa biểu của tòa nhà.</span>
				</div>
				<div class="card-body">
					<form method="POST" action="{{route('admin.dashboard')}}" id="formAdd">
						@csrf
						<div class="row">
							@if (Auth::user()->role == 'superadmin')
							<div class="col-md-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tòa</span></div>
									<select name="building" class="form-control btn-square">
										@foreach($buildingID as $key => $value)
										<option value="{{$value['buildingID']}}">{{$value['buildingID']}}</option>
										@endforeach
									</select>
								</div>
							</div>
							@endif
							<div class="col-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tầng</span></div>
									<select name="floor" class="form-control btn-square">
										@foreach($floorArr as $key => $value)
										<option 
											@if($value == $input['floor'])
												selected 
											@endif
											value="{{$value}}">{{$value}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ngày</span></div>
									<input class="form-control" name="day" value="{{ $input['day'] == ''?CARBON\CARBON::now()->toDateString():$input['day']}}" type="date">
								</div>
							</div>
							
							<div class="col-3 mb-3">
								<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
								<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#roomModal"><i class="fa fa-plus"></i></button>
							</div>
						</div>
					</form>
					<table class="table table-bordered text-center align-middle">
						<thead>
							<tr>
								<th></th>
								@foreach($room as $key => $value)
								<th class="table-primary"><b>{{$value}}</b></th>
								@endforeach
							</tr>
						</thead>
						<tbody>
							@foreach ($time as $hour)
							<tr>
								<td class="table-info">{{$hour.":00"}}</td>
								@foreach($room as $value)
									@if ($schedule[$hour][$value] == "continue")

									@elseif ($schedule[$hour][$value] != null)
										<td class="table-warning" rowspan="{{$schedule[$hour][$value]->timeEnd-$schedule[$hour][$value]->timeStart+1}}">
											{{$schedule[$hour][$value]->subjectID}}
											<br>{{$schedule[$hour][$value]->subjectName}}
											<br>{{$schedule[$hour][$value]->teacher}}
										</td>
									@else
										<td></td>
									@endif
								@endforeach
							</tr>
							@endforeach
						</tbody>
					</table>
					<form action="{{route('admin.addSchedule')}}" method="POST">
					@csrf
					<div class="modal fade modal-centered " id="roomModal" aria-hidden="true" aria-labelledby="roomModal" tabindex="-1">
						<div class="modal-dialog fadeIn animated modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Thêm lịch học</h5>
							  		<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
						   		</div>
						   		<div class="modal-body">
							  		<form method="POST" class="modalForm">
										<div class="mb-3">
									 	<div class="input-group">
										 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ngày</span></div>
										 <input class="form-control" name="day" value="{{ $input['day'] == ''?CARBON\CARBON::now()->toDateString():$input['day']}}" type="date">
									 </div>
								 </div>
								 <div class="row mb-3">
									 <div class="col">
										 <div class="input-group">
											 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Từ</span></div>
											 <input class="form-control"  name="timeStart" type="text" id="timeStart" placeholder="VD:7">
										 </div>
									 </div>
									 <div class="col">
										 <div class="input-group">
											 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Đến</span></div>
											 <input class="form-control"  name="timeEnd" type="text" id="timeEnd" placeholder="VD:12">
										 </div>
									 </div>
								 </div>
								 <div class="mb-3">
									 <div class="input-group">
										 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
										 <select name="roomID" class="form-control btn-square">
											 @foreach($roomArr as $key => $value)
											 <option value="{{$value->buildingID.'-'.$value->roomID}}">{{$value->buildingID.'-'.$value->roomID}}</option>
											 @endforeach
										 </select>
									 </div>
								 </div>
								 <div class="mb-3">
									 <div class="input-group">
										 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Người mượn</span></div>
										 <input class="form-control" name="teacher" value="" type="text" placeholder="VD: Nguyễn Văn A">
									 </div>
								 </div>
								 <div class="mb-3">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã môn học</span></div>
										<input class="form-control" name="subjectID" value="" type="text" placeholder="VD: COMP 411">
									</div>
								</div>
								<div class="mb-3">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên môn học</span></div>
										<input class="form-control" name="subjectName" value="" type="text" placeholder="VD: Công nghệ phần mềm">
									</div>
								</div>
						   </div>
								<div class="modal-footer">
									<button class="btn btn-primary" data-bs-target="#deviceModal" data-bs-toggle="modal" data-bs-dismiss="modal">Tiếp theo</button>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								</div>
							</div>
						</div>
					</div>
					<div class="modal fade modal-centered" id="deviceModal" aria-hidden="true" aria-labelledby="deviceModal" tabindex="-1">
						<div class="modal-dialog fadeIn animated modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
										 <h5 class="modal-title">Mượn thiết bị</h5>
								   <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="" checked id="flexCheckDefault">
										<h6 class="form-check-label" for="flexCheckDefault">Chìa khóa</h6>
									</div>
									<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="" checked id="flexCheckDefault">
										<h6 class="form-check-label" for="flexCheckDefault">Microphone</h6>
									</div>
									<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="" checked id="flexCheckDefault">
										<h6 class="form-check-label" for="flexCheckDefault">Điều khiển máy chiếu</h6>
									</div>
									<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
										<h6 class="form-check-label" for="flexCheckDefault">Loa</h6>
									</div>
									<div class="form-check mb-3">
										<input class="form-check-input" type="checkbox" value="" id="flexCheckDefault">
										<h6 class="form-check-label" for="flexCheckDefault">Cáp HDMI</h6>
									</div>
								</div>
								<div class="modal-footer">
									<!-- Toogle to first dialog, `data-bs-dismiss` attribute can be omitted - clicking on link will close dialog anyway -->
									<a class="btn btn-success" href="#roomModal" data-bs-toggle="modal" data-bs-dismiss="modal" role="button">Quay lại</a>
									<button class="btn btn-primary" type="submit">Thêm</button>
									<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
								</div>
							</div>
						</div>
					</div>
					</form>
				</div>
			</div>
		</div>
	</div>
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5 class="pull-left">Thêm tài khoản</h5>
				</div>
				<div class="card-body">
					<div class="tabbed-card">
						<ul class="pull-right nav nav-tabs border-tab nav-primary" id="top-tab2" role="tablist">
							<li class="nav-item"><a class="nav-link active" id="top-home-tab2" data-bs-toggle="tab" href="#top-home2" role="tab" aria-controls="top-home" aria-selected="false"><i class="fa fa-pencil"></i></i>Thêm một</a></li>
							<li class="nav-item"><a class="nav-link" id="profile-top-tab2" data-bs-toggle="tab" href="#top-profile2" role="tab" aria-controls="top-profile2" aria-selected="true"><i class="fa fa-file-excel-o" aria-hidden="true"></i>Thêm nhiều</a></li>
						</ul>
						<div class="tab-content" id="top-tabContent2">
							<div class="tab-pane fade active show" id="top-home2" role="tabpanel" aria-labelledby="top-home-tab">
								<form method="POST" action="{{route('admin.dashboard')}}" id="formAdd">
									@csrf
									<label for="password" class="text-danger">Mật khẩu mặc định là: 12345678</label>
									<div class="row">
										<div class="col-md-3 mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên</span></div>
												<input class="form-control @error('name') is-invalid @enderror"  name="name" value="{{ old('name') }}" type="text" placeholder="Nguyễn Văn A" required>
												@error('name')
													<span class="invalid-feedback" role="alert">
														<strong>{{ $message }}</strong>
													</span>
												@enderror
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">@</span></div>
												<input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required type="email" placeholder="Email@hnue.edu.vn" aria-describedby="inputGroupPrepend">
												@error('email')
												<span class="invalid-feedback" role="alert">
													<strong>{{ $message }}</strong>
												</span>
												@enderror
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Vai trò</span></div>
												<select name="role" class="form-control btn-square">
												<option value="user">User</option>
												<option value="admin">Admin</option>
												<option value="superadmin">Superadmin</option>
												</select>
											</div>
										</div>
										<div class="col-md-3 mb-3">
											<button class="btn btn-primary" type="submit">Thêm</button>
										</div>
									</div>
								</form>
							</div>
							<div class="tab-pane fade" id="top-profile2" role="tabpanel" aria-labelledby="profile-top-tab">
								<form class="dropzone dropzone-info" id="fileTypeValidation" enctype="multipart/form-data" action="{{route('admin.dashboard')}}" method="post">
									@csrf
									<div class="dz-message needsclick">
										<i class="icon-cloud-up"></i>
										<h6>Drop files here or click to upload.</h6>
									</div>
								</form>
								<hr>
								<div class="text-center">
									<button class="btn btn-primary" type="submit" id="submit">Thêm</button>
								</div>
							</div>
						</div>
					</div>
					
				</div>
			</div>
		</div>
	</div>
</div>
{{-- <div class="container-fluid">
	<div class="col-xl-4 col-lg-12 xl-50 calendar-sec box-col-6">
		<div class="card gradient-primary o-hidden">
			<div class="card-body">
				<div class="setting-dot">
					<div class="setting-bg-primary date-picker-setting position-set pull-right"><i class="fa fa-spin fa-cog"></i></div>
				</div>
				<div class="default-datepicker">
					<div class="datepicker-here" data-language="en"></div>
				</div>
				<span class="default-dots-stay overview-dots full-width-dots"><span class="dots-group"><span class="dots dots1"></span><span class="dots dots2 dot-small"></span><span class="dots dots3 dot-small"></span><span class="dots dots4 dot-medium"></span><span class="dots dots5 dot-small"></span><span class="dots dots6 dot-small"></span><span class="dots dots7 dot-small-semi"></span><span class="dots dots8 dot-small-semi"></span><span class="dots dots9 dot-small">                </span></span></span>
			</div>
		</div>
	</div>
</div> --}}
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
<script>
	Dropzone.autoDiscover = false;
  
	var myDropzone = new Dropzone(".dropzone", { 
	autoProcessQueue: false,
	paramName: "file",
	acceptedFiles: "application/vnd.openxmlformats-officedocument.spreadsheetml.sheet,application/vnd.ms-excel"
	});

	$('#submit').click(function(){
		myDropzone.processQueue();
	});
	$('.schedule').on('change', function() {
		$.ajax({
			url:{{route('admin.dashboard')}}
		})
	});
</script>
@endsection
