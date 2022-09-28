<!DOCTYPE html>
<html>
<head>
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
    <!-- header section strats -->
    @include('home.header')
    <!-- end header section -->

</div>
    <div class="container">
        <table class="table">
            <thead>
            <tr>
                <th scope="col">Name</th>
                <th scope="col">Quantity</th>
                <th scope="col">Price</th>
                <th scope="col">image</th>
                <th scope="col">Action</th>
            </tr>
            </thead>
            <tbody>
            <?php $totalPrice = 0; ?>
                @foreach($carts as $cart)
                    <tr>
                        <td>{{$cart->product_title}}</td>
                        <td>{{$cart->quantity}}</td>
                        <td>{{$cart->price}}</td>
                        <td><img src="/products/{{$cart->image}}" alt="" style="width:50px;height:50px"></td>
                        <td>
                            <form action="{{ route('cart.delete', $cart->id) }}" method="post" style="display: inline-block">
                                @csrf
                                @method('DELETE')
                                <button type="submit" onclick="return confirm('are you sure')" class="btn btn-danger">Delete</button>
                            </form>
                        </td>
                    </tr>
                    <?php $totalPrice = $totalPrice + $cart->price ?>
                @endforeach
            </tbody>
        </table>
        <center>
            <h6>Total cach : $ {{$totalPrice}}</h6>
        </center>
        <center><h3 style="font-size:20px">proceed to order</h3></center>
        <center>
            <a href="{{route('cashOrder')}}" class="btn btn-danger">Cash On Delivery</a>
            <a href="{{route('stripe',$totalPrice)}}" class="btn btn-danger">Pay Using Card</a>
        </center>
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
