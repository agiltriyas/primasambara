@extends('layouts.app')

@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Transaction</h3>
    </div>


  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12 col-sm-12  ">
      <div class="x_panel">
        <div class="x_title">
          <h2>List Transaction</h2>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <table class="table table-striped">
            <thead>
              <tr>
                <th>#</th>
                <th>Date</th>
                <th>Nama Customer</th>
                <th>No. Transaction</th>
                <th>No. Invoice</th>
                <th>No. SJ</th>
                <th>Pembayaran</th>
                <th>Status</th>
                <th>Action</th>
              </tr>
            </thead>
            <tbody>
              @forelse($transactions as $transaction)
              <tr>
                <th scope="row">{{$loop->iteration}}</th>
                <td>{{$transaction->created_at}}</td>
                <td>{{$transaction->namapenerima}}</td>
                <td>{{$transaction->notrans}}</td>
                <td>{{($transaction->noinv)?:"-"}}</td>
                <td>{{($transaction->nosj) ?:"-"}}</td>
                <td>{{($transaction->bank)?:"-"}}</td>
                <td>{{$transaction->status}}</td>
                <td>
                  
                  <div class="btn-group">
                    <a class="btn btn-sm btn-info btnView" data-id="{{$transaction->id}}" href="#" data-toggle="modal" data-target="#modalView">View</a>
                  </div>
                  
                  @if(auth()->user()->role == 'gudang')
                  @if($transaction->status == "APPROVE" || $transaction->status == "PAID")
                  <div class="btn-group">
                  <a class="btn btn-sm btn-primary btnStatus" data-image="{{$transaction->image}}" data-id="{{$transaction->id}}" data-auth="{{auth()->user()->role}}" href="#" data-toggle="modal" data-target="#modalStatus">Status</a>
                  </div>
                  @endif
                  @endif
                  @if(auth()->user()->role == 'admin')
                  <div class="btn-group">
                    <a class="btn btn-sm btn-primary btnStatus" data-image="{{$transaction->image}}" data-id="{{$transaction->id}}" data-auth="{{auth()->user()->role}}" href="#" data-toggle="modal" data-target="#modalStatus">Status</a>
                  </div>
                  @endif
                  @if(auth()->user()->role != "gudang")
                  <div class="btn-group">
                    @if(auth()->user()->role == "admin")
                    @if($transaction->image || $transaction->imagedp)
                    <a class="btn btn-sm btn-primary btnkonfirmasi" href="#" data-image="{{$transaction->image}}" data-imagedp="{{$transaction->imagedp}}" data-bank="{{$transaction->bank}}" data-id="{{$transaction->id}}" data-toggle="modal" data-target="#modalKonfirmasi">Konfirmasi</a>
                    @endif
                    @else
                    <a class="btn btn-sm btn-primary btnkonfirmasicust" href="#" data-image="{{$transaction->image}}" data-imagedp="{{$transaction->imagedp}}" data-bank="{{$transaction->bank}}" data-id="{{$transaction->id}}" data-toggle="modal" data-target="#modalKonfirmasicust">Konfirmasi {{(strlen($transaction->imagedp == 0)) ? "DP" : ""}}</a>
                    @endif  
                  </div>
                  @endif
                  <!-- Split button -->
                  <div class="btn-group">
                    <button type="button" class="btn btn-sm btn-danger">Cetak</button>
                    <button type="button" class="btn btn-sm btn-danger dropdown-toggle dropdown-toggle-split" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                      <span class="sr-only">Toggle Dropdown</span>
                    </button>
                    <div class="dropdown-menu">
                      @if($transaction->status == "SJ")
                        <a class="dropdown-item" href="{{route('sj',$transaction->id)}}">SURAT JALAN</a>
                      @endif
                      
                    @if($transaction->status == "INV" || $transaction->status == "PENDING")
                      @if(auth()->user()->role == 'admin' || auth()->user()->role == 'customer')
                        <a class="dropdown-item" href="{{route('inv',$transaction->id)}}">INVOICE</a>
                      @endif
                    @endif
                    </div>
                  </div>
                </td>
              </tr>
              @empty
              <tr class="text-center">
                <td colspan="6">Belum ada transaksi</td>
              </tr>
              @endforelse
            </tbody>
          </table>

        </div>

      </div>
    </div>
  </div>
</div>

 <!-- Modal -->
 <div class="modal fade" id="modalView" tabindex="-1" role="dialog" aria-labelledby="modalViewLabel" aria-hidden="true">
  <div class="modal-dialog modal-lg" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalViewLabel">Detail Transaction</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
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
            <tbody class="tableview">
              {{-- <tr>
                <th scope="row">1</th>
                <td class="tdimage"><img class="img-thumbnail" width="100" src="images/cengkeh.png" alt="image" /></td>
                <td class="tdnameproduct">Cengkeh</td>
                <td class="tdqty">10</td>
                <td class="tdprice">Rp. 110,000</td>
                <td class="tdtotal">Rp. 1,100,000</td>
              </tr>
              <tr>
                <th scope="row">2</th>
                <td><img class="img-thumbnail" width="100" src="images/jahe_bubuk.png" alt="image" /></td>
                <td>Jahe Bubuk</td>
                <td>10</td>
                <td>Rp. 73,000</td>
                <td>Rp. 730,000</td>
              </tr> --}}
              {{-- <tr class="h5">
                <td colspan="5" class="text-right">Grand Total</td>
                <td colspan="5" class="tdgrandtotal">Rp. 1,8300,000</td>
              </tr> --}}
            </tbody>
          </table>
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
                  <form class="form-label-left input_mask">

                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                      <input disabled type="text" class="form-control has-feedback-left" name="penerima" id="namapenerima" value="PT. INDAH KOTA">
                      <span class="fa fa-user form-control-feedback left" aria-hidden="true"></span>
                    </div>
                    
                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                      <input disabled type="tel" class="form-control" name="nohp" id="nohp" value="08121187445">
                      <span class="fa fa-phone form-control-feedback right" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group has-feedback">
                      <input disabled type="email" class="form-control has-feedback-left" name="ekspedisi" id="ekspedisi" value="DAKOTA">
                      <span class="fa fa-envelope form-control-feedback left" aria-hidden="true"></span>
                    </div>

                    <div class="col-md-6 col-sm-6  form-group has-feedback mb-5">
                      <textarea disabled name="address" id="address" rows="5" class="form-control" ></textarea>
                      <span class="fa fa-sitemap form-control-feedback right" aria-hidden="true"></span>
                    </div>

                  </form>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>>
    </div>
  </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalStatus" tabindex="-1" role="dialog" aria-labelledby="modalStatusLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalStatusLabel">Update Status</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="forstatus" class="form-label-left input_mask" method="post">
          @csrf
          @method('PUT')
          <input type="hidden" name="id" id="idStatus">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
            <select class="form-control" name="status" id="statusoption">
              <option value="">--Pilih Status--</option>
              @if(auth()->user()->role == "admin")
              <option value="APPROVE">APPROVE</option>
              <option value="REJECT">REJECT</option>
              <option value="INV">INV</option>
              @endif
              <option value="WIP">WIP</option>
              <option value="SJ">SJ</option>
            </select>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary source">Simpan</button>
        </div>
      </form> 
    </div>
  </div>
</div>

@if(auth()->user()->role == "admin")
<!-- Modal -->
<div class="modal fade" id="modalKonfirmasi" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasiLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKonfirmasiLabel">Konfirmasi Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form class="form-label-left input_mask">

          <div class="col-md-12 col-sm-12  form-group has-feedback">
              <p id="bankp"> </p>
              <label>Foto bukti pembayaran</label>
              </br>
              <div class="col-md-6">
                <img class="mt-3" id="imagekonfirmasidp" src="" width=200 alt="Belum tersedia">
                DP
              </div>
              <div class="col-md-6">
                <img class="mt-3" id="imagekonfirmasi" src="" width=200 alt="Belum tersedia">
              </div>
          </div>
        </form> 
      {{-- <h5 class="mt-4">Instruksi Pembayaran</h5>
      <ol>
          <li>Di halaman metode pembayaran pilih Transfer Bank</li>
          <li>Pilih Bank tujuan pembayaran (BCA, BNI, BRI, Bank Mandiri, Bank Permata, Bank Sampoerna atau Bank Lainnya)</li>
          <li>Catat nomor rekening (kode Virtual Account) & nominal pembayaran</li>
          <li>Silahkan lakukan pembayaran melalui menu Virtual Account pada M-Banking/ ATM / Internet Banking dan ikuti instruksi pembayaran sesuai Bank yang Anda pilih</li>
          <li>Simpan bukti pembayaran</li>
      </ol> --}}
      </div>
      <div class="modal-footer">
      
      </div>
    </div>
  </div>
</div>
@endif

<div class="modal fade" id="modalKonfirmasicust" tabindex="-1" role="dialog" aria-labelledby="modalKonfirmasicustLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="modalKonfirmasicustLabel">Konfirmasi Pembayaran</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        <form id="formkonfirmasicust" class="form-label-left input_mask" method="post" enctype="multipart/form-data">
          @csrf
          @method('put')
          <input type="hidden" name="type" value="image">
          <div class="col-md-12 col-sm-12  form-group has-feedback">
              <label>Foto bukti pembayaran</label>
                <input type="file" name="image" class="form-control">
                <select name="bank" id="bankselect" class="form-control mt-3">
                  <option value="bca">BCA</option>
                  <option value="panin">PANIN</option>
                </select>
                <div class="col-md-6">
                  <img class="mt-3" id="imagekonfirmasicustdp" src="" width=200>
                  DP
                </div>
                <div class="col-md-6">
                  <img class="mt-3" id="imagekonfirmasicust" src="" width=200>
                </div>
          </div>
          <h5 class="mt-4">Informasi Pembayaran</h5>
          Pembayaran 50% DP dan 50% sebelum pengiriman
        </br>
      </br>
          Pembayaran dapat dilakukan melalui rekening
          <ul class="bankul">
              <li>Bank BCA - No Rekening : 109210912 - a.n. PT PRIMA SAMBARA PERSADA</li>
              <li>Bank PANIN - No Rekening : 109210912 - a.n. PT PRIMA SAMBARA PERSADA</li>
          </ul>
          <h5 class="mt-4">Instruksi Pembayaran</h5>
          
          <ol>
            <li>Di halaman metode pembayaran pilih Transfer Bank</li>
            <li>Pilih Bank tujuan pembayaran (BCA, BNI, BRI, Bank Mandiri, Bank Permata, Bank Sampoerna atau Bank Lainnya)</li>
            <li>Catat nomor rekening (kode Virtual Account) & nominal pembayaran</li>
            <li>Silahkan lakukan pembayaran melalui menu Virtual Account pada M-Banking/ ATM / Internet Banking dan ikuti instruksi pembayaran sesuai Bank yang Anda pilih</li>
            <li>Simpan bukti pembayaran</li>
          </ol>
        </div>
        <div class="modal-footer">
          <button type="submit" class="btn btn-primary source" >Simpan</button>
          
        </div>
      </form> 
    </div>
  </div>
</div>
@endsection
@push('addscript')
<script>
  
  $('.btnView').on('click', function(){
    let id = $(this).data('id');
    $.ajax({
      url: "{{url('transaction')}}/"+id,
      dataType: "JSON",
      success: function (r) {
        $('.tableview').empty();
        let grandtotal =0
        for(let index = 0;index<r.detail_transaction.length;index++){
          grandtotal = grandtotal + r.detail_transaction[index].price * r.detail_transaction[index].qty;
          $(".tableview").append(`<tr><th scope="row">${index+1}</th><td><img class="img-thumbnail" width="100" src="${r.detail_transaction[index].product.image}" alt="image" /></td><td>${r.detail_transaction[index].product.name}</td><td >${r.detail_transaction[index].qty}</td><td >${r.detail_transaction[index].price}</td><td>Rp. ${r.detail_transaction[index].price * r.detail_transaction[index].qty} </td></tr>`)
        }
        $('.tableview').append(`<tr class="h5"><td colspan="5" class="text-right">Grand Total</td><td colspan="5" class="tdgrandtotal">Rp. ${grandtotal}</td></tr>`)
        $('#namapenerima').val(r.namapenerima)
        $('#nohp').val(r.nohp)
        $('#ekspedisi').val(r.ekspedisi)
        $('#address').html(r.address)
      }
    });
  })

  $('.btnStatus').on('click', function (event) {
            let id = $(this).data('id')
            let image = $(this).data('image')
            let auth = $(this).data('auth')
            $('#idStatus').val(id)
            $('#forstatus').attr('action',"{{url('transaction/')}}/"+id)
            $("#statusoption .paidoption").remove()
            
            if(image.length != 0 && auth == "admin"){
                $("#statusoption").append('<option class="paidoption" value="PAID">PAID</option>')
            }
        })
  $('.btnkonfirmasicust').on('click', function (event) {
      $('#imagekonfirmasicust').removeAttr('src')
      $('#imagekonfirmasicustdp').removeAttr('src')

      let id = $(this).data('id')
      let image = $(this).data('image')
      let imagedp = $(this).data('imagedp')
      let bank = $(this).data('bank')
      $('#idStatus').val(id)
      // $(`#bankselect option[value=${bank}]`).change();
      $(`#bankselect`).val(bank).change();

      if(imagedp)
        $('#imagekonfirmasicustdp').attr('src',"{{url('storage')}}/"+imagedp)

      if(image)
        $('#imagekonfirmasicust').attr('src',"{{url('storage')}}/"+image)

      $('#formkonfirmasicust').attr('action',"{{url('transaction/')}}/"+id)
  })
  $('.btnkonfirmasi').on('click', function (event) {
      $('#imagekonfirmasi').removeAttr('src')
      $('#imagekonfirmasidp').removeAttr('src')
      let id = $(this).data('id')
      let image = $(this).data('image')
      let imagedp = $(this).data('imagedp')
      let bank = $(this).data('bank')

      $('#idStatus').val(id)
      $('#bankp').html("Pilihan Bank: "+bank.toUpperCase())
      // $(".bankul").empty()
      // if(bank.length > 0){
      //   $('#bankselect').attr('disabled','disa')
      // }
      if(image)
        $('#imagekonfirmasi').attr('src',"{{url('storage')}}/"+image)

      if(imagedp)
        $('#imagekonfirmasidp').attr('src',"{{url('storage')}}/"+imagedp)
  })
</script>
@endpush