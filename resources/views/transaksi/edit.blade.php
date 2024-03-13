@extends('layouts.master', [
    'judul' => 'Edit Transaksi',
])
@section('content')
    <section class="section">
        <div class="card">
            <div class="card-header">Edit Transaksi</div>

            <div class="card-body">
                <form action="{{Route('transaksi.update', $data->id)}}" method="post">
                    @csrf
                    @method("PUT")
                    <div class="row">
                        <div class="form-group col-lg-6 col-6">
                            <label class="form-label">Satuan (KG)</label>
                            <input type="text" name="satuan1" required value="{{$data->satuan1}}" onkeyup="return price()" placeholder="7.000 Kg"
                                class="form-control satuan-1">
                        </div>
                        <div class="form-group col-lg-6 col-6">
                            <label class="form-label">Volume (Kendaraan)</label>
                            <input type="text" name="volume1" required value="{{$data->VolumeKendaraanBaru1}}" onkeyup="return price()" placeholder="Volume Kendaraan"
                                class="form-control volume-1">
    
                        </div>
    
                        <div class="form-group col-lg-6 col-6">
                            <label class="form-label">Satuan (KG)</label>
                            <input type="text" name="satuan2" required value="{{$data->satuan2}}" onkeyup="return price()" placeholder="7.001 Kg Keatas"
                                class="form-control satuan-2">
                        </div>
                        <div class="form-group col-lg-6 col-6">
                            <label class="form-label">Volume (Kendaraan)</label>
                            <input type="text" name="volume2" required value="{{$data->VolumeKendaraanBaru2}}" placeholder="Volume Kendaraan" class="form-control volume-2"
                                onkeyup="return price()">
                        </div>
                    </div>
                    <div class="form-group">
                        <label class="mb-2 mt-2">Total Buku Uji</label>
                        <input type="number" name="total_buku_uji" disabled onkeyup="return price()"
                            placeholder="Total Buku Uji" value="{{$data->VolumeKendaraanBaru1 + $data->VolumeKendaraanBaru2}}" class="form-control uji">
                    </div>
                    <div class="form-group">
                        <label class="mb-2 mt-2">Grand Total</label>
                    </div>
                    <input type="text" name="grandTotal" disabled placeholder="Grand Total "class="form-control grand-total">
                    <div class="bg-info text-white p-3 rounded-3 mt-3">Biaya Lainya Di Tambah Biaya Buku Uji + Biaya
                        Registrasi Pendaftaran Baru</div>
                    
                    <button class="btn btn-primary mt-2" type="submit">Update Data</button>
                </form>
            </div>
        </div>
    </section>

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
