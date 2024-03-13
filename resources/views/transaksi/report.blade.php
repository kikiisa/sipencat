<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/app-dark.css') }}">
</head>
<style>
    @media print {
  @page {
    size: landscape;
  }
}

</style>
<body>
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-lg-12 mt-4 py-4">
                <h3 class="text-center">Laporan Keuangan</h3>
                <p class="text-center">Dari Tanggal {{request()->get('from')}} - {{request()->get('to')}}</p>
                <hr>
                <table class="table table-striped" id="table1">
                    <thead>
                        <tr>
                            <th>No</th>
                            <th>B. Uji 7.000 < | B. Regis</th>
                            <th>B. Uji 8.000 > | B. Regis </th>
                            <th>B. Buku Uji</th>
                            <th>Volume Kendaraan</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>Rp {{number_format(($item->VolumeKendaraanBaru1) * 150000, 0, ',', '.') }} | Rp  {{number_format(($item->VolumeKendaraanBaru1) * 350000, 0, ',', '.')}}</td>
                                <td>Rp {{number_format(($item->VolumeKendaraanBaru2) * 250000, 0, ',', '.') }} | Rp  {{number_format(($item->VolumeKendaraanBaru2) * 750000, 0, ',', '.')}}</td>
                                <td>Rp {{number_format(($item->VolumeKendaraanBaru1 + $item->VolumeKendaraanBaru2) * 35000, 0, ',', '.') }}</td>
                                <td>{{$item->VolumeKendaraanBaru1 + $item->VolumeKendaraanBaru2}}</td>
                               
                                
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    <script>
        window.print()
    </script>
    <script src="{{ asset('template/assets/js/bootstrap.js') }}"></script>
</body>
</html>
