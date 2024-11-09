<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use Illuminate\Http\JsonResponse;
use App\Http\Requests\ProductRequest;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Contracts\Pagination\LengthAwarePaginator;

/**
 * @OA\Schema(
 *     schema="ProductRequest",
 *     type="object",
 *     required={"name", "price", "description", "image"},
 *     @OA\Property(property="name", type="string", example="Product"),
 *     @OA\Property(property="description", type="string", example="Product details description"),
 *     @OA\Property(property="price", type="number", format="float", example=19.99),
 * )
 */
class ProductController extends Controller
{
    public function __construct(
        private ProductService $productService,
        private CategoryService $categoryService,
    ) {
    }

    /**
     * @OA\Get(
     *     path="/products",
     *     summary="Get list of products",
     *     description="Returns a paginated list of products",
     *     tags={"Products"},
     *     @OA\Response(
     *         response=200,
     *         description="A paginated list of products",
     *     )
     * )
     */
    public function index(): LengthAwarePaginator
    {
        return $this->productService->all();
    }

    /**
     * @OA\Post(
     *     path="/products",
     *     summary="Create a new product",
     *     description="Stores a new product in the database",
     *     tags={"Products"},
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     *     @OA\Response(
     *         response=201,
     *         description="Product created",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="product created !"),
     *             @OA\Property(property="product", ref="#/components/schemas/ProductRequest")
     *         )
     *     )
     * )
     */
    public function store(ProductRequest $request): JsonResponse
    {
        $this->productService->store($request->validated());
        return response()->json([
            'message' => 'product created !',
        ], 201);
    }

    /**
     * @OA\Get(
     *     path="/products/{id}",
     *     summary="Show product detail",
     *     description="Show product detail",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Show product detail",
     *     )
     * )
     */
    public function show(Product $product): Model
    {
        return $this->productService->findOne($product->id);
    }

    /**
     * @OA\Put(
     *     path="/products/{id}",
     *     summary="Update an existing product",
     *     description="Updates the details of an existing product",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product to update",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\RequestBody(
     *         required=true,
     *         @OA\JsonContent(ref="#/components/schemas/ProductRequest")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product updated",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="product updated !"),
     *             @OA\Property(property="product", ref="#/components/schemas/ProductRequest")
     *         )
     *     ),
     *     @OA\Response(
     *         response=404,
     *         description="Product not found",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="Product not found !")
     *         )
     *     )
     * )
     */
    public function update(ProductRequest $request, Product $product): JsonResponse
    {
        $this->productService->update($request->validated(), $product);
        return response()->json([
            'message' => 'product updated !',
        ], 200);
    }

    /**
     * @OA\Delete(
     *     path="/products/{id}",
     *     summary="Delete a product",
     *     description="Deletes an existing product from the database",
     *     tags={"Products"},
     *     @OA\Parameter(
     *         name="id",
     *         in="path",
     *         required=true,
     *         description="ID of the product to delete",
     *         @OA\Schema(type="string")
     *     ),
     *     @OA\Response(
     *         response=200,
     *         description="Product deleted",
     *         @OA\JsonContent(
     *             type="object",
     *             @OA\Property(property="message", type="string", example="product deleted !")
     *         )
     *     )
     * )
     */
    public function destroy(Product $product): JsonResponse
    {
        $this->productService->delete($product->id);
        return response()->json([
            'message' => 'product deleted !',
        ], 200);
    }
}
