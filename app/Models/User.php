<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;

use App\Enum\UserStatusEnum;
use App\Models\Scopes\OrderByNameScope;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;

class User extends Authenticatable
{
    use HasFactory, SoftDeletes, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'email',
        'password',
        'status',
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
     * Get the attributes that should be cast.
     *
     * @return array<string, string>
     */
    protected function casts(): array
    {
        return [
            'email_verified_at' => 'datetime',
            'password' => 'hashed',
            'status' => UserStatusEnum::class,
            'is_management' => 'Boolean'
        ];
    }

    public function isManagement() : bool
    {
        return $this->is_management === true;
    }

    public function scopeIsActive($query) : void
    {
        $query->where('status', UserStatusEnum::ACTIVE->value);
    }

    public function scopeIsInactive($query) : void
    {
        $query->where('status', UserStatusEnum::INACTIVE->value);
    }
}
