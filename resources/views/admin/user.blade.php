@extends('layouts.simple.master')
@section('title', 'Quản lí người dùng')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
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
		<!-- Server Side Processing start-->
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
		<!-- Server Side Processing end-->
	</div>
</div>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script>
	$(document).ready(function() {
		$('#tableUser')
		// .on('draw.dt', function () {
		// 	$("td:nth-child(1)").addClass("text-center");
		// })
		.DataTable( {
			"processing": true,
			"serverSide": true,
			"scrollX": true,
			"ajax": "{{ route('admin.user') }}",
			columns: [
				{data: 'id', name: 'id'},
				{data: 'name', name: 'name'},
				{data: 'email', name: 'email'},
				{data: 'role', name: 'role'},
				{data: 'action', name: 'action', orderable: false, searchable: false},
			]
		});
	});
</script>
@endsection