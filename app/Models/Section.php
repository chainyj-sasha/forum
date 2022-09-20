<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Query\Builder;

/**
 * @mixin Builder
 */

class Section extends Model
{
    use HasFactory;

    public function topic()
    {
        return $this->hasMany(Topic::class);
    }
}
