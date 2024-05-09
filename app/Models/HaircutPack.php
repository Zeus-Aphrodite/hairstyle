<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\HaircutPack
 *
 * @property int $id
 * @property string $name
 * @property-read \Illuminate\Database\Eloquent\Collection|\App\Models\Haircut[] $haircuts
 * @mixin \Eloquent
 */
class HaircutPack extends Model
{
    protected $table = 'haircut_packs';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'is_paid' => 'boolean',
    ];

    protected $hidden = [
        'created_at',
        'updated_at',
    ];

    public function haircuts()
    {
        return $this->hasMany(Haircut::class);
    }

    public function getPickings(): int
    {
        return PackedHaircutSelection::whereIn('haircut_id', $this->haircuts->pluck('id'))->pluck('count')->sum();
    }

    public function resetPickings()
    {
        PackedHaircutSelection::whereIn('haircut_id', $this->haircuts->pluck('id'))->delete();
    }
}
