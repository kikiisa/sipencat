<?php

namespace App\Http\Service;


class ServiceTransaksi 
{
    public function removeKoma($number):int
    {
        $data = $angka_tanpa_koma = str_replace('.', '', $number);
        return $data;
    }

    public function grandTotal(int $satuan,int $volume):int
    {
        if($satuan > 7000)
        {
            $total = 750000 * $satuan;
        }
        return 0;
    }
}