<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Models\Specialty;
use App\Http\Controllers\Controller;

class SpecialtyController extends Controller
{
    
    public function index(){
        $specialties= Specialty::all();
        return view('specialties.index', compact('specialties'));
    }

    public function create()
    {
        return view('specialties.create');
    }

    public function sendData(Request $request){
        $rules= [
                'name'=> 'required|min:3'
                ];

        $messages = [
            'name.required'=> 'El nombre de la especialidad es obbligatorio.',
            'name.min'=> 'El nombre de la especialidad debe tener mas de 3 caracteres.'
        ]; 

        $this->validate($request, $rules,$messages);
        $specialty = new Specialty();
        $specialty->name=$request->input('name');
        $specialty->description=$request->input('description');
        $specialty->precio=$request->input('precio');
        $specialty->duracion=$request->input('duracion');
        $specialty->save();
        $notification='La especialidad ha sido creada correctamente.';
        return redirect('/especialidades')->with(compact('notification'));
        
    }

    public function edit(Specialty $specialty){
        return view('specialties.edit', compact('specialty'));
    }

    public function update(Request $request, Specialty $specialty){
        $rules= [
                'name'=> 'required|min:3'
                ];

        $messages = [
            'name.required'=> 'El nombre de la especialidad es obbligatorio.',
            'name.min'=> 'El nombre de la especialidad debe tener mas de 3 caracteres.'
        ]; 

        $this->validate($request, $rules,$messages);
       
        $specialty->name=$request->input('name');
        $specialty->description=$request->input('description');
        $specialty->precio=$request->input('precio');
        $specialty->duracion=$request->input('duracion');
        $specialty->save();

        $notification='La especialidad ha sido actualizada correctamente.';      
        return redirect('/especialidades')->with(compact('notification'));
        
    }

    public function destroy(Specialty $specialty){
        $deletename= $specialty->name;
        $specialty->delete();
        $notification='La especialidad '. $deletename .' se ha sido eliminada correctamente.';      
        return redirect('/especialidades')->with(compact('notification'));
       
    }

}
