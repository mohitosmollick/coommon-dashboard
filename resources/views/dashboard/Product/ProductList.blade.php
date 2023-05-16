@extends('layouts.dashboard')
@section('content')
    <div class="col-lg-12">
                <h3>Product list</h3>
                @if(session('soft_delete'))
                    <p class="text-danger">{{session('soft_delete')}}</p>
                @endif
{{--                @if(session('subcatupdate'))--}}
{{--                    <p class="text-success">{{session('subcatupdate')}}</p>--}}
{{--                @endif--}}
                <table class="table table-bordered p-3 bg-white">
                    <thead>
                    <tr>
                        <th>SL</th>
                        <th>Product Name</th>
                        <th>Main Price</th>
                        <th>Dis Count</th>
                        <th>Nid Price</th>
                        <th>Sort Desc</th>
                        <th>Long Desc</th>
                        <th>Image</th>
                        <th>Action</th>
                    </tr>
                    </thead>
                    <tbody>
                    @foreach($product as $key=>$product)
                        <tr>
                            <td>{{$key+1}}</td>
                            <td>{{$product->product_name}}</td>
                            <td>{{$product->product_price}}</td>
                            <td>{{$product->discount}}</td>
                            <td>{{$product->after_discount}}</td>
                            <td>{{substr($product->sort_desp, 0, 10)}}</td>
                            <td>{{substr($product->long_desp, 0, 10) }}</td>
                            <td width="100"><img class="img-fluid" src="{{ asset('/uploads/products')}}/{{$product->preview}}" alt=""> </td>
                            <td width="100">
                                <a href="{{route('edit_product',$product->id)}}" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-archive"></i></a>
                                <a href="{{route('soft_delete_product',$product->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                            </td>
                        </tr>
                    @endforeach
                    </tbody>
                </table>
    </div>


    <div class="col-lg-12">
        <h3>Trust Product list</h3>
        @if(session('restore'))
            <p class="text-danger">{{session('restore')}}</p>
        @endif
{{--        @if(session('subcatupdate'))--}}
{{--            <p class="text-success">{{session('subcatupdate')}}</p>--}}
{{--        @endif--}}
        <table class="table table-bordered p-3 bg-white">
            <thead>
            <tr>
                <th>SL</th>
                <th>Product Name</th>
                <th>Main Price</th>
                <th>Dis Count</th>
                <th>Nid Price</th>
                <th>Sort Desc</th>
                <th>Long Desc</th>
                <th>Image</th>
                <th>Action</th>
            </tr>
            </thead>
            <tbody>
            @foreach($trashProduct as $key=>$tProduct)
                <tr>
                    <td>{{$key+1}}</td>
                    <td>{{$tProduct->product_name}}</td>
                    <td>{{$tProduct->product_price}}</td>
                    <td>{{$tProduct->discount}}</td>
                    <td>{{$tProduct->after_discount}}</td>
                    <td>{{substr($tProduct->sort_desp, 0, 10)}}</td>
                    <td>{{substr($tProduct->long_desp, 0, 10) }}</td>
                    <td width="100"><img class="img-fluid" src="{{ asset('/uploads/products')}}/{{$tProduct->preview}}" alt=""> </td>
                    <td width="100">
                        <a href="{{route('product_reStore',$tProduct->id )}}" class="btn btn-primary shadow btn-xs sharp"><i class="fa fa-pencil mt-1"></i></a>
                        <a href="{{route('delete_product',$tProduct->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash"></i></a>
                    </td>
                </tr>
            @endforeach
            </tbody>
        </table>
    </div>
@endsection
