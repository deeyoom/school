<?php
namespace App\Models;
use Illuminate\Database\Eloquent\Model;

class Subject extends Model {
    protected $fillable = ['name', 'school_class_id'];
}