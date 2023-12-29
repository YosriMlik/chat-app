<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;


class ChatMessage extends Model
{
    use HasFactory;

    public function room() : BelongsTo
    {
        return $this->belongsTo(ChatRoom::class);
    }

    public function user() : BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}

