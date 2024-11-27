<link rel="stylesheet" href="{{ asset('css/shop-card.css') }}">

<div class="shop-card">
    <img src="{{ asset('storage/' . $shop->image) }}" alt="{{ $shop->name }}" class="shop-image">
    <div class="shop-details">
        <h3>{{ $shop->name }}</h3>
        <p>#{{ $shop->region->name }} #{{ $shop->genre->name }}</p>
        <a href="{{ route('shops.show', $shop->id) }}" class="btn btn-primary">詳しく見る</a>

        @auth
            <button class="favorite-btn" data-shop-id="{{ $shop->id }}">
                @if (Auth::user()->favorites()->where('shop_id', $shop->id)->exists())
                    <i class="fas fa-heart"></i> <!-- お気に入り状態のハート -->
                @else
                    <i class="far fa-heart"></i> <!-- お気に入りされていない状態のハート -->
                @endif
            </button>
        @endauth
    </div>
</div>

<script>
document.addEventListener('DOMContentLoaded', function () {
    document.querySelectorAll('.favorite-btn').forEach(function (button) {
        button.addEventListener('click', function (e) {
            e.preventDefault();

            const shopId = this.getAttribute('data-shop-id');
            const icon = this.querySelector('i');
            const isFavorite = icon.classList.contains('fas');
            const url = isFavorite ? `/favorites/${shopId}` : `/favorites`;
            const csrfToken = document.querySelector('meta[name="csrf-token"]').getAttribute('content');

            fetch(url, {
                method: isFavorite ? 'DELETE' : 'POST',
                headers: {
                    'Content-Type': 'application/json',
                    'X-CSRF-TOKEN': csrfToken,
                },
                body: JSON.stringify({ shop_id: shopId })
            })
            .then(response => response.json())
            .then(data => {
                if (data.success) {
                    if (isFavorite) {
                        icon.classList.remove('fas');
                        icon.classList.add('far');

                        // マイページの場合はページをリロードして更新
                        if (window.location.pathname === '/mypage') {
                            location.reload();
                        }
                    } else {
                        icon.classList.remove('far');
                        icon.classList.add('fas');
                    }
                } else {
                    console.error('Error in response:', data.message);
                }
            })
            .catch(error => {
                console.error('Error:', error);
            });
        });
    });
});
</script>