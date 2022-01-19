<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome Icons -->
  <link rel="stylesheet" href="{{asset('Backend/plugins/fontawesome-free/css/all.min.css')}}">
  <link rel="stylesheet" href="{{asset('Backend/plugins/toastr/toastr.min.css')}}">
 
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{asset('Backend')}}/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{asset('Backend')}}/dist/css/adminlte.min.css">
   <!-- DataTables -->
   <link rel="stylesheet" href="{{asset('Backend')}}/plugins/datatables-bs4/css/dataTables.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('Backend')}}/plugins/datatables-responsive/css/responsive.bootstrap4.min.css">
  <link rel="stylesheet" href="{{asset('Backend')}}/plugins/datatables-buttons/css/buttons.bootstrap4.min.css">

  <!-- custome css -->
  <link rel="stylesheet" href="{{asset('Backend')}}/dist/css/style.css">
     <!-- summernote -->
     <link rel="stylesheet" href="{{ asset('Backend') }}/plugins/summernote/summernote-bs4.css">
     <link rel="stylesheet" type="text/css" href="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/css/dropify.css">
     <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap-tagsinput/0.6.0/bootstrap-tagsinput.css" integrity="sha512-3uVpgbpX33N/XhyD3eWlOgFVAraGn3AfpxywfOTEQeBDByJ/J7HkLvl4mJE1fvArGh4ye1EiPfSBnJo2fgfZmg==" crossorigin="anonymous" referrerpolicy="no-referrer" />


</head>
<body class="hold-transition  sidebar-mini layout-fixed layout-navbar-fixed layout-footer-fixed">



<div class="wrapper">



  <!-- Navbar -->
@include('layouts.admin_partial.navbar')

    <!-- Main Sidebar Container -->
  @include('layouts.admin_partial.sidebar')

 

 
 @yield('admin_content')


 
  <aside class="control-sidebar control-sidebar-dark">

  </aside>



</div>



<!-- jQuery -->
<script src="{{asset('Backend')}}/plugins/jquery/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="{{asset('Backend')}}/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{asset('Backend')}}/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{asset('Backend')}}/dist/js/adminlte.js"></script>

<!-- PAGE PLUGINS -->
<!-- jQuery Mapael -->
<script src="{{asset('Backend')}}/plugins/jquery-mousewheel/jquery.mousewheel.js"></script>
<script src="{{asset('Backend')}}/plugins/raphael/raphael.min.js"></script>
<script src="{{asset('Backend')}}/plugins/jquery-mapael/jquery.mapael.min.js"></script>
<script src="{{asset('Backend')}}/plugins/jquery-mapael/maps/usa_states.min.js"></script>
<!-- ChartJS -->
<script src="{{asset('Backend')}}/plugins/chart.js/Chart.min.js"></script>

<!-- AdminLTE for demo purposes -->
<script src="{{asset('Backend')}}/dist/js/demo.js"></script>
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{asset('Backend')}}/dist/js/pages/dashboard2.js"></script>
<!-- toastr -->
<script type="text/javascript" src="{{asset('Backend')}}/plugins/toastr/toastr.min.js"></script>
<script src="{{ asset('Backend/plugins/sweetalert/sweetalert.min.js') }}"></script>
<!-- sweetalert -->
<script>  
         $(document).on("click", "#delete", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to delete?",
                  text: "Once Delete, This will be Permanently Delete!",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } 
                });
            });
    </script>
   {{-- before  logout showing alert message --}}
     <script>  
         $(document).on("click", "#logout", function(e){
             e.preventDefault();
             var link = $(this).attr("href");
                swal({
                  title: "Are you Want to logout?",
                  text: "",
                  icon: "warning",
                  buttons: true,
                  dangerMode: true,
                })
                .then((willDelete) => {
                  if (willDelete) {
                       window.location.href = link;
                  } 
                });
            });
    </script>

<script>
  @if(Session::has('message'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.success("{{ session('message') }}");
  @endif

  @if(Session::has('error'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.error("{{ session('error') }}");
  @endif

  @if(Session::has('info'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.info("{{ session('info') }}");
  @endif

  @if(Session::has('warning'))
  toastr.options =
  {
  	"closeButton" : true,
  	"progressBar" : true
  }
  		toastr.warning("{{ session('warning') }}");
  @endif
</script>

<!-- DataTables  & Plugins -->
<script src="{{asset('Backend')}}/plugins/datatables/jquery.dataTables.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-bs4/js/dataTables.bootstrap4.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-responsive/js/dataTables.responsive.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-responsive/js/responsive.bootstrap4.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-buttons/js/dataTables.buttons.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-buttons/js/buttons.bootstrap4.min.js"></script>
<script src="{{asset('Backend')}}/plugins/jszip/jszip.min.js"></script>
<script src="{{asset('Backend')}}/plugins/pdfmake/pdfmake.min.js"></script>
<script src="{{asset('Backend')}}/plugins/pdfmake/vfs_fonts.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-buttons/js/buttons.html5.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-buttons/js/buttons.print.min.js"></script>
<script src="{{asset('Backend')}}/plugins/datatables-buttons/js/buttons.colVis.min.js"></script>
<script src="{{ asset('Backend') }}/plugins/summernote/summernote-bs4.min.js"></script>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/js/select2.min.js"></script>
  <script src="http://bootstrap-tagsinput.github.io/bootstrap-tagsinput/dist/bootstrap-tagsinput.min.js"></script>
  <script src="//cdn.ckeditor.com/4.16.0/full/ckeditor.js"></script>
  <script src="https://cdnjs.cloudflare.com/ajax/libs/printThis/1.15.0/printThis.js" integrity="sha512-Fd3EQng6gZYBGzHbKd52pV76dXZZravPY7lxfg01nPx5mdekqS8kX4o1NfTtWiHqQyKhEGaReSf4BrtfKc+D5w==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script>
  $(function () {
    // Summernote
    $('.textarea').summernote()
  })
</script>
<script>
  $(function () {
    $("#example1").DataTable({
      "responsive": true, "lengthChange": false, "autoWidth": false,
      "buttons": ["copy", "csv", "excel", "pdf", "print", "colvis"]
    }).buttons().container().appendTo('#example1_wrapper .col-md-6:eq(0)');
    $('#example2').DataTable({
      "paging": true,
      "lengthChange": false,
      "searching": false,
      "ordering": true,
      "info": true,
      "autoWidth": false,
      "responsive": true,
    });
  });
</script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/Dropify/0.2.2/js/dropify.js"></script>

<script type="text/javascript">
	$('.dropify').dropify();

// change notification status
  $('.notificatioinbell').click(function(){

     $.ajax({

        url: "{{ url("/notification/status/change/") }}/",
        type: 'get',
        success: function(data) {
          $('.notificationstatus').html('0');
                
       }
});
    })

    // change seen status
    $('.seen').click(function(){
    var id=$(this).data('id');

   $.ajax({

   url: "{{ url("/seen/status/change/") }}/"+id,
   type: 'get',
   success: function(data) {     
  }

});
})
// change message status
$('.messagelogo').click(function(){


$.ajax({

   url: "{{ url("/message/status/change/") }}/",
   type: 'get',
   success: function(data) {
     $('.messagecount').html('0');
           
  }
});
})
  
</script>
</body>
</html>
