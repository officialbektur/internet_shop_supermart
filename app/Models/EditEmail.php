<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class EditEmail extends Model
{
    use HasFactory;
    protected $table = 'edit_emails';
    protected $guarded = false;
    protected $fillable = [];
}
