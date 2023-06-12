@include('layouts.app')

<body >
<div >
    <div class="container ">
        <div class="row justify-content-center mt-3 h-100 align-items-center">
            <div class="col-md-6">
                <div class="authincation-content">
                    <div class="row no-gutters">
                        <div class="col-xl-12">
                            <div class="auth-form">
                                <div class="text-center mb-3">
                                    <a href="index.html"><img src="images/logo-full.png" alt=""></a>
                                </div>
                                <h4 class="text-center mb-4 text-white">Sign up your account</h4>
                                @if(session('success'))
                                    <span class="text-success">{{session('success')}}</span>
                                @endif
                                <form method="POST" action="{{url('/admin/login')}}">
                                    @csrf
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Email</strong></label>
                                        <input type="email" name="email" class="form-control" value="{{session('email')? session('email'):'dip@gmail.com'}}">
                                    </div>
                                    <div class="form-group">
                                        <label class="mb-1 text-white"><strong>Password</strong></label>
                                        <input type="password" name="password" class="form-control" value="{{session('password')? session('password'):''}}">
                                    </div>
                                    <div class="text-center mt-4">
                                        <button type="submit" class="btn bg-white text-primary btn-block">Sign in</button>
                                    </div>
                                </form>
                                <div class="new-account mt-3">
                                    <p class="text-white">You don't have an account? <a class="text-white" href="{{route('admin.register.form')}}">Register</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>



</body>
</html>
