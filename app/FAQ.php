<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class FAQ extends Model
{
    protected $table = 'tbl_faqs';

    protected $fillable = [
        'id',
        'name',
        'email',
        'subject',
        'message',
    ];
}
