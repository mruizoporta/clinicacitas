<?php
use Illuminate\Support\Str;
?>

@extends('layouts.panelweb') 
@include('sweetalert::alert')
@section('content')
         
  <div class="card shadow">

    <div class="card-header border-0">
      <div class="row align-items-center">
        <div class="col">
        </div>
      </div>
    </div>

    <div class="card-body">   
      <div class="row">
        
        <div class="form-group col-md-4 mda-px-0">
      
          <div id="accordion" class="pt-3">

            <div class="card mda-process">

              <div class="card-header py-1" id="headingOne">
                  <button id="acservicio" class="btn btn-link btn-block p-0" data-toggle="collapse" data-target="#collapseOne" aria-controls="collapseOne">
                    <h2 id="tituloservicio">
                      <span> Selecciona el servicio</span>
                    </h2>
                    <h2 id="tituloservicioeditar" style="display: none;">
                      <span>Servicio.</span>
                      <span id="lbleditarespecialidad" class="mda-edit">Editar<span>
                    </h2>
                  </button>
              </div>

              <div id="collapseOne" class="collapse " aria-labelledby="headingOne" data-parent="#accordion">
                <div class="card-body py-2">
                  <div class="mda-process-info p-3">
                    <h3>
                      <span id="especialidadselect">${especialidadselecionada}.</span>
                    </h3>
                    <h3 class="m-0">
                        <span id="precioselect">${precioseleccionado}</span>
                        <span id="duracionselect">${duracionseleccionada}</span>
                    </h3>
                  </div>
                </div>
              </div>

            </div>

            <div class="card mda-process">
              <div class="card-header py-1" id="headingTwo">
                  <button id="acmedico" class="btn btn-link btn-block p-0 collapsed" data-toggle="collapse" data-target="#collapseTwo" aria-expanded="false" aria-controls="collapseTwo">
                  <h2 id="titulomedico">
                    <span>Selecciona el médico</span>
                  </h2>
                  <h2 id="titulomedicoeditar" style="display: none;">
                    <span>Médico.</span>
                    <span  id="lbleditarmedico" class="mda-edit">Editar<span>
                  </h2>                      
                  </button>
              </div>
              <div id="collapseTwo" class="collapse" aria-labelledby="headingTwo" data-parent="#accordion">
              <div class="card-body py-2">
                  <div class="mda-process-info p-3">
                    <h3>
                    <span id="medicoselect">${medicoseleccionado}</span>
                    </h3>
                    <h3 class="m-0">
                      <span  id="espacialidadmedicoselect">Especialista en ${especialidadselecionada}.</span>
                    </h3>
                  </div>
                </div>
              </div>
            </div>

            <div class="card mda-process">
              <div class="card-header py-1" id="headingThree">
                  <button id="acfecha" class="btn btn-link btn-block p-0 collapsed" data-toggle="collapse" data-target="#collapseThree" aria-expanded="false" aria-controls="collapseTwo">
                    <h2 id="titulodia">
                      <span>Selecciona el día y la hora</span>
                    </h2>
                    <h2 id="titulodiaeditar" style="display: none;">
                      <span>Día y Hora.</span>
                      <span  id="lbleditarfecha" class="mda-edit">Editar</span>
                    </h2>
                  </button>
              </div>
              <div id="collapseThree" class="collapse" aria-labelledby="headingThree" data-parent="#accordion">
                <div class="card-body py-2">                     
                  <h3 class="m-0">
                    <span id="fechaselect"></span>
                    <span id="intevaloselect"></span>
                  </h3>                    
                </div>
              </div>
            </div>

            <div class="card mda-process">
              <div class="card-header py-1" id="headingFour">
                <button class="btn btn-link btn-block p-0 collapsed" data-toggle="collapse" data-target="#collapseFour" aria-expanded="false" aria-controls="collapseFour">
                  <h2 id="titulodatos">
                    <span>Ingresa datos personales</span>
                  </h2>
                </button>
              </div>
            </div>

          </div> 
        </div>

        <div class="form-group col-md-8 mda-px-0">   
              
          <!-- <form>          -->
            <div id="servicio" >             
              <div class="form-row">                    
                <div class="form-group col-md-8">

                  <h3 style=" color:#383C57 !important;" >Selecciona el servicio</h3>                                            
                  @foreach($specialties as $especialidad)
                  <div class="col-12">
                    <div class="card-deck mda-card">
                      <div id="{{$especialidad->id}}-cardes" class="cardes mb-4">
                        <div class="card-body" role="button">
                          <h5 class="card-title"><input name="seleccionservicio" value="{{$especialidad->name}}"  id="{{$especialidad->id}}" type="radio">
                            <label for="{{$especialidad->name}} ">{{$especialidad->name}} </label></h5>
                            <p class="card-text">
                              <span id="precio-{{$especialidad->id}}"> Precio: ${{$especialidad->precio}} </span>
                              <span id="duracion-{{$especialidad->id}}">- {{$especialidad->duracion}} minutos</span>
                              <a href="https://www.valencia-medspa.com/servicios/">Mas informacion</a>
                              <p>{{$especialidad->description}}</p>
                          </p>
                        
                        </div>
                      </div>
                    </div>
                  </div>
                  @endforeach

                </div>
              </div>
            </div>

            <div id="medicos" style="display: none;">
               <div class="form-row">   
                <div class="form-group col-md-8">
                  <h3 id="doctor">Selecciona un medico</h3>   
                 <div id="medicoconcatenar">
              <!--       <div id="elephant-card" class="cardmedicos mb-4">
                      <div class="card-body" role="button">
                        <h5 class="card-title"><input id="elephant" type="radio">
                          <label for="elephant">Elephant desde el inicio</label>
                        </h5>
                        <p class="card-text">It is a long established fact that a reader will be
                        distracted by the readable content of a page when looking at its layout.</p>
                      </div>
                    </div>-->
                  </div>        
                </div>
              </div> 
            </div>

            <div id="fecha">

              <div id="calendario">
                <div class="form-row">
                  <div class="form-group col-md-10">
                    <h3>Selecciona tu fecha y hora preferida</h3>                          
                    <div id="calendar" class="mda-calendar"></div>
                  </div>
                </div>
              </div>

              <div id="horas">
                <div class="form-row">
                  <div class="form-group col-md-10">
                  <div id="intervalohoras">
                      <div >
                        <div id="hoursMorning" class="btn-group-toggle mda-horas" data-toggle="buttons">                            
                        </div>                                       
                      </div>
                      <div >                        
                        <div id="hoursAfternoom" class="btn-group-toggle mda-horas" data-toggle="buttons">                          
                        </div>                        
                      </div>
                  </div>
                  </div>
                </div>
              </div>

            </div>

            <div id="paciente" style="display: none;">
              <form id="formpacientes" onsubmit="GuardarCita();"> 
               <div class="form-row mda-form">
                  <div class="col-md-10">
                    <h3 >Estas casi listo, ingresa tus datos personales</h3>

                    <div  style="display: none;" id="notificacion" class="card-body">             
                      <div class="alert alert-success" role="alert">
                        
                      </div>           
                  </div>

                    <div class="custom-control custom-radio mt-3 mb-3" style="display: none;">
                        <input type="radio" id="type1" name="type" checked class="custom-control-input"
                        @if(old('type')=='Consulta') checked @endif 
                        value="Consulta">
                        <label class="custom-control-label" for="type1">Consulta</label>
                    </div>

                    <div class="input-group mb-3">
                      <div class="input-group-prepend">
                        <input class="input-group-text" id="area" value="+507">
                      </div>
                      <input type="tel" name="phone" class="form-control" value="" placeholder="Teléfono " id="phone"  aria-describedby="phone" required>
                    </div>

                    <div class="form-group">
                      <input class="form-control" name="email" type="email" placeholder="Correo electrónico "  value="" id="email" required>
                    </div>

                    <div class="form-group">
                      <input class="form-control" name="name" placeholder="Nombres"  type="text" value="" id="name" required>
                    </div>

                    <div class="form-group">
                      <input class="form-control"  placeholder="Apellidos" type="text" value="" id="lastname" required>
                    </div>

                    <div class="form-group">
                      <textarea name="description" id="description" type="text" class="form-control"
                  rows=5 placeholder="Notas de cita" required></textarea>
                    </div>                 

                    <div id="notificacion" style="display: none;" class="alert alert-success" role="alert">    
                    Gracias!. Su cita ha sido programada correctamente.           
                    </div>

                    <button type="submit"  id="btnreservar" class="btn btn-sm btn-primary px-5 float-right"> Reservar cita</button>

                  </div>
                </div>
               </form>  
            </div>

          <!-- </form> -->
        </div>
      
        <div class="form-group col-md-12 mda-px-0">

          <div class="row">
            <div class="col-12">
              <div id="botonderechaservicios" class="mda-btn text-right">                 
                <button disabled id="btnserviciosiguiente" class="btn btn-primary">Continuar</button>                  
              </div>
            </div>
            <div class="col-md-6">
              <div id= "botonizquierdomedico" class="mda-btn text-left" style="display: none;">                  
                <button id="btnmedicoanterior" class="btn btn-success">Regresar</button>
              </div>  
            </div>
            <div class="col-md-6">
              <div  id="botonderechamedicos" class="mda-btn text-right" style="display: none;">   
                <button disabled id="btnmedicosiguiente" class="btn btn-primary">Continuar</button>
              </div>
            </div>
            <div class="col-md-6">
              <div id= "botonizquierdofecha" class="mda-btn text-left" style="display: none;">                  
                <button  id="btnfechaanterior" class="btn btn-success">Regresar</button>
              </div>
            </div>
            <div class="col-md-6">
              <div  id="botonderechafecha" class="mda-btn text-right" style="display: none;">   
                <button disabled id="btnfechasiguiente" class="btn btn-primary">Continuar</button>
              </div>
            </div>
            <div class="col-md-6">
              <div id= "botonizquierdopaciente" class="mda-btn text-left" style="display: none;">                  
                <button id="btnpacienteanterior" class="btn btn-success">Regresar</button>
              </div>
            </div>
          </div>

        </div>

      </div>
    </div>
    
  </div>
@endsection

@section('scripts')
<script src="{{asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script>
<!-- <script src="{{asset('js/plugins/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}} "></script> -->
<!-- <script src="https://code.jquery.com/jquery-3.6.0.js"></script>
<script src="https://code.jquery.com/ui/1.13.1/jquery-ui.js"></script> -->
<!-- <script src="{{ asset('js/appointments/jquery-3.3.1.min.js')}}">   -->
<script src="{{ asset('js/appointments/createweb.js')}}">  
<script src="{{ asset('js/appointments/calendar.js')}}"> 
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.min.js "></script>

<script>

$(document).ready(function () {
    
   //   $("#fecha").css("display", "none");

      $('input:radio').change(function () {
          const radioClicked = $(this).attr('id');
          specialtyId = radioClicked;
          especialidadselecionada =  $(this).attr('value');         
          precioseleccionado = $('#precio-' + radioClicked).text();
          duracionseleccionada= $('#duracion-' + radioClicked).text();

          $("#btnserviciosiguiente").attr("disabled", false)
          $('·collapseOne')
            .removeClass('cbtn btn-link btn-block p-0 ')
            .addClass('btn btn-link btn-block p-0 collapsed')

          unclickRadio();
          removeActive();
          clickRadio(radioClicked);
          makeActive(radioClicked);

          document.getElementById('especialidadselect').innerHTML = especialidadselecionada;
          document.getElementById('precioselect').innerHTML = precioseleccionado;
          document.getElementById('duracionselect').innerHTML = duracionseleccionada;

          //Cargar los medicos           
          const url=`/especialidades/${radioClicked}/medicos`;
          $.getJSON(url,onDoctorsLoad);
      });
      $(".cardes").click(function () {
          const inputElement = $(this).find('input[type=radio]').attr('id');
          specialtyId = inputElement;
          especialidadselecionada = $(this).find('input[type=radio]').attr('value');
          precioseleccionado = $('#precio-' + inputElement).text();
          duracionseleccionada= $('#duracion-' + inputElement).text();
          $("#btnserviciosiguiente").attr("disabled", false)

          unclickRadio();
          removeActive();
          makeActive(inputElement);
          clickRadio(inputElement);        
         
          document.getElementById('especialidadselect').innerHTML = especialidadselecionada;
          document.getElementById('precioselect').innerHTML = precioseleccionado;
          document.getElementById('duracionselect').innerHTML = duracionseleccionada;
          
          const url=`/especialidades/${inputElement}/medicos`;
          $.getJSON(url,onDoctorsLoad);
      });
      $("#btnmedicoanterior").click(function(){
          $("#servicio").css("display", "block"); 
          $("#medicos").css("display", "none"); 

          $("#botonderechaservicios").css("display", "block"); 
          $("#botonderechamedicos").css("display", "none"); 
          $("#botonizquierdomedico").css("display", "none"); 
          $("#botonizquierdofecha").css("display", "none"); 
          $("#botonderechafecha").css("display", "none");  
         
      });  

      $("#lbleditarespecialidad").click(function(){
          $("#servicio").css("display", "block"); 
          $("#medicos").css("display", "none"); 
          $("#fecha").css("display", "none"); 
          $("#paciente").css("display", "none"); 

          $("#botonderechaservicios").css("display", "block"); 
          $("#botonderechamedicos").css("display", "none"); 
          $("#botonizquierdomedico").css("display", "none");  
          $("#botonizquierdofecha").css("display", "none"); 
          $("#botonderechafecha").css("display", "none");
          $("#botonizquierdopaciente").css("display", "none");           
      });  
      
      $("#lbleditarmedico").click(function(){
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "block"); 
          $("#fecha").css("display", "none"); 
          $("#paciente").css("display", "none"); 

          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "block"); 
          $("#botonizquierdomedico").css("display", "block");  
          $("#botonizquierdofecha").css("display", "none"); 
          $("#botonderechafecha").css("display", "none");
          $("#botonizquierdopaciente").css("display", "none");           
      });  

      $("#lbleditarfecha").click(function(){
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "none"); 
          $("#fecha").css("display", "block"); 
          $("#paciente").css("display", "none"); 

          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "none"); 
          $("#botonizquierdomedico").css("display", "none");  
          $("#botonizquierdofecha").css("display", "block"); 
          $("#botonderechafecha").css("display", "block");
          $("#botonizquierdopaciente").css("display", "none");           
      });  

      $("#btnmedicosiguiente").click(function()
      {        
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "none"); 
          $("#fecha").css("display", "block");
         
          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "none"); 
          $("#botonizquierdomedico").css("display", "none"); 

          $("#botonizquierdofecha").css("display", "block"); 
          $("#botonderechafecha").css("display", "block"); 

          $("#titulomedico").css("display", "none");                 
          $("#titulomedicoeditar").css("display", "block");
          $('#acmedico').trigger('click'); 

      });  

      $("#btnfechaanterior").click(function(){
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "block"); 
          $("#fecha").css("display", "none"); 

          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "block"); 
          $("#botonizquierdomedico").css("display", "block");  
          $("#botonizquierdofecha").css("display", "none"); 
          $("#botonderechafecha").css("display", "none");   
      }); 

      $("#btnfechasiguiente").click(function()
      {
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "none"); 
          $("#fecha").css("display", "none"); 
          $("#paciente").css("display", "block"); 

          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "none"); 
          $("#botonizquierdomedico").css("display", "none"); 

          $("#botonizquierdofecha").css("display", "none"); 
          $("#botonderechafecha").css("display", "none"); 

          $("#botonizquierdopaciente").css("display", "block");

          $("#titulodia").css("display", "none");                 
          $("#titulodiaeditar").css("display", "block"); 
          $('#acfecha').trigger('click'); 

      });  

      $("#btnpacienteanterior").click(function(){
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "none"); 
          $("#fecha").css("display", "block"); 
          $("#paciente").css("display", "none"); 

          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "none"); 
          $("#botonizquierdomedico").css("display", "none");  
          $("#botonizquierdofecha").css("display", "block"); 
          $("#botonderechafecha").css("display", "block"); 
          $("#botonizquierdopaciente").css("display", "none");
      }); 
    
      });
      
      function GuardarCita()
      {
        var url_route = 'http://citas.test/api/solicitar';    
       
            var formData = {
                name: $("#name").val() + ' ' + $("#lastname").val(),
                email: $("#email").val(),
                phone: $("#phone").val(),
                scheduled_date:fechaseleccionada,
                scheduled_time: intervaloseleccionado,
                type: "Consulta",
                description: $("#description").val(),
                doctor_id: doctorId,
                specialty_id: specialtyId
              };
            console.log(formData);
            $.ajax({
                type: 'post',
                dataType: "json",
                url: url_route,
                data: JSON.stringify(formData),    
                encode: true, 
                contentType: "application/json; charset=utf-8"
            }).done(function (data) {
              console.log(data);
              if (data.status=1)
              {                              
                  swal("Muchas gracias!", data.msg ,"success", {
                      button:"OK"
                    });
                   window.location.replace("https://www.valencia-medspa.com/");
              }else{
                swal("Disculpe!", "En este momento no es posible registrar la cita. Intente mas tarde!" ,"error", {
                      button:"OK"
                    });
              }
            });
             event.preventDefault();
           
      }

    function darclick(elem)
    {              
      const inputElement = $('#'+elem.id).find('input[type=radio]').attr('id');    
      doctorId= inputElement;
      medicoseleccionado=$('#nombre-'+inputElement).text();      
      
      unclickRadio();
      removeActivemedicos();
      makeActivemedicos(inputElement);
      clickRadio(inputElement);  
      $("#btnmedicosiguiente").attr("disabled", false)

      document.getElementById('medicoselect').innerHTML = medicoseleccionado;
      document.getElementById('espacialidadmedicoselect').innerHTML = "Especialista en " + especialidadselecionada;     
         
    }

    function horasclick(elem)
    { 
      const inputElement = $('#'+elem.id).find('input[type=radio]').attr('id');    
      intervaloid= inputElement;
      intervaloseleccionado= $('#'+inputElement+"-cardhoras").text().trim();      
      removeActivehoras();
      makeActivehoras(inputElement);
      $("#btnfechasiguiente").attr("disabled", false);
      document.getElementById('intevaloselect').innerHTML = " - " + intervaloseleccionado;
       
    }


    function unclickRadio() {
        $("input:radio").prop("checked", false);
    }

    function clickRadio(inputElement) {
        $("#" + inputElement).prop("checked", true);
    }

    function removeActive() {
      var rojos = document.getElementsByClassName("activees");
      for (var i = 0; i<rojos.length; i++) {
        rojos[i].classList.remove("activees");       
      }
    }

    function makeActive(element) {  
        $("#" + element + "-cardes").addClass("activees");
    }

    function removeActivemedicos() {
      var rojos = document.getElementsByClassName("activemedicos");
      for (var i = 0; i<rojos.length; i++) {
        rojos[i].classList.remove("activemedicos");       
      }
    }

    function removeActivehoras(element) {      
      var rojos = document.getElementsByClassName("activehoras");  
      var seleccionados =  document.getElementsByClassName("btn btn-mda btn-secondary active"); 
      
      for (var i = 0; i<rojos.length; i++) {
        rojos[i].classList.remove("activehoras");       
      }

      for (var i = 0; i<seleccionados.length; i++) {
        seleccionados[i].classList.remove("active");       
      }

      $("#" + element + "-cardhoras").addClass("activehoras");
     
    }
    
    function makeActivehoras(element) {     
 
      $("#" + element + "-cardhoras").removeClass("active");           
      }

    function makeActivemedicos(element) {       
      $("#" + element + "-cardmedicos").addClass("activemedicos");     
  }

    
</script>

@endsection
