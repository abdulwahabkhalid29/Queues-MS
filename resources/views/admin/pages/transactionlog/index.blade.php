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
                    <h2 class="card-title">Transaction Log </h2>
                </div>
                <div class="col-md-1">
                    <a href="{{route('transactionlog.create')}}" class="btn text-light" style="background-color:rgba(37, 37, 191, 0.732); margin-left:-2px;">Add <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Ticket</th>
                        <th>Action</th>
                        <th>Time Stamp</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($transaction_logs as $index=>$transaction_log)
                        <tr>
                            <td>{{ ++$index}}</td>
                            <td>{{ $transaction_log->ticket->ticket_number ?? '--' }}</td>                            
                            <td>{{ $transaction_log->action }}</td>
                            <td>{{ $transaction_log->timestamp }}</td>
                            <td class="actions">
                                <a href="{{route('transactionlog.edit',$transaction_log->transaction_id)}}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <button class="delete-transaction" data-id="{{ $transaction_log->transaction_id }}" style="border: none; background-color: transparent;">
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
                $('.delete-transaction').click(function() {
                    var serviceId = $(this).data('id');
                    swal({
                            title: "Are you sure?",
                            text: "You want to delete this Transaction Log?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: "{{ route('transactionlog.destroy', '') }}/" + serviceId,
                                    type: "DELETE",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            swal("Deleted!", response.message, "success");
                                            $('.transaction-item-' + serviceId).remove();
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