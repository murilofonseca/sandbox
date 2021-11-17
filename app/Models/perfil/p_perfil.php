<?php

namespace App\Models\perfil;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class p_perfil extends Model
{
    use HasFactory;
    protected $fillable = ['nome', 'descricao'];
    protected $dates = ['deleted_at'];
}
