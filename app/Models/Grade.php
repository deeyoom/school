<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Grade extends Model {
    protected $fillable = ['student_id', 'subject_id', 'q1', 'q2', 'q3', 'q4'];
}