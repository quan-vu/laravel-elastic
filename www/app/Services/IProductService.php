<?php

namespace App\Services;

use App\Models\Product;

interface IProductService
{
    public function search(string $keyword);
    public function paginate(array $filter);
    public function store(array $attributes): Product;
    public function update(string $id, array $attributes): Product;
    public function delete(string $uuid): bool;
}
