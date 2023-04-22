<?php

namespace App\Models\Admin;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
// use Illuminate\Database\Eloquent\Casts\Attribute;

class Part extends Model
{
    use HasFactory;

    protected $fillable = ['name'];

    public function models()
    {
        return $this->belongsToMany(ModelPart::class, 'model_part', 'part_id', 'model_id');
    }

    public function processes()
    {
        return $this->belongsToMany(MasterProcess::class, 'part_process', 'part_id', 'process_id');
    }
    
}
