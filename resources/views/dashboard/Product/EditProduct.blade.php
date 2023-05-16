@extends('layouts.dashboard')
@section('content')


    @if(session('success'))
        <small class="alert alert-success">{{session('success')}}</small>
    @endif

    <div class="cal-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Edit Product</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Category</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option value="{{$products->category_id}}">--
                                        @php
                                        if (App\Models\Category::where('id',$products->category_id)->exists()){
                                                        echo $products->rel_to_category->category_name;
                                                    }else{
                                                        echo 'N/A';
                                        }
                                    @endphp
                                        --</option>
                                    @foreach($category as $values)
                                        <option value="{{$values->id}}">{{$values->category_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Sub_Category</label>
                                <select name="subcategory_id" id="subcategory" class="form-control">
                                    <option value="{{$products->subcategory_id}}">--
                                        @php
                                            if (App\Models\SubCategory::where('id',$products->subcategory_id)->exists()){
                                                            echo $products->rel_to_subcategory->subcategry_name;
                                                        }else{
                                                            echo 'N/A';
                                            }
                                        @endphp
                                        --</option>
                                    @foreach($subCategory as $values)
                                        <option value="{{$values->id}}">{{$values->subcategry_name}}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>
                        <input  type="hidden" class="form-control " value="{{$products->id}}" name="product_id">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="product_name" id="" class="form-control" value="{{$products->product_name}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" name="product_price" id="" class="form-control" value="{{$products->product_price}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Discount %</label>
                                <input type="number" name="product_discount" id="" class="form-control" value="{{$products->discount}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Short Description</label>
                                <input type="text" name="short_des" id="" class="form-control" value="{{$products->sort_desp}}">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="product_image" id="" class="form-control">
                                <li><img class="img-fluid" src="{{ asset('/uploads/products')}}/{{$products->preview}}" alt=""></li>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for=""  class="form-label">Long Description</label>
                                <textarea name="long_desc" id="summernote" cols="30" rows="10" class="form-control" value="{{$products->long_desp}}">{{$products->long_desp}}</textarea>
                            </div>
                        </div>
                        <div class="col-md-12 text-center">
                            <div class="form-group">
                                <button type="submit" class="btn btn-primary ">Add Product</button>
                            </div>
                        </div>
                    </div>

                </form>
            </div>
        </div>
    </div>
@endsection


@section('footer_script')
    <script>
        $('#category').change(function () {
            var category_id = $(this).val();
            $.ajaxSetup({
                headers: {
                    'X-CSRF-TOKEN': $('meta[name="csrf-token"]').attr('content')
                }
            });
            $.ajax({
                type: 'POST',
                url: '/getSubCategory',
                data:{'category_id': category_id},
                success:function (data) {
                    $('#subcategory').html(data);
                }
            })
        });
    </script>


@endsection
