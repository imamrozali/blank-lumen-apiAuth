<?php

namespace App;

use App\UserVerification;
use Illuminate\Auth\Authenticatable;
use Illuminate\Contracts\Auth\Access\Authorizable as AuthorizableContract;
use Illuminate\Contracts\Auth\Authenticatable as AuthenticatableContract;
use Illuminate\Database\Eloquent\Model;
use Laravel\Lumen\Auth\Authorizable;
use Laravel\Passport\HasApiTokens;

class User extends Model implements AuthenticatableContract, AuthorizableContract
{
    use Authenticatable, Authorizable, HasApiTokens;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'account_activated',
        'email',
        'email_two',
        'name',
        'password',
        'phone',
        'username',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'password',
    ];

    // ELOQUENT RELATIONSHIPS
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Get the pending verifications of the user.
     */
    public function pendingVerifications()
    {
        return $this->hasMany(UserVerification::class);
    }
}
