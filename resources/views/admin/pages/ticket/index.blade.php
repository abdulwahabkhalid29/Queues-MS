@extends('admin.layouts.scaffold')
@push('styles')
<link rel="stylesheet" href="https://cdn.datatables.net/2.1.4/css/dataTables.dataTables.css" />
@endpush
@section('content')
<section role="main" class="content-body">
<div class="row mt-2">
    <div class="col-md-12">
        @if(Session::has('success'))
        <div class="alert alert-success alert-top-border alert-dismissible shadow fade show alert-dismissible" id="my-app" style="float: right;" role="alert">
                <i class="ri-check-double-line me-3 align-middle fs-16 text-success"></i>
            {{Session::get('success')}}
            <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
        </div>
        @endif
    </div>
    <div class="col-md-12">
        <section class="card">
        <header class="card-header">
            <div class="row">
                <div class="col-md-11">
                    <h2 class="card-title">Tickets </h2>
                </div>
                <div class="col-md-1">
                    <a href="{{route('ticket.create')}}" class="btn text-light" style="background-color:rgba(37, 37, 191, 0.732); margin-left:-2px;">Add <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>User</th>
                        <th>Business</th>
                        <th>Counter</th>
                        <th>Ticket Number</th>
                        <th>Created Time</th>
                        <th>Complete At</th>
                        <th>Status</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($tickets as $index=>$ticket)
                        <tr>
                            <td>{{ ++$index}}</td>
                            <td>{{ $ticket->user->name ?? '--' }}</td>                            
                            <td>{{ $ticket->business->business_name ?? '--' }}</td>                            
                            <td>{{ $ticket->counter->counter_number ?? '--' }}</td>                            
                            <td>{{ $ticket->ticket_number }}</td>
                            <td>{{   $ticket->created_time }}</td>
                            <td>{{ date('d M Y' , strtotime( $ticket->completed_at ))}}</td>
                            <td>
                                @if($ticket->status == 'waiting')
                                    <span class="badge bg-warning">Waiting</span>
                                @elseif($ticket->status == 'serving')
                                    <span class="badge bg-info">Serving</span>
                                @elseif($ticket->status == 'completed')
                                    <span class="badge bg-success">Completed</span>
                                @elseif($ticket->status == 'cancelled')
                                    <span class="badge bg-danger">Cancelled</span>
                                @endif
                            </td>
                            <td class="actions">
                                <a href="{{route('ticket.edit',$ticket->ticket_id)}}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <button class="delete-ticket" data-id="{{ $ticket->ticket_id }}" style="border: none; background-color: transparent;">
                                    <i class="pointer-cursor far fa-trash-alt "></i>
                                </button>
                            </td>
                        </tr>
                    @empty
                    @endforelse 
                </tbody>
            </table>
        </div>
        </section>
    </div>
</div>
</section>

@endsection
@push('scripts')
<script src="https://cdn.datatables.net/2.1.4/js/dataTables.js"></script>
    <script>
$(document).ready( function () {
$('#myTable').DataTable();
} );
var milliseconds = 3000;

setTimeout(function () {
document.getElementById('my-app').remove();
}, milliseconds);
            $(document).ready(function() {
                $('.delete-ticket').click(function() {
                    var ticketId = $(this).data('id');
                    swal({
                            title: "Are you sure?",
                            text: "You want to delete this Ticket?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: "{{ route('ticket.destroy', '') }}/" + ticketId,
                                    type: "DELETE",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            swal("Deleted!", response.message, "success");
                                            $('.ticket-item-' + ticketId).remove();
                                        } else {
                                            swal("Error!", response.message, "error");
                                        }
                                        window.location.reload();
                                    }
                                })

                            }
                        });
                });
            });
    </script>
@endpush