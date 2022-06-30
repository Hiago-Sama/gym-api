<?php

declare(strict_types=1);

namespace App\Models;

use App\Models\Traits\UuidTrait;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

abstract class BaseModel extends Model
{
    use UuidTrait;
    use SoftDeletes;

    protected $keyType = 'string';
    protected $connection = 'mysql';
    public $incrementing = false;
}
