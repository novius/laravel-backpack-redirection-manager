<?php

namespace Novius\Backpack\RedirectionManager\Models;

use Backpack\CRUD\CrudTrait;
use Illuminate\Database\Eloquent\Model;

class Redirection extends Model
{
    use CrudTrait;

    protected $table = 'redirections';
    protected $primaryKey = 'id';
    protected $fillable = [
        'from',
        'to',
    ];
}
