<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Passport\HasApiTokens;

class User extends Authenticatable
{
    use HasFactory, Notifiable, HasApiTokens;

    /**
     * User roles.
     *
     * @return BelongsToMany
     */
    
    public function roles()
    {
        return $this->belongsToMany(Role::class)->withTimestamps();
    }

    /**
     * Assign role to user.
     *
     * @param string $role
     *
     * @return Role
     */

    public function assignRole($role)
    {
        $this->roles()->save($role);
    }

    /**
     * Return true if user has given role.
     *
     * @param string|Collection $role
     *
     * @return bool
     */
    public function hasRole($role)
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        return !! $role->intersect($this->roles)->count();
    }

    public function abilities()
    {
        return $this->roles->map->abilities->flatten()->pluck('name')->unique();
    }

    public function customerInfo()
    {
        return $this->hasOne(CustomerInfo::class, 'user_id');
    }

    public function manufacturerInfo()
    {
        return $this->hasOne(ManufacturerInfo::class, 'user_id');
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

    public function orders()
    {
        return $this->hasMany(Order::class, 'id' , 'customer_id');
    }

    public function favouritelist(){
        return $this->hasMany(FavouriteList::class);
    }

}
