<?php

namespace App\Models;

use App\Models\Order;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Notifications\Notifiable;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'role_id',
        'is_login',
        'is_active',
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
        'password' => 'hashed',
    ];

    public function orders():HasMany{
        return $this->hasMany(Order::class,'user_id','id');
    }

    public function transactions():HasMany{
        return $this->hasMany(Transaction::class, 'user_id', 'id');
    }

    public function role(): BelongsTo {
        return $this->belongsTo(Role::class, 'role_id', 'id');
    }

    public function isNormal(): bool {
        if ($this->role_id == 1) {
            return true;
        }
        return false;
    }

    public function isVerified():bool {
        if ($this->email_verified_at == null){
            return false;
        }

        return true;
    }

    public function isAdmin(): bool {
        if ($this->role_id == 2) {
            return true;
        }
        return false;
    }

}
