<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;


class News extends Model
{
    use HasFactory;
    use Sluggable;


    /** scope for active items */
    public function scopeActiveEntries($query)
    {
        return $query->where([
            'status' => 1,
            'is_approved' => 1
        ]);
    }

    protected $fillable = ['title' , 'language' , 'category_id', 'image', 'slug' , 'content', 'meta_title' , 'meta_description'  ];

    /** scope for check language */

    public function scopeWithLocalize($query)
    {
        return $query->where(['language' => getLanguage()]);
    }

    public function tags()
    {
        return $this->belongsToMany(Tag::class  , 'news_tags');
    }

    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    public function auther()
    {
        return $this->belongsTo(Admin::class);
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title',
                'onUpdate' => true

            ]
        ];
    }



}
