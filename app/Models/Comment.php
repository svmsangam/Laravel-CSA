<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Comment extends Model
{
    use HasFactory;
    protected $fillable = [
        'body',
        'user_id'
    ];
    protected $dates = [
        'created_at',
        'updated_at'
    ];

    public function post(){
        return $this->belongsTo(Posts::class);
    }
    public function user(){
        return $this->belongsTo(User::class);
    }
    //eloquent event
    // public static function boot(){
    //     parent::boot();
    //     static::created(function($comment){
    //         $comment->post ()->increment('reply_count',1);
    //     });
    // }

    public function getBodyHtmlAttribute(){
        return \Parsedown::instance()->text($this->body); 
    }
    public function getCreatedDateAttribute(){
        return $this->created_at->diffForHumans();
    }
}
