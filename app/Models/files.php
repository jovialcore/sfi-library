<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

use Carbon\Carbon;

class files extends Model
{
    use HasFactory;

        protected $fillable = ['name', 'file_type', 'path', 'size', 'user_id', 'category_id' ];

        public function category() {
            return $this->belongsTo(category::class);
        }


        public function User() {
            return $this->belongsTo(User::class);
        }


    //lets write the format for the date

    public function getTimeAttribute(){
        return (Carbon::parse($this->updated_at))->diffForHumans();
    }

}
