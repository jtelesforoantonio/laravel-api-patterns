<?php

namespace Modules\Posts\Models;

use App\Models\User;
use Database\Factories\CommentFactory;
use Illuminate\Database\Eloquent\Factories\Factory;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class Comment extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = ['post_id', 'user_id', 'comment'];

    /**
     * {@inheritDoc}
     */
    protected static function newFactory(): Factory
    {
        return CommentFactory::new();
    }

    /**
     * Author.
     */
    public function user(): BelongsTo
    {
        return $this->belongsTo(User::class);
    }
}
