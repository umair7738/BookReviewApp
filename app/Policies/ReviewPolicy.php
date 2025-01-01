<?php

namespace App\Policies;

use App\Models\User;
use App\Models\Review;
use Illuminate\Support\Facades\Log;
use Illuminate\Auth\Access\HandlesAuthorization;

class ReviewPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can update the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Review $review)
    {
        // Log user ID and review user_id for debugging
        Log::debug('Checking update permission for user ID: ' . $user->id . ' and review owner ID: ' . $review->user_id);
    
        // Check if the user is the owner of the review
        $isOwner = $user->id === $review->user_id;
    
        // Log whether the user is authorized to update the review
        if ($isOwner) {
            Log::debug('User is authorized to update the review.');
        } else {
            Log::debug('User is NOT authorized to update the review.');
        }
    
        return $isOwner;
    }

    /**
     * Determine whether the user can delete the review.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Review  $review
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Review $review)
    {
        // Log user ID and review user_id for debugging
        Log::debug('Checking delete permission for user ID: ' . $user->id . ' and review owner ID: ' . $review->user_id);
    
        // Check if the user is the owner of the review
        $isOwner = $user->id === $review->user_id;
    
        // Log whether the user is authorized to delete the review
        if ($isOwner) {
            Log::debug('User is authorized to delete the review.');
        } else {
            Log::debug('User is NOT authorized to delete the review.');
        }
    
        return $isOwner;
    }
}
