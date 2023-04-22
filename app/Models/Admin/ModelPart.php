<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;

class ModelPart extends Model
{
    use HasFactory;

    protected $table = 'models';
    protected $fillable = ['name'];

    public function parts()
    {
        return $this->belongsToMany(Part::class, 'model_part', 'model_id', 'part_id');
    }

    public function processes()
    {
        return $this->belongsToMany(MasterProcess::class, 'model_part_process', 'model_id', 'process_id')->withPivot('part_id', 'main_process_id');
    }

    protected function name(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => strtoupper($value),
        );
    }
}
