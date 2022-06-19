@extends('layouts.dashboard')
@section('title', '- Transaction')
@section('container')

<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<style>
    .border-right {
        border-right: 1px solid #eee;
    }
</style>

<div class="container">
    <div class="row mb-3">
        <h3>Transaction</h3>
    </div>
    <div class="row">
        @if (Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
        @endif
        @if ($errors->any())
        <div class="alert alert-danger">
            @foreach ($errors->all() as $error)
            {{ $error }}
            @endforeach
        </div>
        @endif
        <div class="table-responsive">
            <!-- <div class="d-flex justify-content-start">
                <button type="button" class="btn btn-outline-primary btn-sm mb-3" data-bs-toggle="modal" data-bs-target="#modalCategory">
                    <i class='bx bx-plus-medical'></i> Add Category
                </button>
            </div> -->
            <table class="table table-hover table-sm bg-white" id="tableCategory">
                <thead>
                    <tr>
                        <th class="p-0">#</th>
                        <th>Devisi</th>
                        <th>Item</th>
                        <th>User</th>
                        <th>Qty</th>
                        <th>No Nota</th>
                        <th>Date</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>

                            @if($item->theItem->division == 'Handphone')
                            <span class="badge bg-primary">{{ $item->theItem->division }}</span>
                            @else
                            <span class="badge bg-warning text-dark">{{ $item->theItem->division }}</span>
                            @endif
                        </td>
                        <td>{{ $item->theItem->name }}</td>
                        <td>{{ $item->theUser->name }}</td>
                        <td>{{ $item->quantity }}</td>
                        <td>{{ $item->invoice }}</td>
                        <td>{{ $item->date }}</td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- MODAL PARKING -->

<!-- Modal -->
<div class="modal fade" id="modalCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1" aria-labelledby="modalCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/Settings/Category/add">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Category Item">
                        <label for="name">Category Item</label>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit" class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Save</strong></button>
                    <button type="button" class="btn text-danger btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0" data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tableCategory').DataTable();
    });
</script>

@endsection