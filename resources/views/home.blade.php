@extends('layouts.app')

@section('content')
@if(auth()->user()->role == "admin")
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-asterisk"></i>
        </div>
        <div class="count">{{$data['product']}}</div>

        <h3>Total Product</h3>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-users"></i>
        </div>
        <div class="count">{{$data['customer']}}</div>

        <h3>Total Customer</h3>
    </div>
</div>
<div class="animated flipInY col-lg-3 col-md-3 col-sm-6  ">
    <div class="tile-stats">
        <div class="icon"><i class="fa fa-files-o"></i>
        </div>
        <div class="count">{{$data['transaction']}}</div>

        <h3>Total Transaksi</h3>
    </div>
</div>
@else
<div>
    Dashboard for {{auth()->user()->role}}
</div>
@endif
@endsection
