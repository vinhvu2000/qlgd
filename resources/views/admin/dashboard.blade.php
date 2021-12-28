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
					<form method="POST" action="{{route('admin.dashboard')}}">
						@csrf
						<div class="row">
							@if (Auth::user()->role != 'admin')
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
									<input class="form-control" name="day" id="day" value="{{ $input['day'] == ''?CARBON\CARBON::now()->toDateString():$input['day']}}" type="date">
								</div>
							</div>
							
							<div class="col-3 mb-3">
								<button class="btn btn-primary" type="submit"><i class="fa fa-search"></i></button>
								@if(Auth::user()->role == 'admin')
								<button class="btn btn-success" type="button" data-bs-toggle="modal" data-bs-target="#roomModal"><i class="fa fa-plus"></i></button>
								@endif
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
										<td 
											@switch($schedule[$hour][$value]->status)
											@case(2)
											class="table-secondary"
												@break
											@case(0)
											class="table-warning"
												@break
											@default
											class="table-success" 
											@endswitch
											rowspan="{{$schedule[$hour][$value]->timeEnd-$schedule[$hour][$value]->timeStart+1}}">
											<a style="color:unset" 
											@switch($schedule[$hour][$value]->status)
												@case(0)
													href="#checkInModal" 
													@break
												@case(1)
													href="#checkOutModal"
													@break
												@default
													href="#scheduleModal"
											@endswitch
											 data-bs-toggle="modal" data-bs-dismiss="modal" role="button">
											 <div>
												<label>{{$schedule[$hour][$value]->subjectID}}</label><br>
												<label>{{$schedule[$hour][$value]->subjectName}}</label><br>
												<label>{{$schedule[$hour][$value]->teacher}}</label><br>
												<label class="d-none">{{$schedule[$hour][$value]->day}}</label>
												<label class="d-none">{{$schedule[$hour][$value]->timeStart}}</label>
												<label class="d-none">{{$schedule[$hour][$value]->timeEnd}}</label>
												<label class="d-none">{{$value}}</label>
												<label class="d-none scheduleInfo">{{$schedule[$hour][$value]->id}}</label>
												<label class="d-none">{{$schedule[$hour][$value]->user['user']}}</label>
												<label class="d-none">{{$schedule[$hour][$value]->listDevice}}</label>
											</div></a>
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
										 <input class="form-control" name="day" required value="{{ $input['day'] == ''?CARBON\CARBON::now()->toDateString():$input['day']}}" type="date">
									 </div>
								 </div>
								 <div class="row mb-3">
									 <div class="col">
										 <div class="input-group">
											 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Từ</span></div>
											 <input class="form-control"  name="timeStart" required type="text" id="timeStart" placeholder="VD:7">
										 </div>
									 </div>
									 <div class="col">
										 <div class="input-group">
											 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Đến</span></div>
											 <input class="form-control"  name="timeEnd" required type="text" id="timeEnd" placeholder="VD:12">
										 </div>
									 </div>
								 </div>
								 <div class="mb-3">
									 <div class="input-group">
										 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
										 <select name="roomID"  class="form-control btn-square">
											 @foreach($roomArr as $key => $value)
											 <option value="{{$value->buildingID.'-'.$value->roomID}}">{{$value->buildingID.'-'.$value->roomID}}</option>
											 @endforeach
										 </select>
									 </div>
								 </div>
								 <div class="mb-3">
									 <div class="input-group">
										 <div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Người mượn</span></div>
										 <input class="form-control" name="teacher" value="" required type="text" placeholder="VD: Nguyễn Văn A">
									 </div>
								 </div>
								 <div class="mb-3">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã môn học</span></div>
										<input class="form-control" name="subjectID" value="" required type="text" placeholder="VD: COMP 411">
									</div>
								</div>
								<div class="mb-3">
									<div class="input-group">
										<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên môn học</span></div>
										<input class="form-control" name="subjectName" value="" required type="text" placeholder="VD: Công nghệ phần mềm">
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
					<form method="POST" id="formAccept">
					<div class="modal fade modal-centered " id="scheduleModal" aria-hidden="true" aria-labelledby="roomModal" tabindex="-1">
						<div class="modal-dialog fadeIn animated modal-dialog-centered">
							<div class="modal-content">
								<div class="modal-header">
									<h5 class="modal-title">Thông tin mượn phòng học</h5>
									<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
								</div>
								<div class="modal-body">
									<div class="mb-3">
										<input type="text" hidden name="id" id="idModal3" value="">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ngày</span></div>
											<input class="form-control" name="day" id="dayModal3" type="date">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Từ</span></div>
												<input class="form-control" name="timeStart" type="text" id="timeStartModal3">
											</div>
										</div>
										<div class="col">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Đến</span></div>
												<input class="form-control type="text" name="timeEnd" id="timeEndModal3">
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
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Giảng viên</span></div>
											<input class="form-control" id="teacherModal3" name="teacher" type="text">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã môn học</span></div>
											<input class="form-control" id="subjectIDModal3" name="subjectID" type="text">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên môn học</span></div>
											<input class="form-control" id="subjectNameModal3" name="subjectName" type="text">
										</div>
									</div>
									<div class="mb-3">
										<div class="input-group">
											<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Người mượn</span></div>
											<input class="form-control" id="userModal3" name="user" type="text">
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" id="inlineCheckbox11" disabled checked>
												<label class="form-check-label" for="inlineCheckbox11">Chìa khóa</label>
											</div>
										</div>
										<div class="col-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" id="inlineCheckbox12" disabled checked>
												<label class="form-check-label" for="inlineCheckbox12">Microphone</label>
											</div>
										</div>
										<div class="col-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" id="speModal3" value="SPE"  readonly name="listDevice[]">
												<label class="form-check-label" for="speModal3">Loa</label>
											</div>
										</div>
									</div>
									<div class="row mb-3">
										<div class="col-4">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" id="cabModal3" value="CAB" readonly name="listDevice[]">
												<label class="form-check-label" for="cabModal3">Cáp HDMI</label>
											</div>
										</div>
										<div class="col-8">
											<div class="form-check form-check-inline">
												<input class="form-check-input" type="checkbox" id="inlineCheckbox13" disabled checked>
												<label class="form-check-label" for="inlineCheckbox13">Điều khiển máy chiếu</label>
											</div>
										</div>
									</div>
								</div>
								<div class="modal-footer">
									<button class="btn btn-primary" type="submit">Từ chối</button>
									<button class="btn btn-primary" type="submit">Đồng ý</button>
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
	@if (Auth::user()->role=="superadmin")
	<div class="row">
		<div class="col-sm-12">
			<div class="card">
				<div class="card-header">
					<h5 class="pull-left">Phân bố phòng học</h5>
				</div>
				<div class="card-body">
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
	@endif
	
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
@if (Auth::user()->role=="superadmin")
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
@endif
<script>
	$("#scheduleModal").on("show.bs.modal", function (e) {
        const t = $(e.relatedTarget);
		$("#subjectIDModal3").val($(t).find("label:nth-child(1)").text());
		$("#subjectNameModal3").val($(t).find("label:nth-child(3)").text());
		$("#teacherModal3").val($(t).find("label:nth-child(5)").text());
		$("#dayModal3").val($(t).find("label:nth-child(7)").text());
		$("#timeStartModal3").val($(t).find("label:nth-child(8)").text());
		$("#timeEndModal3").val($(t).find("label:nth-child(9)").text());
		$("#roomIDModal3").val($("#buildingID").val()+'-'+$(t).find("label:nth-child(10)").text());
		$("#idModal3").val($(t).find("label:nth-child(11)").text());
		$("#userModal3").val($(t).find("label:nth-child(12)").text());
		var listDevice = $(t).find("label:nth-child(13)").text();
		$("#speModal3").prop( "checked", listDevice.search("SPE") != -1 );
		$("#cabModal3").prop( "checked", listDevice.search("CAB") != -1 );
	})
	$("#formAccept").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: "{{route('admin.accSchedule')}}",
			type: "POST",
			data: $(this).serialize(),
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				swal("Đồng ý mượn phòng thành công", {icon: "success",});
				$("#scheduleModal").modal('hide');
				$(".scheduleInfo").each(function () {
					if($(this).text() == data[0]){
						$(this).parent().parent().parent().removeClass("table-secondary");
						$(this).parent().parent().parent().addClass("table-warning");
						$(this).parent().parent().attr("href","#checkInModal")
					}
				})
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
