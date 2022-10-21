<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Task extends Model
{
    use HasFactory, SoftDeletes;

    protected $fillable = [
        'content',
        'priority_level',
        'deadline',
        'status',
    ];

    protected $dates = ['deadline'];


    public function user()
    {
        return $this->belongsTo(User::class, 'assigned_to', 'id');
    }
}