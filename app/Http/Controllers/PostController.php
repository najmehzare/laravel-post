<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\PostRequest;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function index(): JsonResponse
    {
        return response()->json($this->postService->getAll());
    }

    /**
     * @throws CustomException
     */
    public function store(PostRequest $request): JsonResponse
    {
        return response()->json($this->postService->create($request->validated()));
    }
}
