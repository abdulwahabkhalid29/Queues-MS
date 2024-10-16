@extends('admin.layouts.scaffold')
@section('content')
<section role="main" class="content-body">
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <a href="{{route('ticket.index')}}" class="btn mb-3 text-light" style="background-color:rgba(37, 37, 191, 0.732);">Back</a>
            </div>
        </div>
        <section class="card">
            
            <div class="card-body">
                <h3 style="color: black;">Create Ticket</h3>
                <form action="{{route('ticket.store')}}" class="form-horizontal form-bordered" method="POST">
                    @csrf
                    @method('POST')
                    <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="">User</label>
                                <select name="user_id" class="form-control" required id="user-select">
                                    <option selected disabled >--Select User--</option>
                                    @foreach ($users as $user)
                                    <option value="{{ $user->user_id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('user_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Business</label>
                                <select name="business_id" class="form-control" required id="business-select">
                                    <option selected disabled>--Select Business--</option>
                                    @foreach ($businesses as $business)
                                    <option value="{{ $business->business_id }}">{{ $business->business_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('business_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Counter</label>
                                <select name="counter_id" class="form-control" required id="counter-select">
                                    <option selected disabled>--Select Counter--</option>
                                    @foreach ($counters as $counter)
                                    <option value="{{ $counter->counter_id }}">{{ $counter->counter_number }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('counter_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Status</label>
                                <select name="status" class="form-control" required>
                                    <option selected disabled>--Select status--</option>
                                        <option value="waiting">waiting</option>
                                        <option value="serving">serving</option>
                                        <option value="completed">completed</option>
                                        <option value="cancelled">cancelled</option>
                                </select>
                                <small class="text-danger">@error ('status') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Completed at</label>
                                <input type="date" name="completed_at" class="form-control">
                                <small class="text-danger">@error ('completed_at') {{ $message }} @enderror</small>
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
@push('scripts')
<script>
$(document).ready(function() {
    $('#user-select').change(function() {
        var id = $(this).val();
        $('#business-select').empty().append('<option selected disabled>--Select Business--</option>');
        $('#counter-select').empty().append('<option selected disabled>--Select Counter--</option>');

        if(id) {
            $.ajax({
                url: "{{ route('business','') }}/" + id,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, business) {
                        $('#business-select').append('<option value="' + business.business_id + '">' + business.business_name + '</option>');
                    });
                }
            });
        }
    });
    $('#business-select').change(function() {
        var id = $(this).val();
        $('#counter-select').empty().append('<option selected disabled>--Select Counter--</option>');

        if(id) {
            $.ajax({
                url: "{{route('counter','')}}/" + id,
                type: 'GET',
                success: function(data) {
                    $.each(data, function(index, counter) {
                        $('#counter-select').append('<option value="' + counter.counter_id + '">' + counter.counter_number + '</option>');
                    });
                }
            });
        }
    });
});
</script>
@endpush