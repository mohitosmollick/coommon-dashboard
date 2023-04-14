@extends('layouts.dashboard')
@section('content')

    <div class="page-titles">
        <ol class="breadcrumb">
            <li class="breadcrumb-item"><a href="javascript:void(0)">Dashboard</a></li>
            <li class="breadcrumb-item active"><a href="javascript:void(0)">Edit Sub Category</a></li>
        </ol>
    </div>
    <div class="col-lg-6">
        <div class="card">
            <div class="card-header">
                <h3>Edit Sub_Category</h3>
            </div>
            <div class="card-body">
                <form action="{{route('update_sub_categories')}}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label for="name"> Select Category Name</label>
                        <select name="category_id" class="form-control" id="">
                            <option value="">--
                                @php
                                    if (App\Models\Category::where('id',$subcategory_info->category_id)->exists()){
                                                    echo $subcategory_info->rel_to_category->category_name;
                                                }else{
                                                    echo 'N/A';
                                    }
                                @endphp

                                --</option>
{{--                            @foreach($categories as $category)--}}
{{--                                <option value="{{$category->id}}"  {{($category->id == $subcategory_info->category_id?'selected':' ')}}>{{$category->category_name}}</option>--}}
{{--                            @endforeach--}}
                        </select>
                        @error('category_id')
                        <small class="text-danger">{{$message}}</small>
                        @enderror

                    </div>
                    <div class="form-group mt-5">
                        <label for="name">Sub_Category Name</label>
                        <input  type="hidden" class="form-control " value="{{$subcategory_info->id}}" name="subcategory_id">
                        <input id="name" type="text" class="form-control  @error('subcategory_name') is-invalid @enderror" value="{{$subcategory_info->subcategry_name}}" name="subcategory_name">
                        @error('subcategory_name')
                        <small class="text-danger">{{$message}}</small>
                        @enderror
                        @if(session('error'))
                            <small class="text-danger">{{session('error')}}</small>
                        @endif
                    </div>
                    <div class="form-group mt-2">
                        <button type="submit" class="btn btn-success">Update</button>
                    </div>
                </form>
            </div>

        </div>
    </div>

@endsection

@section('footer_script')

    @if(session('success'))
        <script>
            const Toast = Swal.mixin({
                toast: true,
                position: 'top-end',
                showConfirmButton: false,
                timer: 2000,
                timerProgressBar: true,
                didOpen: (toast) => {
                    toast.addEventListener('mouseenter', Swal.stopTimer)
                    toast.addEventListener('mouseleave', Swal.resumeTimer)
                }
            })

            Toast.fire({
                icon: 'success',
                title: 'Category add successfully'
            })
        </script>
    @endif
@endsection

