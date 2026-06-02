<?php
namespace App\Models;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Teacher extends Authenticatable {
    protected $fillable = ['full_name', 'login', 'password'];
    
    public function schoolClass() { 
        return $this->hasOne(SchoolClass::class, 'teacher_id'); 
    }
}