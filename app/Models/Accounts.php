<?php

namespace App\Models;

use Illuminate\Contracts\Auth\Authenticatable;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model implements Authenticatable
{
    use \Illuminate\Auth\Authenticatable;

    public function getAuthIdentifierName()
    {
        return 'username';  // Set 'username' as the field for authentication
    }
    //
    protected $table = 'users';
    
    protected $fillable = [
        'id',
        'username',
        'password',
        'role',
              
    ];
}
