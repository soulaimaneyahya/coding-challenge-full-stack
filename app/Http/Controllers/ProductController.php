<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private CategoryService $categoryService,
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
        return $this->productService->all();
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @return JsonResponse
     */
    public function store(ProductRequest $request): JsonResponse
    {
        try {
            $this->productService->store($request->validated());
            return response()->json([
                'message' => 'product created !',
            ], 201);
        } catch (Exception $ex) {
            response()->json([
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Product  $product
     * @return Model
     */
    public function show(Product $product): Model
    {
        return $this->productService->findOne($product->id);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \App\Http\Requests\ProductRequest  $request
     * @param  \App\Models\Product  $product
     * @return JsonResponse
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        try {
            $this->productService->update($request->validated(), $product);
            return response()->json([
                'message' => 'product updated !',
            ], 200);
        } catch (Exception $ex) {
            response()->json([
                'message' => $ex->getMessage(),
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return JsonResponse
     */
    public function destroy(Product $product): JsonResponse
    {
        try {
            $this->productService->delete($product->id);
            return response()->json([
                'message' => 'product deleted !',
            ], 200);
        } catch (Exception $ex) {
            response()->json([
                'message' => $ex->getMessage(),
            ]);
        }
    }
}
