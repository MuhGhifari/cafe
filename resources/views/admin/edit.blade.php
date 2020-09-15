@extends('layouts.new')
@section('content')

<style>

    .card{
      margin-top: 40px;
      padding: 20px;
      border-radius: 10px;
      box-shadow: 0 30px 20px 0 rgba(0,0,0,0.3);
    }

</style>

<br>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">DALGONA</div>
      <div class="list-group list-group-flush">
        <a href="#" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="{{ route('admin.user') }}" class="list-group-item list-group-item-action bg-light">Users</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Product</a>
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
    
    <!-- /#page-content-wrapper -->
    <div class="row justify-content-center mb-5">
    <div class="col-md-10">
        <div class="card">
            <div class="card-header d-flex align-items-center" style="background-color:white; border-bottom:none;">
                <span style="border-bottom:2px solid #007BFF; font-size: 1.5em; color: #007BFF; font-weight: bold;">Data User</span>

                <a href="{{ route('admin.user') }}" class="btn btn-primary ml-auto">
                    <i class="fa fa-arrow-left mr-2"></i>
                    Kembali
                </a>
            </div>
            <div class="card-body">
                <form method="post"  action=" {{route('admin.update', ['id' => $users->id])}}">	
                    @method('PATCH')
                    @csrf
                    
                    
                    <div class="row justify-content-center">
                        <div class="col-md-10">
                            <div class="form-group">
                                <label for="name">Nama</label>
                                <input type="text" name="name" id="name" class="form-control" value="{{ $users->name }}" >
                            </div>

                             <div class="form-group">
                                <label for="email">Email</label>
                                <input type="email" name="email" id="email" class="form-control" value="{{ $users->email}}" >
                            </div>

                        <div class="form-group">
                                <label for="username">Username</label>
                                <input type="text" name="username" id="username" class="form-control" value="{{ $users->username }}" >
                            </div>

                            <div class="form-group">
                                <label for="role">Role</label>
                                <select name="role" id="role" class="wide" >
                                    <option disabled selected>Pilih salah satu</option>
                                        <option value="kasir">Kasir</option>
                                </select>
                            </div>

                             <div class="form-group">
                                <label for="password">Password</label>
                                <input type="password" name="password" id="password" class="form-control" value="{{ $users->password }}">
                            </div>

                          <!--   <div class="d-flex mt-4">
                                <button type="submit" class="btn btn-success btn-block ml-auto">
                                    Simpan
                                </button>
                            </div> -->
                        </div>
                    </div>
                      <div class="d-flex mt-4">
                                <button type="submit" class="btn btn-success btn-block ml-auto">
                                    Simpan
                                </button>
                            </div>
                </form>
            </div>
        </div>
    </div>
</div>

  </div>



@endsection