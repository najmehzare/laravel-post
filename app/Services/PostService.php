<?php

namespace App\Services;

use App\Models\Post;
use Exception;
use Illuminate\Database\Eloquent\Collection;
use App\Exceptions\CustomException;

class PostService
{
    /**
     * دریافت لیست پست‌ها
     * @return Collection
     */
    public function getAll(): Collection
    {
        return Post::all();
    }

    /**
     * ایجاد پست جدید
     * @param array $data
     * @return Post
     * @throws CustomException
     */
    public function create(array $data): Post
    {
        try {
            return Post::create($data);
        } catch (Exception $e) {
            throw new CustomException("خطا در ایجاد پست" . $e);
        }
    }
}
