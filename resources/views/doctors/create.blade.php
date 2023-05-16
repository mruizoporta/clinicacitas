<?php
  use Illuminate\Support\Str;
 
?>

@extends('layouts.panel')

@section ('styles')

  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

@endsection

@section('content')
          <div class="card shadow">
            <div class="card-header border-0">
              <div class="row align-items-center">
                <div class="col">
                  <h3 class="mb-0" >Nuevo medico</h3>
                </div>
                <div class="col text-right">
                  <a href="{{url('/medicos')}}" class="btn btn-sm btn-success">Regresar</a>
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
                <form action="{{url('/medicos')}}" method="POST">
                  @csrf
                    <div class="form-group">
                        <label for="name"> Nombre del medico</label>
                        <input type="text" name="name" class="form-control" value="{{old('name')}}" require> </input>
                    </div>

                    <div class="form-group">
                      <label for="specialties">Especialidades</label>
                        <select name="specialties[]" id="specialties" class="form-control selectpicker" 
                        data-style="btn-primary"  title="Seleccionar especialidades" multiple required>                        
                        @foreach ($specialties as $especialidad)
                          <option value="{{ $especialidad -> id }}"> {{$especialidad -> name}} </option>
                        @endforeach
                        </select>
                    </div>

                    <div class="form-group">
                        <label for="email"> Correo electronico </label>
                        <input type="text" name="email" class="form-control"  value="{{old('email')}}"> </input>
                    </div>

                    <div class="form-group">
                        <label for="cedula"> Cedula </label>
                        <input type="text" name="cedula" class="form-control"  value="{{old('cedula')}}"> </input>
                    </div>

                    <div class="form-group">
                        <label for="address"> Direccion </label>
                        <input type="text" name="address" class="form-control"  value="{{old('address')}}"> </input>
                    </div>

                    <div class="form-group">
                        <label for="phone"> Telefono / Movil </label>
                        <input type="text" name="phone" class="form-control"  value="{{old('phone')}}"> </input>
                    </div>

                    <div class="form-group">
                        <label for="password"> Contrasena </label>
                        <input type="text" name="password" class="form-control"  value="{{old('password',  Str::random(8))}}"> </input>
                    </div>

                    <button type="submit" class="btn btn-sm btn-primary" > Crear medico</button>
                </form>
            </div>
          </div>
   
@endsection

@section ('scripts')
<script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>
@endsection