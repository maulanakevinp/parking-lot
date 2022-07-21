@extends('layouts.app')
@section('title', ' - Parking')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-4">
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Tambah Parkir</h5>
                </div>
                <div class="card-body">
                    <form class="mb-3" action="{{ route('parking.store') }}" method="POST">
                        @csrf
                        <div class="mb-3">
                            <input type="text" class="form-control @error('license_plate') is-invalid @enderror" id="license_plate" name="license_plate" placeholder="Masukkan Plat Nomor" value="{{ old('license_plate') }}">
                            @error('license_plate')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button type="submit" class="btn btn-outline-primary">Tambah</button>
                        </div>
                    </form>
                </div>
            </div>
            <div class="card mb-4">
                <div class="card-header">
                    <h5 class="mb-0">Filter</h5>
                </div>
                <div class="card-body">
                    <form class="mb-3">
                        <div class="mb-3">
                            <input type="text" class="form-control @error('search') is-invalid @enderror" id="search" name="search" placeholder="Cari ..." value="{{ request('search') }}">
                        </div>
                        <div class="mb-3">
                            <label for="start_time">Waktu Mulai</label>
                            <input type="datetime-local" class="form-control @error('start_time') is-invalid @enderror" id="start_time" name="start_time" placeholder="Cari ..." value="{{ request('start_time') }}">
                        </div>
                        <div class="mb-3">
                            <label for="end_time">Waktu Selesai</label>
                            <input type="datetime-local" class="form-control @error('end_time') is-invalid @enderror" id="end_time" name="end_time" placeholder="Cari ..." value="{{ request('end_time') }}">
                        </div>
                        <div class="text-end">
                            <a href="{{ route('parking.index') }}" class="btn btn-outline-secondary">Reset</a>
                            <button type="submit" class="btn btn-outline-primary">Cari</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
        <div class="col-md-8">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header d-flex align-items-center justify-content-between">
                    <h5 class="card-title mb-0">Daftar Parkir</h5>
                    <a href="{{ route('parking.export') }}?search={{ request('search') }}&start_time={{ request('start_time') }}&end_time={{ request('end_time') }}" class="btn btn-sm btn-primary">Export</a>
                </div>
                <div class="card-body">
                    <div class="table-responsive">
                        <table class="table table-bordered table-hover table-striped">
                            <thead>
                                <tr>
                                    <th class="text-center">Kode Unik</th>
                                    <th class="text-center">Plat Nomor</th>
                                    <th class="text-center">Waktu Masuk</th>
                                    <th class="text-center">Waktu Keluar</th>
                                    <th class="text-center"></th>
                                </tr>
                            </thead>
                            <tbody>
                                @forelse ($parkings as $item)
                                    <tr>
                                        <td class="text-center align-middle">{{ $item->unique_code }}</td>
                                        <td class="text-center align-middle">{{ $item->license_plate }}</td>
                                        <td class="text-center align-middle">{{ $item->start_time }}</td>
                                        <td class="text-center align-middle">{{ $item->end_time }}</td>
                                        <td class="text-center align-middle">
                                            @if ($item->end_time == null)
                                                <form action="{{ route('parking.update', $item) }}" method="POST">
                                                    @csrf @method('PUT')
                                                    <button type="submit" class="btn btn-danger btn-sm exit">Catat Keluar</button>
                                                </form>
                                            @else
                                                {{ $item->price }}
                                            @endif
                                        </td>
                                    </tr>
                                @empty
                                    <tr>
                                        <td colspan="5" class="text-center">Tidak ada data</td>
                                    </tr>
                                @endforelse
                            </tbody>
                        </table>
                        {{ $parkings->links('layouts.pagination') }}
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection

