@extends('layouts.app2')

@section('content')
    <div class="book">
        <div class="row">
            <div class="col">
                <h1>{{ $book->title }}</h1>
                <small id="review-summary">
                    @php
                        $rating = $reviews->avg('rating'); // Average rating
                        $fullStars = floor($rating); // Number of full stars
                        $decimal = $rating - $fullStars; // Decimal part of the rating
                        $halfStars = $decimal >= 0.5 ? 1 : 0; // One half star if decimal >= 0.5
                        $emptyStars = 5 - $fullStars - $halfStars; // Remaining empty stars
                    @endphp

                    <span id="average-rating">{{ number_format($rating, 1) }}</span>
                    <span id="stars">
                        {{-- Full stars --}}
                        @for ($i = 1; $i <= $fullStars; $i++)
                            <span class="star full">
                                <i class="fa-solid fa-star"></i>
                            </span>
                        @endfor

                        {{-- Half star --}}
                        @if ($halfStars)
                            <span class="star half">
                                <i class="fa-regular fa-star-half-stroke"></i>
                            </span>
                        @endif

                        {{-- Empty stars --}}
                        @for ($i = 1; $i <= $emptyStars; $i++)
                            <span class="star empty">
                                <i class="fa-regular fa-star"></i>
                            </span>
                        @endfor
                    </span>
                    <span id="review-count">({{ $reviews->count() }})</span>
                </small>


                <p>{{ $book->description }}</p>
                <p><strong>Author:</strong> {{ $book->author }}</p>
                <p><strong>Genre:</strong> {{ $book->genre }}</p>
                <p><strong>Published Date:</strong> {{ $book->published_date }}</p>
            </div>
        </div>
    </div>

    <div class="row">
        <div class="col-3">
            <h3>Reviews</h3>
        </div>
        <div class="col-3">
            <div class="float-end">
                @auth
                    <!-- Add Review Button -->
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#reviewModal"
                        onclick="addReview({{ $book->id }})">Add a Review</button>
                @else
                    <button class="btn btn-success" data-bs-toggle="modal" data-bs-target="#loginModal">
                        Add a Review
                    </button>
                @endauth
            </div>
        </div>
    </div>


    <div id="reviews-list">
        @foreach ($reviews as $review)
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
    </div>


    <!-- Review Modal -->
    <div class="modal fade" id="reviewModal" tabindex="-1" aria-labelledby="reviewModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="reviewModalLabel"></h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body" id="reviewModalBody">
                    <!-- The form will be loaded dynamically here -->
                </div>
            </div>
        </div>
    </div>

    <!-- Login Modal -->
    <div class="modal fade" id="loginModal" tabindex="-1" aria-labelledby="loginModalLabel" aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="loginModalLabel">Please Login or Register</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    <p>You need to be logged in to add a review. Please login or register.</p>
                    <a href="{{ route('login') }}" class="btn btn-primary">Login</a>
                    <a href="{{ route('register') }}" class="btn btn-secondary">Register</a>
                </div>
            </div>
        </div>
    </div>

    <!-- Bootstrap Confirmation Modal -->
    <div class="modal fade" id="confirmDeleteModal" tabindex="-1" aria-labelledby="confirmDeleteModalLabel"
        aria-hidden="true">
        <div class="modal-dialog">
            <div class="modal-content">
                <div class="modal-header">
                    <h5 class="modal-title" id="confirmDeleteModalLabel">Confirm Deletion</h5>
                    <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                    Are you sure you want to delete this review?
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Cancel</button>
                    <button type="button" class="btn btn-danger" id="confirmDeleteButton">Delete</button>
                </div>
            </div>
        </div>
    </div>
@endsection

@push('scripts')
    <script>
        function updateStars() {
            const averageRating = parseFloat($('#average-rating').text()); // Get the average rating
            const stars = $('#stars'); // Select the stars container
            const reviewCount = $('#review-count'); // Select the review count container

            stars.empty(); // Clear the current stars

            const fullStars = Math.floor(averageRating); // Number of full stars
            const decimal = averageRating - fullStars; // Decimal part of the rating
            const halfStar = (decimal >= 0.5) ? 1 : 0; // Determine if a half star is needed
            const emptyStars = 5 - fullStars - halfStar; // Remaining empty stars

            // Add full stars
            for (let i = 0; i < fullStars; i++) {
                stars.append('<span class="star full"><i class="fa-solid fa-star"></i></span>');
            }

            // Add half star if needed
            if (halfStar) {
                stars.append('<span class="star half"><i class="fa-regular fa-star-half-stroke"></i></span>');
            }

            // Add empty stars
            for (let i = 0; i < emptyStars; i++) {
                stars.append('<span class="star empty"><i class="fa-regular fa-star"></i></span>');
            }

            // Update the review count
            const count = parseInt(reviewCount.text().replace(/[^\d]/g,
            '')); // Get the current count (remove any non-digit characters)
            reviewCount.text(`(${count})`); // Set the review count in brackets
        }




        // Open review modal with pre-filled data for editing
        function editReview(id) {
            $.get(`/reviews/${id}/edit`, function(data) {

                // Set dynamic title for the modal (Update Review)
                $('#reviewModalLabel').text('Update Review');

                // Inject the form into the modal body
                $('#reviewModalBody').html(data);

                // Show the modal
                $('#reviewModal').modal('show').attr('aria-hidden', 'false');

            });
        }

        // Open review modal for creating
        function addReview(id) {
            // Fetch the review form content using AJAX
            $.get('/reviews/create', {
                book_id: id
            }, function(data) {
                // Set the modal title dynamically
                $('#reviewModalLabel').text('Add Review');

                // Inject the form into the modal body
                $('#reviewModalBody').html(data);

                // Show the modal
                $('#reviewModal').modal('show').attr('aria-hidden', 'false');

                // Set the book_id dynamically in the hidden input field
                $('#reviewForm').find('input[name="book_id"]').val(id);

            });
        }

        // Submit the review form using AJAX
        $(document).on('submit', '#reviewForm', function(e) {
            e.preventDefault();

            let url = $(this).attr('action');
            let method = $(this).attr('method'); // This will get the form's method (POST, PUT)
            let formData = $(this).serialize();

            $.ajax({
                url: url,
                method: method,
                data: formData,
                success: function(response) {
                    if (response.status === 'success') {
                        $('#reviews-list').html(response.reviews); // Update reviews dynamically
                        toastr.success(response.message); // Show success notification

                        // Update review count and average rating
                        $('#review-count').text(response.reviewCount);
                        $('#average-rating').text(response.averageRating.toFixed(1));

                        $('#reviewModal').modal('hide').attr('aria-hidden', 'true'); // Close modal
                        $('#reviewModalBody').empty();

                        updateStars();
                    } else {
                        toastr.error(response.message); // Show error notification
                    }
                },
                error: function(xhr, status, error) {
                    toastr.error('An error occurred while submitting the review.');
                }
            });
        });

        // Clear modal body and reset it when modal is hidden
        $('#reviewModal').on('hidden.bs.modal', function() {
            $('#reviewModalBody').empty(); // Clear modal body
        });

        let reviewIdToDelete = null;

        // Open the confirmation modal for deleting a review with ajax
        function deleteReview(id) {
            reviewIdToDelete = id; // Store the review ID to delete
            $('#confirmDeleteModal').modal('show').attr('aria-hidden', 'false'); // Show the modal
        }

        // Handle the actual deletion when the user confirms
        $('#confirmDeleteButton').click(function() {
            if (reviewIdToDelete !== null) {
                $.ajax({
                    url: `/reviews/${reviewIdToDelete}/delete`,
                    method: 'DELETE',
                    data: {
                        _token: '{{ csrf_token() }}',
                    },
                    success: function(response) {
                        if (response.status === 'success') {
                            $('#review-' + reviewIdToDelete).remove(); // Remove the review element
                            toastr.success(response.message); // Show success message
                            // Update review count and average rating
                            $('#review-count').text(response.reviewCount);
                            $('#average-rating').text(response.averageRating.toFixed(1));
                            updateStars();
                        } else {
                            toastr.error(response.message); // Show error message
                        }
                        $('#confirmDeleteModal').modal('hide').attr('aria-hidden',
                            'true'); // Close the modal
                        reviewIdToDelete = null; // Reset the review ID
                    },
                    error: function(xhr, status, error) {
                        toastr.error('An error occurred while deleting the review.');
                        $('#confirmDeleteModal').modal('hide').attr('aria-hidden',
                            'true'); // Close the modal in case of error
                        reviewIdToDelete = null; // Reset the review ID
                    }
                });
            }
        });
    </script>
@endpush
