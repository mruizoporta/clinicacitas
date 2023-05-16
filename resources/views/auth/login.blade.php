@extends('layouts.form')
@section('title','Iniciar sesión')

@section('content')

  <!-- Page content -->
  <div class="container mt--8 pb-5">
      <div class="row justify-content-center">
        <div class="col-lg-5 col-md-7">
          <div class="card bg-secondary shadow border-0">
           
          
            <div class="card-body px-lg-5 py-lg-5">
            @if ($errors->any())

                <div class="text-center text-muted mb-2">
                    <h4>Se encontro el siguiente error.</h4>
                </div>

                <div class="alert alert-danger mb-4" role="alert">
                   {{$errors -> first()}}
                </div>
             @else
                <div class="text-center text-muted mb-4">
                    <h3>Ingresa tus credenciales</h3>
                </div>
            @endif
              <form role="form" method="POST" action="{{ route('login') }}">
                @csrf
                <div class="form-group mb-3">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-email-83"></i></span>
                    </div>
                    <input class="form-control " placeholder="Correo Electrónico" type="email" name="email" value="{{ old('email') }}" required autocomplete="email" autofocus>
                  </div>
                </div>
                <div class="form-group">
                  <div class="input-group input-group-alternative">
                    <div class="input-group-prepend">
                      <span class="input-group-text"><i class="ni ni-lock-circle-open"></i></span>
                    </div>
                    <input class="form-control " placeholder="Contraseñas" type="password" name="password" required autocomplete="current-password">
                  </div>
                </div>
                <div class="custom-control custom-control-alternative custom-checkbox">
                  <input name="remeber" class="custom-control-input" id=" remember" type="checkbox" {{ old('remember') ? 'checked' : '' }}>
                  <label class="custom-control-label" for=" remember">
                    <span class="text-muted">Recordar sesión</span>
                  </label>
                </div>
                <div class="text-center">
                  <button type="submit" class="btn btn-primary my-4 ">Empezar</button>
                </div>
              </form>
            </div>
          </div>
          <div class="row mt-3">
            
          
          </div>
        </div>
      </div>
    </div>
    
@endsection
