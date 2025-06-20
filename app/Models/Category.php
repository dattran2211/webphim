<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{   
    public $timestamps = false;
    use HasFactory;
    public function movie() {
        return $this->hasMany(Movie::class)->orderby('id','DESC');
    }
    // public function country() {
    //     return $this->belongsTo(Country::class,'country_id');
    // }
    // public function genre() {
    //     return $this->belongsTo(Genre::class,'genre_id');
    // }
}
