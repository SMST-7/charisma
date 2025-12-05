<?php

namespace App\Http\Controllers\Panel;

use App\Http\Controllers\Controller;
use App\Models\ActivityLog;
use App\Models\Product;
use App\Models\Review;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class reviewController extends Controller
{

    public function index()
    {
        $reviews = Review::with(['user','product'])->latest()->paginate(10);
        return view('panel.reviews.index', compact('reviews'));
    }


    public function show($id)
    {
        $review = Review::with(['user','product','parent'])->findOrFail($id);
        return view('panel.reviews.show', compact('review'));
    }

    /**
     * تغییر وضعیت نظر (pending → approved → rejected)
     */
    public function toggleStatus($id)
    {
        $review = Review::findOrFail($id);

        switch ($review->status) {
            case 'pending':
                $review->status = 'approved';
                break;
            case 'approved':
                $review->status = 'rejected';
                break;
            case 'rejected':
                $review->status = 'pending';
                break;
        }

        $review->save();

        ActivityLog::record('ویرایش', 'نظر', $review->id, 'Updated review titled: ' . $review->title);


        return redirect()->back()->with('update', 'وضعیت نظر تغییر کرد.');
    }

    public function store(Request $request, Product $product)
    {
        $request->validate([
            'comment' => 'required|string|max:1000',
            'rating' => 'required|integer|min:1|max:5',
        ]);

        $review = new Review();
        $review->user_id = Auth::id();
        $review->product_id = $product->id;
        $review->comment = $request->comment;
        $review->rating = $request->rating;
        $review->status = 'pending';
        $review->save();

        ActivityLog::record('ایجاد', 'نظر', $review->id, 'Created a new review titled: ' . $review->title);

        return back()->with('success', 'نظر شما با موفقیت ثبت شد.');
    }


    public function destroy($id)
    {
     //
    }
}
