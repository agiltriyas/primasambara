@extends('layouts.app')

@section('content')
<div class="">
  <div class="page-title">
    <div class="title_left">
      <h3>Surat Jalan</h3>
    </div>
  </div>

  <div class="clearfix"></div>

  <div class="row">
    <div class="col-md-12">
      <div class="x_panel">
        <div class="x_title">
          <h2>No. {{$transaction->noinv}}</small></h2>
          <ul class="nav navbar-right panel_toolbox">
           
          </ul>
          <div class="clearfix"></div>
        </div>
        <div class="x_content">

          <section class="content invoice">
            
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
              <div class="col-sm-4 invoice-col">
              </div>  
              <!-- /.col -->
              <div class="col-sm-4 invoice-col">
                To
                <address>
                  <strong>{{$transaction->namapenerima}}</strong>
                  {{$transaction->address}}
                </address>
              </div>
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
                    </tr>
                  </thead>
                  <tbody>
                    @foreach($transaction->detailTransaction as $detail)
                    <tr>
                      <th scope="row">{{$loop->iteration}}</th>
                      <td>{{$detail->product->name}}</td>
                      <td>{{$detail->qty}}</td>
                    </tr>
                    @endforeach
                  </tbody>
                </table>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <div class="row text-center mt-5">
              <!-- accepted payments column -->
              <div class="col-md-4">
              </div>  
              <div class="col-md-4">
                <p class="lead">Gudang</p>
                <div style="margin-top:90px;"></div>
                <p>Date: {{ date_format($transaction->created_at,'d/m/y') }}</p>
              </div>
              <!-- /.col -->
              <div class="col-md-4">
                <p class="lead">Customer</p>
                <div style="margin-top:90px;"></div>
                <p>Date: &nbsp; &nbsp; &nbsp; &nbsp; &nbsp; &nbsp;</p>
              </div>
              <!-- /.col -->
            </div>
            <!-- /.row -->

            <!-- this row will not appear when printing -->
            <div class="row no-print">
              <div class=" ">
                <button class="btn btn-default" onclick="window.print();"><i class="fa fa-print"></i>
                  Print</button>
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
