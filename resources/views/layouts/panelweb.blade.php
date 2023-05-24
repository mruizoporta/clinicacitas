<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <title>
   {{config('app.name')}}
  </title>
  <!-- Favicon -->
  <link href="{{asset('img/brand/favicon-color.png')}}" rel="icon" type="image/png">
  <!-- Fonts -->
  <link href="https://fonts.googleapis.com/css?family=Open+Sans:300,400,600,700" rel="stylesheet">

  <link href="https://fonts.googleapis.com/css?family=Roboto:300,400,500,700" rel="stylesheet">
  <link href="https://fonts.googleapis.com/icon?family=Material+Icons" rel="stylesheet">
  
  <!-- Icons -->
  <link href="{{asset('js/plugins/nucleo/css/nucleo.css')}}" rel="stylesheet" />
  <link href="{{asset('js/plugins/@fortawesome/fontawesome-free/css/all.min.css')}}" rel="stylesheet" />
  <!-- CSS Files -->
  <link href="{{asset('css/argon-dashboard.css?v=1.1.2')}}" rel="stylesheet" /> 
  <link href="{{asset('css/citasweb.css')}}" rel="stylesheet" />
  <link href="{{asset('css/fullcalendar.css')}}" rel="stylesheet" />
  <link href="{{asset('css/fullcalendar.print.css')}}" rel="stylesheet" media="print" />
  <link href="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/1.1.3/sweetalert.css" rel="stylesheet" />

  @yield('styles')
</head>

<body class="">
  
  <div class="main-content">    

    <!-- Header -->
    <div class="header bg-gradient-primary pb-8 pt-4 pt-md-6">   
    <div class="container-fluid">
     <div class="logo">
     <a class="navbar-brand pt-0" href="https://www.valencia-medspa.com/"><img src="{{asset('img/brand/header.png')}}" class="navbar-brand-imgweb" alt="..."> 
   
    </div> 
    </div>     
    </div>
    <div class="container-fluid mt--7">
      @yield('content')



     @include('includes.panel.footer')
    </div>
  </div>
  <!--   Core   -->
  <script src="{{asset('js/plugins/jquery/dist/jquery.min.js')}}"></script>
  <script src="{{asset('js/plugins/bootstrap/dist/js/bootstrap.bundle.min.js')}}"></script>
  <!--   Optional JS   -->
  <script src="{{asset('js/plugins/chart.js/dist/Chart.min.js')}}"></script>
  <script src="{{asset('js/plugins/chart.js/dist/Chart.extension.js')}}"></script>
  <!--   Optional JS   -->
  <script src="{{asset('js/plugins/calendar/jquery-ui.custom.min.js')}}"></script>
  <script src="{{asset('js/plugins/calendar/fullcalendar.js')}}"></script>

  @yield('scripts')
  
  <!--   Argon JS   -->
  <script src="{{asset('js/argon-dashboard.min.js?v=1.1.2')}}"></script>
  <script src="https://cdn.trackjs.com/agent/v3/latest/t.js"></script>
  <script>
    window.TrackJS &&
      TrackJS.install({
        token: "ee6fab19c5a04ac1a32a645abde4613a",
        application: "argon-dashboard-free"
      });
  </script>
  <script>

$(function() {
  var date = new Date();
  var d = date.getDate();
  var m = date.getMonth();
  var y = date.getFullYear();

  /*  className colors

  className: default(transparent), important(red), chill(pink), success(green), info(blue)

  */

  /* initialize the calendar
  -----------------------------------------------------------------*/

  var calendar =  $('#calendar').fullCalendar({
    header: {
      left: 'prev',
      center: 'title',
      right: 'next'
    },
    editable: false,
    firstDay: 1, //  1(Monday) this can be changed to 0(Sunday) for the USA system
    selectable: true,
    defaultView: 'month',

    axisFormat: 'h:mm',
    columnFormat: {
              month: 'ddd',    // Mon
              week: 'ddd d', // Mon 7
              day: 'dddd M/d',  // Monday 9/7
              agendaDay: 'dddd d'
          },
          titleFormat: {
              month: 'MMMM yyyy', // September 2009
              week: "MMMM yyyy", // September 2009
              day: 'MMMM yyyy' // Tuesday, Sep 8, 2009
          },
    allDaySlot: true,
    selectHelper: true
    //select: function(start, end, allDay) {
      //var title = prompt('Event Title:');
      //if (title) {
        //calendar.fullCalendar('renderEvent',
          //{
            //title: title,
            //start: start,
            //end: end,
            //allDay: allDay
          //},
          //true // make the event "stick"
        //);
      //}
      //calendar.fullCalendar('unselect');
    //}
  });

});

</script>
</body>

</html>