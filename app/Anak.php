<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Anak extends Model
{
    protected $table = 'anak';

    protected $guarded = [];

    public function pembelajaran()
    {
        return $this->hasMany(Pembelajaran::class);
    }

    public function orangTua()
    {
        return $this->belongsTo(OrangTua::class);
    }
}
