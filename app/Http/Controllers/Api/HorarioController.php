<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Models\Horarios;
use App\Interfaces\HorarioServicesInterface;
use Carbon\Carbon;
use Illuminate\Http\Request;

class HorarioController extends Controller
{
    public function hours(Request $request, HorarioServicesInterface $horarioserviceinterface){
        $rules=[
            'date'=> 'required|date_format:"Y-m-d"',
            'doctor_id' => 'required|exists:users,id'
        ];

        $this->validate($request, $rules);
        $date = $request->input('date');       
        $doctorID = $request->input('doctor_id');

        return $horarioserviceinterface->getAvailableIntervals($date,$doctorID);
               
    }

   
}
