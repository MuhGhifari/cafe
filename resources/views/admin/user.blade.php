@extends('layouts.new')
@section('content')

<style>

.card{
    box-shadow:  0 20px 20px 0 rgba(0,0,0,0.3);
}
</style>


<br>
<div class="d-flex" id="wrapper">

    <!-- Sidebar -->
    <div class="bg-light border-right" id="sidebar-wrapper">
      <div class="sidebar-heading">DALGONA</div>
      <div class="list-group list-group-flush">
        <a href="{{ route('admin.index') }}" class="list-group-item list-group-item-action bg-light">Dashboard</a>
        <a href="{{ route('admin.user') }}" class="list-group-item list-group-item-action bg-light">Users</a>
        <a href="{{ route('admin.product') }}" class="list-group-item list-group-item-action bg-light">Product</a>
        <a href="#" class="list-group-item list-group-item-action bg-light">Laporan</a>
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
    <br><br>
    <div class="row justify-content-center">
        <div class="col-md-11">
            @if (session('message'))
                <div class="alert alert-success alert-dismissible mb-3" role="alert">
                    <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                    </button>
                    <strong>Success!</strong> {{ session('message') }}
                </div>
            @endif
            <div class="card">
                <div class="card-header d-flex align-items-center" style="background-color:white; border-bottom:none; font-weight:bold; font-size:1.5em; color: #007BFF;">
                    <span>Data Users</span>

                    <a href="{{ route('admin.create') }}" class="btn btn-primary ml-auto">
                        <i class="fa fa-plus mr-2"></i>
                        Create data
                    </a>
                </div>
                <div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Nama</th>
                                <th>Username</th>
                                <th>Email</th>
                                <th>Role</th>
                                <th></th>
                            </tr>
                        </thead>
                        <tbody>
                            <?php $index = 1; ?>
                            @foreach($users as $user)
                                <td>{{ $index }}</td>
                                <td>{{ $user->name }}</td>
                                <td>{{ $user->username }}</td>
                                <td>{{ $user->email }}</td>
                                <td>
                                    @if($user->role == 'admin')
                                    <h4>
                                        <span class="badge badge-danger" style="background: #ff6258; width: ">{{ $user->role }}</span>
                                    </h4>
                                    @elseif($user->role == 'kasir')
                                    <h4>
                                        <span class="badge badge-success">{{ $user->role }}</span>
                                    </h4>
                                    @elseif($user->role == 'member')
                                    <h4>
                                        <span class="badge badge-warning" style="color: white; background: #8862e0;">{{ $user->role }}</span>
                                    </h4>
                                    @endif
                                </td>
    
                                    <td>
                                        <div class="dropdown">
                                            <button class="btn btn-primary dropdown-toggle" type="button" id="dropdownMenuButton" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Aksi
                                            </button>
                                            <div class="dropdown-menu" aria-labelledby="dropdownMenuButton">
                                                <a href="{{ route('admin.edit', $user->id) }}" class="dropdown-item">Edit</a>
                                                <form action="{{ route('admin.destroy', $user->id) }}"  method="post">
                                                    @method('DELETE')
                                                    @csrf
                                                    <button  type="submit" class="dropdown-item" style="cursor: pointer" onclick="return confirm('Yakin ingin menghapus data?')">Delete</button>
                                                </form>
                                            </div>
                                        </div>
                                    </td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>

    </div>
    <!-- /#page-content-wrapper -->
  </div>

@endsection