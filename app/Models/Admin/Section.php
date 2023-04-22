<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use App\Models\User;
use App\Models\Admin\Department;

class Section extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'department_id'
    ];

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }

    public function department(): BelongsTo {
        return $this->belongsTo(Department::class);
    }
}
