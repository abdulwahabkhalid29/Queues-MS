@extends('admin.layouts.scaffold')
@section('content')
<section role="main" class="content-body">
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <a href="{{route('business.index')}}" class="btn text-light mb-3" style="background-color:rgba(37, 37, 191, 0.732);">Back</a>
            </div>
        </div>
        <section class="card">
            <div class="card-body">
                <h3 style="color: black">Edit Business</h3>
                <form action="{{route('business.update',$business->business_id)}}" class="form-horizontal form-bordered" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="">User</label>
                                <select name="user_id" class="form-control" required>
                                    <option selected disabled>--Select User--</option>
                                    @foreach ($users as $user)
                                        <option {{ ($business->user_id) == $user->user_id ? 'selected' : '' }} value="{{ $user->user_id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('business_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Business Name</label>
                                <input type="name" name="business_name" class="form-control" value="{{$business->business_name}}">
                                <small class="text-danger">@error ('business_name') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Business Type</label>
                                <input type="name" name="business_type" class="form-control" value="{{$business->business_type}}">
                                <small class="text-danger">@error ('business_type') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Email</label>
                                <input type="email" name="email" class="form-control" value="{{$business->email}}">
                                <small class="text-danger">@error ('email') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Phone Number </label>
                                <input type="number" name="phone_number" class="form-control" value="{{$business->phone_number}}">
                                <small class="text-danger">@error ('phone_number') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Address</label>
                                <input type="address" name="address" class="form-control" value="{{$business->address}}">
                                <small class="text-danger">@error ('address') {{ $message }} @enderror</small>
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