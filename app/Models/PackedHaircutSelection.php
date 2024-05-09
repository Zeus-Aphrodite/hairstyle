<?php namespace App\Models;

use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\PackedHaircutSelection
 * @property int $id
 * @property int $haircut_id
 * @property int $count
 *
 * @property-read \App\Models\Haircut $haircut
 * @mixin \Eloquent
 */
class PackedHaircutSelection extends Model
{
    protected $table = 'packed_haircut_selections';

    protected $guarded = [
        'id',
    ];

    public function haircut()
    {
        return $this->belongsTo(Haircut::class);
    }
}
