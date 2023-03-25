<?php

namespace App;

use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    public function courses_joined()
    {
      return $this->hasMany(Courses_joined::class,'courseId','id');
    }
}
