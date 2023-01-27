<?php

namespace App\Services;

use Exception;
use App\Models\Image;
use App\Models\Product;
use App\Repositories\ProductRepository;
use Illuminate\Support\Facades\Storage;
use Illuminate\Pagination\LengthAwarePaginator;

class ProductService
{
    public function __construct(
        private ProductRepository $productRepository,
        private Product $product,
        private Image $image,
    ) {
    }

    /**
     * Get All Products
     *
     * @return LengthAwarePaginator
     */
    public function all()
    {
        return $this->productRepository->all();
    }

    /**
     * findOne Category
     * @param string $id
     * @return Product
     */
    public function findOne(string $id): Product
    {
        try {
            return $this->productRepository->findOne($id);
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * Store Product
     * @param array $data
     * @return Product
     */
    public function store(array $data): Product
    {
        $product = $this->product->create($data);
        
        if (isset($data['image']) && $data['image'] instanceof \Illuminate\Http\UploadedFile) {
            $path = $data['image']->store('products');
            $product->image()->save(
                $this->image->make(['path' => $path])
            );
        }

        if (isset($data['categories'])) {
            $product->categories()->attach($data['categories']);
        }

        return $product;
    }

    /**
     * Update Product
     * @param array $data
     * @param Product $product
     * @return Product
     */
    public function update(array $data, Product $product)
    {
        if (isset($data['image'])) {
            if ($product->image) {
                Storage::delete($product->image->path);
                $product->image->delete();
            }
            if ($data['image'] instanceof \Illuminate\Http\UploadedFile) {
                $path = $data['image']->store('products');
                $product->image()->save(
                    $this->image->make(['path' => $path])
                );
            }
        }

        if (isset($data['categories'])) {
            $product->categories()->sync([]);
            $product->categories()->attach($data['categories']);
        } else {
            $product->categories()->sync([]);
        }

        $product->update($data);

        return $product;
    }

    /**
     * delete product
     * @param string $id
     * @return void
     */
    public function delete(string $id)
    {
        try {
            $this->findOne($id)->delete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    /**
     * delete forceDelete product
     * @param string $id
     * @return void
     */
    public function forceDelete(string $id)
    {
        try {
            $product = $this->findOne($id);
            $product->categories()->sync([]);
            $product->forceDelete();
        } catch (Exception $ex) {
            throw $ex;
        }
    }
}
