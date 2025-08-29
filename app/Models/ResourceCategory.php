<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class ResourceCategory extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'slug',
        'description',
        'icon',
        'color',
        'sort_order',
        'is_active',
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($category) {
            if (empty($category->slug)) {
                $category->slug = Str::slug($category->name);
            }
            
            if (is_null($category->sort_order)) {
                $category->sort_order = static::max('sort_order') + 1;
            }
        });

        static::updating(function ($category) {
            if ($category->isDirty('name') && empty($category->getOriginal('slug'))) {
                $category->slug = Str::slug($category->name);
            }
        });
    }

    /**
     * Get the resources for the category.
     */
    public function resources()
    {
        return $this->hasMany(Resource::class, 'category_id');
    }

    /**
     * Get published resources for the category.
     */
    public function publishedResources()
    {
        return $this->hasMany(Resource::class, 'category_id')
                    ->where('is_published', true);
    }

    /**
     * Scope for active categories.
     */
    public function scopeActive($query)
    {
        return $query->where('is_active', true);
    }

    /**
     * Scope for ordered categories.
     */
    public function scopeOrdered($query)
    {
        return $query->orderBy('sort_order', 'asc');
    }

    /**
     * Get the URL for the category.
     */
    public function getUrlAttribute()
    {
        return route('resources.category', $this->slug);
    }

    /**
     * Get resources count attribute.
     */
    public function getResourcesCountAttribute()
    {
        return $this->resources()->where('is_published', true)->count();
    }
}