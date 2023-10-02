<?php

/**
 * Created by Reliese Model.
 */

namespace App\Models;

use Carbon\Carbon;
use Illuminate\Database\Eloquent\Model;

/**
 * Class Seeall
 *
 * @property int $id
 * @property Carbon|null $created_at
 * @property Carbon|null $updated_at
 * @property string $jsondata
 *
 * @package App\Models
 */
class Seeall extends Model
{
    protected $table = 'seealls';
    public static $snakeAttributes = false;

    protected $fillable = [
        'jsondata'
    ];
}
