<!DOCTYPE html>
<html lang="en">
@include('admin.adminCSS')
{{--<style type="text/css">--}}
{{--    .div_center--}}
{{--    {--}}
{{--        text-align:center;--}}
{{--        padding-top: 40px;--}}
{{--    }--}}
{{--    .h2_font--}}
{{--    {--}}
{{--        font-size: 40px;--}}
{{--        padding-bottom: 40px;--}}
{{--    }--}}


{{--</style>--}}
<body>
<div class="container-scroller">
    <div class="row p-0 m-0 proBanner" id="proBanner">
        <div class="col-md-12 p-0 m-0">
            <div class="card-body card-body-padding d-flex align-items-center justify-content-between">
                <div class="ps-lg-1">
                    <div class="d-flex align-items-center justify-content-between">
                        <p class="mb-0 font-weight-medium me-3 buy-now-text">Free 24/7 customer support, updates, and more with this template!</p>
                        <a href="https://www.bootstrapdash.com/product/corona-free/?utm_source=organic&utm_medium=banner&utm_campaign=buynow_demo" target="_blank" class="btn me-2 buy-now-btn border-0">Get Pro</a>
                    </div>
                </div>
                <div class="d-flex align-items-center justify-content-between">
                    <a href="https://www.bootstrapdash.com/product/corona-free/"><i class="mdi mdi-home me-3 text-white"></i></a>
                    <button id="bannerClose" class="btn border-0 p-0">
                        <i class="mdi mdi-close text-white me-0"></i>
                    </button>
                </div>
            </div>
        </div>
    </div>
    <!-- partial:partials/_sidebar.html -->
    @include('admin.sidebar')
    <!-- partial -->
    <div class="container-fluid page-body-wrapper">
        <!-- partial:partials/_navbar.html -->
        @include('admin.navbar')
        <!-- partial -->
        <div class="main-panel" >
            <div class="content-wrapper" >
                <div class="container">
                    <form action="{{route('order.search')}}" method="get">
                        @csrf
                        <input type="text" placholder="serach" name="search" style="color: black;">
                        <input type="submit" class="btn btn-success" value="Search">
                    </form>
                </div>
            <div class="container">
                <table class="table">
                    <thead>
                    <tr>
                        <th scope="col">Client</th>
                        <th scope="col">Client Address</th>
                        <th scope="col">Client Phone Number</th>
                        <th scope="col">Product Name</th>
                        <th scope="col">Product amount</th>
                        <th scope="col">Product image</th>
                        <th scope="col">Product price</th>
                        <th scope="col">Payment way</th>
                        <th scope="col">Delivery status</th>
                        <th scope="col">Take Pdf</th>
                        <th scope="col">Send Email</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($orders as $order)
                        <tr>
                            <td>{{$order->email}}</td>
                            <td>{{$order->address}}</td>
                            <td>{{$order->phone}}</td>
                            <td>{{$order->product_title}}</td>
                            <td>{{$order->quantity}}</td>
                            <td><img src="/products/{{$order->image}}" alt="" style="width:50px;height:50px"></td>
                            <td>{{$order->price}}</td>
                            <td>{{$order->payment_status}}</td>
                        @if($order->delivery_statud != "Delieverd")
                            <td><a href="{{route('delivered',$order->id)}}" class="btn btn-success">click to Deliver</a></td>
                            @else
                            <td>Deliverd</td>
                        @endif
                            <td><a href="{{route('print.pdf',$order->id)}}" class="btn btn-secondary">Print PDF</a></td>
                            <td><a href="{{route('send.email',$order->id)}}" class="btn btn-primary">Send Email</a></td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
            </div>
            </div>
            <!-- page-body-wrapper ends -->
        </div>
        <!-- container-scroller -->
        <!-- plugins:js -->
        @include('admin.adminScript')
        <!-- End custom js for this page -->

</body>
</html>
