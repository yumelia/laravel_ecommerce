<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
class ReviewController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'point' => 'required|integer|min:1|max:5',
            'comment' => 'required|string',
        ]);
        $review = new Review();
        $review->user_id = auth()->user()->id;
        $review->product_id = $request->product_id;
        $review->point = $request->point;
        $review->comment = $request->comment;
        $review->save();

        toast('Terima kasih atas ulasan anda!', 'success');
        return back();
    }

}
