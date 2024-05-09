<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Collection;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuizQuestion
 *
 * @property-read Collection|QuizQuestionOption[] $options
 * @property-read Quiz $quiz
 * @mixin \Eloquent
 * @property int $id
 * @property int $quiz_id
 * @property string $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|QuizQuestion whereCreatedAt($value)
 * @method static Builder|QuizQuestion whereId($value)
 * @method static Builder|QuizQuestion whereQuizId($value)
 * @method static Builder|QuizQuestion whereText($value)
 * @method static Builder|QuizQuestion whereUpdatedAt($value)
 */
class QuizQuestion extends Model
{
    protected $table = 'quiz_questions';

    protected $guarded = [
        'id',
    ];

    protected $with = [
        'options',
    ];

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function options()
    {
        return $this->hasMany(QuizQuestionOption::class);
    }
}
