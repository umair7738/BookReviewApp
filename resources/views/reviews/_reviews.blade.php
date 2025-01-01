<!-- resources/views/reviews/_reviews.blade.php -->
@foreach($reviews as $review)
<div id="review-{{ $review->id }}">
    <strong>{{ $review->user->name }}</strong> ({{ $review->rating }} stars)
    <p>{{ $review->review_text }}</p>
    @can('update', $review)
        <button class="btn btn-warning btn-sm" onclick="editReview({{ $review->id }})">Edit</button>
    @endcan
    @can('delete', $review)
        <button class="btn btn-danger btn-sm" onclick="deleteReview({{ $review->id }})">Delete</button>
    @endcan
</div>
@endforeach