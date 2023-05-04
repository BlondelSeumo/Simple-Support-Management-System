<?php

namespace App;

use App\Models\Message;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Spatie\MediaLibrary\HasMedia\HasMedia;
use Spatie\MediaLibrary\HasMedia\HasMediaTrait;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements HasMedia
{
    use Notifiable, HasMediaTrait, HasRoles;

    protected $appends = ['image'];

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'phone', 'address', 'username', 'password',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $dates = [
        'date_of_birth',
        'joining_date',
    ];

    public function messages()
    {
        return $this->hasMany(Message::class);
    }

    public function getImageAttribute()
    {
        if (!empty($this->getFirstMediaUrl('user'))) {
            return asset($this->getFirstMediaUrl('user'));
        }
        return asset('image/avatar-1.png');
    }

    public function getCustomDateOfBirthAttribute()
    {
        return $this->date_of_birth ? $this->date_of_birth->format('d-m-Y') : '';
    }

    public function getCustomJoiningDateAttribute()
    {
        return $this->joining_date ? $this->joining_date->format('d-m-Y') : '';
    }

    public function getCustomRoleAttribute()
    {
        return $this->roles->pluck('id', 'id')->first();
    }

    public function getrole()
    {
        return $this->hasOne(Role::class, 'id', 'customrole');
    }

}
