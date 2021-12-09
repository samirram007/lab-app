<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <link rel="shortcut icon" type="image/png" href="{{ asset('dist/img/c2c-logo.png') }}">
  <title>Service | Dashboard</title>



  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('plugins/fontawesome-free/css/all.min.css') }}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css') }}">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('plugins/icheck-bootstrap/icheck-bootstrap.min.css') }}">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('plugins/jqvmap/jqvmap.min.css') }}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('dist/css/adminlte.min.css') }}">
  <link rel="stylesheet" href="{{ asset('dist/css/custom.css') }}">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('plugins/overlayScrollbars/css/OverlayScrollbars.min.css') }}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('plugins/daterangepicker/daterangepicker.css') }}">
  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('plugins/summernote/summernote-bs4.min.css') }}">
  
  <script src="{{ asset('plugins/jquery/jquery.min.js') }}"></script>
  {{-- <script src="{{ asset('plugins/jquery/jquery.js') }}"></script> --}}
  {{-- @jquery --}}
  @toastr_css
  @toastr_js
  <script src="{{ asset('plugins/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <meta name="csrf-token" content="{{ csrf_token() }}" />
</head>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="page-loader" style="display:none;">
        <div class="d-flex vh-100 vw-100 fa-3x">
            <i class="m-auto fas fa-circle-notch fa-spin"></i>
           
        </div>
    </div>
<div class="wrapper">

  <!-- Preloader -->
  <div class="preloader flex-column justify-content-center align-items-center">
    <img class="animation__shake" src="{{ asset('dist/img/AdminLTELogo.png') }}" alt="AdminLTELogo" height="60" width="60">
  </div>

  <!-- Navbar -->
  <?php if(Session::has('loginid')){ ?>

    @include('admin.nav')
  <?php } ?>

  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  @extends('admin.menu')


<!-- Content-->
@yield('content')
   <div class="modal fade" id="rems-popup" data-backdrop="static" role="dialog" aria-labelledby="staticBackdropLabel"  aria-hidden="true">

    </div>
<?php if(Session::has('loginid')){ ?>
<footer class="main-footer">
    <strong>Copyright &copy; 2014-2021 <a href="https://ctc.web"></a>.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
      <b>Version</b> 6.0.2.0-rc
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <?php } ?>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->


<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('plugins/jquery-ui/jquery-ui.min.js') }}"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>

<!-- Bootstrap 4 -->



<script src="{{ asset('plugins/datatables/jquery.dataTables.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-bs4/js/dataTables.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/dataTables.responsive.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-responsive/js/responsive.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/dataTables.buttons.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.bootstrap4.min.js') }}"></script>
<script src="{{ asset('plugins/jszip/jszip.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/pdfmake.min.js') }}"></script>
<script src="{{ asset('plugins/pdfmake/vfs_fonts.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.html5.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.print.min.js') }}"></script>
<script src="{{ asset('plugins/datatables-buttons/js/buttons.colVis.min.js') }}"></script>

<!-- ChartJS -->
<script src="{{ asset('plugins/chart.js/Chart.min.js') }}"></script>
<!-- Sparkline -->
<script src="{{ asset('plugins/sparklines/sparkline.js') }}"></script>
<!-- JQVMap -->
<script src="{{ asset('plugins/jqvmap/jquery.vmap.min.js') }}"></script>
<script src="{{ asset('plugins/jqvmap/maps/jquery.vmap.usa.js') }}"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('plugins/jquery-knob/jquery.knob.min.js') }}"></script>
<!-- daterangepicker -->
<script src="{{ asset('plugins/moment/moment.min.js') }}"></script>
<script src="{{ asset('plugins/daterangepicker/daterangepicker.js') }}"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js') }}"></script>
<!-- Summernote -->
<script src="{{ asset('plugins/summernote/summernote-bs4.min.js') }}"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js') }}"></script>

<!-- AdminLTE App -->
<script src="{{ asset('dist/js/adminlte.js') }}"></script>
<!-- AdminLTE for demo purposes -->
{{-- <script src="{{ asset('dist/js/demo.js') }}"></script> --}}
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('dist/js/pages/dashboard.js') }}"></script>
<script>

$('.cp-datepicker').daterangepicker({
        singleDatePicker: true,
        timePicker: true,
        timePickerIncrement: 1,
        opens: "left",
        drops: "auto",
        applyButtonClasses: "btn-info",
        showDropdowns: true,
        minDate: "01/01/2021 12:00 AM",
        // maxDate: "<?= date('d/m/Y') . ' 11:59 PM' ?>", // this is set in the elemet's data-maxDate attribute.
        locale: {
            "format": 'DD/MM/YYYY hh:mm A'
        }
    });

    function openDatepicker(elm) {
        var dateInput = $(elm).parents('.input-group').find('.cp-datepicker');
        $(dateInput).trigger('click');
    }
    $('#rems-popup').on('shown.bs.modal', function() {
        $('.cp-datepicker').daterangepicker({
            singleDatePicker: true,
            timePicker: false,
            timePickerIncrement: 1,
            opens: "left",
            drops: "auto",
            applyButtonClasses: "btn-info",
            showDropdowns: false,
            minDate: "01/01/2021 12:00 AM",
            // maxDate: "<?= date('d/m/Y') . ' 11:59 PM' ?>", // this is set in the elemet's data-maxDate attribute.
            locale: {
                "format": 'DD/MM/YYYY'
            }
        });
    });
 $.ajaxSetup({
        headers: {
            'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
        }
    });
//jQuery.support.cors = true;
 $(document).on("click", ".load-popup", function() {
 //e.preventDefault();
        var param = $(this).data('param');
        var url = $(this).data('url');
        var size = $(this).data('size');
     // alert(param);
        $.ajax({
            url: url,
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                  'param': param,
                  'size': size
            },
            success: function(data) {
           //   alert(data);
               if(!data.error){
                 $("#rems-popup").html(data['html']);
                 $("#rems-popup").modal('show');
               }
               else{
                 console.log(data);
               }
 
            },
            error: function(xhr, status, error) {
             // alert(xhr);
               console.log(xhr);
 
            }

        })

    });

    $(document).on("click", "#IncludeProduct", function() {
 //e.preventDefault();
        var MasterID = $("#MasterID").val();
        var IncludeProductID = $("#IncludeProductID").val();
        var url = $(this).data('url'); 
     // alert(url);
        $.ajax({
            url: url,
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                  'MasterID': MasterID,
                  'IncludeProductID': IncludeProductID 
            },
            success: function(msg) {
              console.log(msg);
              //alert(data);
               if(!msg.error){
                 $("#include_list").html(msg['html']);
                // $("#rems-popup").modal('show');
               }
               else{
                
               }
 
            },
            error: function(xhr, status, error) {
              $("#include_list").html(status+": "+ error);
             // alert(xhr);
             //  console.log(xhr);
 
            }

        })

    });
    function ChangeStatusToAction(ProductID){
      //console.log(ProductID);
      $("#StatusButton"+ProductID).show();
      $("#StatusText"+ProductID).hide();

    }
   
      $(document).on("click", ".SaveIncludeProduct", function() {
      var SubProductID =$(this).data('productid');
        var ServiceID =$(this).data('serviceid');
        var Description = $("#Description"+SubProductID).val();
        var url = $(this).data('url'); 
       // alert(SubProductID+Description+ServiceID);
      $.ajax({
            url: url,
            type: "get",
            headers: {'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')},
            contentType: "application/json; charset=utf-8",
            dataType: "json",
            data: {
                  'SubProductID': SubProductID,
                  'ServiceID': ServiceID,
                  'Description': Description 
            },
            success: function(msg) {
              console.log("Ajax Success Message: "+msg);
              //alert(data);
               if(!msg.error){
                 $("#include_list").html(msg['html']);
                // $("#rems-popup").modal('show');
               }
               else{
                
               }
 
            },
            error: function(xhr, status, error) {
              $("#include_list").html(status+": "+ error);
             // alert(xhr);
             //  console.log(xhr);
 
            }

        })
      });
</script>

@toastr_render

</body>
</html>
