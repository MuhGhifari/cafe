@extends('layouts.new')
@section('content')

<style type="text/css">
		table tr td,
		table tr th{
			font-size: 9pt;
		}
</style>

	<div class="container">
		<center>
			<h4>Laporan</h4>
		</center>
		<div class="card-body">
                    <table class="table" id="datatable">
                        <thead>
                            <tr>
                                <th>#</th>
                                <th>Name</th>
                                <th>Price</th>
                                <th>Varians</th>
                            </tr>
                        </thead>
                        <tbody>
                                
                                <?php $index = 1 ?>
                                @foreach($products as $p)
                                <tr>
                                    <td>{{ $index }}</td>
                                    <td>{{ $p->name }}</td>
                                    <td>{{ $p->price }}</td>
                                    <td>{{ $p->varians }}</td>
                                </tr>
                                @endforeach
                        </tbody>
                    </table>
                </div>
	</div>

@endsection