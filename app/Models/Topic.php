<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */

class Topic extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'user_id',
        'section_id',
    ];

    public function section()
    {
        return $this->belongsTo(Section::class);
    }

    public function message()
    {
        return $this->hasMany(Message::class);
    }
}
