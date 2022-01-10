@extends('admin.master')
@section('head_asset')
    <link href="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.css')}}" rel="stylesheet">  
@endsection
@section('content')
                    <div class="card shadow mb-4">
                        <div class="card-header py-3 d-flex justify-content-between align-items-center h-100 w-100">
                            <div class="">
                                <h5 class="m-0 font-weight-bold text-primary">Orders</h5>
                            </div>
                            <form type="post" action="{{url('/admin/search_order')}}">
                                <div class="d-flex">
                                    <div class="" style="margin-right:10px;">
                                        <input class="form-control mr-sm-2" type="search" name="query" placeholder="Search" aria-label="Search">
                                    </div>
                                    <div class="">
                                        <button class="btn btn-primary" type="submit">Search Orders</button>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <div class="card-body">
                            <div class="table-responsive">
                                <table class="table table-bordered" id="datatable" width="100%" cellspacing="0">
                                    <thead>
                                        <tr>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Phone</th>
                                            <th>Address</th>
                                            <th>Country</th>
                                            <th>City</th>
                                            <th>Product Name</th>
                                            <th>Price</th>
                                            <th>Quantity</th>
                                            <th>Total Price</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    @foreach($order as $orders)
                                    <tbody>
                                        <td>{{$orders->name}}</td>
                                        <td>{{$orders->email}}</td>
                                        <td>{{$orders->phone}}</td>
                                        <td>{{$orders->address}}</td>
                                        <td>{{$orders->country}}</td>
                                        <td>{{$orders->city}}</td>
                                        <td>{{$orders->product_name}}</td>
                                        <td>${{$orders->price}}</td>
                                        <td>{{$orders->quantity}}</td>
                                        <td>${{$orders->totalprice}}</td>
                                        <td>{{$orders->status}}</td>
                                        <td>
                                            <a href="{{url('/admin/updatestatus', $orders->id)}}" class="btn btn-success">
                                                Delivered
                                            </a>
                                        </td>
                                    </tbody>
                                    @endforeach
                                    
                                </table>
                                <div class="d-flex justify-content-center w-100">
                                    <div class="">
                                        {{ $order->links() }}
                                    </div>                
                                </div>    
                            </div>
                        </div>
                    </div>


@endsection
@section('footer_asset')
    <script src="{{asset('admin/vendor/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin/vendor/datatables/dataTables.bootstrap4.min.js')}}"></script>

    <!-- Page level custom scripts -->
    <script src="{{asset('admin/js/demo/datatables-demo.js')}}"></script>
    <!-- <script>
        $(document).ready(function() {
            $('#datatable').DataTable();
        } );
    </script> -->
@endsection


