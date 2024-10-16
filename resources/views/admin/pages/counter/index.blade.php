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
                    <h2 class="card-title">Counters </h2>
                </div>
                <div class="col-md-1">
                    <a href="{{route('counter.create')}}" class="btn text-light" style="background-color:rgba(37, 37, 191, 0.732); margin-left:-2px;">Add <i class="fas fa-plus"></i></a>
                </div>
            </div>
        </header>
        <div class="card-body">
            <table class="table table-bordered table-striped" id="myTable" >
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>Business</th>
                        <th class="text-center">Counter Number</th>
                        <th>Actions</th>
                    </tr>
                </thead>
                <tbody>
                    @forelse ($counters as $index=>$counter)
                        <tr>
                            <td>{{ ++$index}}</td>
                            <td>{{ $counter->business->business_name ?? '--' }}</td>                            
                            <td class="text-center">{{ $counter->counter_number }}</td>
                            <td class="actions">
                                <a href="{{route('counter.edit',$counter->counter_id)}}" class="on-default edit-row"><i class="fas fa-pencil-alt"></i></a>
                                <button class="delete-counter" data-id="{{ $counter->counter_id }}" style="border: none; background-color: transparent;">
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
                $('.delete-counter').click(function() {
                    var counterId = $(this).data('id');
                    swal({
                            title: "Are you sure?",
                            text: "You want to delete this Counter?",
                            icon: "warning",
                            buttons: true,
                            dangerMode: true,
                        })
                        .then((willDelete) => {
                            if (willDelete) {
                                $.ajax({
                                    url: "{{ route('counter.destroy', '') }}/" + counterId,
                                    type: "DELETE",
                                    data: {
                                        _token: "{{ csrf_token() }}",
                                    },
                                    success: function(response) {
                                        if (response.status == 'success') {
                                            swal("Deleted!", response.message, "success");
                                            $('.counter-item-' + counterId).remove();
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