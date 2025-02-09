<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Album extends Model
{
    use HasFactory;

    protected $fillable = ['title', 'artist_id', 'cover_image', 'release_date', 'status'];

    /**
     * Relationship: An album belongs to an artist.
     */
    public function artist(): BelongsTo
    {
        return $this->belongsTo(Artist::class);
    }

    /**
     * Relationship: An album has many tracks.
     */
    public function tracks(): HasMany
    {
        return $this->hasMany(Track::class);
    }

    /**
     * Mutator: Capitalize each word in the title.
     */
    public function setTitleAttribute($value)
    {
        $this->attributes['title'] = ucwords(strtolower($value));
    }

    /**
     * Accessor: Format release date to Y-m-d.
     */
    public function getReleaseDateAttribute($value)
    {
        return date('Y-m-d', strtotime($value));
    }
}
