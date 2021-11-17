<?php

namespace App\Models;

use App\Actions\Fortify\PasswordValidationRules;
use App\Models\perfil\p_perfil;
use App\Models\perfil\p_users;
use Database\Seeders\PerfilSeeder;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;

use Tymon\JWTAuth\Contracts\JWTSubject;

class User extends Authenticatable implements JWTSubject
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use SoftDeletes;

    use PasswordValidationRules;

    /**
     * Get the identifier that will be stored in the subject claim of the JWT.
     *
     * @return mixed
     */
    public function getJWTIdentifier()
    {
        return $this->getKey();
    }

    /**
     * Return a key value array, containing any custom claims to be added to the JWT.
     *
     * @return array
     */
    public function getJWTCustomClaims()
    {
        return [];
    }

    /**
     * The attributes that are mass assignable.
     *
     * @var string[]
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'uuid'
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array
     */
    protected $hidden = [
        'password',
        'remember_token',
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array
     */
    protected $appends = [
        'profile_photo_url',
    ];

    protected $dates = ['deleted_at'];



    /**
     * Usuários com relacionamento p_users
     *
     * @return void
     */
    public function p_users()
    {
        return $this->hasOne(p_users::class)
        ->with('p_perfils');
            //->leftJoin('p_perfils', 'p_perfils.id', '=', 'p_users.perfil_id');
    }


    /**
     * Pesquisar usuários com nome ou email
     *
     * @param  mixed $search
     * @return void
     */
    public function getDados($search = null)
    {

        $registros =  $this
            ->where(function ($querySearch) use ($search) {
                if ($search <> null)
                    $querySearch->where('users.name', 'LIKE', "%{$search}%")
                        ->orWhere('users.email', 'LIKE', "%{$search}%");;
            });

        return $registros;
    }

    public function rules($id)
    {
        return [
            'name' => 'required|min:3',
            'email' => "required|email|unique:users,email,{$id}",
            'password' => $this->passwordRules(),
            'current_password' => 'required',
            'perfil' => 'required'
        ];
    }

    public function feedback()
    {
        return [
            'required' => 'O campo :attribute é obrigatório',
            'email.unique' => 'O email já existe'
        ];
    }
}
