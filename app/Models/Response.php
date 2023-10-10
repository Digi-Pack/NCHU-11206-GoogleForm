<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Response
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property int $user_id
 * @property int $question_id
 * @property string|null $answer
 *
 * @package App\Models
 */
class Response extends Model
{
    protected $table = 'responses';
    public static $snakeAttributes = false;

    protected $casts = [
        'user_id' => 'int',
        'question_id' => 'int'
    ];

    protected $fillable = [
        'user_id',
        'question_id',
        'answer'
    ];

    public function question()
    {
        return $this->belongsTo(Question::class, 'id', 'question_id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'id', 'user_id');
    }
}
