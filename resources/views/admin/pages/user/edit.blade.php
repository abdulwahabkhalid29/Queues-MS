@extends('admin.layouts.scaffold')
@section('content')
<section role="main" class="content-body">
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <a href="{{route('user.index')}}" class="btn text-light mb-3" style="background-color:rgba(37, 37, 191, 0.732);">Back</a>
            </div>
        </div>
        <section class="card">
            <div class="card-body">
                <h3 style="color: black">Edit User</h3>
                <form action="{{route('user.update',$user->user_id)}}" class="form-horizontal form-bordered" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="">Name</label>
                                <input type="name" name="name" class="form-control" value="{{$user->name}}">
                                <small class="text-danger">@error ('name') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for=""> Email</label>
                                <input type="email" name="email" class="form-control" value="{{$user->email}}">
                                <small class="text-danger">@error ('email') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Phone Number </label>
                                <input type="number" name="phone_number" class="form-control" value="{{$user->phone_number}}">
                                <small class="text-danger">@error ('phone_number') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">password</label>
                                <input type="password" name="password" class="form-control">
                            </div>
                            
                            <footer class="text-center mt-3">
                                <button class="btn text-light" style="background-color:rgba(37, 37, 191, 0.732);" type="submit">Update</button>
                            </footer>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
</section>
@endsection