<?php

namespace App\Http\Controllers;

abstract class Controller
{
    // public function RouteJualBeliMotor() { // Modul
    //     return view('jualbelimotor.index');
    // }
    
    public function RouteSparePartMotor() { //
        return view('sparepart.index');
    }

    public function RouteAksesorisMotor() {
     return view('aksesoris.index');
    }

    public function RouteServisMotor() {
        return view('servismotor.index');

    }

    public function RouteSteamMotor() {
        return view('steammotoor.index');
    }

    public function RouteModfikasiMotor() {
        return view('modifikasi.index');
    }


}