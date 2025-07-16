<?php

namespace App\Http\Controllers;

use App\Exceptions\CustomException;
use App\Http\Requests\PostRequest;
use App\Services\ElasticClient;
use App\Services\PostService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;

class PostController extends Controller
{
    private PostService $postService;

    public function __construct(PostService $postService)
    {
        $this->postService = $postService;
    }

    public function search(Request $request): JsonResponse
    {
        $query = $request->input('q');

        $results = ElasticClient::client()->search([
            'index' => 'posts',
            'body' => [
                'query' => [
                    'multi_match' => [
                        'query' => $query,
                        'fields' => ['title', 'content']
                    ]
                ]
            ]
        ]);

        return response()->json([
            'results' => $results['hits']['hits']
        ]);
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
