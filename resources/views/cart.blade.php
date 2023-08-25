@extends('layouts.app')

@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Cart</h3>
    </div>


  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12  ">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Cart</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Thumbnail</th>
                <th>Nama Product</th>
                <th>Qty</th>
                <th>Harga</th>
                <th>Total</th>
              </tr>
            </thead>
            <tbody>
              <?php $total = 0 ?>
              @forelse($carts as $cart)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td><img class="img-thumbnail" width="100" src="{{$cart->product->image}}" alt="image" /></td>
                <td>{{$cart->product->name}}</td>
                <td>{{$cart->qty}}</td>
                <td>{{General::rp($cart->product->price)}}</td>
                <td>{{General::rp($cart->qty * $cart->product->price)}}</td>
              </tr>
              <?php $total = $total + ($cart->qty * $cart->product->price) ?>
              @empty
              <tr class="text-center">
                <td colspan="6">Keranjang Kosong</td>
              </tr>
              @endforelse
              <tr class="h5">
                <td colspan="5" class="text-right">Grand Total</td>
                <td colspan="5" >{{General::rp($total)}}</td>
              </tr>
            </tbody>
          </table>

        </div>
      </div>
    </div>
  </div>
</div>

@if(count($carts) != 0)
<div class="row">
  <div class="col-md-12 col-sm-12 ">
    <div class="x_panel">
      <div class="x_title">
        <h2>Detail Penerima</h2>
        <ul class="nav navbar-right panel_toolbox">
          
        </ul>
        <div class="clearfix"></div>
      </div>
      <div class="x_content">
        <br />
        <form class="form-label-left input_mask" method="post" action="{{route('transaction.store')}}">
          @csrf
          <div class="col-md-6 col-sm-6  form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="namapenerima" id="inputSuccess2" value="{{auth()->user()->name}}" placeholder="Nama Penerima">
            <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
          </div>
          
          <div class="col-md-6 col-sm-6  form-group has-feedback">
            <input type="text" class="form-control" id="inputSuccess5" name="nohp" placeholder="No Hp">
            <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
          </div>

          <div class="col-md-6 col-sm-6  form-group has-feedback">
            <input type="text" class="form-control has-feedback-left" name="ekspedisi" id="inputSuccess4" placeholder="Jasa Pengiriman">
            <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
          </div>

          <div class="col-md-6 col-sm-6  form-group has-feedback mb-5">
            <textarea id="" rows="5" class="form-control" name="address" placeholder="Alamat lengkap penerima"></textarea>
            <span class="fa fa-sitemap form-control-feedback right" aria-hidden="true"></span>
          </div>

          <div class="form-group row text-right">
            <div class="col-md-12 col-sm-12  offset-md-12">
              <button type="submit" class="btn btn-success" style="color:white">Buat Pesanan</button>
            </div>
          </div>

        </form>
      </div>
    </div>
  </div>
</div>
@endif
@endsection
@push('addscript')
@endpush
