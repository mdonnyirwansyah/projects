<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Casts\AsArrayObject;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class ActivityLog extends Model
{
    protected $table = 'activity_log';

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'properties' => AsArrayObject::class,
    ];

    /**
     * Get the user that owns the activity log.
     */
    public function causer(): BelongsTo
    {
        return $this->belongsTo(User::class, 'causer_id', 'id');
    }
}
