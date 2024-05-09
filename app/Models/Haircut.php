<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use JD\Cloudder\Facades\Cloudder;

/**
 * App\Models\Haircut
 *
 * @property int $id
 * @property int $haircut_pack_id
 * @property string $name
 * @property string $type
 * @property string $description
 * @property boolean $is_free
 * @property string $wig_cloudinary_id
 * @property string $preview_cloudinary_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|Haircut whereCreatedAt($value)
 * @method static Builder|Haircut whereId($value)
 * @method static Builder|Haircut whereName($value)
 * @method static Builder|Haircut wherePreviewCloudinaryId($value)
 * @method static Builder|Haircut whereType($value)
 * @method static Builder|Haircut whereUpdatedAt($value)
 * @method static Builder|Haircut whereWigCloudinaryId($value)
 * @method static Builder|Haircut packed()
 * @method static Builder|Haircut notPacked()
 * @mixin \Eloquent
 * @property-read mixed $preview_thumbnail_url
 * @property-read mixed $preview_url
 * @property-read mixed $wig_thumbnail_url
 * @property-read mixed $wig_url
 * @property-read \App\Models\HaircutPack $pack
 * @property-read \App\Models\PackedHaircutSelection $packedAnswers
 */
class Haircut extends Model
{
    protected $guarded = [
        'id',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
        'wig_cloudinary_id',
        'preview_cloudinary_id',
    ];

    protected $appends = [
        'preview_url',
        'preview_thumbnail_url',
        'wig_url',
        'wig_thumbnail_url',
    ];

    protected $casts = [
        'is_free' => 'boolean',
    ];

    // terrible way to implement that, but i don't want to deal with one more model/table/relation for 200$ :)
    const GROUPS = [
        // group 1
        [2, 3, 5, 7, 8, 10, 12, 14, 15, 19, 20, 22, 23, 25, 26,],
        // group 2
        [28, 30, 31, 32, 33, 34, 37, 40,],
        // group 3
        [41, 42, 43, 44, 47, 51, 52, 54, 56,],
        // group 4
        [57, 59, 60, 63, 64, 65, 66, 67, 69, 70, 71, 72, 75, 77, 79,],
        // group 5
        [81, 82, 85, 89, 92, 93, 94, 97, 99, 114, 115, 116, 118,],
        // group 6
        [83, 84, 88, 96, 100, 102, 104, 108, 110, 120,],
    ];

    public function pack()
    {
        return $this->belongsTo(HaircutPack::class, 'haircut_pack_id');
    }

    public function packedAnswers()
    {
        return $this->hasOne(PackedHaircutSelection::class);
    }

    public function getPreviewUrlAttribute()
    {
        return $this->getPreviewImage();
    }

    public function getPreviewThumbnailUrlAttribute()
    {
        return $this->getPreviewImage('thumbnail');
    }

    public function getWigUrlAttribute()
    {
        return $this->getWigImage();
    }

    public function getWigThumbnailUrlAttribute()
    {
        return $this->getWigImage('thumbnail');
    }

    protected static function boot()
    {
        parent::boot();
        self::deleted(function (self $haircut) {
            // deleting image from cloudinary
            Cloudder::destroyImages([$haircut->wig_cloudinary_id, $haircut->preview_cloudinary_id]);
        });
        self::saved(function (self $haircut) {
            // clearing cache which is used in ApiController
            // not using tagged cache because database driver, which is used on the server, doesn't support it =|
            \Cache::forget('haircuts.all');
            \Cache::forget('haircuts.short');
            \Cache::forget('haircuts.medium');
            \Cache::forget('haircuts.long');
            \Cache::forget('packed-haircuts.all');
        });
    }

    public function getWigImage(string $type = ''): string
    {
        // because of customer uses free cloudinary account we can't use transformations =|
        $options = /*\config("cloudder.types.$type") ?: */[];
        return Cloudder::show($this->wig_cloudinary_id/*, $options*/);
    }

    public function getPreviewImage(string $type = ''): string
    {
        // because of customer uses free cloudinary account we can't use transformations =|
        $options = /*\config("cloudder.types.$type") ?: */[];
        return Cloudder::show($this->preview_cloudinary_id/*, $options*/);
    }

    public function getAnswersCountForQuiz2(string $age = ''): int
    {
        $builder = QuizAnswer::forHaircut($this)->forQuiz(Quiz::find(2));
        if ($age) {
            $builder = $builder->forAge($age);
        }
        return $builder->count();
    }

    public function scopePacked($query)
    {
        return $query->whereNotNull('haircut_pack_id');
    }

    public function scopeNotPacked($query)
    {
        return $query->whereNull('haircut_pack_id');
    }

    public function getTimesSelected(): int
    {
        return $this->packedAnswers->count ?? 0;
    }
}
