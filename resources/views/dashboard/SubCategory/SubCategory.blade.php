@extends('layouts.dashboard')
@section('content')


        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Add Sub_Category</h3>
                    @if(session('success'))
                        <p class="text-success">{{session('success')}}</p>
                    @endif
                </div>
                <div class="card-body">
                    <form action="{{ route('add_subCategory') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name"> Select Category Name</label>
                            <select name="category_id" class="form-control" id="">
                                <option value="">--select category--</option>
                                @foreach($category as $categry)
                                    <option value="{{$categry->id}}">{{$categry->category_name}}</option>
                                @endforeach
                            </select>
                            @error('category_id')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                            @if(session('error'))
                                <small class="text-danger">{{session('error')}}</small>
                            @endif
                        </div>
                        <div class="form-group mt-5">
                            <label for="name">Sub_Category Name</label>
                            <input id="name" type="text" class="form-control  @error('subcategory_name') is-invalid @enderror" value=""{{old('subcategory_name')}} name="subcategory_name">
                            @error('subcategory_name')
                            <small class="text-danger">{{$message}}</small>
                            @enderror
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit" class="btn btn-success">Submit</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Sub Category list</h3>
                    @if(session('delete'))
                        <p class="text-danger">{{session('delete')}}</p>
                    @endif
                    @if(session('subcatupdate'))
                        <p class="text-success">{{session('subcatupdate')}}</p>
                    @endif

                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category-Name</th>
                            <th>Sub Category Name</th>
                            <th>Sub Category Slug</th>
                            <th>Created-at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($subCategory as $key=>$subCategory)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @php
                                        if (App\Models\Category::where('id',$subCategory->category_id)->exists()){
                                            echo $subCategory->rel_to_category->category_name;
                                        }else{
                                            echo 'N/A';
                                        }
                                    @endphp
                                </td>
                                <td>{{$subCategory->subcategry_name}}</td>
                                <td>{{$subCategory->subcategry_slug}}</td>
                                <td>{{$subCategory->created_at->diffForHumans()}}</td>
                                <td>

                                    <a href="{{route('soft_delete_subCat',$subCategory->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash mt-1"></i></a>
                                    <a href="{{route('edit_sub_category',$subCategory->id )}}" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-pencil mt-1"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

                </div>

            </div>
        </div>

        <div class="col-lg-12">
            <div class="card">
                <div class="card-header">
                    <h3>Trust list</h3>
                    @if(session('hardDelete'))
                        <p class="text-danger">{{session('hardDelete')}}</p>
                    @endif
                    @if(session('restore'))
                        <p class="text-success">{{session('restore')}}</p>
                    @endif
                </div>
                <div class="card-body">

                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Category-Name</th>
                            <th>Sub Category Name</th>
                            <th>Sub Category Slug</th>
                            <th>Created-at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trashSubcategory as $key=>$value)
                            <tr>
                                <td>{{$key+1}}</td>
                                <td>
                                    @php
                                        if (App\Models\Category::where('id',$value->category_id)->exists()){
                                            echo $value->rel_to_category->category_name;
                                        }else{
                                            echo 'N/A';
                                        }
                                    @endphp
                                </td>
                                <td>{{$value->	subcategry_name}}</td>
                                <td>{{$value->	subcategry_slug}}</td>
                                <td>{{$value->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{ route('subCat_hard_delete', $value->id)}}" class="btn btn-danger shadow btn-xs sharp"><i class="fa fa-trash mt-1"></i></a>
                                    <a href="{{route('subCat_reStore', $value->id)}}" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-pencil mt-1"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>

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
                title: 'Sub_Category add successfully'
            })
        </script>
    @endif


    @if(session('delete'))
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
                title: 'Sub_Category delete successfully'
            })
        </script>

    @endif

    @if(session('hardDelete'))
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
                title: 'Sub_Category delete successfully'
            })
        </script>

    @endif

    @if(session('restore'))
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
                title: 'Sub_Category Restore successfully'
            })
        </script>

    @endif




@endsection



