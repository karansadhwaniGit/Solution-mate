<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Str;

class Question extends Model
{
    use HasFactory;
    protected $guarded=['id'];
    public function getUrlAttribute()
    {
        return "questions/{$this->id}";
    }
    public function getAnswerStyleAttribute()
    {
        if($this->answers_count>0){
            var_dump($this->best_answer_id);
            if($this->best_answer_id){
                return "has-best-answer";
            }
            else{
                return "answered";
            }
        }else{
            return "unanswered";
        }
    }
    public function getCreatedDateAttribute()
    {
        return $this->created_at->diffForHumans();
    }
    public function getWasUpdatedAttribute()
    {
        return $this->created_at != $this->updated_at;
    }
    public function setTitleAttribute(string $title)
    {
        $this->attributes['title']=$title;
        $this->attributes['slug']=Str::slug($title);
    }
    public function owner()
    {
        return $this->belongsTo(User::class,'user_id');
    }

}
