<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Course extends Model
{
    use HasFactory;

    protected $fillable = [
        'title', 'subtitle', 'description', 'status', 'slug', 'user_id',
        'level_id', 'categorie_id', 'price_id'
    ];

    protected $withCount = ['students', 'reviews'];

    const BORRADOR = 1;
    const REVISION = 2;
    const PUBLICADO = 3;

    public function getRouteKeyName()
    {
        return 'slug';
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
    public function level()
    {
        return $this->belongsTo(Level::class, 'level_id', 'id');
    }
    public function categorie()
    {
        return $this->belongsTo(Categorie::class, 'categorie_id', 'id');
    }
    public function price()
    {
        return $this->belongsTo(Price::class, 'price_id', 'id');
    }

    public function reviews()
    {
        return $this->hasMany(Review::class, 'course_id', 'id');
    }

    public function requirement()
    {
        return $this->hasMany(Requirement::class, 'course_id', 'id');
    }

    public function goal()
    {
        return $this->hasMany(Goal::class, 'course_id', 'id');
    }

    public function audience()
    {
        return $this->hasMany(Audience::class, 'course_id', 'id');
    }

    public function section()
    {
        return $this->hasMany(Section::class, 'course_id', 'id');
    }
    //relacion uno a uno polimoprfica

    public function image()
    {
        return $this->morphOne(Image::class, 'imageable');
    }

    //relacion idrecta sin tomar en cuenta la tablaintermedia
    public function lessons()
    {
        return $this->hasManyThrough(Lesson::class, Section::class);
    }

    public function teacher()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function students()
    {
        return $this->belongsToMany(User::class);
    }

    //definir un atributo 

    public function getRatingAttribute()
    {
        if ($this->reviews_count) {
            return round($this->reviews->avg('rating'), 1);
        } else {
            return 5;
        }
    }

    //query scope 

    public function scopeCategorie($query,$categorie_id){
        if ($categorie_id) {
            return $query->where('categorie_id',$categorie_id);
        }
    }

    public function scopeLevel($query,$level_id){
        if ($level_id) {
            return $query->where('level_id',$level_id);
        }
    }
}
