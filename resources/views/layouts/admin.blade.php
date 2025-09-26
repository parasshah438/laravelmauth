<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <title>@yield('title')</title>
  <!-- Tell the browser to be responsive to screen width -->
  <meta content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=no" name="viewport">
  <!-- Bootstrap 5 CDN -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-ENjdO4Dr2bkBIFxQpeoA6VZgQGA6h9gZQ1Q1ZtQTwF3e1hZl6tzt4t1Q5V5Q5Q5Q" crossorigin="anonymous">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{url('public/admin_assets/bower_components/font-awesome/css/font-awesome.min.css')}}">
  <!-- Ionicons -->
  <link rel="stylesheet" href="{{url('public/admin_assets/bower_components/Ionicons/css/ionicons.min.css')}}">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{url('public/admin_assets/dist/css/AdminLTE.min.css')}}">
  <!-- AdminLTE Skins. Choose a skin from the css/skins
       folder instead of downloading all of them to reduce the load. -->
  <link rel="stylesheet" href="{{url('public/admin_assets/dist/css/skins/_all-skins.min.css')}}">
  <!-- Morris chart -->
  <link rel="stylesheet" href="{{url('public/admin_assets/bower_components/morris.js/morris.css')}}">
  <!-- jvectormap -->
  <link rel="stylesheet" href="{{url('public/admin_assets/bower_components/jvectormap/jquery-jvectormap.cssimage')}}">
  <!-- Date Picker -->
  <link rel="stylesheet" href="{{url('public/admin_assets/bower_components/bootstrap-datepicker/dist/css/bootstrap-datepicker.min.css')}}">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{url('public/admin_assets/bower_components/bootstrap-daterangepicker/daterangepicker.css')}}">
  <!-- bootstrap wysihtml5 - text editor -->
  <link rel="stylesheet" href="{{url('public/admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.min.css')}}">

  <link rel="stylesheet" href="{{ asset('public/admin_assets/bower_components/datatables.net-bs/css/dataTables.bootstrap.min.css')}}">

  <link href="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.8/summernote.css" rel="stylesheet">

  <!-- Google Font -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,600,700,300italic,400italic,600italic">
  @yield('pagespecificstyle')
</head>
<body>
<div class="container-fluid">
  @include('admin.partials.header')
  <div class="row">
    <div class="col-md-2">
      @include('admin.partials.leftsidebar')
    </div>
    <div class="col-md-10">
      @yield('content')
    </div>
  </div>
  @include('admin.partials.footer')
</div>
<!-- Bootstrap 5 JS Bundle CDN -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-qQ1Q1ZtQTwF3e1hZl6tzt4t1Q5V5Q5Q5QENjdO4Dr2bkBIFxQpeoA6VZgQGA6h9gZ" crossorigin="anonymous"></script>
<!-- FastClick -->
<script src="{{asset('public/admin_assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
<!-- AdminLTE App -->
<script src="{{asset('public/admin_assets/dist/js/adminlte.min.js')}}"></script>
<!-- AdminLTE for demo purposes -->
<script src="{{asset('public/admin_assets/dist/js/demo.js')}}"></script>
<script src="{{ asset('public/admin_assets/bower_components/datatables.net/js/jquery.dataTables.min.js')}}"></script>
<script src="{{ asset('public/admin_assets/bower_components/datatables.net-bs/js/dataTables.bootstrap.min.js')}}"></script>
<script src="{{ asset('public/admin_assets/bower_components/bootstrap-datepicker/dist/js/bootstrap-datepicker.min.js')}}"></script>
<!-- Bootstrap WYSIHTML5 -->
<script src="{{ asset('public/admin_assets/plugins/bootstrap-wysihtml5/bootstrap3-wysihtml5.all.min.js')}}"></script>
<script src="{{ asset('public/admin_assets/bower_components/jquery-slimscroll/jquery.slimscroll.min.js')}}"></script>
<script src="{{ asset('public/admin_assets/bower_components/fastclick/lib/fastclick.js')}}"></script>
<script src="{{ asset('public/admin_assets/js/table2excel.js')}}" type="text/javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/summernote/0.8.9/summernote.js"></script>

<script src="{{ asset('public/admin_assets/js/bootbox.min.js')}}"></script> 
<script src="{{ asset('public/admin_assets/js/bootstrap-notify.min.js')}}"></script>
<script  src="{{asset('public/admin_assets/js/jquery.validate.js')}}"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/moment.js/2.5.1/moment.min.js"></script>
<script type="text/javascript">
$(".alert-success,.alert-danger").fadeTo(7000, 500).slideUp(500, function(){
    $(".alert-success,.alert-danger").slideUp(7000);
});


$('.ckeditor').summernote({
    height: 200
}); 

</script>
@yield('pagespecificscripts')
</body>
</html>