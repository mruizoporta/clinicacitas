<?php
namespace App\Http\Controllers;

use Illuminate\Support\Facades\Hash;
use Illuminate\Http\Request;
use App\Models\User;
use Carbon\Carbon;
use App\Models\Appointment;
use Illuminate\Support\Facades\Validator;


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
            if($data->password=="ND")
            {
               
                $user = User::create([  'name'  => $data->name,  
                'email' => $data->email,  
                'phone' => $data->phone, 
                'role'=>'paciente'              
            ]);
           
            }else
            {
               
                $user = User::create([  'name'  => $data->name,  
                'email' => $data->email,  
                'phone' => $data->phone, 
                'role'=>'paciente',
                'password' => Hash::make($data->password),
            ]);
           
            }
       
      
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

    public function usuarioexiste(Request $request){

        // console.log('llama al api');
         $response =["existe"=>0];
         $data= json_decode($request->getContent());
        
         //Buscamos si es un email existente
         $user = User::where('email',  $data->email)->first(); 
       
          if ($user)
          {         
            $response['existe']=1;
          }else{
            $response['existe']=0;
          }
        
        return response()-> json($response);
     }

}