@extends('admin.layouts.scaffold')
@section('content')
<section role="main" class="content-body">
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <a href="{{route('ticket.index')}}" class="btn text-light mb-3" style="background-color:rgba(37, 37, 191, 0.732);">Back</a>
            </div>
        </div>
        <section class="card">
            <div class="card-body">
                <h3 style="color: black">Edit Ticket</h3>
                <form action="{{route('ticket.update',$ticket->ticket_id)}}" class="form-horizontal form-bordered" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                        <div class="col-md-6 mt-3">
                            <label for="">User</label>
                            <select name="user_id" class="form-control" required>
                                <option selected disabled>--Select User--</option>
                                @foreach ($users as $user)
                                <option {{ ($ticket->user_id) == $user->user_id ? 'selected' : '' }} value="{{ $user->user_id }}">{{ $user->name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('user_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Business</label>
                                <select name="business_id" class="form-control" required>
                                    <option selected disabled>--Select Business--</option>
                                    @foreach ($businesses as $business)
                                        <option {{ ($ticket->business_id) == $business->business_id ? 'selected' : '' }} value="{{ $business->business_id }}">{{ $business->business_name }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('business_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Counter</label>
                                <select name="counter_id" class="form-control" required>
                                    <option selected disabled>--Select Counter--</option>
                                    @foreach ($counters as $counter)
                                    <option {{ ($ticket->counter_id) == $counter->counter_id ? 'selected' : '' }} value="{{ $counter->counter_id }}">{{ $counter->counter_number }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('counter_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">status</label>
                                <select name="status" class="form-control" required>
                                    <option selected disabled>--Select status--</option>
                                    <option {{ $ticket->status == 'waiting' ? 'selected' : '' }} value="waiting">Waiting</option>
                                    <option {{ $ticket->status == 'serving' ? 'selected' : '' }} value="serving">Serving</option>
                                    <option {{ $ticket->status == 'completed' ? 'selected' : '' }} value="completed">Completed</option>
                                    <option {{ $ticket->status == 'cancelled' ? 'selected' : '' }} value="cancelled">Cancelled</option>
                                </select>
                                <small class="text-danger">@error ('status') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Completed at</label>
                                <input type="date" name="completed_at" class="form-control" value="{{$ticket->completed_at}}">
                                <small class="text-danger">@error ('completed_at') {{ $message }} @enderror</small>
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