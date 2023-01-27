<?php

namespace App\Http\Controllers;

use Exception;
use App\Models\Product;
use App\Services\ProductService;
use App\Services\CategoryService;
use App\Http\Requests\ProductRequest;
use Illuminate\Http\RedirectResponse;
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
     * @return RedirectResponse
     */
    public function store(ProductRequest $request)
    {
        try {
            $product = $this->productService->store($request->validated());
            return redirect()->route('products.edit', compact('product'))->with('alert-success', 'Product Created !');
        } catch (Exception $ex) {
            return redirect()->route('products.index')->with('alert-danger', 'Something going wrong!');
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
     * @return RedirectResponse
     */
    public function update(ProductRequest $request, Product $product)
    {
        try {
            $product = $this->productService->update($request->validated(), $product);
            return redirect()->route('products.edit', compact('product'))->with('alert-info', 'Product Updated !');
        } catch (Exception $ex) {
            return redirect()->route('products.index')->with('alert-danger', 'Something going wrong!');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Product  $product
     * @return RedirectResponse
     */
    public function destroy(Product $product)
    {
        try {
            $this->productService->delete($product->id);
            return redirect()->route('products.index')->with('alert-info', 'Product Deleted !');
        } catch (Exception $ex) {
            return redirect()->route('products.index')->with('alert-danger', 'Something going wrong!');
        }
    }
}
