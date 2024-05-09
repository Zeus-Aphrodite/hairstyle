<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuizQuestionOption
 *
 * @property-read QuizQuestion $question
 * @mixin \Eloquent
 * @property int $id
 * @property int $quiz_question_id
 * @property string $text
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|QuizQuestionOption whereCreatedAt($value)
 * @method static Builder|QuizQuestionOption whereId($value)
 * @method static Builder|QuizQuestionOption whereQuizQuestionId($value)
 * @method static Builder|QuizQuestionOption whereText($value)
 * @method static Builder|QuizQuestionOption whereUpdatedAt($value)
 */
class QuizQuestionOption extends Model
{
    protected $table = 'quiz_question_options';

    protected $guarded = [
        'id',
    ];

    public function question()
    {
        return $this->belongsTo(QuizQuestion::class);
    }
}
