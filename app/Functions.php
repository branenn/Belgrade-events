<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Functions extends Model
{


    public static function ispisDatuma2($nekidatum){
        $datum = strtotime( $nekidatum );
        $novidatum = date( 'd.m.Y.', $datum );
        return $novidatum;
    }
    public static function ispisDatuma($nekidatum){
        $timestamp = strtotime($nekidatum );
        $datum = date("d.m.Y H:i",$timestamp);
        return $datum;

    }
    public static function upisDatuma($nekidatum){
        $timestamp = strtotime($nekidatum );
        $datum = date("Y-m-d H:i:s",$timestamp);
        return $datum;
    }
    public static function upisDatuma2($nekidatum){
        $timestamp = strtotime($nekidatum );
        $datum = date("Y-m-d",$timestamp);
        return $datum;
    }
    
    public static function zaDvaDana(){
        $dat=strtotime("+2 days");
        $datum= date("Y-m-d H:i:s", $dat);
        return $datum;
    }
    public static function ispisVremena($nekovreme){
        $datum = strtotime($nekovreme);
        $vreme = date('H:i', $datum);
        return $vreme;
    }
    public static function minusTriDana($nekidatum){
        $datum= date("Y-m-d H:i:s", strtotime($nekidatum . "-3 days"));
        return $datum;
    }


}
