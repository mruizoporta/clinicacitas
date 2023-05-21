<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Appointment;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
  
    public function index(){
        $role=auth()->user()->role;

        if($role=='admin')
        {
            //Admin
            $confirmedAppointments=Appointment::all()
            ->where('status','Confirmada');

            $pendingAppointments=Appointment::all()
            ->where('status','Reservada');   

            $oldAppointments=Appointment::all()
            ->whereIn('status',['Atendida','Cancelada']);
           
        }elseif($role=='doctor'){
                $confirmedAppointments=Appointment::all()
                ->where('status','Confirmada')
                ->where('doctor_id',auth()->id());

                $pendingAppointments=Appointment::all()
                ->where('status','Reservada')
                ->where('doctor_id',auth()->id());   

                $oldAppointments=Appointment::all()
                ->whereIn('status',['Atendida','Cancelada'])
                ->where('doctor_id',auth()->id()); 
        }
        elseif($role=='paciente')
        {
            $confirmedAppointments=Appointment::all()
                ->where('status','Confirmada')
                ->where('patient_id',auth()->id());

            $pendingAppointments=Appointment::all()
                ->where('status','Reservada')
                ->where('patient_id',auth()->id());   

            $oldAppointments=Appointment::all()
                ->whereIn('status',['Atendida','Cancelada'])
                ->where('patient_id',auth()->id()); 
        }        
        return view('home',compact('confirmedAppointments','pendingAppointments','oldAppointments','role'));
    }
}
