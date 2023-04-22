<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\Admin\Position;
use App\Models\Admin\Department;
use App\Models\Admin\Section;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'nik',
        'name',
        'email',
        'password',
        'position_id',
        'department_id',
        'section_id',
        // 'costcenter_id',
        'isAdmin',
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
    ];

    public function position(): BelongsTo {
        return $this->belongsTo(Position::class);
    }

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }

    public function section(): BelongsTo {
        return $this->belongsTo(Section::class);
    }

    /* -------------------------- Accessors & Mutators -------------------------- */
    // protected function isAdmin(): Attribute {
    //     return Attribute::make(
    //         get: fn ($value) => $value ? 'Admin' : 'User',
    //     );
    // }

    protected function nik(): Attribute{
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }

    protected function name(): Attribute{
        return Attribute::make(
            set: fn ($value) => ucwords($value),
        );
    }
}
