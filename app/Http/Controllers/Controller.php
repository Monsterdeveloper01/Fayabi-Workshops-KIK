<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // public function RouteJualBeliMotor() { // Modul: YANG TERUTAMA YAZID tapi ttp bareng bareng
    //     return view('jualbelimotor.index');
    // }
    
    public function RouteSparePartMotor() { // Bintang
        return view('sparepart.index');
    }

    // public function RouteAksesorisMotor() { // Farel
    //  return view('aksesoris.index');
    // }

    public function RouteServisMotor() { // Yazid
        return view('servismotor.index');

    }

    public function RouteSteamMotor() { // bintang
        return view('steammotoor.index');
    }

    public function RouteModfikasiMotor() { // Farel
        return view('modifikasi.index');
    }

    //BRAND MOTOR : Honda, Yamaha, Suzuki Kawazaki, Aprila, Ducati, Harley, KTM


}