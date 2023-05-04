<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Message extends Model
{
    protected $fillable = ['message', 'user_id', 'to_user_id', 'group_id'];
    protected $appends  = ['created_on'];
    protected $dates    = [
        'created_at',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function getCreatedOnAttribute()
    {
        return $this->created_at->format('d M Y h:i A');
    }
}
