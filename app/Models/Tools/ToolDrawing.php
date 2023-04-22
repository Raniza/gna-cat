<?php

namespace App\Models\Tools;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\Attribute;
use App\Models\User;

class ToolDrawing extends Model
{
    use HasFactory;

    protected $fillable = [
        'master_tool_id', 'drawing', 'rev_no', 'note', 'uploader'
    ];

    public function tool()
    {
        return $this->belongsTo(MasterTool::class);
    }

    protected function uploader(): Attribute {
        return Attribute::make(
            get: fn ($value) => User::find($value)->name,
        );
    }
}
