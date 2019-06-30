<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method where(string $string, int $int)
 * @method static create(array $array)
 */
class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','phone','code', 'lat', 'lng', 'avatar', 'role', 'checked'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function Role()
    {
        return $this->hasOne('App\Models\Role','id','role');
    }

    public function avatar()
    {
        return appPath() . '/images/users/' . $this->avatar;
    }
}
