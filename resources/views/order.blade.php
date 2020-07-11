@extends('layouts.master')

@section('title', 'Buyurtmani tahlil qilish')

@section('content')

    <h1>Iltimos buyurtmani tasdiqlang:</h1>
    <div class="container">
        <div class="row justify-content-center">
            <p>Umumiy qiymati: <b>${{ $order->getFullPrice() }}</b></p>
            <form action="{{ route('basket-confirm') }}" method="POST">
                <div>
                    <p>Ismingiz va Telefon raqamingizni kiriting:</p>
                    <br>
                    <div class="container">
                        <div class="form-group">
                            <label for="name" class="control-label col-lg-offset-3 col-lg-2">Ism: </label>
                            <div class="col-lg-4">
                                <input type="text" name="name" id="name" value="" class="form-control">
                            </div>
                        </div>
                        <br>
                        <br>
                        <div class="form-group">
                            <label for="phone" class="control-label col-lg-offset-3 col-lg-2">Telefon
                                raqami: </label>
                            <div class="col-lg-4">
                                <input type="text" name="phone" id="phone" value="" class="form-control">
                            </div>
                        </div>
                    </div>
                    <br>
                    <input type="hidden" name="_token" value="u5qBRtrp63m5G4WPAxXui5YJkRw1TJrVuS4Fbgm5">
                    <br>
                    @csrf
                    <input type="submit" class="btn btn-success" value=" Tasdiqlash ">
                </div>
            </form>
        </div>
    </div>
@endsection
