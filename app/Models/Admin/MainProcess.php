<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MainProcess extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function processes()
    {
        return $this->hasMany(MasterProcess::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords($value),
        );
    }
}
