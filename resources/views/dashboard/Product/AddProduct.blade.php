@extends('layouts.dashboard')
@section('content')

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Add Product</a></li>
        </ol>

    </div>
    @if(session('success'))
        <small class="alert alert-success">{{session('success')}}</small>
    @endif

    <div class="cal-md-12">
        <div class="card">
            <div class="card-header">
                <h3>Add Header</h3>
            </div>
            <div class="card-body">
                <form action="{{route('add_product')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="row">
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Category</label>
                                <select name="category_id" id="category" class="form-control">
                                    <option value="">--Select Category--</option>
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
                                    <option value="">--Select Sub Category--</option>
                                </select>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Product Name</label>
                                <input type="text" name="product_name" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Product Price</label>
                                <input type="number" name="product_price" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Discount %</label>
                                <input type="number" name="product_discount" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Short Description</label>
                                <input type="text" name="short_des" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <label for="" class="form-label">Image</label>
                                <input type="file" name="product_image" id="" class="form-control">
                            </div>
                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Long Description</label>
                                <textarea name="long_desc" id="summernote" cols="30" rows="10" class="form-control"></textarea>
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
    <script>
        $(document).ready(function() {
            $('#summernote').summernote();
        });
    </script>

    {{--    @if(session('success'))--}}
    {{--        <script>--}}
    {{--            alert('tik ace');--}}
    {{--        </script>--}}
    {{--    @endif--}}

@endsection
