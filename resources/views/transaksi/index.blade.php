@extends('layouts.master', [
    'judul' => 'Daftar Transaksi',
])
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">Daftar Transaksi</div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#add">
                    Tambah Transaksi
                </button>
                <form method="GET">
             
                    <div class="row">
                        <div class="form-group col-lg-3 mt-3">
                            <label for="">Dari Tanggal</label>
                            <input required="required" type="date" name="from" class="form-control" id="">
                        </div>
                        <div class="form-group col-lg-3 mt-3">
                            <label for="">Sampai Tanggal</label>
                            <input required="required" type="date" name="to" class="form-control" id="">
                        </div>
                        <div class="form-group col-lg-3 py-4 mt-3">
                            <button name="rekap" class="btn btn-primary">Rekap</button>
                            <button name="cetak" class="btn btn-warning">Cetak PDF</button>
                        </div>
                    </div>

                </form>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>Transaksi</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tgl Transaksi</th>
                            <th>Tgl Update Transaski</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name_transaksi }}</td>
                                <td>{{ $item->qty }} {{$item->satuan}}</td>
                                <td> {{ "Rp " . number_format($item->price_uji + $item->price_regis,0,',','.');  }}</td>
                                <td>
                                    @if ($item->status == 'success')
                                        <small class="badge bg-success"><strong>Berhasil</strong></small>
                                    @elseif ($item->status == 'pending')
                                        <small class="badge bg-warning"><strong>Pending</strong></small>
                                    @else
                                        <small class="badge bg-danger">
                                            <strong>Dibatalkan</strong>
                                        </small>
                                    @endif
                                </td>
                                <td>{{$item->created_at}}</td>
                                <td>{{$item->updated_at}}</td>
                                <td>
                                    <form action="{{ Route('transaksi.destroy', $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Menghapus Data transaksi ? Menghapus Data Transaksi Lainya')"><i
                                                class="bi bi-trash"></i></button>
                                        <a href="{{ Route('transaksi.edit',$item->uuid) }}" class="btn btn-warning"><i
                                                class="bi bi-pen"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade text-left modal-borderless" id="add" tabindex="-1" role="dialog"
        aria-labelledby="myModalLabel1" aria-hidden="true">
        <div class="modal-dialog modal-lg modal-dialog-scrollable" role="document">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title">Tambah Transaksi</h5>
                    <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                        <i data-feather="x"></i>
                    </button>
                </div>
                <form action="{{ route('transaksi.store') }}" method="post" enctype="multipart/form-data">
                    <div class="modal-body">
                        @method('POST')
                        @csrf
                        <div class="row">
                            <div class="form-group col-lg-6 col-6">
                                <label for="nomor">Transaksi</label>
                                <input required type="text" name="name_transaksi" placeholder="Transaksi" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 col-6">
                                <label for="nomor">Qty</label>
                                <input required type="number" name="qty" placeholder="Qty" class="form-control">
                            </div>    
                        </div>
                        <div class="form-group">
                            <label for="satuan">Satuan</label>
                            <select name="satuan" required required id="satuan" class="form-control">
                                <option selected disabled>Pilih Satuan</option>
                                <option value="kg">Kilogram (kg)</option>
                                <option value="gram">Gram (g)</option>
                                <option value="ton">Ton (t)</option>
                                <option value="liter">Liter (L)</option>
                                <option value="meter">Meter (m)</option>
                                <option value="centimeter">Centimeter (cm)</option>
                                <option value="mililiter">Mililiter (ml)</option>
                                <option value="kilometer">Kilometer (km)</option>
                                <!-- Anda dapat terus menambahkan pilihan satuan lainnya di sini -->
                            </select>
                        </div>
                        <div class="row">
                            <div class="form-group col-lg-6 col-6">
                                <label for="judul">Harga Regis</label>
                                <input required type="text" name="regis" placeholder="Harga Regis" class="form-control">
                            </div>
                            <div class="form-group col-lg-6 col-6">
                                <label for="pengarang">Harga Uji</label>
                                <input required type="text" name="uji" placeholder="Harga Uji" class="form-control">
                            </div>
                        </div>
                        <div class="form-group">
                            <label for="status">Status</label>
                            <select required name="status" id="status" class="form-control">
                                <option selected disabled>-- Pilih Status --</option>
                                <option value="success">Berhasil</option>
                                <option value="pending">Pending</option>
                                <option value="failed">Gagal</option>
                            </select>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn btn-light-primary" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button class="btn btn-primary ml-1" type="submit">Simpan</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
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
