<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class DocElectronico extends Model
{
    public function items(){
        return $this->hasMany('App\DocElectronicoItem','doc_electronico_id','id');
    }

    public function resumenes(){
        return $this->belongsToMany('App\ResumenElectronico',
            'doc_resumen_electronico_items',
            'documento_electronico_id',
            'resumen_electronico_id');
    }
}