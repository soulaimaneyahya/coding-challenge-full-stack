<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Category;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\RedirectResponse;
use App\Http\Requests\CategoryRequest;
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
     * @return RedirectResponse
     */
    public function store(CategoryRequest $request)
    {
        try {
            $category = $this->categoryService->store($request->validated());
            return redirect()->route('categories.edit', compact('category'))
            ->with('alert-success', 'Category Created !');
        } catch (Exception $ex) {
            return redirect()->route('categories.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Category  $category
     * @return JsonResponse
     */
    public function show(Category $category): JsonResponse
    {
        return $category;
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\CategoryRequest  $request
     * @param  \App\Models\Category  $category
     * @return RedirectResponse
     */
    public function update(CategoryRequest $request, Category $category)
    {
        try {
            $category = $this->categoryService->update($request->validated(), $category);
            return redirect()->route('categories.edit', compact('category'))->with('alert-info', 'Category Updated !');
        } catch (Exception $ex) {
            return redirect()->route('categories.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * category destroy
     * @param Category $category
     * @return RedirectResponse
     */
    public function destroy(Category $category)
    {
        try {
            $this->categoryService->delete($category->id);
            return redirect()->route('categories.index')->with('alert-info', 'Category Deleted !');
        } catch (Exception $ex) {
            return redirect()->route('categories.index')->with('alert-danger', 'Something going wrong!');
        }
    }
}
