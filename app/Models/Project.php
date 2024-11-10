<?php

namespace App\Models;

use Spatie\Activitylog\LogOptions;
use Illuminate\Database\Eloquent\Model;
use Spatie\Activitylog\Traits\LogsActivity;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\MorphMany;

class Project extends Model
{
    use SoftDeletes, LogsActivity;

    /**
     * The attributes that aren't mass assignable.
     *
     * @var array
     */
    protected $guarded = [];

    public function getActivitylogOptions(): LogOptions
    {
        return LogOptions::defaults()->logAll();
    }

    /**
     * Get all of the issue's images.
     */
    public function additionalInformations(): MorphMany
    {
        return $this->morphMany(AdditionalInformation::class, 'additional_informationable');
    }

    /**
     * Get the project manager that owns the project.
     */
    public function projectManager(): BelongsTo
    {
        return $this->belongsTo(User::class, 'project_manager_id', 'id');
    }

    /**
     * Get the users for the project.
     */
    public function projectUsers(): HasMany
    {
        return $this->hasMany(ProjectUser::class, 'project_id', 'id');
    }
}
