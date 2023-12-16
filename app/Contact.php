<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Contact extends Model
{
    protected $table = 'tbl_contacts';

    protected $fillable = [
        'id',
        'name',
        'email',
        'subject',
        'message',
    ];
}
