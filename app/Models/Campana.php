<?php

namespace App\Models;


class Campana 
{
    public string $id;
    public string $nombre;

    public function get_campanas(){
        $campanas = array();
        $campana = new Campana();
        $campana->id= 'FALF';
        $campana->nombre= 'Flujo';
        array_push($campanas, $campana);

        $campana = new Campana();
        $campana->id= 'FALC';
        $campana->nombre= 'Masiva';
        array_push($campanas, $campana);

        $campana = new Campana();
        $campana->id= 'FALB';
        $campana->nombre= 'Saldos';
        array_push($campanas, $campana);

        $campana = new Campana();
        $campana->id= 'FALR';
        $campana->nombre= 'Requisa';
        array_push($campanas, $campana);
        
        return $campanas;
    }

}
