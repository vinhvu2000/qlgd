<?php

namespace App\Imports;

use App\Models\Schedule;
use Carbon\Carbon;
use Carbon\CarbonPeriod;
use Illuminate\Support\Facades\Validator;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\WithValidation;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Facades\Excel;
use Maatwebsite\Excel\Validators\Failure;
use Maatwebsite\Excel\Concerns\FromCollection;

class ScheduleImport implements FromCollection, WithValidation
{
    /**
    * @param array $row
    *
    * @return \Illuminate\Database\Eloquent\Model|null
    */
    private $errors = [];

    public function collection()
    {   
        // return Schedule::all();
    }

    public function rules(): array
    {
        return [
            'day' => 'required|date',
            'timeStart' => 'required',
            'timeEnd' => 'required',
            'buildingID' => 'required',
            'roomID' => 'required',
            'subjectID' => 'required',
            'subjectName' => 'required',
            'credit' => 'required',
            'time' => 'required',
            'teacher' => 'required'
        ];
    }

    public function validationMessages()
    {

    }
    
    public function genData($file)
    {
        $dataJson = [];
        $rows = Excel::toArray(new ScheduleImport, $file)[0];
        foreach ($rows as $key => $value) {
            if($key == 0) continue;
            if($value[0] == "") break;
            $dayStart = Carbon::createFromFormat("d/m/y",substr($value[4],0,8))->format('Y-m-d');
            $dayEnd = Carbon::createFromFormat("d/m/y",substr($value[4],9,8))->format('Y-m-d');
            $period = CarbonPeriod::create($dayStart,$dayEnd);
            $time = substr($value[4],strpos($value[4],"(T")+2);
            $temp = explode("-",substr($time,0,-1));
            $roomArray = explode("-",$value[6]);
            $timeStart = $temp[0]<=5?6+$temp[0]:7+$temp[0];
            $timeEnd = $timeStart+$temp[1]-$temp[0]+1;
            $value4toArr = explode(" ",$value[4]);
            foreach ($period as $key => $date) {
                if($date->dayOfWeek + 1 == $value4toArr[1]){
                    $data = [
                        'day' => $date->format('Y-m-d'),
                        'timeStart' => $timeStart,
                        'timeEnd' => $timeEnd,
                        'buildingID' => $roomArray[0],
                        'roomID' => $roomArray[1],
                        'subjectID' => $value[0],
                        'subjectName' => $value[1],
                        'credit' => $value[2],
                        'time' => $value[3],
                        'teacher' => $value[5]
                    ];
                    $validator = Validator::make($data, $this->rules());
                    if ($validator->fails()) {
                        foreach ($validator->errors()->messages() as $messages) {
                            foreach ($messages as $error) {
                                // accumulating errors:
                                $this->errors[] = $error;
                            }
                        }
                    } else {
                        Schedule::create($data);
                        array_push($dataJson,$data);
                    }
                } elseif($value4toArr[1] == "nhật" && $date->dayOfWeek == 0){
                        $data = [
                            'day' => $date->format('Y-m-d'),
                            'timeStart' => $timeStart,
                            'timeEnd' => $timeEnd,
                            'buildingID' => $roomArray[0],
                            'roomID' => $roomArray[1],
                            'subjectID' => $value[0],
                            'subjectName' => $value[1],
                            'credit' => $value[2],
                            'time' => $value[3],
                            'teacher' => $value[5]
                        ];
                        $validator = Validator::make($data, $this->rules());
                        if ($validator->fails()) {
                            foreach ($validator->errors()->messages() as $messages) {
                                foreach ($messages as $error) {
                                    // accumulating errors:
                                    $this->errors[] = $error;
                                }
                            }
                        } else {
                            array_push($dataJson,$data);
                            Schedule::create($data);
                        }
                }
            }
        }
        print_r(json_encode($dataJson));
        die();
    }

    public function getErrors()
    {
        return $this->errors;
    }
}
