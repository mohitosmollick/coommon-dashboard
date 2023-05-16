@extends('layouts.dashboard')
@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Add Category</h3>
                    @if(session('success'))
                        <span class="text-success">{{session('success')}}</span>
                    @endif

                </div>

                <div class="card-body">
                    <form method="POST" action="{{route('services.insert')}}">
                        @csrf
                        <div class="form-group">
                            <label for="name">Service Name</label>
                            <input id="name" type="text" class="form-control" name="service_name"  value="">
                            @error('service_name') <span class="text-danger">{{$message}}</span> @enderror
                            <input  type="hidden" class="form-control" name="id"  value="">
                        </div>
                        <div class="form-group">
                            <label for="name">Icon react Code</label>
                            <input id="name" type="text" class="form-control" name="icon"  value="">
                            @error('icon') <span class="text-danger">{{$message}}</span> @enderror

                        </div>
                        <div class="col-md-12">
                            <div class="form-group">
                                <label for="" class="form-label">Long Description</label>
                                <textarea name="desc" id="summernote" cols="30" rows="10" class="form-control"></textarea>
                                @error('desc') <span class="text-danger">{{$message}}</span> @enderror
                            </div>
                        </div>
                        <div class="form-group mt-2 ml-3">
                            <button type="submit"  class="btn btn-danger btn-sm">Save</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

    </div>
    <div class="col-lg-12">
        <div class="card">
            <div class="card-header">
                <h3>Category list</h3>
                @if(session('delete'))
                    <span class="text-danger">{{session('delete')}}</span>
                @endif
            </div>
            <div class="card-body">
                <form action="{{ route('mark.soft_delete_category') }}" method="POST">
                    @csrf
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL</th>
                            <th>Service-Name</th>
                            <th>Description</th>
                            <th>Icon</th>
                            <th>Created-at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($all_service as $key=>$value)

                            <tr>
                                <td>{{$key+1}}</td>
                                <td>{{$value->service_name}}</td>
                                <td>{{$value->desc}}</td>
                                <td>{{$value->icon}}</td>
                                <td>{{$value->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('soft.delete.service', $value->id)}}" class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash mt-1"></i></a>
                                    <a href="{{route('edit.edit', $value->id)}}" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-pencil mt-1"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>
                    </table>
                </form>
            </div>

        </div>
{{--        <div class="card">--}}
{{--            <div class="card-header">--}}
{{--                <h3>Trash Category list</h3>--}}
{{--            </div>--}}
{{--            <div class="card-body">--}}
{{--                <form action="{{route('mark.restore_category')}}" method="POST">--}}
{{--                    @csrf--}}
{{--                    <table class="table table-bordered">--}}
{{--                        <thead>--}}
{{--                        <tr>--}}
{{--                            <th><input onClick="hardDel(this)" type="checkbox" > Mark All</th>--}}
{{--                            <th>SL</th>--}}
{{--                            <th>User Id</th>--}}
{{--                            <th>Category-Name</th>--}}
{{--                            <th>Slug</th>--}}
{{--                            <th>Created-at</th>--}}
{{--                            <th>Action</th>--}}
{{--                        </tr>--}}
{{--                        </thead>--}}
{{--                        <tbody>--}}
{{--                        @foreach($trash_category as $key=>$value)--}}

{{--                            <tr>--}}
{{--                                <td><input type="checkbox"  name="delete[]" value="{{$value->id}}"></td>--}}
{{--                                <td>{{$key+1}}</td>--}}
{{--                                <td>--}}
{{--                                <td>--}}
{{--                                    @php--}}
{{--                                        if(App\Models\User::where('id',$value->user_id )->exists()){--}}
{{--                                            echo $value->rel_to_user->name;--}}
{{--                                        }else{--}}
{{--                                            echo 'N/A';--}}
{{--                                        }--}}
{{--                                    @endphp--}}
{{--                                </td>--}}
{{--                                </td>--}}
{{--                                <td>{{$value->category_name}}</td>--}}
{{--                                <td>{{$value->category_slug}}</td>--}}
{{--                                <td>{{$value->created_at->diffForHumans()}}</td>--}}
{{--                                <td>--}}
{{--                                    <a href="{{ route('hard_delete_category', $value->id)}}" class="btn btn-sm btn-danger shadow ">Delete</a>--}}
{{--                                    <a href="{{ route('restore_category', $value->id)}}" class="btn btn-sm btn-secondary shadow ">Restore</a>--}}
{{--                                </td>--}}
{{--                            </tr>--}}
{{--                        @endforeach--}}
{{--                        </tbody>--}}
{{--                    </table>--}}
{{--                    <button type="submit" class="btn btn-danger btn-sm">All Restore</button>--}}

{{--                </form>--}}
{{--            </div>--}}
{{--        </div>--}}
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
                icon: 'delete',
                title: 'Category delete successfully'
            })
        </script>

    @endif

    <script language="JavaScript">
        function toggle(source) {
            checkboxes = document.getElementsByName('mark[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>
    <script language="JavaScript">
        function hardDel(source) {
            checkboxes = document.getElementsByName('delete[]');
            for(var i=0, n=checkboxes.length;i<n;i++) {
                checkboxes[i].checked = source.checked;
            }
        }
    </script>



@endsection


