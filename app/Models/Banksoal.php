<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Banksoal extends Model
{
    //
    use SoftDeletes;
    protected $table = 'banksoal';
    protected $guarded = [];

    public function dosen()
    {
        return $this->belongsTo(User::class, 'id_users')->where('role', 'dosen');
    }
}
