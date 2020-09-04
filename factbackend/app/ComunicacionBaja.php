<?php
/**
 * Created by PhpStorm.
 * User: garce_000
 * Date: 07/11/2018
 * Time: 05:00 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ComunicacionBaja extends Model
{
    protected $table= 'doc_comunicacionbaja';

    public function items(){
        return $this->belongsToMany('App\DocElectronico','doc_comunicacionbaja_item',
            'comunicacion_id','doc_electronico_id');
    }
    public function comItems(){
        return $this->hasMany('App\ComunicacionBajaItem','doc_electronico_id','id');
    }
}