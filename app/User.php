<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use App\Role;
use Illuminate\Support\Facades\Hash;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'login', 'password','is_admin'
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

    /**
     * Method check user role.
     * 
     * @return bool
     */
    public function isAdmin()
    {
        return (bool)$this->is_admin;
    }

    /**
     * Method check matching new and old passwords.
     * 
     * @param  string  $password
     * @param  int  $user_id
     * @return bool
     */
    static public function is_dublicate_password($password, $user_id){

        $user = self::where('id', $user_id)->first();
        $check = Hash::check($password, $user->password);
        return $check;
    }

    /**
     * Method change passwords.
     * 
     * @param  string  $password
     * @param  int  $user_id
     */
    static public function change_user_password($password, $user_id){
        $new_hash_password = Hash::make($password);
        self::where('id', $user_id)
            ->update(['password' => $new_hash_password]);
    }



}
