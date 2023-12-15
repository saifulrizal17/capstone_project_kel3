<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class UserRole extends Model
{
    protected $table = 'tbl_users_role';

    protected $fillable = [
        'id',
        'name',
        'description',
    ];

    public function roles()
    {
        return $this->hasMany(User::class, 'role_id');
    }
}
