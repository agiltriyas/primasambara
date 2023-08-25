<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link href="../vendors/font-awesome/css/font-awesome.min.css" rel="stylesheet">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm" crossorigin="anonymous">
    <link href="../vendors/bootstrap/dist/css/bootstrap.min.css" rel="stylesheet">

    <link href="../build/css/custom.min.css" rel="stylesheet">


    <title>PT Prima Sambara Persada</title>
  </head>
  <body>

      <div id="carouselExampleControls" class="carousel slide" data-ride="carousel">
        <div class="carousel-inner">
          <div class="carousel-item active">
            <img class="d-block w-100" src="https://fastly.picsum.photos/id/109/1200/300.jpg?hmac=81lUkpADrc2uL5YmopDdbtWg5Gm3eWFixB3v-Qi02rI" alt="First slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://fastly.picsum.photos/id/109/1200/300.jpg?hmac=81lUkpADrc2uL5YmopDdbtWg5Gm3eWFixB3v-Qi02rI" alt="Second slide">
          </div>
          <div class="carousel-item">
            <img class="d-block w-100" src="https://fastly.picsum.photos/id/768/1200/300.jpg?hmac=t2cpGR-q4Yr6U-jVjze6fBWwESl8zDX-eTvYRrW35xk" alt="Third slide">
          </div>
        </div>
        <a class="carousel-control-prev" href="#carouselExampleControls" role="button" data-slide="prev">
          <span class="carousel-control-prev-icon" aria-hidden="true"></span>
          <span class="sr-only">Previous</span>
        </a>
        <a class="carousel-control-next" href="#carouselExampleControls" role="button" data-slide="next">
          <span class="carousel-control-next-icon" aria-hidden="true"></span>
          <span class="sr-only">Next</span>
        </a>
      </div>

      <div class="row">
        <div class="col-md-12">
          <div class="x_panel">
            <div class="x_title">
              <h2>Produk</h2>
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
                        <button data-id="{{$product->id}}" data-price="{{$product->price}}" class="btn text-white modalButtonCart" data-toggle="modal" data-target="#modalCart" id=""><i class="fa fa-cart-plus fa-2x " style="background-color: red;padding: 10px;border-radius: 10px;"></i></button>
                      </div>
                    </div>
                  </div>
                  <div class="caption px-3 pt-2">
                    <div class="row">
                        <div class="col-md-6">
                            <p><strong>{{$product->name}}</strong>
                            </p>
                            <p>{{General::rp($product->price)}}/Kg</p>
                        </div>
                        <div class="col-md-6 text-right">
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
                <input type="text" class="form-control" name="qty" id="qtycart" placeholder="Kuantitas">
            </div>
            <div class="modal-footer">
                <button class="btn btn-primary source" type="submit">Simpan</button>
            </div>
        </form> 
          </div>
        </div>
      </div>
<!-- jQuery -->
<script src="../vendors/jquery/dist/jquery.min.js"></script>
<!-- Bootstrap -->
<script src="../vendors/bootstrap/dist/js/bootstrap.bundle.min.js"></script>
<script src="../build/js/custom.min.js"></script>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.2.1.min.js" integrity="sha384-KJ3o2DKtIkvYIK3UENzmM7KCkRr/rE9/Qpg6aAZGJwFDMVNA/GpGFF93hXpG5KkN" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.12.9/dist/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.0.0/dist/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl" crossorigin="anonymous"></script>
  </body>
</html>