@extends('layouts.master')

@section('title','Asosiy Menu')

@section('content')
    <h1>Barcha maxsulotlar</h1>

    <div class="row">
        @foreach($products as $product)
            @include('layouts.card', compact('product'))
        @endforeach
    </div>
@endsection

