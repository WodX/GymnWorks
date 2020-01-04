@extends('layouts.auth')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-sm-10 col-md-8 col-lg-5 col-xl-4">
            <div class="login-img" ><img src="{{asset('storage/_images/logo.png')}}"></div>
            <div class="card-body" data-aos="fade-in">
                <form method="POST" action="/role/{{Auth::user()->role}}">
                    @csrf
                    @method('PATCH')
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" name="role" value="gymnast" class="register-btn">
                                Gymnast
                            </button>
                        </div>
                    </div>
                    <div class="form-group row">
                        <div class="col-md-12">
                            <button type="submit" name="role" value="coach" class="register-btn">
                                Coach
                            </button>
                        </div>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
