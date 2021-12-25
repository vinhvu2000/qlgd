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
								<div class="col-md-2 mb-3">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tầng</span></div>
										<select name="floor" class="form-control btn-square">
											@foreach($floor as $key => $value)
											<option value="{{$value}}">{{$value}}</option>
											@endforeach
										</select>
									</div>
								</div>
								<div class="col-2 mb-3">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ngày</span></div>
										<input class="form-control" value="{{CARBON\CARBON::now()->toDateString()}}" name="day" value="{{ old('day') }}" type="date">
									</div>
								</div>
								
								<div class="col-md-3 mb-3">
									<button class="btn btn-primary" type="submit">Tìm kiếm</button>
								</div>
							</div>
						</form>
					<table class="display datatables text-center" id="tableUser">
						<thead>
							<tr>
								<th>STT</th>
								<th>Tên</th>
								<th>Email</th>
								<th>Vai trò</th>
								<th>Hành động</th>
							</tr>
						</thead>
					</table>
					<div class="modal fade modal-centered" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
						   <div class="modal-content">
							  <div class="modal-header">
                           			<h5 class="modal-title">Cập nhật thông tin tài khoản</h5>
								 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
							  </div>
							  <div class="modal-body">
								 <form method="POST" class="modalForm">
									<div class="mb-3">
											<input class="form-control" hidden name="id" type="text" id="id" readonly>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên</span></div>
											<input class="form-control"  name="name" type="text" id="name">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">@</span></div>
											<input class="form-control"  name="email" type="email" id="email">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Vai trò</span></div>
											<select class="form-select" name="role" type="text" id="role">
												<option value="superadmin">Super Admin</option>
												<option value="admin">Admin</option>
												<option value="user">User</option>
											  </select>
										</div>
									</div>
							  </div>
							  <div class="modal-footer">
								 <button class="btn btn-primary" type="submit">Cập nhật</button>
								 <button class="btn btn-secondary" type="button" data-bs-dismiss="modal">Đóng</button>
								</form>
							  </div>
						   </div>
						</div>
					 </div>
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
</script>
@endsection
