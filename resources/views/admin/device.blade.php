@extends('layouts.simple.master')

@section('title', 'Quản Lí Phòng Học')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Quản lí thiết bị</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Quản lí thiết bị</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Danh sách thiết bị</h5>
					<span>Hiển thị danh sách thiết bị của tòa quản lí.</span>
				</div>
				<div class="card-body">
					<table class="display datatables text-center" id="tableDevice">
						<thead>
							<tr>
								<th>STT</th>
								<th>Mã thiết bị</th>
								<th>Tên thiết bị</th>
								<th>Phòng học</th>
								<th>Trạng thái</th>
								<th>Ghi chú</th>
								<th>Ngày mua</th>
								<th>Ngày cập nhật</th>
								<th>Hành động</th>
							</tr>
						</thead>
					</table>
					<div class="modal fade modal-centered" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
						   <div class="modal-content">
							  <div class="modal-header">
                           			<h5 class="modal-title">Cập nhật thông tin thiết bị</h5>
								 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
							  </div>
							  <div class="modal-body">
								 <form method="POST" class="modalForm">
									<div class="mb-3">
											<input class="form-control" hidden name="id" type="text" id="id" readonly>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã thiết bị</span></div>
											<input class="form-control" readonly name="deviceID" type="text" id="deviceID">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên thiết bị</span></div>
											<input class="form-control"  name="deviceName" type="text" id="deviceName">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
											<select name="roomID" class="form-control btn-square" id="roomID">
												@foreach($roomID as $key => $value)
												<option value="{{$value['buildingID']."-".$value['roomID']}}">{{$value['buildingID']."-".$value['roomID']}}</option>
												@endforeach
											</select>
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Trạng thái</span></div>
											<select class="form-select" name="status" type="text" id="status">
												<option value="Đang hoạt động">Đang hoạt động</option>
												<option value="Tạm đóng">Tạm đóng</option>
											</select>
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ghi chú</span></div>
											<input class="form-control" name="note" type="text" id="note">
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
					<h5>Thêm thiết bị</h5>
					<span>Thêm thiết bị vào danh sách thiết bị của tòa quản lí.</span>
				</div>
				<div class="card-body">
					<form method="POST" action="{{route('admin.addDevice')}}" id="formAdd">
						@csrf
						<div class="row">
							<div class="col-md-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
									<select name="roomID" class="form-control btn-square">
										@foreach($roomID as $key => $value)
												<option value="{{$value['buildingID']."-".$value['roomID']}}">{{$value['buildingID']."-".$value['roomID']}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã thiết bị</span></div>
									<input class="form-control" name="deviceID" value="{{ old('deviceID') }}" type="text">
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên thiết bị</span></div>
									<input class="form-control" name="deviceName" value="{{ old('deviceName') }}" type="text">
								</div>
							</div>
							<div class="col-md-3 mb-3">
								<button class="btn btn-primary" type="submit">Thêm</button>
							</div>
						</div>
					</form>
				</div>
			</div>
		</div>
	</div>
</div>
<script type="text/javascript">
	var session_layout = '{{ session()->get('layout') }}';
</script>
@endsection

@section('script')
<script src="{{asset('assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
<script src="{{asset('assets/js/sweet-alert/sweetalert.min.js')}}"></script>
{{-- <script src="{{asset('assets/js/sweet-alert/app.js')}}"></script> --}}
<script>
	function deleteDevice(t) {
		var tbody = $(t).parent().parent();
		swal({
			title: "Bạn có chắc chắn không?",
			text: "Hành động này sẽ xóa thiết bị "+tbody.find("td:nth-child(2)").text()+" vĩnh viễn",
			icon: "warning",
			buttons: true,
			dangerMode: true,
        }).then((willDelete) => {
			if (willDelete) {
				var text = tbody.find("td:nth-child(2)").text()
				$.ajax({
				url: 'deleteDevice/'+text,
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data){
					swal("Thiết bị "+tbody.find("td:nth-child(2)").text()+" đã bị xóa", {
					icon: "success",
					});
				}
				});
				table.ajax.reload();
			} else {
				swal("Thao tác này đã bị hủy", {
					icon: "success",
				});
			}
        })
	}
	var table = $('#tableDevice').DataTable( {
		processing: true,
		serverSide: true,
		scrollX: true,
		ajax: "{{ route('admin.device') }}",
		columns: [
			{data: 'id', name: 'id'},
			{data: 'deviceID', name: 'deviceID'},
			{data: 'deviceName', name: 'deviceName'},
			{data: 'roomID', name: 'roomID'},
			{data: 'status', name: 'status'},
			{data: 'note', name: 'note'},
			{data: 'created_at', name: 'created_at'},
			{data: 'updated_at', name: 'updated_at'},
			{data: 'action', name: 'action', orderable: false, searchable: false}]
	});

	 

	$("#exampleModal").on("show.bs.modal", function (e) {
		var tr = $(e.relatedTarget).parent().parent();
		$("#id").val($(tr).find("td:nth-child(1)").text());
		$("#deviceID").val($(tr).find("td:nth-child(2)").text());
		$("#deviceName").val($(tr).find("td:nth-child(3)").text());
		$("#roomID").val($(tr).find("td:nth-child(4)").text());
		$("#status").val($(tr).find("td:nth-child(5)").text());
		$("#note").val($(tr).find("td:nth-child(6)").text());
	});

	$(".modalForm").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: '{{route("admin.editDevice")}}',
			type: 'POST',
			data: $(this).serialize(),
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				swal("Cập nhật phòng học thành công", {icon: "success"});
				$("#exampleModal").modal('hide');
				table.ajax.reload();
			},
			error: function () {
				swal("Cập nhật phòng học thất bại", {
				icon: "error",
				});
			}
		})
	})

	$("#formAdd").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: '{{route("admin.addDevice")}}',
			type: 'POST',
			data: $(this).serialize(),
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				swal("Thêm thiết bị thành công", {icon: "success",});
				table.ajax.reload();
			},
			error: function (data) {
				var error = data.responseJSON;
				console.log(error);
				swal(Object.values(error)[0][0], {icon: "error",});
			}
		})
	})
	
</script>
@endsection
