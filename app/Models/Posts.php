<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Posts extends Model
{
    use HasFactory;

    protected $fillable =[
        'title',
        'body',
        'images'
    ];
    protected $dates = [
        'created_at',
        'updated_at',
        // your other new column
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }
    public function comments(){
        return $this->hasMany(Comment::class);
    }

    public function setTitleAttribute($value){
        $this->attributes['title'] =  $value;
        $this->attributes['slug'] = Str::slug($value)."-".Str::random(40);
    }
    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
    // public function getUpdatedDateAttribute(){
    //     return $this->updated_at->diffForHumans();
    // }
    public function getUrlAttribute(){
        return route("posts.show",$this->slug);
    }
    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body); 
    }

}
