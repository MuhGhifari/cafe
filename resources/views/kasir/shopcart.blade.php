@extends('layouts.new')
​
@section('content')
    <div class="content-wrapper">
        <div class="content-header">
            <div class="container-fluid">
                <div class="row mb-2">
                    <div class="col-sm-6">
                        <h1 class="m-0 text-dark">Transaksi</h1>
                    </div>
                    <div class="col-sm-6">
                        <ol class="breadcrumb float-sm-right">
                            <li class="breadcrumb-item"><a href="{{ route('home') }}">Home</a></li>
                            <li class="breadcrumb-item active">Transaksi</li>
                        </ol>
                    </div>
                </div>
            </div>
        </div>
​
        <section class="content" id="dw">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-8">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="">Produk</label>
                                        <select name="product_id" id="product_id" class="form-control" required width="100%">
                                            <option value="">Pilih</option>
                                            @foreach ($products as $product)
                                            <option value="{{ $product->id }}">{{ $product->code }} - {{ $product->name }}</option>
                                            @endforeach
                                        </select>
                                    </div>
                                    <div class="form-group">
                                        <label for="">Qty</label>
                                        <input type="number" name="qty" id="qty" value="1" min="1" class="form-control">
                                    </div>
                                    <div class="form-group">
                                        <button class="btn btn-primary btn-sm">
                                            <i class="fa fa-shopping-cart"></i> Ke Keranjang
                                        </button>
                                    </div>
                                </div>
                                
                                <!-- MENAMPILKAN DETAIL PRODUCT -->
                                <div class="col-md-5">
                                    <h4>Detail Produk</h4>
                                    <div v-if="product.name">
                                        <table class="table table-stripped">
                                            <tr>
                                                <th>Kode</th>
                                                <td>:</td>
                                                <td>@{{ product.code }}</td>
                                            </tr>
                                            <tr>
                                                <th width="3%">Produk</th>
                                                <td width="2%">:</td>
                                                <td>@{{ product.name }}</td>
                                            </tr>
                                            <tr>
                                                <th>Harga</th>
                                                <td>:</td>
                                                <td>@{{ product.price | currency }}</td>
                                            </tr>
                                        </table>
                                    </div>
                                </div>
                                
                                <!-- MENAMPILKAN IMAGE DARI PRODUCT -->
                                <div class="col-md-3" v-if="product.photo">
                                    <img :src="'/uploads/product/' + product.photo" 
                                        height="150px" 
                                        width="150px" 
                                        :alt="product.name">
                                </div>
                            </div>
                    </div>
                </div>
            </div>
        </section>
    </div>
@endsection
​