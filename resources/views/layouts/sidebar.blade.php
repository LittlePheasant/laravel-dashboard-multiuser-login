<!-- resources/views/layouts/sidebar.blade.php -->
<ul class="navbar-nav bg-gradient-primary sidebar sidebar-dark accordion" id="accordionSidebar">
  
  <!-- Sidebar - Brand -->
  <a class="sidebar-brand d-flex align-items-center justify-content-center" href="#">
    <div class="sidebar-brand-icon rotate-n-15">
      <i class="fas fa-laugh-wink"></i>
    </div>
    <div class="sidebar-brand-text mx-3">{{ Auth::user()->username }} </div>
  </a>
  
  <!-- Divider -->
  <hr class="sidebar-divider my-0">
  
  <!-- Nav Item - Dashboard -->
  <li class="nav-item">
    <a class="nav-link" href="{{ route('dashboard') }}"> 

      <i class="fas fa-fw fa-tachometer-alt"></i>
      <span>Dashboard</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="#">

      <i class="fas fa-fw fa-info"></i>
      <span>About</span></a>
  </li>
  
  <li class="nav-item">
    <a class="nav-link" href="#">

      <i class="fas fa-fw fa-user"></i>
      <span>Profile</span></a>
  </li>

  <hr class="sidebar-divider d-none d-md-block">

  <h6 class="mb-0 mt-1 px-2">Auxillary</h6>
  <li class="nav-item">
    <a class="nav-link" href="#">

      <i class="fas fa-fw fa-download"></i>
      <span>Download</span></a>
  </li>

  <li class="nav-item">
    <a class="nav-link" href="#">

      <i class="fas fa-fw fa-download"></i>
      <span>Download</span></a>
  </li>
  
  <hr class="sidebar-divider d-none d-md-block">

  <li class="nav-item">
    <a class="nav-link" href="#">

      <i class="fas fa-fw fa-sign-out-alt"></i>
      <span>Logout</span></a>
  </li>
  <!-- Divider -->
  <hr class="sidebar-divider d-none d-md-block">
  
  <!-- Sidebar Toggler (Sidebar) -->
  <div class="text-center d-none d-md-inline">
    <button class="rounded-circle border-0" id="sidebarToggle"></button>
  </div>
  
  
</ul>

<script>
  var userId = {{ Auth::user()->id }};
  localStorage.setItem('user_id', userId);
</script>