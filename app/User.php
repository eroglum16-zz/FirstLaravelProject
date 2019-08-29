<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use App\Message;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Support\Str;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','api_token',
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

    public function generateToken()
    {
        $this->api_token = Str::random(60);
        $this->save();

        return $this->api_token;
    }

    public function forgetToken()
    {
        $this->api_token = null;
        return $this->save();
    }

    public function projects(){
        return $this->hasMany(Project::class,'owner_id');
    }

    public function messages($receiver_id){

        return Message::whereIn('sender_id',[$this->id,$receiver_id])
            ->whereIn('receiver_id',[$this->id,$receiver_id])
            ->with(['sender','receiver'])
            ->get();

    }

}
