<?php

namespace App\Http\Controllers;

use App\Http\Requests\StoreProductRequest;
use App\Http\Requests\UpdateProductRequest;
use App\Http\Resources\ProductDetailResource;
use App\Models\Product;
use App\Services\ProductService;
use Illuminate\Http\JsonResponse;
use Illuminate\Http\Request;
use Illuminate\Http\Response;

class ProductController extends Controller
{
    private ProductService $productService;

    public function __construct(
        ProductService $productService
    )
    {
        $this->productService = $productService;
    }

    /**
     * Search products by keyword from Elastic Search
     * @param Request $request
     * @param string $keyword
     * @return JsonResponse
     */
    public function search(Request $request, string $keyword): JsonResponse
    {
        $searchResult = $this->productService->search($keyword);
        if ($request->input('dump') == 1) {
            $searchResult = $searchResult->getHits();
        }
        return $this->success($searchResult, "Search products successful.");
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param StoreProductRequest $request
     * @return JsonResponse
     */
    public function store(StoreProductRequest $request): JsonResponse
    {
        $product = $this->productService->store($request->all());
        return $this->success(new ProductDetailResource($product), "Store product successful.", 201);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param UpdateProductRequest $request
     * @param Product $product
     * @return Response
     */
    public function update(UpdateProductRequest $request, string $id)
    {
        $product = $this->productService->update($id, $request->all());
        return $this->success(new ProductDetailResource($product), "Update product successful.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param Product $product
     * @return Response
     */
    public function destroy(Product $product)
    {
        //
    }
}
