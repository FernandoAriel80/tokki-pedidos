<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Attributes\Fillable;
use Illuminate\Database\Eloquent\Attributes\Table;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

#[Table('status_user')]
#[Fillable(['name'])]
class StatusUser extends Model
{
    public function users(): HasMany
    {
        return $this->hasMany(User::class);
    }
}
