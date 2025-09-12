@foreach ($reviews as $review)
    <div class="review-card">
        <div class="reviewer-profile">
            <img src="assets/img/person/person-f-3.webp" alt="Customer"
                class="profile-pic">
            <div class="profile-details">
                <div class="customer-name">{{ $review->user->name }}</div>
                <div class="review-meta">
                    <div class="review-stars">
                        @for ($i = 1; $i <= 5; $i++)
                            <i class="bi bi-star{{ $i <= $review->rating ? '-fill' : '' }}"></i>
                        @endfor
                    </div>
                    <span class="review-date">{{ $review->created_at }}</span>
                </div>
            </div>
        </div>
        <div class="review-text">
            <p>{{ $review->review }}</p>
        </div>
        <div class="review-actions">
            <button class="action-btn"><i class="bi bi-hand-thumbs-up"></i> Helpful
                (12)</button>
            <button class="action-btn"><i class="bi bi-chat-dots"></i> Reply</button>
        </div>
    </div>
@endforeach