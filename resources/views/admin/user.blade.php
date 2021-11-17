@extends('layouts.simple.master')
@section('title', 'Quản lí người dùng')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/dropzone.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Quản lí người dùng</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Super Admin</li>
<li class="breadcrumb-item active">Quản lí người dùng</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Danh sách tài khoản</h5>
					<span>Hiển thị danh sách tài khoản có trong hệ thống.</span>
				</div>
				<div class="card-body">
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
								<form method="POST" action="{{route('admin.addUser')}}">
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
												<input class="form-control @error('email') is-invalid @enderror" name="email" value="{{ old('email') }}" required type="text" placeholder="Email@hnue.edu.vn" aria-describedby="inputGroupPrepend">
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
								<form class="dropzone dropzone-info" id="fileTypeValidation" enctype="multipart/form-data" action="{{route('admin.addUser')}}" method="post">
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
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/dropzone/dropzone.js')}}"></script>
<script>

	var table = $('#tableUser').DataTable( {
		"processing": true,
		"serverSide": true,
		"scrollX": true,
		"ajax": "{{ route('admin.user') }}",
		columns: [
			{data: 'id', name: 'id'},
			{data: 'name', name: 'name'},
			{data: 'email', name: 'email'},
			{data: 'role', name: 'role'},
			{data: 'action', name: 'action', orderable: false, searchable: false}]
	});

	
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