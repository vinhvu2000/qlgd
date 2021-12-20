@extends('layouts.simple.master')

@section('title', 'Quản Lí Phòng Học')

@section('css')
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/datatables.css')}}">
<link rel="stylesheet" type="text/css" href="{{asset('assets/css/vendors/sweetalert2.css')}}">
@endsection

@section('style')
@endsection

@section('breadcrumb-title')
<h3>Quản Lí Phòng Học</h3>
@endsection

@section('breadcrumb-items')
<li class="breadcrumb-item">Quản lí phòng học</li>
@endsection

@section('content')
<div class="container-fluid">
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5>Danh sách phòng học</h5>
					<span>Hiển thị danh sách phòng học của tòa quản lí.</span>
				</div>
				<div class="card-body">
					<table class="display datatables text-center" id="tableRoom">
						<thead>
							<tr>
								<th>STT</th>
								<th>Phòng học</th>
								<th>Trạng thái</th>
								<th>Ghi chú</th>
								<th>Hành động</th>
							</tr>
						</thead>
					</table>
					<div class="modal fade modal-centered" id="exampleModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
						<div class="modal-dialog modal-dialog-centered" role="document">
						   <div class="modal-content">
							  <div class="modal-header">
                           			<h5 class="modal-title">Cập nhật thông tin phòng học</h5>
								 <button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
							  </div>
							  <div class="modal-body">
								 <form method="POST" class="modalForm">
									<div class="mb-3">
											<input class="form-control" hidden name="id" type="text" id="id" readonly>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
											<input class="form-control" readonly name="roomID" type="text" id="roomID">
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
					<h5>Thêm phòng học</h5>
					<span>Thêm phòng học vào danh sách phòng học của tòa quản lí.</span>
				</div>
				<div class="card-body">
					<form method="POST" action="{{route('admin.addUser')}}" id="formAdd">
						@csrf
						<div class="row">
							@if (Auth::user()->role == "superadmin")
							<div class="col-md-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã toà</span></div>
									<select name="buildingID" class="form-control btn-square">
										@foreach($buildingID as $key => $value)
										<option value="{{$value['buildingID']}}">{{$value['buildingID']}}</option>
										@endforeach
									</select>
								</div>
							</div>
							@else
							<div class="col-md-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã toà</span></div>
									<input class="form-control" readonly name="buildingID" value="{{ old('buildingID') }}" type="text">
								</div>
							</div>
								
							@endif
							<div class="col-md-4 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Số phòng</span></div>
									<input class="form-control @error('roomID') is-invalid @enderror"  name="roomID" value="{{ old('roomID') }}" type="text" placeholder="VD: 101 hoặc 101-110" required>
									@error('roomID')
										<span class="invalid-feedback" role="alert">
										<strong>{{ $message }}</strong>
										</span>
									@enderror
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
	function deleteRoom(t) {
		var tbody = $(t).parent().parent();
		swal({
			title: "Bạn có chắc chắn không?",
			text: "Hành động này sẽ xóa phòng "+tbody.find("td:nth-child(2)").text()+" vĩnh viễn",
			icon: "warning",
			buttons: true,
			dangerMode: true,
        }).then((willDelete) => {
			if (willDelete) {
				var text = tbody.find("td:nth-child(2)").text()
				$.ajax({
				url: 'deleteRoom/'+text,
				type: 'POST',
				headers: {
					'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
				},
				success: function(data){
					swal("Phòng học "+tbody.find("td:nth-child(2)").text()+" đã bị xóa", {
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
	var table = $('#tableRoom').DataTable( {
		processing: true,
		serverSide: true,
		scrollX: true,
		ajax: {
			url: "{{ route('admin.room') }}",
			data: {"buildingID": $(".profile-nav .media-body span").text().substring($(".profile-nav .media-body span").text().length-2).trim()},
		},
		columns: [
			{data: 'id', name: 'id'},
			{data: 'roomID', name: 'roomID'},
			{data: 'status', name: 'status'},
			{data: 'note', name: 'note'},
			{data: 'action', name: 'action', orderable: false, searchable: false}]
	});

	 

	$("#exampleModal").on("show.bs.modal", function (e) {
		var tr = $(e.relatedTarget).parent().parent();
		$("#id").val($(tr).find("td:nth-child(1)").text());
		$("#roomID").val($(tr).find("td:nth-child(2)").text());
		$("#status").val($(tr).find("td:nth-child(3)").text());
		$("#note").val($(tr).find("td:nth-child(4)").text());
	});

	$(".modalForm").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: '{{route("admin.editRoom")}}',
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
			url: '{{route("admin.addRoom")}}',
			type: 'POST',
			data: $(this).serialize(),
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				swal("Thêm phòng học thành công", {icon: "success",});
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
