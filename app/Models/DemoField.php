<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class DemoField extends Model
{
    use HasFactory;

    protected $fillable = [
        "firstName",
        "lastName",
        "executionTime"
    ];

    public $timestamps = false;
}
