@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Profile</h3>

                </div>
                <h4>@if(session('success')) <small class="text-success ml-4"> {{session('success')}}</small> @endif</h4>

                <div class="card-body">
                    <form  action="{{route('update_profile')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input id="name" type="text" class="form-control" name="name"  value="{{Auth::User()->name}}" />
                            <input  type="hidden" class="form-control" name="id"  value="" />
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit"  class="btn btn-danger btn-sm"> Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>

        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Change Password</h3>
                    <h4>@if(session('success_pass')) <small class="text-success  ml-4"> {{session('success')}}</small> @endif</h4>
                    <h4>@if(session('taken_pass')) <small class="text-danger  ml-4"> {{session('taken_pass')}}</small> @endif</h4>
                    <h4>@if(session('wrong_pass')) <small class="text-danger  ml-4"> {{session('wrong_pass')}}</small> @endif</h4>
                </div>
                <div class="card-body">

                    <form method="POST" action="{{url('/update/password')}}">
                        @csrf
                        <div class="form-group">
                            <label for="">Old Password</label>
                            <input  type="password" class="form-control" name="old_password"  value="">
                            @if(session('old_error')) <small class="text-danger"> {{session('old_error')}}</small> @endif
                            @error('old_password') <small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="form-group">
                            <label for="">New Password</label>
                            <input  type="password" class="form-control" name="password"  value="">
                            @error('password') <small class="text-danger"> {{$message}}</small> @enderror
                            @if(session('new_error')) <small class="text-danger"> {{session('new_error')}}</small> @endif
                        </div>
                        <div class="form-group">
                            <label for="">Confirm Password</label>
                            <input  type="password" class="form-control" name="password_confirmation"  value="">
                            @error('password_confirmation') <small class="text-danger"> {{$message}}</small> @enderror
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit"  class="btn btn-danger btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
        <div class="col-lg-4">
            <div class="card">
                <div class="card-header">
                    <h3>Your Name</h3>
                </div>
                <div class="card-body">
                    <form method="POST" action="{{url('/user_photo_update')}}" enctype="multipart/form-data">
                        @csrf
                        <div class="form-group">
                            <label for="">Your Name</label>
                            <input  type="file" class="form-control" name="profile_img"  value="">
                            @error('profile_img')<small class="text-danger"> {{$message}}</small>@enderror
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit"  class="btn btn-danger btn-sm">Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection

@section('footer_script')
    @if(session('success_pass'))
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
                title: 'Password change successfully'
            })
        </script>
    @endif

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
                title: 'Name change successfully'
            })
        </script>
    @endif



@endsection

