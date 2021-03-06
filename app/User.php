<?php

namespace App;

use Illuminate\Notifications\Notifiable;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable
{
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'code', 'name', 'username', 'password', 'branch_id', 'permissions', 'active',
    ];

    protected $casts = [
        'permissions' => 'array',
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    public function roles()
    {
        return $this->belongsToMany(Role::class, 'role_users');
    }

    /**
     * Checks if User has access to $permissions.
     */
    public function hasAccess(array $permissions) : bool
    {
        // check if the permission is available in any role
        // $tes = json_decode($this->permissions, true);
        // dd($tes["add-member"]);

        foreach ($permissions as $permission)
        {
            if ($this->hasPermission($permission))
                return true;
        }
        return false;
        
        // foreach ($this->roles as $role) {
        //     if($role->hasAccess($permissions)) {
        //         return true;
        //     }
        // }
        // return false;
    }

    protected function hasPermission(string $permission) : bool
    {
        // return $this->permissions[$permission] ?? false;
        $permissions = json_decode($this->permissions, true);
        return $permissions[$permission]??false;
    }

    /**
     * Checks if the user belongs to role.
     */
    public function inRole(string $roleSlug)
    {
        return $this->roles()->where('slug', $roleSlug)->count() == 1;
    }

    public function branch()
    {
        return $this->belongsTo('App\Branch');
    }
    public function mpc()
    {
        return $this->hasMany('App\Mpc'); 
    }
}
