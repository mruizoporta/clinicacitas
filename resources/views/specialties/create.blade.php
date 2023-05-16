@extends('layouts.panel')

@section('content')
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0">Nueva especialidad</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('/especialidades')}}" class="btn btn-sm btn-success">Regresar</a>
                  <i class="fas fa-chevron-left"> </i>
                </div>
              </div>
            </div>
            
            <div class="card-body">
              @if($errors->any())
              @foreach($errors->all() as $error)
              <div class="alert alert-danger" role="alert">
                <i class="fas fa-exclamation-triangle"></i>
              <strong>Por favor!</strong> {{$error}}
              </div>
              @endforeach
              @endif
                <form action="{{url('/especialidades')}}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="name"> Nombre de la especialidad </label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" require> </input>
                    </div>

                    <div class="form-group">
                        <label for="description"> Descripcion </label>
                        <textarea type="text" name="description" class="form-control"  rows=3 >
                        {{old('description',$specialty->description)}} </textarea>
                    </div>
                    
                    <div class="form-group">
                        <label for="precio"> Precio: </label>
                        <input class="form-control" type="number" 
                        min="0" step="0.01"
                        pattern="^\d+(?:\.\d{1,2})?$"
                        value="{{old('precio')}}" name="precio">                      
                    </div>

                    <div class="form-group">
                        <label for="duracion"> Duración del servicio (minutos): </label>
                        <input class="form-control" type="number" 
                        min="0" step="0.01"
                        pattern="^\d+(?:\.\d{1,2})?$"
                        value="{{old('duracion')}}" name="duracion">                      
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" > Crear especialidad</button>
                </form>
            </div>
          </div>
   
@endsection
