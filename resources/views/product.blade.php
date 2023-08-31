@extends('layouts.app')

@section('content')
<div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Product</h2>
          @if(auth()->user()->role == 'admin')
          <button class="btn btn-info btn-sm ml-3" data-toggle="modal" data-target="#modalTambah">Tambah</button>
          @endif
          <div class="clearfix"></div>
        </div>
        <div class="x_content">
          <div class="row">
            @foreach($products as $product)
            <div class="mt-3 col-md-3">
              <div class="image view view-first">
                <img style="width: 100%; background-size: auto;" src="{{$product->image}}" alt="image" />
                <div class="mask no-caption">
                  <div class="tools tools-bottom">
                    <!-- <a href="#"><i class="fa fa-link"></i></a> -->
                    @if($product->qty == 0)
                    <button class="btn text-white modalButtonCart" data-toggle="modal" data-target="#modalCart" id="" disabled><i class="fa fa-cart-plus fa-2x " style="background-color: grey;padding: 10px;border-radius: 10px;"></i></button>
                    @else
                    <button data-id="{{$product->id}}" data-price="{{$product->price}}" data-stock="{{$product->qty}}" class="btn text-white modalButtonCart" data-toggle="modal" data-target="#modalCart" id="" ><i class="fa fa-cart-plus fa-2x " style="background-color: red;padding: 10px;border-radius: 10px;"></i></button>
                    @endif
                  </div>
                </div>
              </div>
              <div class="caption px-3 pt-2">
                <div class="row">
                    <div class="col-md-6">
                        <p><strong>{{$product->name}}</strong>
                        </p>
                        <p>{{General::rp($product->price)}}/Kg</p>
                        <p>Stock: {{$product->qty}}</p>
                    </div>
                    <div class="col-md-6 text-right">
                      @if(auth()->user()->role != "customer")
                        <button data-id="{{$product->id}}" data-name="{{$product->name}}"  data-price="{{$product->price}}" data-stock="{{$product->qty}}" class="btn btn-sm btn-info modalButton" data-toggle="modal" data-target="#modaledit" id="">Edit</button>
                        @endif
                    </div>
                </div>
              </div>
            </div>
            @endforeach
          </div>
        </div>
      </div>
    </div>
  </div>

  <br />

  <div class="row">

  </div>


  <div class="row">

  </div>

  <div class="modal fade" id="modalTambah" tabindex="-1" role="dialog" aria-labelledby="modalTambahLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalTambahLabel">Add Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form class="form-label-left input_mask" method="post" action="{{route('product.store')}}" enctype="multipart/form-data">
            @csrf
            <input type="text" class="form-control" name="name" id="" placeholder="Nama Product">
            <input type="text" class="form-control mt-2" name="price" id="" placeholder="Harga">
  
            <div class="mt-2 col-md-12 col-sm-12  form-group has-feedback">
                <label>Gambar Product</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary source" type="submit">Simpan</button>
        </div>
    </form> 
      </div>
    </div>
  </div>

  <div class="modal fade" id="modaledit" tabindex="-1" role="dialog" aria-labelledby="modaleditLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modaleditLabel">Edit Product</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formedit" class="form-label-left input_mask" method="post" enctype="multipart/form-data">
            @csrf
            @method("put")
            <input type="hidden" name="id" id="id">
            <input type="text" class="form-control" name="name" id="name" placeholder="Nama Product">
            <input type="text" class="form-control mt-2" name="price" id="price" placeholder="Harga">
            <input type="text" class="form-control mt-2" name="qty" id="stock" placeholder="Stock">
  
            <div class="mt-2 col-md-12 col-sm-12  form-group has-feedback">
                <label>Gambar Product</label>
                <input type="file" name="image" class="form-control">
            </div>
        </div>
        <div class="modal-footer">
            <button class="btn btn-primary source" type="submit">Simpan</button>
        </div>
    </form> 
      </div>
    </div>
  </div>
  
  <div class="modal fade" id="modalCart" tabindex="-1" role="dialog" aria-labelledby="modalCartLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
      <div class="modal-content">
        <div class="modal-header">
          <h5 class="modal-title" id="modalCartLabel">Tambah Keranjang</h5>
          <button type="button" class="close" data-dismiss="modal" aria-label="Close">
            <span aria-hidden="true">&times;</span>
          </button>
        </div>
        <div class="modal-body">
          <form id="formedit" class="form-label-left input_mask" method="post" action="{{route('cart.store')}}">
            @csrf
            <input type="hidden" name="id" id="idcart">
            <input type="hidden" name="price" id="pricecart">
            <input type="hidden" name="stock" id="stockcart">
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
        $('.modalButton').on('click', function (event) {
            let price = $(this).data('price')
            let name = $(this).data('name')
            let id = $(this).data('id')
            let stock = $(this).data('stock')

            console.log(id)

            $('#id').val(id)
            $('#price').val(price)
            $('#name').val(name)
            $('#stock').val(stock)
            $('#formedit').attr('action',"{{url('product/')}}/"+id)

        })
        $('.modalButtonCart').on('click', function (event) {
            let id = $(this).data('id')
            let price = $(this).data('price')
            let stock = $(this).data('stock')
            console.log(id)

            $('#idcart').val(id)
            $('#pricecart').val(price)
            $('#stockcart').val(stock)
        })
    </script>
@endpush
