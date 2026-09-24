<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\Testimonial;
use Illuminate\Http\Request;

class TestimonialController extends Controller
{
    public function create(Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        if ($order->status != 'selesai') {
            return redirect()
                ->back()
                ->with('error', 'Pesanan belum selesai.');
        }

        return view('testimonials.create', compact('order'));
    }

    public function store(Request $request, Order $order)
    {
        if ($order->user_id != auth()->id()) {
            abort(403);
        }

        $request->validate([
            'rating' => 'required|integer|min:1|max:5',
            'comment' => 'required|string|max:500',
        ]);

        if ($order->testimonial) {
            return back()->with(
                'error',
                'Anda sudah memberikan testimoni.'
            );
        }

        Testimonial::create([
            'user_id' => auth()->id(),
            'order_id' => $order->id,
            'rating' => $request->rating,
            'review' => $request->input('comment'),
            'status' => true,
        ]);

        return redirect()
            ->route('orders.show', $order->id)
            ->with('success', 'Terima kasih atas testimoni Anda.');
    }
}