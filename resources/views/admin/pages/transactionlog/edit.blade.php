@extends('admin.layouts.scaffold')
@section('content')
<section role="main" class="content-body">
<div class="row">
    <div class="col">
        <div class="row">
            <div class="col-md-11"></div>
            <div class="col-md-1">
                <a href="{{route('transactionlog.index')}}" class="btn text-light mb-3" style="background-color:rgba(37, 37, 191, 0.732);">Back</a>
            </div>
        </div>
        <section class="card">
            <div class="card-body">
                <h3 style="color: black">Create Transaction Log</h3>
                <form action="{{route('transactionlog.update',$transaction_log->transaction_id)}}" class="form-horizontal form-bordered" method="POST">
                    @csrf
                    @method('PUT')
                    <div class="row">
                            <div class="col-md-6 mt-3">
                                <label for="">Ticket</label>
                                <select name="ticket_id" class="form-control" required>
                                    <option selected disabled>--Select Ticket--</option>
                                    @foreach ($tickets as $ticket)
                                        <option {{ ($transaction_log->ticket_id) == $ticket->ticket_id ? 'selected' : '' }} value="{{ $ticket->ticket_id }}">{{ $ticket->ticket_number }}</option>
                                    @endforeach
                                </select>
                                <small class="text-danger">@error ('ticket_id') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-6 mt-3">
                                <label for="">Action</label>
                                <input type="name" name="action" class="form-control" value="{{$transaction_log->action}}">
                                <small class="text-danger">@error ('action') {{ $message }} @enderror</small>
                            </div>
                            <div class="col-md-12 mt-3">
                                <label for=""> Time Stamp</label>
                                <input type="date" name="timestamp" class="form-control" value="{{$transaction_log->timestamp}}"></input>
                                <small class="text-danger">@error ('timestamp') {{ $message }} @enderror</small>
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