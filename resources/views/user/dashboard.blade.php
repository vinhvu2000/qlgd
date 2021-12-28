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
					<form method="POST" action="{{route('user.dashboard')}}" id="formAdd">
						@csrf
						<div class="row">
							<div class="col-md-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tòa</span></div>
									<select name="buildingID" id="buildingID" class="form-control btn-square">
										@foreach($buildingID as $key => $value)
										<option 
										@if($value['buildingID'] == $input['buildingID'])
												selected 
										@endif
										value="{{$value['buildingID']}}">{{$value['buildingID']}}</option>
										@endforeach
									</select>
								</div>
							</div>
							<div class="col-2 mb-3">
								<div class="input-group">
									<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tầng</span></div>
									<select name="floor" id="floor" class="form-control btn-square">
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
												@if($schedule[$hour][$value]->user['account'] == Auth::user()->name)
													href="#checkModal"
												@else
													href=""
												@endif

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
												@if($schedule[$hour][$value]->status != 0)
												<label class="d-none">{{$schedule[$hour][$value]->user['user']}}</label>
												<label class="d-none">{{$schedule[$hour][$value]->listDevice}}</label>
												@endif
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
					<div class="modal fade" id="checkOutModal" tabindex="-1" role="dialog" aria-labelledby="checkOutModal" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<form method="POST" id="formCheckOut">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Thông tin phòng học</h5>
										<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ngày</span></div>
												<input class="form-control" id="dayModal2" readonly type="date">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Từ</span></div>
													<input class="form-control" readonly type="text" id="timeStartModal2">
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Đến</span></div>
													<input class="form-control"readonly type="text" id="timeEndModal2">
												</div>
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
												<input class="form-control" id="roomIDModal2" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Giảng viên</span></div>
												<input class="form-control" id="teacherModal2" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã môn học</span></div>
												<input class="form-control" id="subjectIDModal2" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên môn học</span></div>
												<input class="form-control" id="subjectNameModal2" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Người mượn</span></div>
												<input class="form-control" id="userModal2" readonly type="text">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox6" disabled checked>
													<label class="form-check-label" for="inlineCheckbox6">Chìa khóa</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox7" disabled checked>
													<label class="form-check-label" for="inlineCheckbox7">Microphone</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="speModal2" disabled readonly>
													<label class="form-check-label" for="inlineCheckbox8">Loa</label>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="cabModal2" disabled readonly>
													<label class="form-check-label" for="inlineCheckbox9">Cáp HDMI</label>
												</div>
											</div>
											<div class="col-8">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox10" disabled checked>
													<label class="form-check-label" for="inlineCheckbox10">Điều khiển máy chiếu</label>
												</div>
											</div>
										</div>
									</div>
									<div class="modal-footer">
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<div class="modal fade" id="checkModal" tabindex="-1" role="dialog" aria-labelledby="checkModal" aria-hidden="true">
						<div class="modal-dialog" role="document">
							<form method="POST" action="{{route('user.updateSchedule')}}" id="formCheck">
							@csrf
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
												<select name="roomID" id="roomIDModal3" class="form-control btn-square">
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
										<button class="btn btn-primary" type="submit">Cập nhật</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					<form action="{{route('user.addSchedule')}}" method="POST">
						@csrf
						<div class="modal fade modal-centered " id="roomModal" aria-hidden="true" aria-labelledby="roomModal" tabindex="-1">
							<div class="modal-dialog fadeIn animated modal-dialog-centered">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Mượn phòng học</h5>
										<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
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
												<input class="form-control" name="user" value="" required type="text" placeholder="VD: Nguyễn Văn A">
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
												<input class="form-control" name="subjectName" value="" required type="text" placeholder="VD: Công nghệ phần mềm">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Giảng viên</span></div>
												<input class="form-control" name="teacher" value="" required type="text" placeholder="VD: Nguyễn Văn B">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" disabled checked>
													<label class="form-check-label" for="inlineCheckbox1">Chìa khóa</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox2" disabled checked>
													<label class="form-check-label" for="inlineCheckbox2">Microphone</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="SPE" name="listDevice[]">
													<label class="form-check-label" for="inlineCheckbox3">Loa</label>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="CAB" name="listDevice[]">
													<label class="form-check-label" for="inlineCheckbox4">Cáp HDMI</label>
												</div>
											</div>
											<div class="col-8">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox5" disabled checked>
													<label class="form-check-label" for="inlineCheckbox5">Điều khiển máy chiếu</label>
												</div>
											</div>
										</div>
									</div>

									<div class="modal-footer">
										<button class="btn btn-primary" type="submit">Mượn phòng</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
									</div>
								</div>
							</div>
						</div>
					</form>
					<div class="modal fade modal-centered " id="checkInModal" aria-hidden="true" aria-labelledby="checkInModal" tabindex="-1">
						<div class="modal-dialog fadeIn animated modal-dialog-centered">
							<form method="POST" id="formCheckIn">
								<div class="modal-content">
									<div class="modal-header">
										<h5 class="modal-title">Xác nhận mở phòng</h5>
										<button class="btn-close" type="button" data-bs-dismiss="modal" aria-label="Close"></button>
									</div>
									<div class="modal-body">
										<input type="text" hidden name="id" id="idModal" value="">
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Ngày</span></div>
												<input class="form-control" name="day" id="dayModal" readonly type="date">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Từ</span></div>
													<input class="form-control"  name="timeStart" readonly type="text" id="timeStartModal">
												</div>
											</div>
											<div class="col">
												<div class="input-group">
													<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Đến</span></div>
													<input class="form-control"  name="timeEnd" readonly type="text" id="timeEndModal">
												</div>
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Phòng học</span></div>
												<input class="form-control" name="roomID" value="" id="roomIDModal" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Giảng viên</span></div>
												<input class="form-control" name="teacher" value="" id="teacherModal" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Mã môn học</span></div>
												<input class="form-control" name="subjectID" value="" id="subjectIDModal" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Tên môn học</span></div>
												<input class="form-control" name="subjectName" value="" id="subjectNameModal" readonly type="text">
											</div>
										</div>
										<div class="mb-3">
											<div class="input-group">
												<div class="input-group-prepend"><span class="input-group-text" id="inputGroupPrepend">Người mượn</span></div>
												<input class="form-control" name="user" value="" id="userModal" required type="text">
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox1" disabled checked>
													<label class="form-check-label" for="inlineCheckbox1">Chìa khóa</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox2" disabled checked>
													<label class="form-check-label" for="inlineCheckbox2">Microphone</label>
												</div>
											</div>
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox3" value="SPE" name="listDevice[]">
													<label class="form-check-label" for="inlineCheckbox3">Loa</label>
												</div>
											</div>
										</div>
										<div class="row mb-3">
											<div class="col-4">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox4" value="CAB" name="listDevice[]">
													<label class="form-check-label" for="inlineCheckbox4">Cáp HDMI</label>
												</div>
											</div>
											<div class="col-8">
												<div class="form-check form-check-inline">
													<input class="form-check-input" type="checkbox" id="inlineCheckbox5" disabled checked>
													<label class="form-check-label" for="inlineCheckbox5">Điều khiển máy chiếu</label>
												</div>
											</div>
										</div>
									<div>
									<div class="modal-footer">
										<button type="submit" class="btn btn-primary">Xác nhận</button>
										<button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Đóng</button>
									</div>
								</div>
							</form>
						</div>
					</div>
					
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
					<form class="dropzone dropzone-info" id="fileTypeValidation" enctype="multipart/form-data" action="{{route('user.dashboard')}}" method="post">
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
	$("#checkInModal").on("show.bs.modal", function (e) {
        const t = $(e.relatedTarget);
		$("#subjectIDModal").val($(t).find("label:nth-child(1)").text());
		$("#subjectNameModal").val($(t).find("label:nth-child(3)").text());
		$("#teacherModal").val($(t).find("label:nth-child(5)").text());
		$("#dayModal").val($(t).find("label:nth-child(7)").text());
		$("#timeStartModal").val($(t).find("label:nth-child(8)").text());
		$("#timeEndModal").val($(t).find("label:nth-child(9)").text());
		$("#roomIDModal").val($("#buildingID").val()+'-'+$(t).find("label:nth-child(10)").text());
		$("#idModal").val($(t).find("label:nth-child(11)").text());
	})
	$("#checkOutModal").on("show.bs.modal", function (e) {
        const t = $(e.relatedTarget);
		$("#subjectIDModal2").val($(t).find("label:nth-child(1)").text());
		$("#subjectNameModal2").val($(t).find("label:nth-child(3)").text());
		$("#teacherModal2").val($(t).find("label:nth-child(5)").text());
		$("#dayModal2").val($(t).find("label:nth-child(7)").text());
		$("#timeStartModal2").val($(t).find("label:nth-child(8)").text());
		$("#timeEndModal2").val($(t).find("label:nth-child(9)").text());
		$("#roomIDModal2").val($("#buildingID").val()+'-'+$(t).find("label:nth-child(10)").text());
		$("#idModal2").val($(t).find("label:nth-child(11)").text());
		$("#userModal2").val($(t).find("label:nth-child(12)").text());
		var listDevice = $(t).find("label:nth-child(13)").text();
		$("#speModal2").prop( "checked", listDevice.search("SPE") != -1 );
		$("#cabModal2").prop( "checked", listDevice.search("CAB") != -1 );

		// console.log($(t).find("label:nth-child(11)").text());
	})
	$("#checkModal").on("show.bs.modal", function (e) {
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
	$("#formCheckIn").submit(function (e) {
		e.preventDefault();
		$.ajax({
			url: "{{route('user.checkIn')}}",
			type: "POST",
			data: $(this).serialize(),
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function(data){
				swal("Xác nhận mở phòng học thành công", {icon: "success"});
				$("#checkInModal").modal('hide');
				$(".scheduleInfo").each(function () {
					if($(this).text() == data[0]){
						$(this).parent().append("<label class='d-none scheduleInfo'>"+data[1]+"</label>")
						$(this).parent().append("<label class='d-none scheduleInfo'>"+data[2]+"</label>")
						$(this).parent().parent().parent().removeClass("table-warning");
						$(this).parent().parent().parent().addClass("table-success");
						$(this).parent().parent().attr("href","#checkOutModal")
					}
				})
			},
			error: function () {
				swal("Không thể nhận phòng", {
				icon: "error",
				});
			}
		})
	})
	$("#buildingID").change(function () {
		$.ajax({
			url: "{{route('user.changeBuild')}}",
			type: "POST",
			data: {"buildingID":$("#buildingID").val()},
			headers: {
				'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
			},
			success: function (data) {
				var $el = $("#floor");
				$el.empty();
				$.each(JSON.parse(data), function(key,value) {
				$el.append($("<option></option>").attr("value", value).text(value));
				});
			}
		})
	})
</script>
@endsection
