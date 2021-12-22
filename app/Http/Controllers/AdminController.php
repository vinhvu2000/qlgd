<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Auth\RegisterController;
use App\Models\User;
use App\Models\Room;
use App\Models\Building;
use App\Models\Device;
use Illuminate\Contracts\Session\Session;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Yajra\DataTables\Facades\DataTables;
use Illuminate\Support\Facades\DB;
use Maatwebsite\Excel\Facades\Excel;
use App\Imports\UsersImport;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Validation\Rule;
use Carbon\Carbon;


class AdminController extends Controller
{
    public function dashboard()
    {
        return view('admin.dashboard');
    }

    public function room(Request $request)
    {
        if($request->ajax()){
            $buildingID = $request->buildingID == "ng" ? "%%" : $request->buildingID;
            $data = Room::where('buildingID', 'like' ,$buildingID)->get();
            return Datatables::of($data)->editColumn('roomID', '{{$buildingID}}-{{$roomID}}')
                                        ->editColumn('created_at', '{{date("Y-m-d H:i:s", strtotime($created_at))}}')
                                        ->editColumn('updated_at', '{{ $updated_at == ""?"":date("Y-m-d H:i:s", strtotime($updated_at)) }}')
                                        ->addColumn('action', function ($row) {
                                            $actionBtn = '<button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa fa-pencil"></i></button>
					                        <button class="btn btn-secondary btn-sm sweet-5" type="button" onclick="deleteRoom(this)"><i class="fa fa-trash-o"></i></button>
                                            ';
                                            return $actionBtn;
                                            })
                                        ->rawColumns(['action'])
                                        ->make(true);
        }
        if (view()->exists('admin.room')) {
            $buildingID = Building::all();
            return view('admin.room',compact('buildingID'));
        }
        return abort('404');
    }

    public function device(Request $request)
    {
        if(Auth::user()->role == "superadmin"){
            $bid = "%%";
        }
        else {
            $temp = explode(" ",Auth::user()->name);
            $bid = end($temp);
        }
        if($request->ajax()){
            $data = Device::where('buildingID', 'like' ,$bid)->get();
            return Datatables::of($data)->editColumn('roomID', '{{$buildingID}}-{{$roomID}}')
                                        ->editColumn('created_at', '{{date("Y-m-d H:i:s", strtotime($created_at))}}')
                                        ->editColumn('updated_at', '{{ $updated_at == ""?"":date("Y-m-d H:i:s", strtotime($updated_at)) }}')
                                        ->addColumn('action', function ($row) {
                                            $actionBtn = '<button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa fa-pencil"></i></button>
					                        <button class="btn btn-secondary btn-sm sweet-5" type="button" onclick="deleteDevice(this)"><i class="fa fa-trash-o"></i></button>
                                            ';
                                            return $actionBtn;
                                            })
                                        ->rawColumns(['action'])
                                        ->make(true);
        }
        $buildingID = Building::where('buildingID', 'like', $bid)->get();
        $roomID = Room::where('buildingID', 'like', $bid)->get();
        return view('admin.device',compact('buildingID','roomID'));
    }

    public function chat()
    {
        return view('admin.chat');
    }

    public function user(Request $request)
    {
        if($request->ajax()){
            $data = User::select('id', 'name', 'email', 'role')->get();
            return Datatables::of($data)->addColumn('action', function ($row) {
                                            $actionBtn = '<button class="btn btn-success btn-sm" type="button" data-bs-toggle="modal" data-bs-target="#exampleModal" ><i class="fa fa-pencil"></i></button>
					                        <button class="btn btn-secondary btn-sm sweet-5" type="button" onclick="deleteUser(this)"><i class="fa fa-trash-o"></i></button>
                                            ';
                                            return $actionBtn;
                                            })
                                        ->rawColumns(['action'])
                                        ->make(true);
        }
        if (view()->exists('admin.user')) {
            return view('admin.user');
        }
        return abort('404');
    }

    public function support()
    {
        return view('admin.support');
    }

    public function settings()
    {
        return view('admin.settings');
    }

    //Quản lí tài khoản
    public function addUser(Request $request)
    {
        if($request->file('file')){
            Excel::import(new UsersImport, $request->file('file'));
        }
        else{
            $data = $request->input();
            $validator = Validator::make($data, [
                'name' => ['required', 'string', 'max:100'],
                'email' => ['required', 'string', 'email', 'max:100', 'unique:users'],
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            User::create($data);
            return response()->json('success', 200);
        }
    }

    public function editUser(Request $request)
    {
        $user = User::find(substr($request->id,4));
        $user->name = $request->name;
        $user->email = $request->email;
        $user->role = $request->role;
        try {
            $user->save();
        } catch (\Exception $e) {
            return response()->json('error',422);
        }
        return response()->json('success',200);
    }

    public function deleteUser($id)
    {
        User::find($id)->delete();
    }

    //Quản lí phòng học
    public function addRoom(Request $request)
    {
        $data = $request->input();
        if(strpos($data['roomID'],'-') !== false){
            $from = substr($data['roomID'],0,strpos($data['roomID'],'-'));
            $to = substr($data['roomID'],strpos($data['roomID'],'-')+1);
            $validator = Validator::make(['roomIDfrom' => $from, 'roomIDto' => $to], [
                'roomIDfrom' => ['required', 'numeric'],
                'roomIDto' => ['required', 'numeric', "gt:$from"],
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            for ($i=$from; $i <= $to; $i++) { 
                $value = [
                    'roomID' => $i,
                    'buildingID' => $data['buildingID'],
                    'status' => "Đang hoạt động"
                ];
                $validator = Validator::make($value, [
                    'roomID' => ['required', 'numeric', 'unique:room,roomID,NULL,buildingID'.$data['buildingID']]
                ]);
                if($validator->fails()){
                    return response()->json($validator->errors(), 422);
                }
                Room::create($value);
            }
        }
        else{
            $validator = Validator::make($data, [
                'roomID' => ['required', 'numeric', 'unique:room,roomID,NULL,buildingID'.$data['buildingID']]
            ]);
            if($validator->fails()){
                return response()->json($validator->errors(), 422);
            }
            Room::create($data);
        }
        return response()->json('success', 200);
    }

    public function editRoom(Request $request)
    {
        $room = Room::find($request->id);
        $room->status = $request->status;
        $room->note = $request->note;
        try {
            $room->save();
        } catch (\Exception $e) {
            return response()->json('error',422);
        }
        return response()->json('success',200);
    }

    public function deleteRoom($id)
    {
        $roomID = substr($id,strpos($id,"-")+1);
        $buildingID = substr($id,0,strpos($id,"-"));
        Room::where(['roomID' => $roomID, 'buildingID' => $buildingID])->delete();
    }

    //Quản lí thiết bị
    public function addDevice(Request $request)
    {
        $data = [
            'roomID' => substr($request->roomID,strpos($request->roomID,"-")+1),
            'buildingID' => substr($request->roomID,0,strpos($request->roomID,"-")),
            'deviceID' => $request->deviceID,
            'deviceName' => $request->deviceName
        ];
        $validator = Validator::make($data, [
            'deviceID' => ['required', 'string', 'unique:device'],
            'deviceName' => ['required', 'string', 'max:100'],
        ]);
        if($validator->fails()){
            return response()->json($validator->errors(), 422);
        }
        Device::create($data);
        return response()->json('success', 200);
    }

    public function editDevice(Request $request)
    {
        $device = Device::find($request->id);
        $device->deviceName = $request->deviceName;
        $device->roomID = substr($request->roomID,strpos($request->roomID,"-")+1);
        $device->buildingID = substr($request->roomID,0,strpos($request->roomID,"-"));
        $device->status = $request->status;
        $device->note = $request->note;
        try {
            $device->save();
        } catch (\Exception $e) {
            return response()->json('error',422);
        }
        return response()->json('success',200);
    }

    public function deleteDevice($id)
    {
        Device::where("deviceID",$id)->delete();
    }

}
