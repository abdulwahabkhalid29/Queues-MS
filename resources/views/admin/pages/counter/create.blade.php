@extends('admin.layouts.scaffold')
@section('content')
<section role="main" class="content-body">
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <a href="{{route('counter.index')}}" class="btn mb-3 text-light" style="background-color:rgba(37, 37, 191, 0.732);">Back</a>
            </div>
        </div>
        <section class="card">
            
            <div class="card-body">
                <h3 style="color: black;">Create Counter</h3>
                <form action="{{route('counter.store')}}" class="form-horizontal form-bordered" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="">Counter Number</label>
                            <input type="text" name="counter_number" class="form-control">
                        </div>
                        <div class="col-md-6 mt-3">
                                <label for="">Business</label>
                                <select name="business_id" class="form-control" required>
                                    <option selected disabled>--Select Business--</option>
                                    @foreach ($businesses as $business)
                                        <option value="{{ $business->business_id }}">{{ $business->business_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('business_id') {{ $message }} @enderror</small>
                            </div>
                            <footer class="text-center mt-3">
                                <button class="btn text-light" style="background-color:rgba(37, 37, 191, 0.732);" type="submit">Submit</button>
                            </footer>
                    </div>
                </form>
            </div>
        </section>
    </div>
</div>
</section>
@endsection