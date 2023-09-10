<!-- resources/views/layouts/index.blade.php -->
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta http-equiv="X-UA-Compatible" content="IE=edge">
  <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
  <meta name="description" content="">
  <meta name="author" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>Office of the Extension Services - Dashboard</title>
  <!-- Custom fonts for this template-->
  <link href="{{ asset('admin_assets/vendor/fontawesome-free/css/all.min.css') }}" rel="stylesheet" type="text/css">
  <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
  
  <!-- Custom styles for this template-->
  <link href="{{ asset('admin_assets/css/sb-admin-2.min.css') }}" rel="stylesheet">

  <link href="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.css') }}" rel="stylesheet">

  <!-- Filepond stylesheet -->
  <!-- <link href="https://unpkg.com/filepond@^4/dist/filepond.css" rel="stylesheet" />
  <link rel='stylesheet' href='https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.css'>
  <link rel='stylesheet' href='https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.min.css'> -->

  <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body id="page-top">
  <!-- Page Wrapper -->
  <div id="wrapper">
  
    <!-- Sidebar -->
    @include('layouts.sidebar')
    <!-- End of Sidebar -->
  
    <!-- Content Wrapper -->
    <div id="content-wrapper" class="d-flex flex-column">
  
      <!-- Main Content -->
      <div id="content">
  
        <!-- Topbar -->
        @include('layouts.navbar')
        <!-- End of Topbar -->
  
        <!-- Begin Page Content -->
        <div class="container-fluid">
          

          <!-- Page Heading -->
          <div class="d-sm-flex align-items-center justify-content-between mb-4">
            <div class="titleContainer">
                <h1 class="text-gray-800">@yield('title')</h1>
            </div>
            <div class="clock-container">
              <div>
                <span id="currentDateTime">MMM dd, YYYY 00:00:00</span>
              </div>
            </div>
          </div>
          
          @yield('scripts')
          @yield('contents')

          
  
          <!-- Content Row -->
  
  
        </div>
        <!-- /.container-fluid -->
  
      </div>
      <!-- End of Main Content -->
  
      <!-- Footer -->
      @include('layouts.footer')
      <!-- End of Footer -->
  
    </div>
    <!-- End of Content Wrapper -->
  
  </div>
  <!-- End of Page Wrapper -->
  
  <!-- Scroll to Top Button-->
  <a class="scroll-to-top rounded" href="#page-top">
    <i class="fas fa-angle-up"></i>
  </a>
  
  <!-- Bootstrap core JavaScript-->
  <!-- <script src="{{ asset('admin_assets/vendor/jquery/jquery.min.js') }}"></script> -->
  <script src="{{ asset('admin_assets/vendor/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
  <!-- Core plugin JavaScript-->
  <script src="{{ asset('admin_assets/vendor/jquery-easing/jquery.easing.min.js') }}"></script>
  <!-- Custom scripts for all pages-->
  <script src="{{ asset('admin_assets/js/sb-admin-2.min.js') }}"></script>
  <!-- Page level plugins -->
  <script src="{{ asset('admin_assets/vendor/chart.js/Chart.min.js') }}"></script>

  <!-- Page level plugins -->
  <script src="{{ asset('admin_assets/vendor/datatables/jquery.dataTables.min.js') }}"></script>
  <script src="{{ asset('admin_assets/vendor/datatables/dataTables.bootstrap4.min.js') }}"></script>


  <script>
    // Function to update the displayed date and time
    function updateDateTime() {

      const currentDate = new Date();

      // Format the date as "Month Day, Year"
      const options = { year: 'numeric', month: 'long', day: 'numeric' };
      const formattedDate = currentDate.toLocaleDateString(undefined, options);
      
      const hours = currentDate.getHours();
      const minutes = currentDate.getMinutes();
      const seconds = currentDate.getSeconds();
      
      const formattedTime = `${hours}:${minutes}:${seconds}`;
      
      // Combine formatted date and time
      const formattedDateTime = `${formattedDate} ${formattedTime}`;
      document.getElementById('currentDateTime').textContent = formattedDateTime;
    }
    
    // Initial call to updateDateTime
    updateDateTime();
    
    // Update the displayed date and time every second (1000 milliseconds)
    setInterval(updateDateTime, 1000);
  </script>

  <!-- Load FilePond library -->
  <!-- <script src="https://unpkg.com/filepond@^4/dist/filepond.js"></script>
  <script src="https://unpkg.com/filepond-plugin-file-poster/dist/filepond-plugin-file-poster.js"></script>
  <script src="https://unpkg.com/filepond-plugin-image-preview/dist/filepond-plugin-image-preview.js"></script> -->


</body>
</html>