<!-- resources/views/reviews/_reviews.blade.php -->
@foreach ($reviews as $review)
<div class="mb-4" id="review-{{ $review->id }}">
    <strong>{{ $review->user->name }}</strong>
    <div class="d-flex gap-2 align-items-center">
        @for ($i = 1; $i <= 5; $i++)
            @if ($i <= $review->rating)
                <span class="star full"><i class="fa-solid fa-star"></i></span>
            @else
                <span class="star empty"><i class="fa-regular fa-star"></i></span>
            @endif
        @endfor
        <small>{{ $review->created_at->diffForHumans() }}</small> <!-- Relative time -->
    </div>
    <p>{{ $review->review_text }}</p>
    @can('update', $review)
        <button class="btn btn-warning btn-sm" onclick="editReview({{ $review->id }})">Edit</button>
    @endcan
    @can('delete', $review)
        <button class="btn btn-danger btn-sm" onclick="deleteReview({{ $review->id }})">Delete</button>
    @endcan
</div>
@endforeach