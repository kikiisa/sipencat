<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Laporan</title>
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/app.css') }}">
    <link rel="stylesheet" href="{{ asset('template/assets/css/main/app-dark.css') }}">
</head>

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
                            <th>Transaksi</th>
                            <th>Qty</th>
                            <th>Total</th>
                            <th>Status</th>
                            <th>Tgl Transaksi</th>
                            <th>Tgl Update Transaski</th>
                           
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($data as $item)
                            <tr>
                                <td>{{ $loop->index + 1 }}</td>
                                <td>{{ $item->name_transaksi }}</td>
                                <td>{{ $item->qty }} {{ $item->satuan }}</td>
                                <td> {{ 'Rp ' . number_format($item->price_uji + $item->price_regis, 0, ',', '.') }}
                                </td>
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
                                <td>{{ $item->created_at }}</td>
                                <td>{{ $item->updated_at }}</td>
                              
                            </tr>
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
