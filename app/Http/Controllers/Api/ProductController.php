<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ProductController extends Controller
{
    public function show(string $slug)
    {
        try {
            // 1) Ambil product + category (kolom category yang benar: name_short)
            $product = DB::table('products as p')
                ->leftJoin('categories as c', 'c.id', '=', 'p.category_id')
                ->select([
                    'p.id',
                    'p.name',
                    'p.slug',
                    'p.series_title',
                    'p.short_description',
                    'p.price',
                    'p.image_url',
                    'p.gofood_url',
                    'p.grabfood_url',
                    'p.shopeefood_url',
                    'p.category_id',
                    DB::raw('c.slug as category_slug'),
                    DB::raw('c.name_short as category_name'),
                ])
                ->where('p.slug', $slug)
                ->where('p.is_active', 1)
                ->first();

            if (!$product) {
                return response()->json([
                    'success' => false,
                    'message' => 'Produk tidak ditemukan',
                ], 404);
            }

            // 2) Options (size/ice/sugar) - dikelompokkan sesuai kebutuhan FE
            $optionsRows = DB::table('product_options')
                ->select(['id', 'type', 'label', 'sort_order'])
                ->where('product_id', $product->id)
                ->where('is_active', 1)
                ->orderBy('type')
                ->orderBy('sort_order')
                ->get();

            $options = [
                'size' => [],
                'ice' => [],
                'sugar' => [],
            ];

            foreach ($optionsRows as $row) {
                if (isset($options[$row->type])) {
                    $options[$row->type][] = $row;
                }
            }

            // 3) Nutrition (1 row)
            $nutrition = DB::table('product_nutritions')
                ->select(['calories_kcal', 'sugar_g', 'protein_g', 'fat_g', 'note'])
                ->where('product_id', $product->id)
                // ->where('is_active', 1)
                ->first();

            if (!$nutrition) {
                // fallback biar FE detail tetap aman
                $nutrition = (object) [
                    'calories_kcal' => null,
                    'sugar_g' => null,
                    'protein_g' => null,
                    'fat_g' => null,
                    'note' => null,
                ];
            }

            // 4) Testimonials untuk produk ini (kalau kosong ya kosong)
            // Kolom testimonial mungkin beda-beda di projectmu, jadi aku pakai yang paling umum:
            // name, rating, message/content, created_at.
            $testimonials = DB::table('testimonials')
                ->select([
                    'id',
                    'name',
                    'rating',
                    'message',
                    'created_at',
                ])
                ->where('product_id', $product->id)
                ->where('is_active', 1)
                ->orderByDesc('created_at')
                ->limit(20)
                ->get();

            // 5) Rating summary (buat kebutuhan tampilan "4.8 (128 ulasan)")
            $ratingAgg = DB::table('testimonials')
                ->where('product_id', $product->id)
                ->where('is_active', 1)
                ->selectRaw('COUNT(*) as total_reviews, AVG(rating) as avg_rating')
                ->first();

            $avgRating = $ratingAgg && $ratingAgg->avg_rating !== null
                ? round((float) $ratingAgg->avg_rating, 1)
                : null;

            $totalReviews = $ratingAgg ? (int) $ratingAgg->total_reviews : 0;

            return response()->json([
                'success' => true,
                'data' => [
                    'product' => $product,
                    'options' => $options,
                    'nutrition' => $nutrition,
                    'testimonials' => $testimonials,
                    'rating' => [
                        'avg' => $avgRating,
                        'count' => $totalReviews,
                    ],
                ],
            ]);
        } catch (\Throwable $e) {
            return response()->json([
                'success' => false,
                'message' => 'Server error',
                'error' => $e->getMessage(),
            ], 500);
        }
    }
}
