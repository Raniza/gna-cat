<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;

class MasterTool extends Model
{
    use HasFactory;

    protected $fillable = ['code', 'desc', 'drawing'];

    public function drawings()
    {
        return $this->hasMany(ToolDrawing::class);
    }

    public function users()
    {
        return $this->hasMany(User::class);
    }
    protected $cast = [
        'created_at' => 'date:Y-m-d',
        'updated_at' => 'date:Y-m-d'
    ];
}
