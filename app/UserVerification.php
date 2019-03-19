<?php

namespace App;

use App\User;
use Illuminate\Database\Eloquent\Model;

class UserVerification extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'email',
        'email_two',
        'password_reset',
        'phone',
        'token',
        'user_id',
    ];

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = [
        'token',
    ];

    // ELOQUENT RELATIONSHIPS
    // -----------------------------------------------------------------------------------------------------------------

    /**
     * Get the user of the pending verification.
     */
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}
