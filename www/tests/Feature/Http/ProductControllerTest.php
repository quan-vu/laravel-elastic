<?php

namespace Tests\Feature\Http;

use App\Models\Category;
use App\Models\Product;
use Tests\BaseTestCase;

class ProductControllerTest extends BaseTestCase
{
    private array $expectedProductDetailStruct = [
        'data' => [
            'id',
            'title',
            'slug',
            'thumbnail',
            'description',
            'content',
            'category_id',
            'indexed_at',
            'created_at',
            'updated_at',
        ]
    ];

    private array $expectedProductListStruct = [
        'data' => [
            '*' => [
                'id',
                'title',
                'slug',
                'thumbnail',
                'description',
                'content',
                'category_id',
                'indexed_at',
                'created_at',
                'updated_at',
            ]
        ]
    ];

    private array $expectedProductListByElasticSearchStruct = [
        'data' => [
            'total',
            'max_score',
            'hits' => [
                '*' => [
                    '_index',
                    '_type',
                    '_id',
                    '_score',
                    '_source' => [
                        'id',
                        'title',
                        'slug',
                        'thumbnail',
                        'description',
                        'content',
                        'category_id',
                        'indexed_at',
                        'created_at',
                        'updated_at',
                    ],
                ]
            ]
        ]
    ];

    public function test_create_product()
    {
        $route = route('api.products.store');

        $category = Category::factory()->count(1)->create()->first();
        $data = [
            'title' => '1:32 Nissan GTR R35 R34 Xe Đua Mô Hình Trẻ Em Đồ Chơi Trẻ Em Xe Diecast & Đồ Chơi Xe Âm Thanh Và Ánh Sáng bé Trai Ô Tô Tặng',
            'thumbnail' => 'https://ae01.alicdn.com/kf/H9a8b7f2ccfa14f089dcfd1925988d9e1G.jpg',
            'description' => "TÊN:1: 32 Nissan NISSAN GTR R35 <br/> CHẤT LIỆU:Thân khóa bằng hợp kim, underbody nhựa, Bánh xe cao su <br/> TÍNH NĂNG:Với âm thanh và ánh sáng mở cửa lại kéo về chức năng <br/> Kích thước:14.8*6.5*4.5CM",
            'content' => "TÊN:1: 32 Nissan NISSAN GTR R35 <br/> CHẤT LIỆU:Thân khóa bằng hợp kim, underbody nhựa, Bánh xe cao su <br/> TÍNH NĂNG:Với âm thanh và ánh sáng mở cửa lại kéo về chức năng <br/> Kích thước:14.8*6.5*4.5CM",
            'category_id' => $category->id,
        ];

        $response = $this->api()->postJson($route, $data);

        $response->assertStatus(201)
            ->assertJsonStructure($this->expectedProductDetailStruct);

        $this->assertDatabaseHas('products', [
            'title' => $data['title'],
            'category_id' => $data['category_id']
        ]);
    }

    public function test_search_product()
    {
        $category = Category::factory()->count(1)->create()->first();
        $product = Product::create([
            'title' => '1:16 Xe Tăng Đồ Chơi Giáo Dục Thành Phố Quân Sự Cho Bé Trai 2022 ',
            'thumbnail' => 'https://ae01.alicdn.com/kf/H9a8b7f2ccfa14f089dcfd1925988d9e1G.jpg',
            'description' => "Xe Tăng Theo Dõi Quân Nhân Hình Viên Gạch Đồ Chơi Giáo Dục Cho Bé Trai",
            'content' => "<p>1. CHẤT LIỆU & GẠCH SỐ: Nhựa ABS Chất Lượng cao Khối Xây Gạch.</p>",
            'category_id' => $category->id,
        ]);
        $this->assertDatabaseHas('products', [
            'title' => $product->title,
            'category_id' => $product->category_id
        ]);

        $route = route('api.products.search', ['keyword' => 'xe tăng giáo dục 2022']);
        $response = $this->api()->getJson($route);

        $response->assertStatus(200)
            ->assertJsonStructure($this->expectedProductListStruct);
    }

    public function test_search_product_with_elastic()
    {
        $category = Category::factory()->count(1)->create()->first();
        $product = Product::create([
            'title' => '1:16 Xe Tăng Đồ Chơi Giáo Dục Cho Bé Trai 2022 ',
            'thumbnail' => 'https://ae01.alicdn.com/kf/H9a8b7f2ccfa14f089dcfd1925988d9e1G.jpg',
            'description' => "Thành Phố Quân Sự Điện Xe Tăng Khối Xây Dựng Kỹ Thuật Xe Tăng Cho Bé Trai",
            'content' => "<p>1. CHẤT LIỆU & GẠCH SỐ: Nhựa ABS Chất Lượng cao Khối Xây Gạch.</p> <p>2. KHÁM PHÁ MICRO KHỐI: GIÁ TRỊ Lớn</p>",
            'category_id' => $category->id,
        ]);
        $this->assertDatabaseHas('products', [
            'title' => $product->title,
            'category_id' => $product->category_id
        ]);

        $route = route('api.products.search', ['keyword' => 'xe tăng', 'dump' => 1]);
        $response = $this->api()->getJson($route);

        $response->assertStatus(200)
            ->assertJsonStructure($this->expectedProductListByElasticSearchStruct);
    }
}
