<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class keuangan extends Model
{
    use HasFactory;
    protected $table="keuangans";
    // public $timestamps = false;
    protected $fillable = [
        'id_user',
        'uang_masuk',
        'uang_keluar',
    ];
    public function tags(){ 
        return $this->hasMany('App\Models\user'); 
    }
}
