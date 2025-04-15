<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Facades\Storage;

class ProductImage extends Model
{
    use HasFactory;

    protected $fillable = [
        'product_id',
        'image_path',
        'image_url',
        'sort_order',
        'is_primary'
    ];

    protected $casts = [
        'is_primary' => 'boolean'
    ];

    protected $appends = ['full_image_url'];

    public function product(): BelongsTo
    {
        return $this->belongsTo(Product::class);
    }

    public function getFullImageUrlAttribute(): string
    {
        if (filter_var($this->image_url, FILTER_VALIDATE_URL)) {
            return $this->image_url;
        }
        
        return $this->image_path
            ? Storage::disk('public')->url($this->image_path)
            : asset('images/no-image.png');
    }
}
