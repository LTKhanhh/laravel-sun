<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Facades\Hash;
use Illuminate\Database\Eloquent\Casts\Attribute;

class User extends Authenticatable
{
    /** @use HasFactory<\Database\Factories\UserFactory> */
    use HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'name',
        'first_name',
        'last_name',
        'email',
        'phone',
        'date_of_birth',
        'gender',
        'address',
        'avatar',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var list<string>
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
            'date_of_birth' => 'date',
        ];
    }

    /**
     * Get the tasks for the user.
     */
    public function tasks(): HasMany
    {
        return $this->hasMany(Task::class);
    }
    /**
     * Get completed tasks for the user.
     */
    public function completedTasks(): HasMany
    {
        return $this->hasMany(Task::class)->where('status', 'completed');
    }

    /**
     * Get pending tasks for the user.
     */
    public function pendingTasks(): HasMany
    {
        return $this->hasMany(Task::class)->where('status', 'pending');
    }

    /**
     * Get roles for the user.
     */
    public function roles(): BelongsToMany 
    {
        return $this->belongsToMany(Role::class);
    }

    /**
     * Gán role cho user
     */
    public function assignRole($role): void
    {
        $roleId = is_string($role) ? Role::where('name', $role)->first()->id : $role;
        $this->roles()->syncWithoutDetaching($roleId);
    }

    /**
     * Gỡ bỏ role khỏi user
     */
    public function removeRole($role): void
    {
        $roleId = is_string($role) ? Role::where('name', $role)->first()->id : $role;
        $this->roles()->detach($roleId);
    }
    /**
     * Kiểm tra user có role không
     */
    public function hasRole($role): bool
    {
        if (is_string($role)) {
            return $this->roles->contains('name', $role);
        }
        
        return $this->roles->contains('id', $role);
    }

    /**
     * Lấy tên các roles của user
     */
    public function getRoleNames(): array
    {
        return $this->roles->pluck('name')->toArray();
    }

    protected function password(): Attribute
    {
        return Attribute::make(
            get: fn (string $value) => $value, // Accessor 
            set: fn (string $value) => Hash::make($value), // Mutator 
        );
    }

    /**
     * Kiểm tra password có khớp không
     */
    public function checkPassword(string $password): bool
    {
        return Hash::check($password, $this->password);
    }
}
