@extends('layouts.master')
@section('title')
Admin | Halaman Detail Request
@endsection
@section('content')
<h1>Detail Permintaan Barang</h1>
<a href="{{ route('barang.index') }}" class="btn btn-primary flex float-right">Kembali</a>
<div>
    <h3>Data Karyawan</h3>
    <p>NIK: {{ $request->employee->nik }}</p>
    <p>Nama: {{ $request->employee->nama }}</p>
    <p>Departemen: {{ $request->employee->departement }}</p>
</div>

<div>
    <h3>Data Permintaan</h3>
    <p>Tanggal Permintaan: {{ $request->request_date }}</p>
</div>

<div>
    <h3>Barang yang Diminta</h3>
    <table class="table">
        <thead>
            <tr>
                <th>Nama Barang</th>
                <th>Jumlah</th>
            </tr>
        </thead>
        <tbody>
            
        </tbody>
    </table>
</div>
@endsection