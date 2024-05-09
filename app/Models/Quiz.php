<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Collection;

/**
 * App\Models\Quiz
 *
 * @property-read Collection|QuizQuestion[] $questions
 * @property-read Collection|QuizAnswer[] $answers
 * @mixin \Eloquent
 * @property int $id
 * @property string $name
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|Quiz whereCreatedAt($value)
 * @method static Builder|Quiz whereId($value)
 * @method static Builder|Quiz whereName($value)
 * @method static Builder|Quiz whereUpdatedAt($value)
 *
 * @mixin \Eloquent
 * @mixin Builder
 */
class Quiz extends Model
{
    protected $table = 'quizzes';

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'questions',
    ];

    public function questions()
    {
        return $this->hasMany(QuizQuestion::class);
    }

    public function answers()
    {
        return $this->hasMany(QuizAnswer::class);
    }
}
