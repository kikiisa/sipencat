<!DOCTYPE html>
<html lang="en">

<head>
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/app.css') }}">

    <title>Laporan Rekapan</title>
</head>
<style>
    @media print {
        @page {
            size: landscape;
        }
    }
</style>

<body>
    @php
        $biayaRegis = $data->VolumeKendaraanBaru1 * 350000 + $data->VolumeKendaraanBaru2 * 750000;
        $biayaUji = $data->VolumeKendaraanBaru1 * 150000 + $data->VolumeKendaraanBaru2 * 250000;
        $bukuUji = ($data->VolumeKendaraanBaru1 + $data->VolumeKendaraanBaru2) * 35000;
        $total = $biayaRegis + $biayaUji + $bukuUji;
    @endphp
    <div class="container">
        <div class="row justify-content-center">
            <h3 class="text-uppercase text-center mt-3">Bukti penyetoran</h3>
            <hr>
            <div class="col-12">
                <table border="0">
                    <tr>
                        <th>Sudah Terimah Dari </th>
                        <td> <strong class="ms-3">PENGELOLA KEUANGAN PKB</strong></td>
                    </tr>
                    <tr>
                        <th>Banyaknya Uang </th>
                        <td> <strong class="ms-3 text-uppercase">{{ $terbilang }}</strong></td>
                    </tr>
                    <tr>
                        <th>Untuk Pembayaran Tanggal</th>
                        <td><strong class="ms-3">{{ $data->created_at }}</strong></td>
                    </tr>
                </table>
                <table class="table">
                    <thead>
                        <tr>
                            <th>Retribusi</th>
                            <th>Volume</th>
                            <th>Satuan</th>
                            <th>Total</th>
                        </tr>
                        <tr>
                            <td>1. <strong>Biaya Registrasi Kendaraan Baru</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>- JBB 0 Kg s/d 7.000 Kg</td>
                            <td>{{ $data->VolumeKendaraanBaru1 }}</td>
                            <td>Rp {{ number_format(350000, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->VolumeKendaraanBaru1 * 350000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>- JBB 0 Kg s/d 7.000 Kg Keatas</td>
                            <td>{{ $data->VolumeKendaraanBaru2 }}</td>
                            <td>Rp {{ number_format(750000, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->VolumeKendaraanBaru2 * 750000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>2. <strong>Biaya Uji</strong></td>
                            <td></td>
                            <td></td>
                            <td></td>
                        </tr>
                        <tr>
                            <td>- JBB 0 Kg s/d 7.000 Kg</td>
                            <td>{{ $data->VolumeKendaraanBaru1 }}</td>
                            <td>Rp {{ number_format(350000, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->VolumeKendaraanBaru1 * 150000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>- JBB 0 Kg s/d 7.000 Kg Keatas</td>
                            <td>{{ $data->VolumeKendaraanBaru2 }}</td>
                            <td>Rp {{ number_format(750000, 0, ',', '.') }}</td>
                            <td>Rp {{ number_format($data->VolumeKendaraanBaru2 * 250000, 0, ',', '.') }}</td>
                        </tr>
                        <tr>
                            <td>3. <strong>Buku Uji</strong></td>
                            <td>{{ $data->VolumeKendaraanBaru1 + $data->VolumeKendaraanBaru2 }}</td>
                            <td>Rp {{ number_format(35000, 0, ',', '.') }}</td>
                            <td>Rp
                                {{ number_format(($data->VolumeKendaraanBaru1 + $data->VolumeKendaraanBaru2) * 35000, 0, ',', '.') }}
                            </td>
                        </tr>
                        <tr>
                            <td></td>
                            <td></td>
                            <td><strong>Total</strong></td>
                            <td>

                                Rp <strong>{{ number_format($total, 0, ',', '.') }}</strong>
                            </td>
                        </tr>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print()
    </script>
</body>

</html>
