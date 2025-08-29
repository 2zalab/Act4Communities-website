<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Storage;

class Resource extends Model
{
    use HasFactory;

    protected $fillable = [
        'title',
        'slug',
        'description',
        'content',
        'file_path',
        'original_filename',
        'file_type',
        'file_size',
        'thumbnail',
        'category_id',
        'tags',
        'is_published',
        'is_featured',
        'download_count',
        'sort_order',
        'meta_title',
        'meta_description',
    ];

    protected $casts = [
        'is_published' => 'boolean',
        'is_featured' => 'boolean',
        'download_count' => 'integer',
        'file_size' => 'integer',
        'sort_order' => 'integer',
    ];

    /**
     * Boot the model.
     */
    protected static function boot()
    {
        parent::boot();

        static::creating(function ($resource) {
            if (empty($resource->slug)) {
                $resource->slug = Str::slug($resource->title);
            }
        });

        static::updating(function ($resource) {
            if ($resource->isDirty('title') && empty($resource->getOriginal('slug'))) {
                $resource->slug = Str::slug($resource->title);
            }
        });
    }

    /**
     * Get the category that owns the resource.
     */
    public function category()
    {
        return $this->belongsTo(ResourceCategory::class, 'category_id');
    }

    /**
     * Scope for published resources.
     */
    public function scopePublished($query)
    {
        return $query->where('is_published', true);
    }

    /**
     * Scope for featured resources.
     */
    public function scopeFeatured($query)
    {
        return $query->where('is_featured', true);
    }

    /**
     * Get formatted file size.
     */
    public function getFormattedFileSizeAttribute()
    {
        if (!$this->file_size) {
            return 'Taille inconnue';
        }

        $bytes = $this->file_size;
        $units = ['B', 'KB', 'MB', 'GB'];

        for ($i = 0; $bytes > 1024 && $i < count($units) - 1; $i++) {
            $bytes /= 1024;
        }

        return round($bytes, 2) . ' ' . $units[$i];
    }

    /**
     * Get file extension from file type.
     */
    public function getFileExtensionAttribute()
    {
        if ($this->file_type) {
            return strtoupper(str_replace('application/', '', $this->file_type));
        }

        if ($this->original_filename) {
            return strtoupper(pathinfo($this->original_filename, PATHINFO_EXTENSION));
        }

        return 'FILE';
    }

    /**
     * Get file icon based on type.
     */
    public function getFileIconAttribute()
    {
        $icons = [
            'pdf' => 'fas fa-file-pdf text-danger',
            'doc' => 'fas fa-file-word text-primary',
            'docx' => 'fas fa-file-word text-primary',
            'xls' => 'fas fa-file-excel text-success',
            'xlsx' => 'fas fa-file-excel text-success',
            'ppt' => 'fas fa-file-powerpoint text-warning',
            'pptx' => 'fas fa-file-powerpoint text-warning',
            'jpg' => 'fas fa-file-image text-info',
            'jpeg' => 'fas fa-file-image text-info',
            'png' => 'fas fa-file-image text-info',
            'gif' => 'fas fa-file-image text-info',
            'zip' => 'fas fa-file-archive text-secondary',
            'rar' => 'fas fa-file-archive text-secondary',
            'mp4' => 'fas fa-file-video text-danger',
            'mp3' => 'fas fa-file-audio text-success',
            'txt' => 'fas fa-file-alt text-muted',
        ];

        $extension = strtolower($this->file_extension);

        return $icons[$extension] ?? 'fas fa-file text-muted';
    }

    /**
     * Get tags as array.
     */
    public function getTagsArrayAttribute()
    {
        return $this->tags ? explode(',', $this->tags) : [];
    }

    /**
     * Check if file exists.
     */
    public function fileExists()
    {
        return $this->file_path && Storage::disk('public')->exists($this->file_path);
    }

    /**
     * Get download URL.
     */
    public function getDownloadUrlAttribute()
    {
        return route('resources.download', $this->slug);
    }

    /**
     * Get view URL.
     */
    public function getUrlAttribute()
    {
        return route('resources.show', $this->slug);
    }

    /**
     * Get thumbnail URL.
     */

    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail && Storage::disk('public')->exists($this->thumbnail)) {
            return Storage::disk('public')->url($this->thumbnail);
        }

        return null; // Retourner null au lieu d'images par défaut qui n'existent pas
    }
    /*
    public function getThumbnailUrlAttribute()
    {
        if ($this->thumbnail && Storage::exists($this->thumbnail)) {
            return Storage::url($this->thumbnail);
        }

        // Retourner une image par défaut basée sur le type de fichier
        $defaultThumbnails = [
            'pdf' => 'images/default-thumbnails/pdf.png',
            'doc' => 'images/default-thumbnails/doc.png',
            'docx' => 'images/default-thumbnails/doc.png',
            'xls' => 'images/default-thumbnails/excel.png',
            'xlsx' => 'images/default-thumbnails/excel.png',
            'ppt' => 'images/default-thumbnails/ppt.png',
            'pptx' => 'images/default-thumbnails/ppt.png',
        ];

        $extension = strtolower($this->file_extension);
        return asset($defaultThumbnails[$extension] ?? 'images/default-thumbnails/file.png');
    }
    */

    /**
     * Vérifier si une thumbnail existe.
     */
    public function hasThumbnail()
    {
        return $this->thumbnail && Storage::disk('public')->exists($this->thumbnail);
    }

    /**
     * Get URL de la catégorie (ajouter cette méthode si elle manque dans ResourceCategory).
     */
    public function getCategoryUrlAttribute()
    {
        return $this->category ? route('resources.category', $this->category->slug) : '#';
    }

}
