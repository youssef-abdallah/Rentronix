<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, Notifiable;

    public function Role()
    {
        return $this->belongsToMany(Role::class);
    }

        public function ManufactureInfo()
        {
            return $this->hasMany(ManufacturerInfo::class);

     }


    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'email', 'password','facebook_id','google_id'
    ];
    //protected $guarded = ['id'];

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
    public function addNew($input)
    {
        $check = static::query()->where('facebook_id',$input['facebook_id'])->first();


        if(is_null($check)){
            return static::query()->create($input);
        }


        return $check;
    }

    public function requests()
    {
        return $this->hasMany('App\Models\Request');
    }

    public function complaints()
    {
        return $this->hasMany('App\Models\Complaint');
    }

    public function addNewGoogle($input)
    {
        $check = static::query()->where('google_id',$input['google_id'])->first();


        if(is_null($check)){
            return static::query()->create($input);
        }


        return $check;
    }


     public function Products()
    {
        return $this->hasMany(Product::class);
    }

}
