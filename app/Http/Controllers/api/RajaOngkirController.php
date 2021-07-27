<?php

namespace App\Http\Controllers\api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Kavist\RajaOngkir\Facades\RajaOngkir;
use Kavist\RajaOngkir\Resources\OngkosKirim;

class RajaOngkirController extends Controller
{
    public function index()
    {
        // $provinces = Province::pluck('name', 'province_id');
    }

    public function getProvince()
    {
        $listProvince = RajaOngkir::provinsi()->all();
        return $this->showData($listProvince);
    }

    public function getCityProvince($province_id)
    {
        $city = RajaOngkir::kota()->dariProvinsi($province_id)->get();
        return $this->showData($city);
    }

    public function checkOngkir(Request $request)
    {
        // $ongkir = RajaOngkir::ongkosKirim([
        //     'origin'        => 501,     // ID kota/kabupaten asal
        //     'destination'   => 419,      // ID kota/kabupaten tujuan
        //     'weight'        => 1300,    // berat barang dalam gram
        //     'courier'       => 'jne'    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        // ])->get();

        $ongkir = RajaOngkir::ongkosKirim([
            'origin'        => $request->origin,     // ID kota/kabupaten asal
            'destination'   => $request->destination,      // ID kota/kabupaten tujuan
            'weight'        => $request->weight,    // berat barang dalam gram
            'courier'       => $request->kurir    // kode kurir pengiriman: ['jne', 'tiki', 'pos'] untuk starter
        ])->get();
        // dd($ongkir->result);
        // return response()->json($ongkir, 200);
        // return OngkosKirim::collection($ongkir);
        return $this->showData($ongkir);
    }
}
