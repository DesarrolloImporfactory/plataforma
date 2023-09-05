<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Lesson extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'url', 'iframe', 'section_id', 'platform_id'];

    public function getCompletedAttribute(){
        return $this->users->contains(auth()->user()->id);
    }

    public function section()
    {
        return $this->belongsTo(Section::class, 'section_id', 'id');
    }

    public function platform()
    {
        return $this->belongsTo(Platform::class, 'platform_id', 'id');
    }

    public function description()
    {
        return $this->hasOne(Description::class);
    }

    public function users()
    {
        return $this->belongsToMany(User::class);
    }
    //relacion uno a uno polimorfica
    public function resource()
    {
        return $this->morphOne(Resource::class, 'resourceable');
    }
    //relacion uno a muchos polimorfica
    public function comments()
    {
        return $this->morphMany(Comment::class, 'commentable');
    }

    public function reactions()
    {
        return $this->morphMany(Raction::class, 'ractionable');
    }
}
