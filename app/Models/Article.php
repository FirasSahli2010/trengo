<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Article extends Model
{
    use HasFactory;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'title',
        'desc'
    ];

    public function views(){
      return $this->hasMany(Views::class);
    }

    public function ratings(){
      return $this->hasMany(Rating::class);
    }

    public function categories() {
      return $this->belongsToMany(Category::class, 'category_article', 'article_id', 'category_id');
    }
}
