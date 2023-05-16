@extends('layouts.panel')

@section('content')

<div></div>

    <div class="col-md-12 mb-4">
            <div class="card">
                <div class="card-header" style="color:#DA8C77;font-size: 1.3rem;">CONTROL DE CITAS</div>

                <div class="card-body">
                    @if (session('status'))
                        <div class="alert alert-success" role="alert">
                            {{ session('status') }}
                        </div>
                    @endif

                  
                </div>
            </div>
        </div>

    
      </div>
     
@endsection
