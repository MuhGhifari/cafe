@extends('layouts.new')

@section('content')


<style type="text/css">
  .jumbotron{
  background: linear-gradient(90deg, rgba(242, 70, 69, 1), rgba(235, 192, 141, 0.867));
  background-size: cover;
  height: 540px;
  text-align: center;
  position: relative;
}

.jumbotron .container{
  z-index: 1;
  position: relative;
}

.jumbotron .display-4{
  color: white;
  
  margin-top: 150px;
  font-weight: 200;
  text-shadow: 2px 1px 2px rgba(0,0,0,0.7);
  font-size: 35px;
  margin-bottom: 20px;
}
.jumbotron .display-4 span{
  font-weight: 500; 
}
</style>

<br>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">DALGONA</div>
      <div class="list-group list-group-flush">
        <a href="" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="{{ route('admin.user') }}" class="list-group-item list-group-item-action bg-light">Users</a>
        <a href="{{ route('admin.product') }}" class="list-group-item list-group-item-action bg-light">Product</a>
        <a href="{{ route('admin.cetak') }}" class="list-group-item list-group-item-action bg-light">Laporan</a>
      </div>
    </div>
    <!-- /#sidebar-wrapper -->

    <!-- Page Content -->
    <div id="page-content-wrapper">

      <nav class="navbar navbar-expand-lg navbar-light fixed-top bg-light border-bottom">
       

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupportedContent">
          <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
            <li class="nav-item active">
              <a class="nav-link" href="">{{ Auth::user()->name }}<span class="sr-only">(current)</span></a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="{{ route('logout') }}">Logout</a>
            </li>
          </ul>
        </div>
      </nav>

<br>
    <div class="jumbotron jumbotron-fluid">
      <div class="container">
       <h1 class="display-4">Welcome {{ Auth::user()->name }} <span>Have a Nice Day</span><br> Happy Working :)</h1>
      </div>
  </div>

<!-- end -->
    </div>
    <!-- /#page-content-wrapper -->

  </div>
@endsection
