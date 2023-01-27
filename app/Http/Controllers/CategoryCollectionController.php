<?php

namespace App\Http\Controllers;

use Illuminate\Database\Eloquent\Collection;
use App\Repositories\CategoryCollectionRepository;

class CategoryCollectionController extends Controller
{
    /**
     * get all Categories
     * @return Collection
     */
    public static function allCategories(): Collection
    {
        return CategoryCollectionRepository::allCategories();
    }
}
