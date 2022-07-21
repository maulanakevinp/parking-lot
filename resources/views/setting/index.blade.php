@extends('layouts.app')
@section('title', ' - Pengaturan')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-6">
            @include('layouts.alert')
            <div class="card">
                <div class="card-header">
                    <h5 class="mb-0">Pengaturan</h5>
                </div>
                <div class="card-body">
                    <form action="{{ route('setting.update', $setting) }}" method="POST">
                        @csrf @method('PUT')
                        <div class="form-group mb-3">
                            <label for="price_per_hour">Parkir Per Jam</label>
                            <input type="number" step="any" class="form-control @error('price_per_hour') is-invalid @enderror" id="price_per_hour" name="price_per_hour" placeholder="Masukkan Harga Parkir Per Jam" value="{{ $setting->price_per_hour }}">
                            @error('price_per_hour')<small class="text-danger">{{ $message }}</small>@enderror
                        </div>
                        <div class="d-grid gap-2">
                            <button class="btn btn-primary">Simpan</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
