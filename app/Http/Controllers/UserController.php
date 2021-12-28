<?php

namespace App\Http\Controllers;

use App\Models\Building;
use App\Models\Device;
use App\Models\Room;
use App\Models\Schedule;
use Carbon\Carbon;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;


class UserController extends Controller
{
    public function dashboard(Request $request)
    {
        $buildingID = Building::all();
        $bid = $request->post()?$request->buildingID:$buildingID[0]['buildingID'];
        $roomArr = Room::where('buildingID',$bid)->where('roomID','<>','100')->get();
        $floorArr = [];
        foreach($roomArr as $key => $value){
            array_push($floorArr,substr($value['roomID'],0,-2));
        }
        $floorArr = array_unique($floorArr);
        sort($floorArr);
        $room = [];
        $tempFloor = $request->floor == NULL?$floorArr[0]:$request->floor;
        foreach($roomArr as $key => $value){
            if(substr($value['roomID'],0,-2) == $tempFloor) array_push($room,$value['roomID']);
        }
        $today = $request->day == NULL?Carbon::now()->toDateString():$request->day;
        $scheduleArr = Schedule::where(['day' => $today, 'buildingID' => $bid])->where('roomID','like', $tempFloor.'%')->orderBy('timeStart','ASC')->get();
        for($i = 7; $i<= 18; $i++) {
            $time[$i] = $i;
            foreach ($room as $key => $value) {
                $schedule[$i][$value] = [];
            }
        }
        foreach ($scheduleArr as $key => $value) {
            $schedule[$value['timeStart']][$value['roomID']] = $value;
            $schedule[$value['timeStart']][$value['roomID']]->user = json_decode($value->user,true);
            for ($i=$value['timeStart']+1; $i <= $value['timeEnd'] ; $i++) { 
                $schedule[$i][$value['roomID']] = "continue";
            }
        }
        $input = $request->post()?$request->input():['buildingID'=>'','floor'=>'','day'=>''];
        return view('user.dashboard',compact('buildingID','floorArr','room','time','schedule','input', 'roomArr'));
    }

    public function addSchedule(Request $request)
    {
        $data = $request->input();
        $data['listDevice'] = "KEY$request->roomID,MIC$request->roomID,REM$request->roomID";
        if($request->listDevice != null){
            foreach($request->listDevice as $key => $value){
                $device = Device::where("deviceID","like",$value."%")->where("roomID","100")->first();
                $data['listDevice'].=",$device->deviceID";
            }
        }
        $data['status'] = 2;
        $data['buildingID'] = substr($data['roomID'],0,strpos($data['roomID'],"-"));
        $data['roomID'] = substr($data['roomID'],strpos($data['roomID'],"-")+1);
        unset($data['user']);
        $data['user'] = json_encode(['account' => Auth::user()->name, 'user' => $request->user]);
        Schedule::create($data);
        return redirect()->back();
    }

    public function checkOut(Request $request)
    {
        # code...
    }

    public function checkIn(Request $request)
    {
        $schedule = Schedule::find($request->id);
        if($request->listDevice != null){
            foreach($request->listDevice as $key => $value){
                $device = Device::where("deviceID","like",$value."%")->where("roomID","100")->first();
                $schedule->listDevice.=",$device->deviceID";
            }
        }
        $schedule->status = 1;
        $schedule->user = json_encode(['account' => Auth::user()->name, 'user' => $request->user]);
        $schedule->save();
        return [$request->id,$request->user,$schedule->listDevice];
    }
    
    public function updateSchedule(Request $request)
    {
        $schedule = Schedule::find($request->id);
        $schedule->day = $request->day;
        $schedule->timeStart = $request->timeStart;
        $schedule->timeEnd = $request->timeEnd;
        $schedule->roomID = substr($request->roomID,strpos($request->roomID,"-")+1);
        $schedule->buildingID = substr($request->roomID,0,strpos($request->roomID,"-"));
        $schedule->teacher = $request->teacher;
        $schedule->subjectID = $request->subjectID;
        $schedule->subjectName = $request->subjectName;
        $schedule->listDevice="KEY$request->roomID,MIC$request->roomID,REM$request->roomID";
        if($request->listDevice != null){
            foreach($request->listDevice as $key => $value){
                $device = Device::where("deviceID","like",$value."%")->where("roomID","100")->first();
                $schedule->listDevice.=",$device->deviceID";
            }
        }
        $schedule->status = 2;
        $schedule->user = json_encode(['account' => Auth::user()->name, 'user' => $request->user]);
        $schedule->save();
        return redirect()->back();
    }

    public function changeBuild(Request $request)
    {
        $bid = $request->buildingID;
        $roomArr = Room::where('buildingID',$bid)->where('roomID','<>','100')->get();
        $floorArr = [];
        foreach($roomArr as $key => $value){
            array_push($floorArr,substr($value['roomID'],0,-2));
        }
        $floorArr = array_unique($floorArr);
        sort($floorArr);
        return json_encode($floorArr);
    }
    
    public function chat()
    {
        return view('admin.chat');
    }

    public function support()
    {
        return view('admin.support');
    }

    public function settings()
    {
        return view('admin.settings');
    }

}
