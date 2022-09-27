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
                {{--                <script>--}}
                {{--                    $(document).ready(function(){--}}
                {{--                        $('.alert-success').fadeIn().delay(10).fadeOut();--}}
                {{--                    });--}}
                {{--                </script>--}}
{{--                @if ($errors->any())--}}
{{--                    <div class="alert alert-danger">--}}
{{--                        <ul>--}}
{{--                            @foreach ($errors->all() as $error)--}}
{{--                                <li>{{ $error }}</li>--}}
{{--                            @endforeach--}}
{{--                        </ul>--}}
{{--                    </div>--}}
{{--                @endif--}}

{{--                @if (session('message'))--}}
{{--                    <div class="alert alert-success">--}}
{{--                        <p class="msg"> {{ session('message') }}</p>--}}
{{--                    </div>--}}
{{--                @endif--}}
{{--                <div class="div_center">--}}
{{--                    <h2 class="h2_font">Add Category</h2>--}}
{{--                    <form action="{{url('/addCategory')}}" method="POST">--}}
{{--                        @csrf--}}
{{--                        <input type="text"   style="color:black" name="category_name" placeholder="Enter New Category">--}}
{{--                        <input type="submit"   class="btn btn-success"  id="add">--}}
{{--                    </form>--}}
{{--                </div>--}}
                <div class="container col-3">
                    <form action="{{url('/saveProduct')}}" method="post" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="title">Title</label>
                            <input type="text" class="form-control " style="color:white " id="title" name="title" placeholder="Enter title" required>
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <input type="text" class="form-control " style="color:white "id="description" name= "description" placeholder="description" required>
                        </div>
                        <div class="form-group">
                            <label for="category">Category</label>
{{--                            <input type="text" class="form-control "style="color:white  id="Category" name="category" placeholder="description">--}}
                            <select class="form-select" name="category" required>
                                <option selected>Select Category</option>
                                @foreach($categories as $category)

                                    <option value="{{$category->category_name}}">{{$category->category_name}}</option>
                                @endforeach
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="Price">Price</label>
                            <input type="number" class="form-control" style="color:white" input id="Price" name="price" placeholder="Price" required>
                        </div>
                        <div class="form-group">
                            <label for="Quantity">Quantity</label>
                            <input type="number" class="form-control "style="color:white"  id="Quantity" name="quntity" placeholder="Quantity" required>
                        </div>
                        <div class="form-group">
                            <label for="Discountprice">Discount Price</label>
                            <input type="number" class="form-control " style="color:white" id="Discountprice" name="discount_price" placeholder="Discountprice">
                        </div>
                        <div class="form-group">
                            <label for="image">image</label>
                            <input type="file" class="form-control "  id="image" name="image" placeholder="description" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Submit</button>
                    </form>
                </di>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
    <!-- plugins:js -->
    @include('admin.adminScript')
    <!-- End custom js for this page -->

</body>
</html>
