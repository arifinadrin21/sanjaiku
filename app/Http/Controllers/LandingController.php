<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\Testimonial;
use App\Models\Voucher;

class LandingController extends Controller
{
    public function index()
    {
        $products = Product::where('status', 1)
            ->latest()
            ->take(6)
            ->get();

        $testimonials = Testimonial::with('user')
            ->whereNotNull('review')
            ->where('review', '!=', '')
            ->where('status', true)
            ->latest()
            ->take(6)
            ->get();

        $vouchers = Voucher::where('start_date', '<=', now())
            ->where('expired_date', '>=', now())
            ->where('quota', '>', 0)
            ->where('status', 1)
            ->latest()
            ->get();

        return view('landing.index', compact(
            'products',
            'testimonials',
            'vouchers'
        ));
    }

    public function products()
    {
        $products = Product::where('status', 1)
            ->latest()
            ->paginate(9);

        return view('landing.products', compact('products'));
    }

    public function about()
    {
        return view('landing.about');
    }

    public function contact()
    {
        return view('landing.contact');
    }

    public function detail($slug)
    {
        $product = Product::with('variants')
            ->where('slug', $slug)
            ->firstOrFail();

        return view('landing.detail', compact('product'));
    }
}