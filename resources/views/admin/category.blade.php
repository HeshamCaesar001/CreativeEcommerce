<!DOCTYPE html>
<html lang="en">
@include('admin.adminCSS')
<style type="text/css">
    .div_center
    {
        text-align:center;
        padding-top: 40px;
    }
    .h2_font
    {
        font-size: 40px;
        padding-bottom: 40px;
    }

</style>
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
        <div class="main-panel">
            <div class="content-wrapper" >
{{--                <script>--}}
{{--                    $(document).ready(function(){--}}
{{--                        $('.alert-success').fadeIn().delay(10).fadeOut();--}}
{{--                    });--}}
{{--                </script>--}}
                @if ($errors->any())
                    <div class="alert alert-danger">
                        <ul>
                            @foreach ($errors->all() as $error)
                                <li>{{ $error }}</li>
                            @endforeach
                        </ul>
                    </div>
                @endif

                @if (session('message'))
                    <div class="alert alert-success">
                        <p class="msg"> {{ session('message') }}</p>
                    </div>
                @endif
                <div class="div_center">
                    <h2 class="h2_font">Add Category</h2>
                    <form action="{{url('/addCategory')}}" method="POST">
                        @csrf
                        <input type="text"   style="color:black" name="category_name" placeholder="Enter New Category">
                        <input type="submit"   class="btn btn-success"  id="add">
                    </form>
                </div>
               <div class="container">
                   <table class="table">
                       <thead>
                       <tr>
                           <th scope="col">ID</th>
                           <th scope="col">Category Name</th>
                           <th scope="col">Created at</th>
                           <th scope="col">Actions</th>
                       </tr>
                       </thead>
                       <tbody>
                       @foreach($categories as $category)
                           <tr>
                               <td>{{$category->id}}</td>
                               <td>{{$category->category_name}}</td>
                               <td>{{$category->created_at}}</td>
                               <td>
                                   <form action="{{ route('cate.delete', $category) }}" method="post" style="display: inline-block">
                                       @csrf
                                       @method('DELETE')
                                       <button type="submit" onclick="return confirm('are you sure')" class="btn btn-danger">Delete</button>
                                   </form>
                               </td>
                           </tr>
                       @endforeach
                       </tbody>
               </div>
                </table>
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
