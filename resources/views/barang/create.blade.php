@extends('layouts.master')
@section('title')
Admin | Halaman Barang
@endsection
@section('content')
<h1>Form Permintaan Barang</h1>

@if(session('success'))
<div class="alert alert-success">
    {{ session('success') }}
</div>
@endif

@if(session('error'))
<div class="alert alert-danger">
    {{ session('error') }}
</div>
@endif
<a href="{{ route('barang.index') }}" class="btn btn-primary flex float-right">Kembali</a>

<form action="{{ route('barang.store') }}" method="post">
    @csrf

    <div class="form-group">
        <label for="employee_id">Pilih Karyawan</label>
        <select class="form-control" id="employee_id" name="employee_id" required>
            <option value="" selected disabled>-- Pilih Karyawan --</option>
            @foreach($employees as $employee)
            <option value="{{ $employee->id }}">{{ $employee->nama }} - {{ $employee->departement }}</option>
            @endforeach
        </select>
    </div>

    <div class="form-group">
        <label>Barang yang Diminta</label>

        <div class="row">
            <div class="col-6">
                <select class="form-control" id="item_id" name="items[0][item_id]" required>
                    <option value="" selected disabled>-- Pilih Barang --</option>
                    @foreach($items as $item)
                    <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                    @endforeach
                </select>
            </div>

            <div class="col-4">
                <input type="number" class="form-control" id="quantity" name="items[0][quantity]" placeholder="Jumlah"
                    required>
            </div>

            <div class="col-2">
                <button type="button" class="btn btn-success" id="add-item">Tambah Barang</button>
            </div>
        </div>

        <div id="item-list" class="mt-2"></div>
    </div>

    <button type="submit" class="btn btn-primary">Submit Permintaan</button>
</form>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
            let itemCount = 1;

            document.getElementById('add-item').addEventListener('click', function () {
                const itemList = document.getElementById('item-list');
                const newItem = document.createElement('div');
                newItem.className = 'row mt-2';

                newItem.innerHTML = `
                    <div class="col-6">
                        <select class="form-control" name="items[${itemCount}][item_id]" required>
                            <option value="" selected disabled>-- Pilih Barang --</option>
                            @foreach($items as $item)
                                <option value="{{ $item->id }}">{{ $item->nama_barang }}</option>
                            @endforeach
                        </select>
                    </div>
                    <div class="col-4">
                        <input type="number" class="form-control" name="items[${itemCount}][quantity]" placeholder="Jumlah" required>
                    </div>
                    <div class="col-2">
                        <button type="button" class="btn btn-danger" onclick="removeItem(this)">Hapus</button>
                    </div>
                `;

                itemList.appendChild(newItem);
                itemCount++;
            });

            
        });

        function removeItem(button) {
                const row = button.closest('.row');
                row.remove();
            }
</script>
<script>
    document.addEventListener('DOMContentLoaded', function () {
        // ... (existing script for dynamic form fields)

        // Add the following script for SweetAlert
        @if(session('success'))
            Swal.fire({
                icon: 'success',
                title: 'Success!',
                text: '{{ session('success') }}',
            });
        @endif

        @if(session('error'))
            Swal.fire({
                icon: 'error',
                title: 'Error!',
                text: '{{ session('error') }}',
            });
        @endif
    });
</script>
@endsection