<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Community extends Model
{
    use HasFactory;
    protected $fillable = [
        'title',
        'description',
        'author',
        'image',
    ];

    public function subscribers()
    {
        return $this->hasMany(CommunityUser::class, 'community_id', 'id');
    }

    public function fiveSubscribers()
    {
        return $this->hasMany(CommunityUser::class, 'community_id', 'id')->limit(5);
    }

    public function type()
    {
        return $this->hasOne(CommunityTypes::class, 'id', 'category');
    }

    public function getAvatarSrcAttribute()
    {
        return $this->image?'/images/groups/avatars/'.$this->image:asset('/storage/avatar/Bwx2LHsq2LoRdRFMol6Gvmr4SCbRpecHDk7WEUWg.jpg');
    }

    public function authorInfo()
    {
        return $this->hasOne(User::class, 'id', 'author');
    }

    public function isIamASubscriber(): bool
    {

        $subs = CommunityUser::where('community_id', $this->id)->where('user_id', \Auth::id())->first();
        if($subs)
            return true;
        return false;
    }
}
