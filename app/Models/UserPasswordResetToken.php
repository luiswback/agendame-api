<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class UserPasswordResetToken extends Model
{
    public $guarded = ['id'];

    const UPDATED_AT = null;

    use HasFactory;

    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }

}
