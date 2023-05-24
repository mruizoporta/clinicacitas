let $doctor, $date, $specialty;
let $hoursMorning, $hoursAfternoom, $titleMorning,$titleAfternoom,iRadio
let especialidadselecionada, medicoseleccionado, precioseleccionado, duracionseleccionada, fechaseleccionada, doctorId;
let specialtyId;
let intervaloid, intevaloseleccionado;
let $medicos;

const titlemorning =`
Mañana`;

const titleAfternoom =`
Tarde`;

const noHours = `
<h5 class="text-danger" >
No hay horas disponibles.
</h5>`

  $(function(){ 

    $specialty=$('#specialty');
    $doctor=$('#doctor');
    $date= $('#date');

    $hoursMorning=$('#hoursMorning');
    $hoursAfternoom=$('#hoursAfternoom');
   // $titleMorning=$('#titleMorning');
    //$titleAfternoom=$('#titleAfternoom');
    $medicos=$('#medicoconcatenar');
    
    $specialty.change(()=>{
      specialtyId=$specialty.val();
      const url=`/especialidades/${specialtyId}/medicos`;
      $.getJSON(url,onDoctorsLoad);
    });

    //$doctor.change(loadHours);
    $date.change(loadHours);
  });
  $(document).ready(function () {  
   
   

  $("#btnserviciosiguiente").click(function()
      {       
          $("#servicio").css("display", "none"); 
          $("#medicos").css("display", "block"); 

          $("#botonderechaservicios").css("display", "none"); 
          $("#botonderechamedicos").css("display", "block"); 
          $("#botonizquierdomedico").css("display", "block"); 

          $("#tituloservicio").css("display", "none");                 
          $("#tituloservicioeditar").css("display", "block");        

         $('#acservicio').trigger('click');
          
      });  
        
      });
      

  var checkbox = document.querySelector("input[name=registrarse]");
      checkbox.addEventListener( 'change', function() {
      if(this.checked) {
        $("#contrasenas").css("display", "block"); 
      } else {
        $("#contrasenas").css("display", "none"); 
      }
  });

  function onDoctorsLoad(doctors){
    let htmlOptions = '';
    doctors.forEach(doctor=>{     

      htmlOptions += `<div class="col-12"><div  id="${doctor.id}-cardmedicos" class="cardmedicos mb-4"  onclick="darclick(this)">
      <div class="card-body" role="button"><h5 class="card-title" style="margin-bottom: 0rem !important; "><input name="seleccionmedico" 
      id="${doctor.id}" type="radio"><label id="nombre-${doctor.id}"  for="${doctor.name}">${doctor.name} </label></h5>
      <span class="card-text" style=" color:#383C57 !important; font-weight: bold !important;" >Especialista en ${especialidadselecionada}</span></div></div> </div>             
</div>  `

      
    });
    $medicos.html(htmlOptions);
    //loadHours();
  }

  function loadHours(){
    $("#cargando").css("display", "block");    
    //const selectedDate= fechaseleccionada;  
    const selectedDate= $date.val(); 
    const url =`/horario/horas?date=${selectedDate}&doctor_id=${doctorId}`;
    console.log(doctorId);   
    $.getJSON(url, displayHours);
  }

  function displayHours(data)
  {
    console.log('Display Hours');
    let htmHoursM='';
    let htmHoursA='';

    iRadio=0;
    
    if (data.morning){
      const morning_intervalos=data.morning;
      morning_intervalos.forEach(intervalo => {
        console.log(intervalo);
        htmHoursM +=getRadioIntervaloHTML(intervalo);
      });
    }

    if (data.afternoon){
      const afternoom_intervalos=data.afternoon;     
      afternoom_intervalos.forEach(intervalo => {
        htmHoursA +=getRadioIntervaloHTML(intervalo);
      });
    }

    if (!htmHoursM != ""){
      htmHoursM += noHours;
    }

    if (!htmHoursA != ""){
      htmHoursA += noHours;
    }

    htmHoursM= `<h4 id="titlemorning" class="my-3 display-4">Mañana </h4>` + htmHoursM;
    $hoursMorning.html(htmHoursM);
    htmHoursA= `<h4 id="titleAfternoom" class="my-3 display-4">Tarde </h4>` + htmHoursA;
    $hoursAfternoom.html(htmHoursA);

    $("#cargando").css("display", "none");   

    //$titleMorning.html(titlemorning);
    //$titleAfternoom.html(titleAfternoom);
  }

  function getRadioIntervaloHTML(intervalo){
    const text=`${intervalo.start} `;

    return `                      
    <label id="interval${iRadio}-cardhoras" class="btn btn-mda btn-secondary" onclick="horasclick(this)">
      <input type="radio" name="scheduled_time" id="interval${iRadio}"  value="${intervalo.start}" autocomplete="off"> ${text}
    </label>      
 `
   
  }

  