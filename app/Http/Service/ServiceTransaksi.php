<?php

namespace App\Http\Service;

use App\Models\Transaksi;
use Illuminate\Support\Facades\Request;
use Ramsey\Uuid\Uuid;

class ServiceTransaksi
{
    public static function removeKoma($number): int
    {
        $data = $angka_tanpa_koma = str_replace('.', '', $number);
        return $data;
    }

    public static function insertTransaksi($request): Bool
    {
        $data = Transaksi::create([
            "uuid" => Uuid::uuid4()->toString(),
            "satuan1" => ServiceTransaksi::removeKoma($request->satuan1),
            "VolumeKendaraanBaru1" => $request->volume1,
            "satuan2" => ServiceTransaksi::removeKoma($request->satuan2),
            "VolumeKendaraanBaru2" => $request->volume2,
        ]);
        if ($data) {
            return true;
        } else {
            return false;
        }
    }
    public static function updateTransaksi($request,$data):bool
    {
        $response = $data->update([
            "satuan1" => ServiceTransaksi::removeKoma($request->satuan1),
            "VolumeKendaraanBaru1" => $request->volume1,
            "satuan2" => ServiceTransaksi::removeKoma($request->satuan2),
            "VolumeKendaraanBaru2" => $request->volume2,
        ]);

        if ($response) {
            return true;
        } else {
            return false;
        }
    }
    public function penyebut($nilai)
    {
        $nilai = abs($nilai);
        $huruf = array("", "satu", "dua", "tiga", "empat", "lima", "enam", "tujuh", "delapan", "sembilan", "sepuluh", "sebelas");
        $temp = "";
        if ($nilai < 12) {
            $temp = " " . $huruf[$nilai];
        } else if ($nilai < 20) {
            $temp = $this->penyebut($nilai - 10) . " belas";
        } else if ($nilai < 100) {
            $temp = $this->penyebut($nilai / 10) . " puluh" . $this->penyebut($nilai % 10);
        } else if ($nilai < 200) {
            $temp = " seratus" . $this->penyebut($nilai - 100);
        } else if ($nilai < 1000) {
            $temp = $this->penyebut($nilai / 100) . " ratus" . $this->penyebut($nilai % 100);
        } else if ($nilai < 2000) {
            $temp = " seribu" . $this->penyebut($nilai - 1000);
        } else if ($nilai < 1000000) {
            $temp = $this->penyebut($nilai / 1000) . " ribu" . $this->penyebut($nilai % 1000);
        } else if ($nilai < 1000000000) {
            $temp = $this->penyebut($nilai / 1000000) . " juta" . $this->penyebut($nilai % 1000000);
        } else if ($nilai < 1000000000000) {
            $temp = $this->penyebut($nilai / 1000000000) . " milyar" . $this->penyebut(fmod($nilai, 1000000000));
        } else if ($nilai < 1000000000000000) {
            $temp = $this->penyebut($nilai / 1000000000000) . " trilyun" . $this->penyebut(fmod($nilai, 1000000000000));
        }
        return $temp;
    }

    public function terbilang($nilai)
    {
        if ($nilai < 0) {
            $hasil = "minus " . trim($this->penyebut($nilai));
        } else {
            $hasil = trim($this->penyebut($nilai));
        }
        return $hasil;
    }

    public function getTotal($data)
    {
        $biayaRegis = ($data->VolumeKendaraanBaru1 * 350000) + ($data->VolumeKendaraanBaru2 * 750000);
        $biayaUji  = ($data->VolumeKendaraanBaru1 * 150000) + ($data->VolumeKendaraanBaru2 * 250000);
        $bukuUji  = ($data->VolumeKendaraanBaru1 + $data->VolumeKendaraanBaru2) * 35000;
        $total = $biayaRegis + $biayaUji + $bukuUji;
        return $total;   
    }
}
