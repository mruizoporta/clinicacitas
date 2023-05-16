<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Models\User;
use App\Http\Controllers\Controller;

class DoctorController extends Controller
{
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        $doctors = User::doctors()->paginate(10);
        return view('doctors.index', compact('doctors'));
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create()
    {
        $specialties = Specialty::all();
        //echo("");

        return view('doctors.create', compact('specialties'));
    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
       // dd($request->all());

        $rules=[
            'name'=> 'required|min:3',
            'email'=> 'required|email',
            'cedula'=>'required',
            'address'=>'nullable|min:6',
            'phone'=>'required',
        ];
        $messages=[
            'name.required'=>'El nombre del medico es obligatorio',
            'name.min'=>'El nombre del medico debe tener mas de 3 caracteres',
            'email.required'=>'El correo electronico es obligatorio',
            'email.email'=>'Ingrese una direccion de correo electronico valido',
            'cedula.required'=>'La cedula es obligatoria',           
            'address.min'=>'La direccion debe tener al menos 6 caracteres',
            'phone.required'=>'El numero de telefono es obligatorio',
            
        ];
     $this->validate($request, $rules, $messages);

     $user = User::create(
        $request->only('name','email','cedula','address','phone')
        +['role'=>'doctor',
        'password'=> bcrypt($request->input('password'))
        ]
     );
     $user ->specialties()->attach($request->input('specialties'));

     $notification='El medico se ha registrado correctamente.';
     return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit(string $id)
    {
        $doctor= User::doctors()->findOrFail($id);

        $specialties = Specialty::all();
        $specialty_ids= $doctor->specialties()->pluck('specialties.id');
        return view('doctors.edit', compact('doctor','specialties','specialty_ids'));
    }

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, string $id)
    {
        $rules=[
            'name'=> 'required|min:3',
            'email'=> 'required|email',
            'cedula'=>'required|digits:10',
            'address'=>'nullable|min:6',
            'phone'=>'required',
        ];
        $messages=[
            'name.required'=>'El nombre del medico es obligatorio',
            'name.min'=>'El nombre del medico debe tener mas de 3 caracteres',
            'email.required'=>'El correo electronico es obligatorio',
            'email.email'=>'Ingrese una direccion de correo electronico valido',
            'cedula.required'=>'La cedula es obligatoria',            
            'address.min'=>'La direccion debe tener al menos 6 caracteres',
            'phone.required'=>'El numero de telefono es obligatorio',
            
        ];
     $this->validate($request, $rules, $messages);
     $user= User::doctors()->findOrFail($id);
     
     $data=$request->only('name','email','cedula','address','phone');
     $password= $request->input('password');
      
     if($password)
        $data['password']=bcrypt($password);
      
      $user->fill($data);
      $user->save() ; 
      $user -> specialties()->sync($request->input('specialties'));
     $notification='La informacion del medico se actualizo correctamente.';
     return redirect('/medicos')->with(compact('notification'));
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(string $id)
    {
        $user = User::doctors()->findOrFail($id);
        $doctorName=$user->name;
        $user->delete();

        $notification="El medico $doctorName se elimino correctamente";
        return redirect('/medicos')->with(compact('notification'));
    }
}
