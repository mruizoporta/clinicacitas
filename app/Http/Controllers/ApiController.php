<?php
namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\User;
use Iluminate\Support\Facades\Hash;
use Carbon\Carbon;
use App\Models\Appointment;

class ApiController extends Controller
{
    public function users(Request $request){
        $users = User::all();
        return response()->json($users);
    }

    public function solicitarcita(Request $request){

       // console.log('llama al api');
        $response =["status"=>0,"msg"=>"","id"=>""];
        $data= json_decode($request->getContent());
       
        //Buscamos si es un email existente
        $user = User::where('email',  $data->email)->first();

        if(!$user){
        //Guardamos los usuarios
        $user = User::create([  'name'  => $data->name,  
                        'email' => $data->email,  
                        'phone' => $data->phone, 
                        'role'=>'paciente'
                    ]
         );
        }
         if ($user)
         {            
                $data=$request->only([
                    'scheduled_date',
                    'scheduled_time',
                    'type',
                    'description',
                    'doctor_id',
                    'specialty_id'
                ]);

                $data['patient_id'] =$user->id;

                $carbonTime=Carbon::createFromFormat('g:i A', $data['scheduled_time']);
                $data['scheduled_time']= $carbonTime->format('H:i:s');
                
                Appointment::create($data);

                $response['msg']="Cita registrada satisfactoriamente.";
                $response['status']=1;
                $response['id']=$user->id;
         }

       //  var idpaciente= $user->id;
       return response()-> json($response);
    }
}