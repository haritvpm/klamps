<?php

namespace App\Models;

use DateTimeInterface;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Spatie\MediaLibrary\HasMedia;
use Spatie\MediaLibrary\InteractsWithMedia;
use Spatie\MediaLibrary\MediaCollections\Models\Media;

class Student extends Model implements HasMedia
{
    use InteractsWithMedia, HasFactory;

    public $table = 'students';

    protected $appends = [
        'photo',
    ];

    public const FEE_PAID_SELECT = [
        'y' => 'Yes',
        'n' => 'No',
    ];

    protected $dates = [
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    public const CENTRE_SELECT = [
        'Trivandrum' => 'Trivandrum',
        'Kochi' => 'Kochi',
        'Kozhikode' => 'Kozhikode',
    ];

    protected $fillable = [
        'roll_number',
        'name',
        'fee_paid',
        'centre',
        'created_at',
        'updated_at',
        'deleted_at',
    ];

    protected function serializeDate(DateTimeInterface $date)
    {
        return $date->format('Y-m-d H:i:s');
    }

    public function registerMediaConversions(Media $media = null): void
    {
        $this->addMediaConversion('thumb')->fit('crop', 50, 50);
        $this->addMediaConversion('preview')->fit('crop', 120, 120);
    }

    public function getPhotoAttribute()
    {
        $file = $this->getMedia('photo')->last();
        if ($file) {
            $file->url       = $file->getUrl();
            $file->thumbnail = $file->getUrl('thumb');
            $file->preview   = $file->getUrl('preview');
        }

        return $file;
    }

    public function getFallbackPhoto()
    {
        
        return  ('/storage/') . $this->roll_number . '.jpg';
    }
}
