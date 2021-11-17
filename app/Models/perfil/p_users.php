<?php

namespace App\Models\perfil;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class p_users extends Model
{
    use HasFactory;
    use SoftDeletes;

    protected $fillable = ['perfil_id', 'user_id'];
    protected $dates = ['deleted_at'];

    public function p_perfils()
    {
        return $this->hasOne(p_perfil::class, 'id', 'perfil_id');
           
    }

}
