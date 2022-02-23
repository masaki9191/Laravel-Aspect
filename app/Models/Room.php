<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Room extends Model implements HasMedia
{
    use HasFactory, InteractsWithMedia;
    
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'build_id',
        'no',
        'price',
        'rent_size',
        'area',
        'facility',
        'point',
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
    
    public function build()
    {
        return $this->belongsTo(Build::class);
    }
    
    
}
