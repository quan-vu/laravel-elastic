<?php

namespace App\Services;

use App\Models\Product;
use Elasticquent\ElasticquentResultCollection;

class ProductService implements IProductService
{

    public function search(string $keyword): ElasticquentResultCollection
    {
        return Product::searchByQuery([
            'match' => [
                'title' => $keyword
            ]
        ]);
    }

    public function paginate(array $filter)
    {
        // TODO: Implement paginate() method.
        return [];
    }

    public function store(array $attributes): Product
    {
        $product = Product::create($attributes)->refresh();
        $product->addAllToIndex();
        return $product;
    }

    public function update(string $id, array $attributes): Product
    {
        $product = Product::find($id);
        $product->update($attributes);
        $product->reindex();
        return $product;
    }

    public function delete(string $uuid): bool
    {
        // TODO: Implement delete() method.
        return true;
    }
}
