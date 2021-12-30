<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class todo extends Model
{
    use HasFactory;

    protected $table = "todo";

    protected $fillable = ['title', 'content', 'image', 'startdate', 'enddate', 'added_by'];

    public $timestamps = false;
}