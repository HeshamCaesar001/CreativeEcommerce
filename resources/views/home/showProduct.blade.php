<!DOCTYPE html>
<html xmlns="http://www.w3.org/1999/html">
<head>
    <base href="/public">
    <!-- Basic -->
    <meta charset="utf-8" />
    <meta http-equiv="X-UA-Compatible" content="IE=edge" />
    <!-- Mobile Metas -->
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no" />
    <!-- Site Metas -->
    <meta name="keywords" content="" />
    <meta name="description" content="" />
    <meta name="author" content="" />
    <link rel="shortcut icon" href="images/favicon.png" type="">
    <title>Creative -Creative Ecommerce</title>
    <!-- bootstrap core css -->
    <link rel="stylesheet" type="text/css" href="home/css/bootstrap.css" />
    <!-- font awesome style -->
    <link href="home/css/font-awesome.min.css" rel="stylesheet" />
    <!-- Custom styles for this template -->
    <link href="home/css/style.css" rel="stylesheet" />
    <!-- responsive style -->
    <link href="home/css/responsive.css" rel="stylesheet" />
</head>
<body>
<div class="hero_area">
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->
<div class="container">

<img src="/products/{{$product->image}}" alt="">
    <h6>{{$product->title}}</h6>
    <h6>{{$product->details}}</h6>
    <h6>{{$product->category}}</h6>
    @if($product->discount_price)
        <h6 style="color : red">
            Dicount Price :${{$product->discount_price}}
        </h6>
        <h6 style="text-decoration:line-through; color:blue;">
          ${{$product->price}}
        </h6>
    @else
        <h6 style="color:blue">
          product Price:  ${{$product->price}}
        </h6>
    @endif
    <h6>Available Quantity : {{$product->quantity}}</h6>
    <form action="{{route('add.cart',$product->id)}}" method="post">
        @csrf
        <div class="row">
            <div class="col-md-4">
                <input type="number" name="quantity" value="1" min="1" max="{{$product->quantity}}">
            </div>
            <div class="col-md-4">
                <input type="submit"   value="Add to Cart">
            </div>
        </div>
    </form>
</div>
</div>




@include('home.footer')
<!-- footer end -->
<div class="cpy_">
    <p class="mx-auto">© 2022 All Rights Reserved By <a href="https://html.design/">Free Html Templates</a><br>

        Distributed By <a href="https://themewagon.com/" target="_blank">ThemeWagon</a>

    </p>
</div>
<!-- jQery -->
<script src="home/js/jquery-3.4.1.min.js"></script>
<!-- popper js -->
<script src="home/js/popper.min.js"></script>
<!-- bootstrap js -->
<script src="home/js/bootstrap.js"></script>
<!-- custom js -->
<script src="home/js/custom.js"></script>
</body>
</html>
