<?php

namespace App\Services;

use App\Models\Product;

interface IProductService
{
    public function search(string $text);
    public function paginate(array $filter);
    public function store(array $attributes): Product;
    public function update(array $attributes): Product;
    public function delete(string $uuid): bool;
}
