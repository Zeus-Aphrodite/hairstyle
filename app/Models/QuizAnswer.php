<?php namespace App\Models;

use Illuminate\Database\Eloquent\Builder;
use Illuminate\Database\Eloquent\Model;

/**
 * App\Models\QuizAnswer
 *
 * @property-read Quiz $quiz
 * @property-read Haircut $haircut
 * @mixin \Eloquent
 * @property int $id
 * @property int $quiz_id
 * @property array $answers
 * @property string $age
 * @property int $haircut_id
 * @property \Carbon\Carbon|null $created_at
 * @property \Carbon\Carbon|null $updated_at
 * @method static Builder|QuizAnswer forHaircut(Haircut $value)
 * @method static Builder|QuizAnswer forQuiz(Quiz $value)
 * @method static Builder|QuizAnswer forAge(string $value)
 */
class QuizAnswer extends Model
{
    protected $table = 'quiz_answers';

    protected $guarded = [
        'id',
    ];

    protected $casts = [
        'answers' => 'array',
    ];

    protected static function boot()
    {
        parent::boot();
        self::created(function (self $answer) {
            // clearing cache which is used in ApiController
            \Cache::forget('dashboard');
        });
    }

    public function quiz()
    {
        return $this->belongsTo(Quiz::class);
    }

    public function haircut()
    {
        return $this->belongsTo(Haircut::class);
    }

    public function scopeForHaircut($query, Haircut $haircut)
    {
        return $query->where('haircut_id', $haircut->id);
    }

    public function scopeForQuiz($query, Quiz $quiz)
    {
        return $query->where('quiz_id', $quiz->id);
    }

    public function scopeForAge($query, string $age)
    {
        return $query->where('age', $age);
    }
}
