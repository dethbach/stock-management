@extends('layouts.dashboard')
@section('title', '- Inventory')
@section('container')


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.1.3/css/bootstrap.min.css">
<link rel="stylesheet" href="https://cdn.datatables.net/1.12.1/css/dataTables.bootstrap5.min.css">
<style>
    .border-right {
        border-right: 1px solid #eee;
    }
</style>

<div class="container bg-white">
    <div class="row">

        @if (Session::has('success'))
        <div class="alert alert-success">
            {!! Session::get('success') !!}
        </div>
        @endif
        @if (Session::has('error'))
        <div class="alert alert-danger">
            {!! Session::get('error') !!}
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
            <div class="d-flex justify-content-start">
                <!-- Button trigger modal -->
                <button type="button" class="btn btn-outline-primary btn-sm mb-3" data-bs-toggle="modal"
                    data-bs-target="#modalCategory">
                    <i class='bx bx-plus-medical'></i> Add Item
                </button>
            </div>
            <table class="table table-hover table-sm bg-white" id="tableCategory">
                <thead>
                    <tr>
                        <th class="p-0">#</th>
                        <th>Devisi</th>
                        <th>Kategori</th>
                        <th>Nama Item</th>
                        <th>Stok</th>
                        <th>Modal</th>
                        <th>Jual</th>
                        <th>Last Update</th>
                        <th>Action</th>
                    </tr>
                </thead>
                <tbody>
                    <?php $i = 1 ?>
                    @foreach($items as $item)
                    <tr>
                        <td>{{$i++}}</td>
                        <td>
                            @if($item->division == 'Handphone')
                            <span class="badge bg-primary">{{ $item->division }}</span>
                            @else
                            <span class="badge bg-warning text-dark">{{ $item->division }}</span>
                            @endif
                        </td>
                        <td>{{ $item->theCategory->name }}</td>
                        <td>{{ $item->name }}</td>
                        <td>
                            @if($item->stock == 0)
                            <span class="badge bg-danger">Stok Habis</span>
                            @else
                            {{ $item->stock }}
                            @endif
                        </td>
                        <td>Rp. {{ $item->capital }}</td>
                        <td>Rp. {{ $item->price }}</td>
                        <td>{{ $item->lastupdate }}</td>
                        <td>
                            @if($item->stock == 0)
                            <span class="badge bg-danger">Stok Habis</span>
                            @if(Auth::user()->role == 'Super')
                            <button type="button" class="btn btn-outline-danger btn-sm mb-3" data-bs-toggle="modal"
                                data-bs-target="#modalEdit" data-bs-id="{{ $item->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            @endif
                            @else
                            <!-- Button trigger modal -->
                            <button type="button" class="btn btn-outline-primary btn-sm mb-3" data-bs-toggle="modal"
                                data-bs-target="#modalSells" data-bs-id="{{ $item->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-cart-plus" viewBox="0 0 16 16">
                                    <path
                                        d="M9 5.5a.5.5 0 0 0-1 0V7H6.5a.5.5 0 0 0 0 1H8v1.5a.5.5 0 0 0 1 0V8h1.5a.5.5 0 0 0 0-1H9V5.5z" />
                                    <path
                                        d="M.5 1a.5.5 0 0 0 0 1h1.11l.401 1.607 1.498 7.985A.5.5 0 0 0 4 12h1a2 2 0 1 0 0 4 2 2 0 0 0 0-4h7a2 2 0 1 0 0 4 2 2 0 0 0 0-4h1a.5.5 0 0 0 .491-.408l1.5-8A.5.5 0 0 0 14.5 3H2.89l-.405-1.621A.5.5 0 0 0 2 1H.5zm3.915 10L3.102 4h10.796l-1.313 7h-8.17zM6 14a1 1 0 1 1-2 0 1 1 0 0 1 2 0zm7 0a1 1 0 1 1-2 0 1 1 0 0 1 2 0z" />
                                </svg>
                            </button>
                            @if(Auth::user()->role == 'Super')
                            <button type="button" class="btn btn-outline-danger btn-sm mb-3" data-bs-toggle="modal"
                                data-bs-target="#modalEdit" data-bs-id="{{ $item->id }}">
                                <svg xmlns="http://www.w3.org/2000/svg" width="20" height="20" fill="currentColor"
                                    class="bi bi-pencil-square" viewBox="0 0 16 16">
                                    <path
                                        d="M15.502 1.94a.5.5 0 0 1 0 .706L14.459 3.69l-2-2L13.502.646a.5.5 0 0 1 .707 0l1.293 1.293zm-1.75 2.456-2-2L4.939 9.21a.5.5 0 0 0-.121.196l-.805 2.414a.25.25 0 0 0 .316.316l2.414-.805a.5.5 0 0 0 .196-.12l6.813-6.814z" />
                                    <path fill-rule="evenodd"
                                        d="M1 13.5A1.5 1.5 0 0 0 2.5 15h11a1.5 1.5 0 0 0 1.5-1.5v-6a.5.5 0 0 0-1 0v6a.5.5 0 0 1-.5.5h-11a.5.5 0 0 1-.5-.5v-11a.5.5 0 0 1 .5-.5H9a.5.5 0 0 0 0-1H2.5A1.5 1.5 0 0 0 1 2.5v11z" />
                                </svg>
                            </button>
                            @endif
                            @endif

                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>


<!-- MODAL PARKING -->

<!-- Modal -->
<div class="modal fade" id="modalCategory" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalCategoryLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/Item/Add">
                @csrf
                <div class="modal-body">
                    <div class="mb-3">
                        <label for="division">Devisi</label>
                        <select class="form-select" aria-label="division" id="division" name="division" required>
                            <option value="Handphone">Handphone</option>
                            <option value="Laptop">Laptop</option>
                            <option value="Inventaris Kantor">Inventaris Kantor</option>
                        </select>
                    </div>
                    <div class="mb-3">
                        <label for="category_id">Kategori</label>
                        <select class="form-select" aria-label="category_id" id="category_id" name="category_id"
                            required>
                            @foreach($categories as $category)
                            <option value="{{ $category->id }}">{{ $category->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="name" name="name" placeholder="Nama Item" required>
                        <label for="name">Nama Item</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="stock" name="stock" placeholder="Jumlah Item"
                            required>
                        <label for="stock">Jumlah Item</label>
                    </div>

                    <label for="capital">Harga Modal</label>
                    <div class="input-group">
                        <span class="input-group-text" id="capital">Rp.</span>
                        <input type="number" class="form-control" id="capital" name="capital" placeholder="Modal"
                            aria-describedby="capital" required>
                    </div>
                    <label class="text-secondary mb-3" for="capital">Tanpa menggunakan (.)</label> <br>

                    <label for="price mt-3">Harga Jual</label>
                    <div class="input-group">
                        <span class="input-group-text" id="price">Rp.</span>
                        <input type="number" class="form-control" id="price" name="price" placeholder="Jual"
                            aria-describedby="price" required>
                    </div>
                    <label class="text-secondary mb-3" for="price">Tanpa menggunakan (.)</label>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Save</strong></button>
                    <button type="button"
                        class="btn text-danger btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>




<!-- Modal -->
<div class="modal fade" id="modalSells" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalSellsLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/Invoice/Add">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="disablemyname" name="disablemyname"
                            placeholder="Nama Item" disabled>
                        <input type="text" class="form-control" id="myname" name="myname" placeholder="Nama Item"
                            hidden>
                        <input type="text" class="form-control" id="theid" name="theid" placeholder="Nama Item" hidden>
                        <label for="myname">Nama Item</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="disablestock" name="disablestock"
                            placeholder="Qty Item" disabled>
                        <input type="text" class="form-control" id="mystock" name="mystock" placeholder="Qty Item"
                            hidden>
                        <label for="myname">Qty Item</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="qty" name="qty" placeholder="Jumlah Item"
                            required>
                        <label for="qty">Jumlah Item</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="number" class="form-control" id="invoice" name="invoice" placeholder="Nomor Nota"
                            required>
                        <label for="invoice">Nomor Nota</label>
                    </div>
                    <label for="status">Status Order</label>
                    <select class="form-select" multiple aria-label="status" name="status" id="status" required>
                        <option value="Jual">Jual</option>
                        <option value="Retur">Retur</option>
                    </select>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Save</strong></button>
                    <button type="button"
                        class="btn text-danger btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<!-- Modal -->
<div class="modal fade" id="modalEdit" data-bs-backdrop="static" data-bs-keyboard="false" tabindex="-1"
    aria-labelledby="modalEditLabel" aria-hidden="true">
    <div class="modal-dialog">
        <div class="modal-content" style="border-radius: 15px;">
            <div class="modal-header">
                <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
            </div>
            <form method="POST" action="/Inventory/edit">
                @csrf
                <div class="modal-body">
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="thename" name="thename" placeholder="Nama Item">
                        <input type="text" class="form-control" id="theids" name="theids" placeholder="Nama Item"
                            hidden>
                        <label for="theids">Nama Item</label>
                    </div>
                    <div class="form-floating mb-3">
                        <input type="text" class="form-control" id="thestock" name="thestock" placeholder="Qty Item">
                        <label for="thestock">Qty Item</label>
                    </div>
                </div>
                <div class="modal-footer flex-nowrap p-0">
                    <button type="submit"
                        class="btn btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0 border-right"><strong>Save</strong></button>
                    <button type="button"
                        class="btn text-danger btn-lg btn-link fs-6 text-decoration-none col-6 m-0 rounded-0"
                        data-bs-dismiss="modal">Cancel</button>
                </div>
            </form>
        </div>
    </div>
</div>

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
<script>
    var modalSells = document.getElementById('modalSells')
    modalSells.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var myid = button.getAttribute('data-bs-id')
        if (myid) {
            $.ajax({
                url: '/Sells/' + myid,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#myname").val(data.name)
                    $("#theid").val(data.id)
                    $("#disablemyname").val(data.name)
                    $("#mystock").val(data.stock)
                    $("#disablestock").val(data.stock)
                }
            });
        }
    });
</script>
<script>
    var modalEdit = document.getElementById('modalEdit')
    modalEdit.addEventListener('show.bs.modal', function(event) {
        // Button that triggered the modal
        var button = event.relatedTarget
        // Extract info from data-bs-* attributes
        var myid = button.getAttribute('data-bs-id')
        if (myid) {
            $.ajax({
                url: '/Sells/' + myid,
                type: "GET",
                dataType: "json",
                success: function(data) {
                    $("#theids").val(data.id)
                    $("#thename").val(data.name)
                    $("#thestock").val(data.stock)
                }
            });
        }
    });
</script>

<script src="https://code.jquery.com/jquery-3.5.1.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/jquery.dataTables.min.js"></script>
<script src="https://cdn.datatables.net/1.12.1/js/dataTables.bootstrap5.min.js"></script>

<script>
    $(document).ready(function() {
        $('#tableCategory').DataTable();
    });
</script>



@endsection