<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsToMany;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory;

    protected $fillable = [
        'name', 'slug', 'description', 'color', 'icon', 'is_active'
    ];

    protected $casts = [
        'is_active' => 'boolean',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    public function projects()
    {
        return $this->hasMany(Project::class);
    }

    public function posts()
    {
        return $this->hasMany(Post::class);
    }

     /**
     * Relation avec les demandes de partenariat (many-to-many)
     */
    public function partnershipRequests(): BelongsToMany
    {
        return $this->belongsToMany(PartnershipRequest::class, 'partnership_request_categories');
    }

    /**
     * Accessor pour compter les partenariats
     */
    public function getPartnershipsCountAttribute()
    {
        return $this->partnerships()->count();
    }
}
