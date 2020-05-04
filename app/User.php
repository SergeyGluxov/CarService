<?php

namespace App;
use App\Http\Resources\SchedulesResource;
use Laravel\Passport\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;

/**
 * @method static where(string $string, $id)
 */
class User extends Authenticatable
{
    use HasApiTokens, Notifiable;

    protected $fillable = [
        'name', 'email', 'password',
    ];

    protected $hidden = [
        'password', 'remember_token',
    ];

    public function cars()
    {
        return $this->belongsTo(Car::class);
    }
    public function token()
    {
        return $this->hasOne(Token::class);
    }
    public function appointments()
    {
        return $this->hasMany(Appointment::class);
    }
    public function schedules()
    {
        return $this->hasMany(Schedules::class);
    }
    public function roles()
    {
        return $this->belongsToMany('App\Role', 'users_roles', 'user_id', 'role_id');
    }
    public function role()
    {
        $roles = $this->roles->toArray();
        return $roles[0];
    }
    /**
     * Проверка принадлежит ли пользователь к какой либо роли
     *
     * @return boolean
     */
    public function isEmployee()
    {
        $roles = $this->roles->toArray();
        return !empty($roles);
    }

    public function hasRole($check)
    {
        return in_array($check, array_pluck($this->roles->toArray(), 'name'));
    }
}
