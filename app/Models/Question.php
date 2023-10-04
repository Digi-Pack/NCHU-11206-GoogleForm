<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Question
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property Carbon|null $modified_at
 * @property Carbon|null $other_modified
 * @property Carbon|null $opened_date
 * @property int $lead_author_id
 * @property string|null $qu_naires_title
 * @property string|null $qu_naires_desc
 * @property string|null $questionnaires
 *
 * @package App\Models
 */
class Question extends Model
{
    protected $table = 'questions';
    public static $snakeAttributes = false;

    protected $casts = [
        'modified_at' => 'datetime',
        'other_modified' => 'datetime',
        'opened_date' => 'datetime',
        'lead_author_id' => 'int'
    ];

    protected $fillable = [
        'modified_at',
        'other_modified',
        'opened_date',
        'lead_author_id',
        'qu_naires_title',
        'qu_naires_desc',
        'questionnaires',
        'random'
    ];

    public function coworker()
    {
        return $this->hasMany(Coworker::class, 'question_id', 'id');
    }
    public function response()
    {
        return $this->hasMany(Response::class, 'question_id', 'id');
    }
    public function user()
    {
        return $this->belongsTo(User::class, 'lead_author_id');
    }
}
