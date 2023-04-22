<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use App\Models\User;

class Position extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function users(): HasMany {
        return $this->hasMany(User::class);
    }
}
