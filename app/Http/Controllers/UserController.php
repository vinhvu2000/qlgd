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
        $bid = $buildingID[0]['buildingID'];
        $roomArr = Room::where('buildingID',$bid)->get();
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
        $input = $request->post()?$request->input():['floor'=>'','day'=>''];
        return view('user.dashboard',compact('buildingID','floorArr','room','time','schedule','input', 'roomArr'));
    }

    public function addSchedule(Request $request)
    {
        $data = $request->input();
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
        foreach($request->listDevice as $key => $value){
            $device = Device::where("device_id","like",$value)->where("roomID","Kho")->first();
            $schedule->listDevice.=",$device->device_id";
        }
        $schedule->status = 1;
        $schedule->user = json_encode(['account' => Auth::user()->name, 'user' => $request->user]);
        $schedule->save();
        return [$request->id,$request->user];
    }
    
}
