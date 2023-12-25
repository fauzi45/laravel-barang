@extends('layouts.master')
@section('title')
Admin | Halaman Barang
@endsection
@push('css')
<link href="{{ asset('css/app.css') }}" rel="stylesheet">
@endpush
@section('content')
<h1>Daftar Permintaan Barang</h1>
<a href="{{ route('barang.create') }}" class="btn btn-primary float-right">Tambah Baru</a>
<table class="table">
    <thead>
        <tr>
            <th>No</th>
            <th>Nama Karyawan</th>
            <th>Tanggal Permintaan</th>
            <th>Status</th>
            <th>Action</th>
        </tr>
    </thead>
    <tbody>
        @foreach($requests as $request)
        <tr>
            <td>{{ $loop->iteration }}</td>
            <td>{{ $request->employee->nama }}</td>
            <td>{{ $request->request_date }}</td>
            <td>@if ($request->status === 'pending') 
                <span class="btn bg-danger text-white">Pending</span>
                 @else 
                <span class="btn bg-success text-white">Terpenuhi</span>
                
                @endif
            </td>
            <td><a href="{{ route('barang.show', $request->id) }}" class="btn btn-primary">Detail</td>
        </tr>
        @endforeach
    </tbody>
</table>
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
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
@push('js')
<script src="{{ asset('js/app.js') }}"></script>
@endpush