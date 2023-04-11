@extends('layouts.dashboard')

@section('content')
    <div class="row">
        <div class="col-lg-6">
            <div class="card">
                <div class="card-header">
                    <h3>Profile</h3>
{{--                    @if(session('success'))--}}
{{--                        <span class="text-success">{{session('success')}}</span>--}}
{{--                    @endif--}}

                </div>

                <div class="card-body">
                    <form  action="{{route('update_user')}}" method="POST">
                        @csrf
                        <div class="form-group">
                            <label for="name">User Name</label>
                            <input id="name" type="text" class="form-control" name="category_name"  value="" />
                            <input  type="hidden" class="form-control" name="id"  value="" />
                        </div>
                        <div class="form-group mt-2">
                            <button type="submit"  class="btn btn-danger btn-sm"> Update</button>
                        </div>
                    </form>
                </div>
            </div>

        </div>
    </div>
@endsection
