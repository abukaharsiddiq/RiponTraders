<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <title>@yield('admin-title')</title>

  <!-- Google Font: Source Sans Pro -->
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro:300,400,400i,700&display=fallback">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/fontawesome-free/css/all.min.css">
  <!-- Ionicons -->
  <link rel="stylesheet" href="https://code.ionicframework.com/ionicons/2.0.1/css/ionicons.min.css">
  <!-- Tempusdominus Bootstrap 4 -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/tempusdominus-bootstrap-4/css/tempusdominus-bootstrap-4.min.css">
  <!-- iCheck -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/icheck-bootstrap/icheck-bootstrap.min.css">
  <!-- JQVMap -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/jqvmap/jqvmap.min.css">
  <!-- Theme style -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/dist/css/adminlte.min.css">
  <!-- overlayScrollbars -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/overlayScrollbars/css/OverlayScrollbars.min.css">
  <!-- Daterange picker -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/daterangepicker/daterangepicker.css">

  <!-- Select2 -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/select2/css/select2.min.css">
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/select2-bootstrap4-theme/select2-bootstrap4.min.css">

  <!-- summernote -->
  <link rel="stylesheet" href="{{ asset('/') }}back-end/plugins/summernote/summernote-bs4.min.css">
   <link
      href="{{ asset('/') }}back-end/assets/libs/datatables.net-bs4/css/dataTables.bootstrap4.css"
      rel="stylesheet"
    />

</head>
@stack('admin-styles')
<style>
  .card-title {
    font-size:30px;
    font-weight: 600;
  }
 .brand-image {
  text-align: center;
  /* margin-left: 80px; */
  margin-top: 10px;
  width: 90%;
  margin-left: 5%;
  height: 60px;
}
.brand-text.font-weight-light {
  text-align: center;
  color: #fff;
  margin-top: 20px;
}
[class*="sidebar-dark-"] .nav-treeview > .nav-item > .nav-link {
  color: #0be337;
  color: #000!important;
  font-size: 14px;
}
[class*="sidebar-dark-"] {
  background-color: #f8f9fa;
}
.nav-sidebar > .nav-item {
  margin-bottom: 0;
  border-bottom: 1px solid #dee2e6;
}
[class*="sidebar-dark-"] .nav-sidebar > .nav-item.menu-open > .nav-link, [class*="sidebar-dark-"] .nav-sidebar > .nav-item:hover > .nav-link, [class*="sidebar-dark-"] .nav-sidebar > .nav-item > .nav-link:focus {
  color: #000;
}
[class*="sidebar-dark-"] .sidebar a {
  color: #343a40;
}
[class*="sidebar-dark-"] .nav-sidebar > .nav-item > .nav-treeview {
  background-color: transparent;
  background: #e9ecef;
}
.sidebar-dark-primary .nav-sidebar > .nav-item > .nav-link.active, .sidebar-light-primary .nav-sidebar > .nav-item > .nav-link.active {
  background-color: #007bff;
  color: #fff !important;
  box-shadow: none;
}
.cashin {
  background: #37a000 !important;
  color:#fff!important;
  border-radius: 0;
}
.cashout{
  background: #6cabbc!important;
  color:#fff!important;
  border-radius: 0;
}
.balance{ 
  background: #8459cf!important;
  color:#fff!important;
  border-radius: 0;
}
.balance1{ 
  background: #749057!important;
  color:#fff!important;
  border-radius: 0;
}

.chart-area {
  background: #fff;
  padding: 20px;
  /* margin-bottom: 20px; */
  margin: 0px 0px 20px 0px;
}
[class*="sidebar-dark"] .user-panel {
  border-bottom:none;
}
[class*="sidebar-dark"] .user-panel {
  border-bottom: none;
  margin-top: -20px !important;
}
</style>
<body class="hold-transition sidebar-mini layout-fixed">
<div class="wrapper">

  <!-- Navbar -->
  <nav class="main-header navbar navbar-expand navbar-white navbar-light">
    <!-- Left navbar links -->
    <ul class="navbar-nav">
      <li class="nav-item">
        <a class="nav-link" data-widget="pushmenu" href="#" role="button"><i class="fas fa-bars"></i></a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="{{ route('home') }}" class="nav-link">Home</a>
      </li>
      <li class="nav-item d-none d-sm-inline-block">
        <a href="#" class="nav-link">Contact</a>
      </li>
    </ul>

    <!-- Right navbar links -->
    <ul class="navbar-nav ml-auto">
     

      <!-- Messages Dropdown Menu -->
      <li class="nav-item dropdown">
        <a class="nav-link" data-toggle="dropdown" href="#">
          Welcome to {{ Auth::user()->name }}
        </a>
      </li>
      <!-- Notifications Dropdown Menu -->

    </ul>
  </nav>
  <!-- /.navbar -->

  <!-- Main Sidebar Container -->
  <aside class="main-sidebar sidebar-dark-primary elevation-4">
    <!-- Brand Logo -->
    <a href="{{ route('home') }}" class="brand-link1">
      @if(isset($setting))
      <img src="{{ asset('/') }}back-end/setting/{{ $setting->logo }}" alt="" class="brand-image " style="opacity: .8;">
      @else
      <h4 class="brand-text font-weight-light">Ripon Traders</h4>
      @endif
    </a>

    <!-- Sidebar -->
    <div class="sidebar">
      <!-- Sidebar user panel (optional) -->
      <div class="user-panel mt-3 pb-3 mb-3 d-flex">
        <!-- <div class="image">
          <img src="{{ asset('/') }}back-end/dist/img/user2-160x160.jpg" class="img-circle elevation-2" alt="User Image">
        </div> -->
        <div class="info">
          <!-- <a href="#" class="d-block">
            {{ Auth::user()->name }}
          </a> -->
        </div>
      </div>

      <!-- Sidebar Menu -->
      <nav class="mt-2">
        <ul class="nav nav-pills nav-sidebar flex-column" data-widget="treeview" role="menu" data-accordion="false">
          <!-- Add icons to the links using the .nav-icon class
               with font-awesome or any other icon font library -->
          <li class="nav-item menu-open">
            <a href="{{ route('home') }}" class="nav-link active">
              <i class="nav-icon fas fa-tachometer-alt"></i>
              <p>
                Dashboard
              </p>
            </a>
           
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-user"></i>
              <p>
                Customer
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

               <li class="nav-item">
                <a href="{{ route('customer-group.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Location Group</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('customer-group.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Location Group</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('customer.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Customer</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('customer.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Customer</p>
                </a>
              </li>

          <li class="nav-item">
                <a href="{{ route('customer.ledger') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Ledger</p>
                </a>
              </li>

            </ul>
          </li>

             <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cubes"></i>
              <p>
                Product
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

                <li class="nav-item">
                <a href="{{ route('product-group.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Group</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('product-group.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Group</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('product.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Product</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('product.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Product</p>
                </a>
              </li>

            </ul>
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-shopping-cart"></i>
              <p>
                Purchase
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('purchase.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Purchase</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('purchase.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Purchase</p>
                </a>
              </li>

            </ul>
          </li>
          

        <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas  fa-balance-scale"></i>
              <p>
                Sale
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('sale.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Sale</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('sale.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Sale</p>
                </a>
              </li>

            </ul>
          </li>


           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-money-bill"></i>
              <p>
                Accounts
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('cashintype.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Cashin Type</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('cashintype.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Cashin Type</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('cashintype-assign.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Cashintype Assign</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('cashintype-assign.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Cashintype Assign</p>
                </a></p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('cashin.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Cash In</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('cashin.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Cash In</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('cashout.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Cash Out</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('cashout.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Cash Out</p>
                </a>


              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-users"></i>
              <p>
                Human Resource
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('employee-group.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Group</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('employee-group.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Group</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('employee.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Employee</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('employee.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Employee</p>
                </a>
              </li>

            </ul>
          </li>

          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-credit-card"></i>
              <p>
                Payroll
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('advance-salary.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Advance Salary</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('advance-salary.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Advance Salary</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('report.employee.salary') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Employee Salary</p>
                </a>
              </li>

            </ul>
          </li>

            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-briefcase"></i>
              <p>
                Bank
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('bank.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Bank</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{ route('bank.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Bank</p>
                </a>
              </li>

                 <li class="nav-item">
                <a href="{{ route('bank-calculation.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Calculation</p>
                </a>
              </li>


              <li class="nav-item">
                <a href="{{ route('bank-calculation.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Calculation</p>
                </a>
              </li>

            </ul>
          </li>

           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Factory
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('factory-group.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Group</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('factory-group.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Group</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('factory.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Debit</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('factory.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Debit</p>
                </a>
              </li>

            </ul>
          </li>

            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-copy"></i>
              <p>
                Director
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('director.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Add Director</p>
                </a>
              </li>

               <li class="nav-item">
                <a href="{{ route('director.index') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Director</p>
                </a>
              </li>

            </ul>
          </li>


           <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-book"></i>
              <p>
                Report
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('report.customer.payment') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Payment</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{ route('report.sale.cashin') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Cashin</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('report.sale.cashout') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Cashout</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('report.sale.bank') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Bank Report</p>
                </a>
              </li>

              <li class="nav-item">
                <a href="{{ route('report.sale.cash') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Cash Report</p>
                </a>
              </li>

            <li class="nav-item">
                <a href="{{ route('report.total.due') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Total Due</p>
                </a>
              </li>


            <li class="nav-item">
                <a href="{{ route('report.customer.due') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Customer Due</p>
                </a>
              </li>

                <li class="nav-item">
                <a href="{{ route('report.account.statement') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Account Statement</p>
                </a>
              </li>

            </ul>
          </li>

            <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="nav-icon fas fa-cog"></i>
              <p>
                Settings
                <i class="fas fa-angle-left right"></i>
              </p>
            </a>
            <ul class="nav nav-treeview">

              <li class="nav-item">
                <a href="{{ route('setting.create') }}" class="nav-link">
                  <i class="far fa-circle nav-icon"></i>
                  <p>Manage Company</p>
                </a>
              </li>

            </ul>
          </li>


          <li class="nav-item">
            <a href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();" class="nav-link">
              <i class="nav-icon fas fa-key"></i>
              <p>
                Logout
              </p>
            </a>

             <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                 @csrf
              </form>
          </li>

          
        </ul>
      </nav>
      <!-- /.sidebar-menu -->
    </div>
    <!-- /.sidebar -->
  </aside>

  <!-- Content Wrapper. Contains page content -->
  <div class="content-wrapper">

    <div class="content-header">
      <div class="container-fluid">
        <div class="row mb-2">
          <div class="col-sm-6">
            <h1 class="m-0">Dashboard</h1>
          </div>
          <div class="col-sm-6">
            <ol class="breadcrumb float-sm-right">
              <li class="breadcrumb-item"><a href="#">Home</a></li>
              <li class="breadcrumb-item active">Dashboard</li>
            </ol>
          </div>
        </div>
      </div>
    </div>
   

    <!-- Main content -->
    <section class="content">
      <div class="container-fluid">

       @yield('admin-content')

      </div><!-- /.container-fluid -->
    </section>
    <!-- /.content -->
  </div>
  <!-- /.content-wrapper -->
  <footer class="main-footer">
    <strong>Copyright &copy; 2024 Ripon Traders.</strong>
    All rights reserved.
    <div class="float-right d-none d-sm-inline-block">
     Developed By <b><a href="https://www.emanagerit.com/" target="_blank">eManagerIT</a></b>
    </div>
  </footer>

  <!-- Control Sidebar -->
  <aside class="control-sidebar control-sidebar-dark">
    <!-- Control sidebar content goes here -->
  </aside>
  <!-- /.control-sidebar -->
</div>
<!-- ./wrapper -->

<!-- jQuery -->
<script src="{{ asset('/') }}back-end/plugins/jquery/jquery.min.js"></script>
<!-- jQuery UI 1.11.4 -->
<script src="{{ asset('/') }}back-end/plugins/jquery-ui/jquery-ui.min.js"></script>
<!-- Resolve conflict in jQuery UI tooltip with Bootstrap tooltip -->
<script>
  $.widget.bridge('uibutton', $.ui.button)
</script>
<!-- Bootstrap 4 -->
<script src="{{ asset('/') }}back-end/plugins/bootstrap/js/bootstrap.bundle.min.js"></script>
<!-- Select2 -->
<script src="{{ asset('/') }}back-end/plugins/select2/js/select2.full.min.js"></script>
<!-- ChartJS -->
<script src="{{ asset('/') }}back-end/plugins/chart.js/Chart.min.js"></script>
<!-- Sparkline -->
<script src="{{ asset('/') }}back-end/plugins/sparklines/sparkline.js"></script>
<!-- JQVMap -->
<script src="{{ asset('/') }}back-end/plugins/jqvmap/jquery.vmap.min.js"></script>
<script src="{{ asset('/') }}back-end/plugins/jqvmap/maps/jquery.vmap.usa.js"></script>
<!-- jQuery Knob Chart -->
<script src="{{ asset('/') }}back-end/plugins/jquery-knob/jquery.knob.min.js"></script>
<!-- daterangepicker -->
<script src="{{ asset('/') }}back-end/plugins/moment/moment.min.js"></script>
<script src="{{ asset('/') }}back-end/plugins/daterangepicker/daterangepicker.js"></script>
<!-- Tempusdominus Bootstrap 4 -->
<script src="{{ asset('/') }}back-end/plugins/tempusdominus-bootstrap-4/js/tempusdominus-bootstrap-4.min.js"></script>
<!-- Summernote -->
<script src="{{ asset('/') }}back-end/plugins/summernote/summernote-bs4.min.js"></script>
<!-- overlayScrollbars -->
<script src="{{ asset('/') }}back-end/plugins/overlayScrollbars/js/jquery.overlayScrollbars.min.js"></script>
<!-- AdminLTE App -->
<script src="{{ asset('/') }}back-end/dist/js/adminlte.js"></script>
<!-- AdminLTE for demo purposes -->
<!-- <script src="{{ asset('/') }}back-end/dist/js/demo.js"></script> -->
<!-- AdminLTE dashboard demo (This is only for demo purposes) -->
<script src="{{ asset('/') }}back-end/dist/js/pages/dashboard.js"></script>
 <script src="{{ asset('/') }}back-end/assets/extra-libs/DataTables/datatables.min.js"></script>
 <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>
    <script>
      $("#zero_config").DataTable();

       $('.select2').select2()

    //Initialize Select2 Elements
    $('.select2bs4').select2({
      theme: 'bootstrap4'
    })

    </script>
@stack('admin-scripts')
</body>
</html>
