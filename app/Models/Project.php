<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Project extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'slug', 'excerpt', 'description', 'featured_image',
        'gallery', 'status', 'start_date', 'end_date', 'location',
        'budget', 'objectives', 'expected_results', 'category_id',
        'is_featured', 'is_published', 'translations'
    ];

    protected $casts = [
        'gallery' => 'array',
        'objectives' => 'array',
        'expected_results' => 'array',
        'translations' => 'array',
        'is_featured' => 'boolean',
        'is_published' => 'boolean',
        'start_date' => 'date',
        'end_date' => 'date',
        'budget' => 'decimal:2',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($project) {
            if (empty($project->slug)) {
                $project->slug = Str::slug($project->title);
            }
        });
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function getStatusBadgeAttribute()
    {
        $badges = [
            'active' => 'bg-green-100 text-green-800',
            'completed' => 'bg-blue-100 text-blue-800',
            'suspended' => 'bg-red-100 text-red-800',
        ];

        return $badges[$this->status] ?? 'bg-gray-100 text-gray-800';
    }
}
