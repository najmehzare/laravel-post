<?php

namespace App\Models;

use App\Services\ElasticClient;
use Illuminate\Database\Eloquent\Model;

class Post extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var list<string>
     */
    protected $fillable = [
        'title',
        'content',
    ];

    protected static function booted()
    {
        static::saved(function ($post) {
            ElasticClient::client()->index([
                'index' => 'posts',
                'id'    => $post->id,
                'body'  => [
                    'title'   => $post->title,
                    'content' => $post->content,
                ],
            ]);
        });

        static::deleted(function ($post) {
            ElasticClient::client()->delete([
                'index' => 'posts',
                'id'    => $post->id,
            ]);
        });
    }
}
