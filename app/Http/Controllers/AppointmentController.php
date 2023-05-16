<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use App\Models\Specialty;
use App\Models\Appointment;
use App\Models\CancelledAppointment;
use App\Interfaces\HorarioServicesInterface;
use Carbon\Carbon;
use App\Models\User;

class AppointmentController extends Controller
{
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
        return view('appointments.index',compact('confirmedAppointments','pendingAppointments','oldAppointments','role'));
    }
    public function create(HorarioServicesInterface $horarioserviceinterface){
        $specialties = Specialty::all();
        $specialtyId=old('specialty_id');
        if($specialtyId){
            $specialty = Specialty::find($specialtyId);
            $doctors=$specialty->users;
        }else{
            $doctors=collect();
        }

        $date = old('scheduled_date');
        $doctorId =  old('doctor_id');

        if ($date && $doctorId){
            $intervals = $horarioserviceinterface->getAvailableIntervals($date, $doctorId);            
        }else{
            $intervals =null;
        }

        return view('appointments.create' , compact('specialties','doctors','intervals'));
    }

    public function solicitar(HorarioServicesInterface $horarioserviceinterface){
        $specialties = Specialty::all();
        $specialtyId=old('specialty_id');
        if($specialtyId){
            $specialty = Specialty::find($specialtyId);
            $doctors=$specialty->users;
        }else{
            $doctors=collect();
        }

        $date = old('scheduled_date');
        $doctorId =  old('doctor_id');

        if ($date && $doctorId){
            $intervals = $horarioserviceinterface->getAvailableIntervals($date, $doctorId);            
        }else{
            $intervals =null;
        }

        return view('appointments.createweb' , compact('specialties','doctors','intervals'));
    }

    public function store(Request $request, HorarioServicesInterface $horarioserviceinterface){
        $rules = [
            'scheduled_time'=> 'required',
            'type' => 'required',
            'description' => 'required',
            'doctor_id' => 'exists:users,id',
            'specialty_id' => 'exists:specialties,id'
        ];
        $messages=[
            'scheduled_time.required'=> 'Debe seleccionar una hora valida para su cita.',
            'type.required'=> 'Debe seleccionar el tipo de consulta.',
            'description.required'=> 'Debe seleccionar sus sintomas.',
        ];

        $validator= Validator::make($request->all(), $rules, $messages);

        $validator->after(function ($validator) use ($request, $horarioserviceinterface) {
            $date= $request->input('scheduled_date');
            $doctorId= $request->input('doctor_id');
            $scheduled_time = $request->input('scheduled_time');
            
            if ( $date && $doctorId && $scheduled_time)
            {
                $start = new Carbon($scheduled_time);                
            }else{
                return;
            }
            if ($horarioserviceinterface->isAvailableInterval($date, $doctorId, $start)) {
                $validator->errors()->add(
                    'available_time', 'La hora seleccionada ya se encuentra reservada por otro paciente.'
                );
            }
        });

        if ($validator->fails()) {
            return back()
                        ->withErrors($validator)
                        ->withInput();
        }
 

        $data=$request->only([
            'scheduled_date',
            'scheduled_time',
            'type',
            'description',
            'doctor_id',
            'specialty_id'
        ]);

        $data['patient_id'] = auth()->id();

        $carbonTime=Carbon::createFromFormat('g:i A', $data['scheduled_time']);
        $data['scheduled_time']= $carbonTime->format('H:i:s');

        Appointment::create($data);

        $notification='La cita se ha realizado correctamente';
        return redirect('/miscitas')->with(compact('notification'));
    }

    public function cancel(Appointment $appointment, Request $request)
    {
        if($request->has('justification')){
            $cancellation=new CancelledAppointment();
            $cancellation->justification=$request->input('justification');
            $cancellation->cancelled_by_id=auth()->id();

            $appointment->cancellation()->save($cancellation);

        }
        $appointment->status='Cancelada';
        $appointment->save();
        $notification='La cita se ha cancelado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
        
    }

    public function confirm(Appointment $appointment)
    {   
        $appointment->status='Confirmada';
        $appointment->save();
        $notification='La cita se ha confirmado correctamente.';

        return redirect('/miscitas')->with(compact('notification'));
        
    }


    public function formcancel(Appointment $appointment){
        if($appointment->status=='Confirmada')
        {
            $role=auth()->user()->role; 
            return view('appointments.cancel', compact('appointment','role'));
        }
        return redirect('/miscitas');        
    }

    public function show(Appointment $appointment){
        $role=auth()->user()->role;        
        return view('appointments.show',compact('appointment','role'));

    }

    public function storeweb(Request $request)
    {
       
        $rules=[
            'name'=> 'required|min:3',
            'email'=> 'required|email',
            'phone'=>'required',
        ];
        $messages=[
            'name.required'=>'El nombre del paciente es obligatorio',
            'name.min'=>'El nombre del paciente debe tener mas de 3 caracteres',
            'email.required'=>'El correo electronico es obligatorio',
            'email.email'=>'Ingrese una direccion de correo electronico valido',
            'phone.required'=>'El numero de telefono es obligatorio',
            
        ];
     $this->validate($request, $rules, $messages);

     User::create(
        $request->only('name','email','cedula','address','phone')
        +['role'=>'paciente'        
        ]
     );
     $notification='El paciente se ha registrado correctamente.';
     return redirect('/pacientes')->with(compact('notification'));
    }

}
