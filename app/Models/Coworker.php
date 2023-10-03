<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Coworker
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $coworker_id
 * @property int $question_id
 *
 * @package App\Models
 */
class Coworker extends Model
{
    protected $table = 'coworkers';
    public static $snakeAttributes = false;

    protected $casts = [
        'coworker_id' => 'int',
        'question_id' => 'int'
    ];

    protected $fillable = [
        'coworker_id',
        'question_id'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id', 'question_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'coworker_id');
    }
}
