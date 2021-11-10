<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class OrangTua extends Model
{
    protected $table = 'orang_tua';
    
    protected $guarded = [];

    public function anak()
    {
        return $this->hasMany(Anak::class);
    }
}
