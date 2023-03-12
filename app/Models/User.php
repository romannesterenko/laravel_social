<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Facades\Auth;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'last_name',
        'email',
        'avatar',
        'fon_image',
        'birthday',
        'gender',
        'profession',
        'about',
        'country',
        'hobby',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    public function unused_images()
    {
        return Image::where('user_id', Auth::id())->where('post_id', null)->get();
    }

    public function myImages($limit=0)
    {
        if($limit==0)
            return Image::where('user_id', Auth::id())->get();
        else
            return Image::where('user_id', Auth::id())->orderBy('id', 'desc')->limit(9)->get();
    }
    public function getFullNameAttribute()
    {
        return "{$this['name']} {$this['last_name']}";
    }
    public function getAvatarSrcAttribute()
    {
        if($this->avatar)
            return "/images/profile/avatars/".$this->avatar;
        else
            return asset('assets/images/man-5781874.svg');
    }
    public function getFonSrcAttribute()
    {
        if($this->fon_image)
            return "/images/profile/fon_src/".$this->fon_image;
        else
            return asset('assets/images/page_logo.webp');
    }

    public function coments()
    {
        return $this->hasMany(Coment::class, 'user');
    }

}
