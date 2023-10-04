<?php

namespace App\Models;

use App\Models\User;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;

class Comment extends Model
{
    use HasFactory, SoftDeletes;

    protected $guarded = [];

    /**
     * Get the comentator that owns the Comment
     *
     * @return \Illuminate\Database\Eloquent\Relations\BelongsTo
     */
    public function comentator(): BelongsTo
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
