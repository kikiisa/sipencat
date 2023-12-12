@extends('layouts.master', [
    'judul' => 'Edit Transaksi',
])
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">Edit Transaksi</div>

            <div class="card-body">
                <form action="{{ route('transaksi.update', $data->id) }}" method="post">
                    @method('PUT')
                    @csrf
                    <div class="row">
                        <div class="form-group col-lg-6 col-6">
                            <label for="nomor">Transaksi</label>
                            <input required type="text" value="{{ $data->name_transaksi }}" name="name_transaksi" placeholder="Transaksi" class="form-control">
                        </div>
                        <div class="form-group col-lg-6 col-6">
                            <label for="nomor">Qty</label>
                            <input required type="number" value="{{$data->qty}}" name="qty" placeholder="Qty" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="satuan">Satuan</label>
                        <select name="satuan" required id="satuan" class="form-control">
                            <option selected disabled>Pilih Satuan</option>
                            @foreach(['kg' => 'Kilogram (kg)', 'gram' => 'Gram (g)', 'ton' => 'Ton (t)', 'liter' => 'Liter (L)', 'meter' => 'Meter (m)', 'centimeter' => 'Centimeter (cm)', 'mililiter' => 'Mililiter (ml)', 'kilometer' => 'Kilometer (km)'] as $key => $value)
                                <option {{ $data->satuan == $key ? 'selected' : '' }} value="{{ $key }}">{{ $value }}</option>
                            @endforeach
                        
                        </select>
                        
                    </div>
                    <div class="row">
                        <div class="form-group col-lg-6 col-6">
                            <label for="judul">Harga Regis</label>
                            <input required type="text" value="{{ $data->price_regis }}" name="regis" placeholder="Harga Regis" class="form-control">
                        </div>
                        <div class="form-group col-lg-6 col-6">
                            <label for="pengarang">Harga Uji</label>
                            <input required value="{{ $data->price_uji }}" type="text" name="uji" placeholder="Harga Uji" class="form-control">
                        </div>
                    </div>
                    <div class="form-group">
                        <label for="status">Status</label>
                        <select required name="status" id="status" class="form-control">
                            <option selected disabled>-- Pilih Status --</option>
                            <option {{ $data->status == 'success' ? 'selected' : '' }} value="success">Berhasil</option>
                            <option {{ $data->status == 'pending' ? 'selected' : '' }} value="pending">Pending</option>
                            <option {{ $data->status == 'failed' ? 'selected' : '' }} value="failed">Gagal</option>
                        </select>
                    </div>
                    <a href="http://" class="btn btn-info"><i class="bi bi-arrow-left"></i> Kembali</a>
                    <button class="btn btn-primary fw-bold">Update</button>
                </form>
            </div>

        </div>
    </section>

    <script src="{{ asset('template/assets/extensions/toastify-js/src/toastify.js') }}"></script>
    @if (count($errors) > 0)
        <script>
            var errors = @json($errors->all());
            Toastify({
                text: errors,
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @enderror
    @if (session()->has('success'))
        <script>
            Toastify({
                text: "{{ session('success') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#19C37D",
            }).showToast();
        </script>
    @endif
    @if (session()->has('error'))
        <script>
            Toastify({
                text: "{{ session('error') }}",
                duration: 3000,
                close: true,
                backgroundColor: "#D61355",
            }).showToast();
        </script>
    @endif
@endsection
