@extends('layouts.dashboard')

@section('content')


    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                    <h2> User List ({{$total_user}})</h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($users as $key=>$list)
                            <tr>
                                <td>{{$users->firstitem()+$key}}</td>
                                <td>{{$list->name}}</td>
                                <td>{{$list->email}}</td>
                                <td>{{$list->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('user_delete', $list->id)}}" class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash mt-1"></i></a>
                                    <a href="{{route('edit_user', $list->id)}}" class="btn btn-secondary shadow btn-xs sharp"><i class="fa fa-pencil mt-1"></i></a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>
                    {{$users->links()}}
                </div>
            </div>
        </div>


        <div class="col-md-12">
            <div class="card">
                <div class="card-header">
                   <h2> Trust Users </h2>
                </div>
                <div class="card-body">
                    <table class="table table-bordered">
                        <thead>
                        <tr>
                            <th>SL NO.</th>
                            <th>Name</th>
                            <th>Email</th>
                            <th>Created at</th>
                            <th>Action</th>
                        </tr>
                        </thead>
                        <tbody>
                        @foreach($trash_users as $key=>$trash_user)
                            <tr>
                                <td>{{$trash_user->$key+1}}</td>
                                <td>{{$trash_user->name}}</td>
                                <td>{{$trash_user->email}}</td>
                                <td>{{$trash_user->created_at->diffForHumans()}}</td>
                                <td>
                                    <a href="{{route('user_hard_delete', $trash_user->id)}}" class="btn btn-danger shadow btn-xs sharp delete"><i class="fa fa-trash mt-1"></i></a>
                                    <a href="{{route('restore_user', $trash_user->id)}}" class="btn btn-secondary shadow ">Restore</a>
                                </td>
                            </tr>
                        @endforeach
                        </tbody>

                    </table>

                </div>
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


@endsection
