<!DOCTYPE html>
<html lang="en">
  <head>
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <title>My Wroom</title>
    <meta content="width=device-width, initial-scale=1.0, shrink-to-fit=no" name="viewport" />
    <link rel="icon" href="{{asset('admin1/assets/img/logo/mywrrom.png')}}" type="image/x-icon" />
    <script src="{{asset('admin1/assets/js/plugin/webfont/webfont.min.js')}}"></script>
    <script>
      WebFont.load({
        google: {
          families: ["Public Sans:300,400,500,600,700"]
        },
        custom: {
          families: ["Font Awesome 5 Solid", "Font Awesome 5 Regular", "Font Awesome 5 Brands", "simple-line-icons", ],
          urls: ["{{asset('admin1/assets/css/fonts.min.css')}}"],
        },
        active: function() {
          sessionStorage.fonts = true;
        },
      });
    </script>
    <link rel="stylesheet" href="{{asset('admin1/assets/css/bootstrap.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin1/assets/css/plugins.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin1/assets/css/kaiadmin.min.css')}}" />
    <link rel="stylesheet" href="{{asset('admin1/assets/css/demo.css')}}" /> 
    @stack('styles')
  </head>
  <body>
    <div class="wrapper">
      @include('layouts.admin1.nav')
      <div class="main-panel">
        @include('layouts.admin1.header')
        <div class="container">
          {{ $slot }}
        </div> 
        @include('layouts.admin1.footer')
      </div>
    </div>
    <div class="custom-template">
      <div class="title">Settings</div>
      <div class="custom-content">
        <div class="switcher">
          <div class="switch-block">
            <h4>Logo Header</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeLogoHeaderColor" data-color="dark"></button>
              <button type="button" class="selected changeLogoHeaderColor" data-color="blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="white"></button>
              <br />
              <button type="button" class="changeLogoHeaderColor" data-color="dark2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="purple2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="light-blue2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="green2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="orange2"></button>
              <button type="button" class="changeLogoHeaderColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Navbar Header</h4>
            <div class="btnSwitch">
              <button type="button" class="changeTopBarColor" data-color="dark"></button>
              <button type="button" class="changeTopBarColor" data-color="blue"></button>
              <button type="button" class="changeTopBarColor" data-color="purple"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue"></button>
              <button type="button" class="changeTopBarColor" data-color="green"></button>
              <button type="button" class="changeTopBarColor" data-color="orange"></button>
              <button type="button" class="changeTopBarColor" data-color="red"></button>
              <button type="button" class="changeTopBarColor" data-color="white"></button>
              <br />
              <button type="button" class="changeTopBarColor" data-color="dark2"></button>
              <button type="button" class="selected changeTopBarColor" data-color="blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="purple2"></button>
              <button type="button" class="changeTopBarColor" data-color="light-blue2"></button>
              <button type="button" class="changeTopBarColor" data-color="green2"></button>
              <button type="button" class="changeTopBarColor" data-color="orange2"></button>
              <button type="button" class="changeTopBarColor" data-color="red2"></button>
            </div>
          </div>
          <div class="switch-block">
            <h4>Sidebar</h4>
            <div class="btnSwitch">
              <button type="button" class="selected changeSideBarColor" data-color="white"></button>
              <button type="button" class="changeSideBarColor" data-color="dark"></button>
              <button type="button" class="changeSideBarColor" data-color="dark2"></button>
            </div>
          </div>
        </div>
      </div>
      <!-- <div class="custom-toggle">
        <i class="icon-settings"></i>
      </div> -->
    </div>
    </div>
    <script src="{{asset('admin1/assets/js/core/jquery-3.7.1.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/core/popper.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/core/bootstrap.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/jquery-scrollbar/jquery.scrollbar.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/dataTables.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/dataTables.bootstrap5.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/dataTables.buttons.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/buttons.bootstrap5.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/jszip.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/pdfmake.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/vfs_fonts.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/buttons.html5.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/datatables/buttons.print.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/plugin/sweetalert/sweetalert.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/kaiadmin.min.js')}}"></script>
    <script src="{{asset('admin1/assets/js/setting-demo2.js')}}"></script>
    <script>
      // $(document).ready(function() {
      //     setTimeout(function() {
      //         $.ajax({
      //             url: "{{ route('logout') }}",
      //             type: "POST",
      //             data: {
      //                 _token: "{{ csrf_token() }}"
      //             },
      //             success: function(response) {
      //                 swal("Alert!", "Your session is about to expire. Please log in again.", {
      //                       icon: "info",
      //                       buttons: {
      //                           confirm: {
      //                           className: "btn btn-success",
      //                           },
      //                       },
      //                   });
      //                 window.location.href = "{{ route('login') }}";
      //             }
      //         });
      //     }, 120 * 60 * 1000);
      // });
    </script>
    @stack('scripts')
  </body>
</html>