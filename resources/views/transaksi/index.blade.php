@extends('layouts.master', [
    'judul' => 'Daftar Transaksi',
])
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">Daftar Transaksi</div>
            <div class="card-body">
                <button type="button" class="btn btn-outline-primary block" data-bs-toggle="modal" data-bs-target="#default">
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
                            <th>B. Uji 7.000 < | B. Regis</th>
                            <th>B. Uji 8.000 > | B. Regis </th>
                            <th>B. Buku Uji</th>
                            <th>Aksi</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>Rp {{number_format(($item->VolumeKendaraanBaru1) * 150000, 0, ',', '.') }} | Rp  {{number_format(($item->VolumeKendaraanBaru1) * 350000, 0, ',', '.')}}</td>
                                <td>Rp {{number_format(($item->VolumeKendaraanBaru2) * 250000, 0, ',', '.') }} | Rp  {{number_format(($item->VolumeKendaraanBaru2) * 750000, 0, ',', '.')}}</td>
                                <td>Rp {{number_format(($item->VolumeKendaraanBaru1 + $item->VolumeKendaraanBaru2) * 35000, 0, ',', '.') }}</td>
                               
                                <td>
                                    <form action="{{ Route('transaksi.destroy', $item->id) }}" method="post">
                                        @method('DELETE')
                                        @csrf
                                        <button class="btn btn-danger"
                                            onclick="return confirm('Menghapus Data transaksi ? Menghapus Data Transaksi Lainya')"><i
                                                class="bi bi-trash"></i></button>
                                        <a href="{{ Route('transaksi.edit', $item->uuid) }}" class="btn btn-warning"><i
                                                class="bi bi-pen"></i></a>
                                        <a href="{{ Route('transaksi.cetak', $item->uuid) }}" class="btn btn-success"><i
                                                class="bi bi-printer"></i></a>
                                    </form>
                                </td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </section>
    <div class="modal fade text-left" id="default" tabindex="-1" role="dialog" aria-labelledby="myModalLabel1"
        aria-hidden="true">
        <form action="{{Route("transaksi.store")}}" method="post">
            @method("POST")
            @csrf
            <div class="modal-dialog modal-dialog-scrollable" role="document">
                <div class="modal-content">
                    <div class="modal-header">
                        <h5 class="modal-title" id="myModalLabel1">Transaksi</h5>
                        <button type="button" class="close rounded-pill" data-bs-dismiss="modal" aria-label="Close">
                            <i data-feather="x"></i>
                        </button>
                    </div>
                    <div class="modal-body">
                        <div class="modal-body">
                            <div class="row">
                                <div class="form-group col-lg-6 col-6">
                                    <label class="form-label">Satuan (KG)</label>
                                    <input type="text" name="satuan1" onkeyup="return price()" placeholder="7.000 Kg"
                                        class="form-control satuan-1">
                                </div>
                                <div class="form-group col-lg-6 col-6">
                                    <label class="form-label">Volume (Kendaraan)</label>
                                    <input type="text" name="volume1" onkeyup="return price()" placeholder="Volume Kendaraan"
                                        class="form-control volume-1">
    
                                </div>
    
                                <div class="form-group col-lg-6 col-6">
                                    <label class="form-label">Satuan (KG)</label>
                                    <input type="text" name="satuan2" onkeyup="return price()" placeholder="7.001 Kg Keatas"
                                        class="form-control satuan-2">
                                </div>
                                <div class="form-group col-lg-6 col-6">
                                    <label class="form-label">Volume (Kendaraan)</label>
                                    <input type="text" name="volume2" placeholder="Volume Kendaraan" class="form-control volume-2"
                                        onkeyup="return price()">
                                </div>
                            </div>
                            <div class="form-group">
                                <label class="mb-2 mt-2">Total Buku Uji</label>
                                <input type="number" name="total_buku_uji" disabled onkeyup="return price()" placeholder="Total Buku Uji"
                                    class="form-control uji">
                            </div>
                            <div class="form-group">
                                <label class="mb-2 mt-2">Grand Total</label>
                            </div>
                            <input type="text" name="grandTotal" disabled placeholder="Grand Total "class="form-control grand-total">
                            <div class="bg-info text-white p-3 rounded-3 mt-3">Biaya Lainya Di Tambah Biaya Buku Uji + Biaya
                                Registrasi Pendaftaran Baru</div>
                        </div>
                    </div>
                    <div class="modal-footer">
                        <button type="button" class="btn" data-bs-dismiss="modal">
                            <i class="bx bx-x d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Close</span>
                        </button>
                        <button type="submit" class="btn btn-primary ms-1" data-bs-dismiss="modal">
                            <i class="bx bx-check d-block d-sm-none"></i>
                            <span class="d-none d-sm-block">Accept</span>
                        </button>
                    </div>
                </div>
            </div>
        </form>
    </div>
    <script src="{{ asset('template/vendor/axios.min.js') }}"></script>
    <script src="{{ asset('template/assets/extensions/toastify-js/src/toastify.js') }}"></script>
    <script>
        const cleanNumber = (volume) => {
            return parseFloat(volume.replace(/\./g, ''));
        }
        let TotalBukuUji = document.querySelector(".uji");

        let satuanText1 = document.querySelector(".satuan-1");
        let volumeText1 = document.querySelector(".volume-1");
        let resultPrice1 = 0;

        let satuanText2 = document.querySelector(".satuan-2");
        let volumeText2 = document.querySelector(".volume-2");
        let resultPrice2 = 0;

        let VolumeUji = document.querySelector(".uji");

        let grandTotal = document.querySelector(".grand-total");
        let sendData = null;

        satuanText1.addEventListener("keyup", function(e) {
            satuanText1.value = formatRupiah(this.value);
        })
        satuanText2.addEventListener("keyup", function(e) {
            satuanText2.value = formatRupiah(this.value);
        })
        const price = async () => {

            sendData = {
                price1: {
                    satuan: cleanNumber(satuanText1.value),
                    volume: cleanNumber(volumeText1.value),
                },
                price2: {
                    satuan: cleanNumber(satuanText2.value),
                    volume: cleanNumber(volumeText2.value),
                },
                uji: cleanNumber(volumeText1.value) + cleanNumber(volumeText2.value)
            }
            const response = await axios.post("/api/transaksi", sendData);
            const {
                finalTotal,
                totalBukuUji
            } = response.data;
            grandTotal.value = `Rp ${formatRupiah(finalTotal)}`;
            TotalBukuUji.value = totalBukuUji
            console.log(response.data);
        }


        function formatRupiah(angka) {
            var bilangan = angka.toString().replace(/[^,\d]/g, '');
            var bilanganSplit = bilangan.split(',');
            var sisa = bilanganSplit[0].length % 3;
            var rupiah = bilanganSplit[0].substr(0, sisa);
            var ribuan = bilanganSplit[0].substr(sisa).match(/\d{3}/gi);
            if (ribuan) {
                var separator = sisa ? '.' : '';
                rupiah += separator + ribuan.join('.');
            }

            rupiah = bilanganSplit[1] !== undefined ? rupiah + ',' + bilanganSplit[1] : rupiah;
            return rupiah;
        }
        const submitForm = document.querySelector(".transaksi");
    </script>
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
