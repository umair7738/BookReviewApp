<!-- reviews/_form.blade.php -->
<form id="reviewForm" action="{{ isset($review) ? route('reviews.update', $review->id) : route('reviews.store') }}"
    method="POST">
    @csrf
    <!-- If we are updating, add the PUT method -->
    @isset($review)
        @method('PUT')
    @endisset

    <input type="hidden" name="book_id" value="{{ $book_id ?? '' }}">

    <!-- Rating Field -->
    <div class="mb-3">
        <label for="rating" class="form-label">Rating</label>
        <div id="star-rating" class="star-rating">
            <input type="hidden" id="rating" name="rating" value="{{ isset($review) ? $review->rating : 0 }}">
            @for ($i = 1; $i <= 5; $i++)
                <span data-value="{{ $i }}" class="star-popup">&#9733;</span>
            @endfor
        </div>
    </div>

    <!-- Review Text Field -->
    <div class="mb-3">
        <label for="review_text" class="form-label">Review</label>
        <textarea name="review_text" id="review_text" class="form-control" rows="3" required>{{ isset($review) ? $review->review_text : '' }}</textarea>
    </div>

    <!-- Submit Button -->
    <button type="submit" class="btn btn-primary">
        {{ isset($review) ? 'Update Review' : 'Submit Review' }}
    </button>
</form>

<!-- CSS for Star Rating -->
<style>
    /* Star Rating Styles */
    .star-rating {
        display: flex;
        gap: 5px;
        cursor: pointer;
    }

    .star-popup {
        font-size: 2rem;
        color: #ccc;
        /* Default star color */
        transition: color 0.2s ease-in-out;
    }

    .star-popup.hovered,
    .star-popup.selected {
        color: #f5c518;
        /* Filled star color */
    }
</style>

<!-- jQuery to handle hover and click events -->
<script>
    $(document).ready(function() {
        // Get the rating value from the hidden input (for editing or adding)
        let selectedRating = parseInt($('#rating').val()); // Get the initial rating value

        // Highlight stars on mouseenter (hover)
        $('.star-popup').on('mouseenter', function() {
            const value = $(this).data('value');
            highlightStars(value);
        });

        // Reset to the selected rating on mouseleave
        $('.star-popup').on('mouseleave', function() {
            highlightStars(selectedRating);
        });

        // Set the rating on click
        $('.star-popup').on('click', function() {
            selectedRating = $(this).data('value');
            $('#rating').val(selectedRating); // Update hidden input value with selected rating
            highlightStars(selectedRating);
        });

        // Highlight stars function
        function highlightStars(value) {
            $('.star-popup').each(function() {
                const starValue = $(this).data('value');
                $(this).toggleClass('hovered', starValue <= value);
                if (starValue <= selectedRating) {
                    $(this).addClass('selected');
                } else {
                    $(this).removeClass('selected');
                }
            });
        }

        // Initialize with the existing selected rating
        highlightStars(selectedRating); // This will correctly highlight the stars based on the review value
    });
</script>
