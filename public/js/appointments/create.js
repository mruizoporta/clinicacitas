let $doctor, $date, $specialty;
let $hoursMorning, $hoursAfternoom, $titleMorning,$titleAfternoom,iRadio

const titlemorning =`
En la manana`;

const titleAfternoom =`
En la tarde`;

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
    $titleMorning=$('#titleMorning');
    $titleAfternoom=$('#titleAfternoom');
    
    $specialty.change(()=>{
      const specialtyId=$specialty.val();
      const url=`/especialidades/${specialtyId}/medicos`;
      $.getJSON(url,onDoctorsLoad);
    });

    $doctor.change(loadHours);
    $date.change(loadHours);
  });
    
  
  function onDoctorsLoad(doctors){
    let htmlOptions = '';
    doctors.forEach(doctor=>{
      htmlOptions += `<option value="${doctor.id}">${doctor.name}</option>`
    });
    $doctor.html(htmlOptions);
    loadHours();
  }

  function loadHours(){
    const selectedDate= $date.val();
   
    const doctorId = $doctor.val();
    const url =`/horario/horas?date=${selectedDate}&doctor_id=${doctorId}`;
    $.getJSON(url, displayHours);
  }

  function displayHours(data)
  {
    let htmHoursM='';
    let htmHoursA='';

    iRadio=0;
    
    if (data.morning){
      const morning_intervalos=data.morning;
      morning_intervalos.forEach(intervalo => {
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

    $hoursMorning.html(htmHoursM);
    $hoursAfternoom.html(htmHoursA);
    $titleMorning.html(titlemorning);
    $titleAfternoom.html(titleAfternoom);
  }

  function getRadioIntervaloHTML(intervalo){
    const text=`${intervalo.start} - ${intervalo.end}`;
    return `<div class="custom-control custom-radio mb-3">
    <input type="radio" id="interval${iRadio}" name="scheduled_time" value="${intervalo.start}" class="custom-control-input" required>
    <label class="custom-control-label" for="interval${iRadio++}">${text}</label>
  </div>`
  }