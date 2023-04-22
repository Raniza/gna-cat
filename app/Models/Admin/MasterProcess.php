<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class MasterProcess extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'main_process_id'];

    public function main()
    {
        return $this->belongsTo(MainProcess::class);
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => ucwords($value),
        );
    }
}
