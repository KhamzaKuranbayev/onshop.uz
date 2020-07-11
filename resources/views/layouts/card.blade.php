<div class="col-sm-6 col-md-4">
    <div class="thumbnail">
        <img src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg" alt="iPhone X 64GB">
        <div class="caption">
            <h3>{{ $product->name }}</h3>
            <h4 class="alert-danger">${{ $product->price }}</h4>
            <form action="{{ route('basket-add', [$product]) }}" method="POST">
                <button type="submit" class="btn btn-primary" role="button">Xarid savatchasiga joylash</button>
                <a href="{{ route('product', [$product->category->code, $product->code]) }}"
                   class="btn btn-warning"
                   role="button">Batafsil</a>
                @csrf
            </form>
        </div>
    </div>
</div>
