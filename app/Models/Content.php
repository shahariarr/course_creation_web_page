<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Content extends Model
{
    use HasFactory;

    protected $fillable = ['module_id', 'type', 'content_data'];

    public function module()
    {
        return $this->belongsTo(Module::class);
    }
}
