<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        $product = DB::table('products')
            ->join('categories', 'products.category_id', '=', 'categories.id')
            ->where('products.slug', $slug)
            ->where('products.is_active', true)
            ->first([
                'products.id',
                'products.name',
                'products.slug',
                'products.series_title',
                'products.short_description',
                'products.price',
                'products.image_url',
                'products.gofood_url',
                'products.grabfood_url',
                'products.shopeefood_url',
                'categories.slug as category_slug',
                'categories.name_short as category_name',
            ]);

        if (!$product) {
            return response()->json([
                'success' => false,
                'message' => 'Produk tidak ditemukan',
            ], 404);
        }

        // options: size/ice/sugar
        $options = DB::table('product_options')
            ->where('product_id', $product->id)
            ->where('is_active', true)
            ->orderBy('type')
            ->orderBy('sort_order')
            ->get(['id', 'type', 'label', 'sort_order']);

        $optionsGrouped = [
            'size' => [],
            'ice' => [],
            'sugar' => [],
        ];
        foreach ($options as $opt) {
            $optionsGrouped[$opt->type] ??= [];
            $optionsGrouped[$opt->type][] = $opt;
        }

        // nutrition
        $nutrition = DB::table('product_nutritions')
            ->where('product_id', $product->id)
            ->first([
                'calories_kcal',
                'sugar_g',
                'protein_g',
                'fat_g',
                'note',
            ]);

        // testimonials max 10 (khusus produk ini)
        $testimonials = DB::table('testimonials')
            ->where('is_active', true)
            ->where('product_id', $product->id)
            ->orderByDesc('created_at')
            ->limit(10)
            ->get(['id', 'name', 'rating', 'message', 'avatar_url', 'created_at']);

        return response()->json([
            'success' => true,
            'data' => [
                'product' => $product,
                'options' => $optionsGrouped,
                'nutrition' => $nutrition,
                'testimonials' => $testimonials,
            ],
        ]);
    }
}
