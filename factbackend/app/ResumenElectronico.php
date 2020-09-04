<?php
/**
 * Created by PhpStorm.
 * User: garce_000
 * Date: 07/11/2018
 * Time: 05:00 AM
 */

namespace App;


use Illuminate\Database\Eloquent\Model;

class ResumenElectronico extends Model
{
    protected $table= 'doc_resumenes_electronicos';

    public function items(){
        return $this->belongsToMany('App\DocElectronico','doc_resumen_electronico_items','resumen_electronico_id','documento_electronico_id');
    }
}