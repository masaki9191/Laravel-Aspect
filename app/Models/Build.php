<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Build extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'state',
        'name',
        'address',
        'scale',
        'construction',
        'room',
        'total_area',
        'rent_area_from',
        'rent_area_to',
        'completion',
        'point'
    ];
    
    public function photo($type)
    {
        $media = $this->getMedia($type)->first();
        if($media == null)
            return null;
        return $media;
    }
    
    public function getPhotosAttribute()
    {
        $files = $this->getMedia('photos');
        $files->each(function ($item) {
            $item->url       = $item->getUrl();
        });

        return $files;
    }

    public function getThumbnailAttribute()
    {
        return $this->getFirstMediaUrl('photos');
    }
    
    /**
     * Get the comments for the blog post.
     */
    public function rooms()
    {
        return $this->hasMany(Room::class);
    }
}
