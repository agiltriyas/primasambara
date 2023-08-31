@extends('layouts.app')

@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Invoice</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>Invoice {{$transaction->noinv}}</small></h2>
          <ul class="nav navbar-right panel_toolbox">
           
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <section class="content invoice">
            <!-- title row -->
            <div class="row">
              <div class="  invoice-header">
                <h1>
                  <i class="fa fa-globe"></i> Invoice.
                  <small class="pull-right">Date: {{ date_format($transaction->created_at,'d/m/y') }}</small>
                </h1>
              </div>
              <!-- /.col -->
            </div>
            <!-- info row -->
            <div class="row invoice-info">
              <div class="col-sm-4 invoice-col">
                From
                <address>
                  <strong>PT Prima Sambara Persada</strong>
                  <br>Jl. Pantai Indah Utara 2 No.28, RT.3/RW.7, Kapuk
                  <br>Kecamatan Cengkareng, Jkt Utara, Daerah Khusus Ibukota Jakarta 14460
                  <br>Phone: 0812 3131 1515
                  <br>Email: primasembada@gmail.com
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{$transaction->namapenerima}}</strong>
                  {{$transaction->address}}
                </address>
              </div>
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                <b>Invoice #{{$transaction->noinv}}</b>
                <br>
                <br>
                <b>Order ID:</b> TR{{$transaction->id}}
                <br>
                <b>Payment Due:</b> {{ date_format($transaction->created_at,'d/m/y') }}
                <br>
                <b>Account:</b> 12345679
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- Table row -->
            <div class="row">
              <div class="  table">
                <table class="table table-striped">
                  <thead>
                    <tr>
                      <th>#</th>
                      <th>Nama Product</th>
                      <th>Qty</th>
                      <th>Harga</th>
                      <th>Total</th>
                    </tr>
                  </thead>
                  <tbody>
                  <?php $total = 0 ?>
                    @foreach($transaction->detailTransaction as $detail)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$detail->product->name}}</td>
                      <td>{{$detail->qty}}</td>
                      <td>{{General::rp($detail->product->price)}}</td>
                      <td>{{General::rp($detail->product->price * $detail->qty)}}</td>
                    </tr>
                    <?php $total = $total + ($detail->qty * $detail->product->price) ?>

                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row">
              <!-- accepted payments column -->
              <div class="col-md-6">
                <p class="lead">Metode Pembayaran:</p>
                <img src="{{asset('images/bca-logo.png')}}" alt="BCA" width=100>
                <!--<img src="images/mastercard.png" alt="Mastercard">-->
                <!--<img src="images/american-express.png" alt="American Express">-->
                <!--<img src="images/paypal.png" alt="Paypal">-->
                <p class="text-muted well well-sm no-shadow" style="margin-top: 10px;">
                  Invoice dilampirkan dengan fakturpajak, PO dan Surat Jalan, Harap menandatangani tanda terima kami, Terimakasih.
                </p>
              </div>
              <!-- /.col -->
              <div class="col-md-6">
                <p class="lead">Batas Tempo {{date('m/d/Y',strtotime('+30 days',strtotime($transaction->created_at)))}}</p>
                <div class="table-responsive">
                  <table class="table">
                    <tbody>
                      <tr>
                        <th style="width:50%">Subtotal:</th>
                        <td>{{General::rp($total)}}</td>
                      </tr>
                      <tr>
                        <th>Total:</th>
                        <td>{{General::rp($total)}}</td>
                      </tr>
                    </tbody>
                  </table>
                </div>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class=" ">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i>
                  Print</button>
                <button class="btn btn-success pull-right"><i class="fa fa-credit-card"></i> Paid</button>
                <button class="btn btn-primary pull-right" style="margin-right: 5px;"><i
                    class="fa fa-download"></i> Generate PDF</button>
              </div>
            </div>
          </section>
        </div>
      </div>
    </div>
  </div>
</div>
@endsection
@push('addscript')
@endpush
