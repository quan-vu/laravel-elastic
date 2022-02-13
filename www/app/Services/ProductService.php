<?php

namespace App\Services;

use App\Models\Product;

class ProductService implements IProductService
{

    public function search(string $text)
    {
        // TODO: Implement search() method.
    }

    public function paginate(array $filter)
    {
        // TODO: Implement paginate() method.
        return [];
    }

    public function store(array $attributes): Product
    {
        return Product::create($attributes)->refresh();
    }

    public function update(array $attributes): Product
    {
        // TODO: Implement update() method.
        return new Product();
    }

    public function delete(string $uuid): bool
    {
        // TODO: Implement delete() method.
        return true;
    }
}
