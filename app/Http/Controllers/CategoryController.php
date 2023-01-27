<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\CategoryRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class CategoryController extends Controller
{
    public function __construct(
        private CategoryService $categoryService
    ) {
        //
    }

    /**
     * Display a listing of the resource.
     *
     * @return LengthAwarePaginator
     */
    public function index(): LengthAwarePaginator
    {
        return $this->categoryService->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @return JsonResponse
     */
    public function store(CategoryRequest $request): JsonResponse
    {
        $this->categoryService->store($request->validated());
        return response()->json([
            'message' => 'category created !',
        ], 201);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return Model
     */
    public function show(Category $category): Model
    {
        return $this->categoryService->findOne($category->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return JsonResponse
     */
    public function update(CategoryRequest $request, Category $category): JsonResponse
    {
        $this->categoryService->update($request->validated(), $category);
        return response()->json([
            'message' => 'category updated !',
        ], 200);
    }

    /**
     * category destroy
     * @param Category $category
     * @return JsonResponse
     */
    public function destroy(Category $category): JsonResponse
    {
        $this->categoryService->delete($category->id);
        return response()->json([
            'message' => 'category deleted !',
        ], 200);
    }
}
