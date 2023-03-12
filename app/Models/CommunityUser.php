<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CommunityUser extends Model
{
    use HasFactory;
    protected $fillable = [
        'user_id',
        'community_id',
        'role',
        'banned',
    ];

    public function user() {
        return $this->hasOne(User::class, 'id', 'user_id');
    }
}
