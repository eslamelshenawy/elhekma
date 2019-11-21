<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RemindTimeMeal extends Model
{
    protected $table = 'remind_time_meal';
    
        public function food()
    {
        return $this->hasMany(ReminderMeal::class, 'meal_id', 'id');
    }

}
