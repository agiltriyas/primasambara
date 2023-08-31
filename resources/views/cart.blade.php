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
                <th></th>
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
                <td>
                  <button class="btn btn-sm btn-primary modalButtonCart" data-id="{{$cart->id}}" data-toggle="modal" data-target="#modalCart">Edit</button>
                  <a href="" class="btn btn-sm btn-danger" onclick="event.preventDefault();
                  document.getElementById('delete-cart').submit();">Delete</a>
                  <form method="post" id="delete-cart" action="{{route('cart.destroy',$cart->id)}}" hidden>
                    @csrf
                    @method('delete')
                    <input type="hidden" name="id" value="{{$cart->id}}">
                  </form>
                </td>
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
            <select name="ekspedisi" id="ekspedisi" class="form-control has-feedback-left">
              <option value="0">--Pilih Jasa Ekspedisi--</option>
              <option value="Kargao Dakota">Kargo Dakota</option>
              <option value="Kargo Kurnia">Kargo Kurnia</option>
            </select>
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

<div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="modalCartLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalCartLabel">Edit Qty</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formedit" class="form-label-left input_mask" method="post">
          @csrf
          @method("put")
          <input type="hidden" name="id" id="idcart">
          <input type="text" class="form-control" name="qty" id="qtycart" placeholder="Kuantitas">
      </div>
      <div class="modal-footer">
          <button class="btn btn-primary source" type="submit">Simpan</button>
      </div>
  </form> 
    </div>
  </div>
</div>
@endsection
@push('addscript')
<script>
  $('.modalButtonCart').on('click', function (event) {
            let id = $(this).data('id')
            console.log(id)

            $('#idcart').val(id)
            $('#formedit').attr('action',"{{url('cart/')}}/"+id)

          })
</script>
@endpush
