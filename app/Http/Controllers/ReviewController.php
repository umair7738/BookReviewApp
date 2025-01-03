<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Review;
use App\Models\Book;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Validator;
use Illuminate\Foundation\Auth\Access\AuthorizesRequests;
use Illuminate\Support\Facades\Log;

class ReviewController extends Controller
{
    use AuthorizesRequests;
    /**
     * Display a listing of the resource.
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     */
    public function create(Request $request)
    {
        $book = Book::findOrFail($request->book_id);
        return view('reviews.create', compact('book'));

    }

    /**
     * Store a newly created resource in storage.
     */
    public function store(Request $request)
    {
        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
            'book_id' => 'required|exists:books,id',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
    
        $review = Review::create([
            'user_id' => Auth::id(),
            'book_id' => $request->book_id,
            'rating' => $request->rating,
            'review_text' => $request->review_text,
        ]);

        // Fetch all reviews for the associated book
        $reviews = $review->book->reviews; // Assuming you have a relationship set up between Review and Book models

        return response()->json([
            'status' => 'success',
            'message' => 'Review added successfully!',
            'reviews' => view('reviews._reviews', compact('reviews'))->render(),
            'reviewCount' => $reviews->count(),
            'averageRating' => $reviews->avg('rating'),
        ]);
    
        // return redirect()->route('books.show', $request->book_id)->with('success', 'Review added!');
    }

    /**
     * Display the specified resource.
     */
    public function show(string $id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     */
    public function edit($id)
    {
        // Find the review by its ID, or fail if not found
        $review = Review::find($id);
        
        // Fetch the book_id associated with the review
        $book_id = $review->book_id;  // Assuming `book_id` is a foreign key in the reviews table
        
        // Return the edit view with the review and book_id
        return view('reviews.edit', compact('review', 'book_id'));

        // Log::debug('Fetching review with ID: ' . $id); // Log review ID
    
        // $review = Review::find($id);
    
        // if (!$review) {
        //     Log::error('Review not found for ID: ' . $id);
        //     return response()->json(['error' => 'Review not found'], 404);
        // }
    
        // Log::debug('Review data:', $review->toArray());
        // return response()->json($review);
    }
    

    /**
     * Update the specified resource in storage.
     */
    public function update(Request $request, Review $review)
    {
        $this->authorize('update', $review);

        $validator = Validator::make($request->all(), [
            'rating' => 'required|integer|min:1|max:5',
            'review_text' => 'required|string',
        ]);

        if ($validator->fails()) {
            return response()->json(['status' => 'error', 'message' => $validator->errors()->first()]);
        }
        
        $review = Review::findOrFail($review->id);

        $review->update($request->only(['rating', 'review_text']));

        // Fetch all reviews for the associated book
        $reviews = $review->book->reviews; // Assuming you have a relationship set up between Review and Book models


        return response()->json([
            'status' => 'success',
            'message' => 'Review updated successfully!',
            'reviews' => view('reviews._reviews', compact('reviews'))->render(),
            'reviewCount' => $reviews->count(),
            'averageRating' => $reviews->avg('rating'),
        ]);

        // return redirect()->route('books.show', $request->book_id)->with('success', 'Review added!');
    }

    /**
     * Remove the specified resource from storage.
     */
    public function destroy(Review $review)
    {
        if ($this->authorize('delete', $review)) {
            $review->delete();

            // Fetch all reviews for the associated book
            $reviews = $review->book->reviews; // Assuming you have a relationship set up between Review and Book models


            return response()->json([
                'status' => 'success',
                'message' => 'Review updated successfully!',
                'reviews' => view('reviews._reviews', compact('reviews'))->render(),
                'reviewCount' => $reviews->count(),
                'averageRating' => $reviews->avg('rating') ?? 0,
            ]);

            // return redirect()->route('books.show', $review->book_id)->with('success', 'Review deleted!');
        }
        return redirect()->route('books.show', $review->book_id)->with('error', 'You can only delete your own reviews!');
    }
    
    // public function destroy(Review $review)
    // {
    //     $this->authorize('delete', $review);

    //     $review->delete();

    //     return redirect()->route('books.show', $review->book_id)->with('success', 'Review deleted!');
    // }
}
