@extends('layouts.master')

@section('title', 'Xarid savatchasi')

@section('content')

    <h1>Xarid savatchasi</h1>
    <p>Buyurtmani ko'rib chiqish</p>
    <div class="panel">
        <table class="table table-striped">
            <thead>
            <tr>
                <th>Tovar Nomi</th>
                <th>Soni</th>
                <th>Narxi</th>
                <th>Summasi</th>
            </tr>
            </thead>
            <tbody>

            @foreach($order->products as $product)
                <tr>
                    <td>
                        <a href="{{ route('product', [$product->category->code, $product->code]) }}">
                            <img height="56px" src="http://internet-shop.tmweb.ru/storage/products/iphone_x.jpg">
                            {{ $product->name }}
                        </a>
                    </td>
                    <td><span class="badge">{{ $product->pivot->count }}</span>
                        <div class="btn-group form-inline">
                            <form action="{{ route('basket-remove' , [$product]) }}" method="POST">
                                <button type="submit" class="btn btn-danger">
                                    <span class="glyphicon glyphicon-minus" aria-hidden="true"></span>
                                </button>
                                @csrf
                            </form>

                            <form action="{{ route('basket-add' , [$product]) }}" method="POST">
                                <button type="submit" class="btn btn-success">
                                    <span class="glyphicon glyphicon-plus" aria-hidden="true"></span>
                                </button>
                                @csrf
                            </form>
                        </div>
                    </td>
                    <td>${{ $product->price }}</td>
                    <td>${{ $product->getPriceForCount() }}</td>
                </tr>
            @endforeach

            <tr>
                <td colspan="3">Umumiy summa:</td>
                <td>${{$order->getFullPrice()}}</td>
            </tr>
            </tbody>
        </table>
        <br>
        <div class="btn-group pull-right" role="group">
            <a type="button" class="btn btn-success" href="{{ route('basket-place') }}">
                Buyurtmani oformit qilish</a>
        </div>
    </div>
@endsection
