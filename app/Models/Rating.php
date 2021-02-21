<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Rating extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'score',
        'user_address',
        //'article_id'
    ];

    public function article(){
      return $this->belongsTo(Article::class, 'article_id');
    }

}
