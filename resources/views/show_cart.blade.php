@extends('layouts.app')

@section('content')
    <div class="container">
        <div class="row justify-content-center">
            <div class="col-md-8">
                <div class="card">
                    <div class="card-header">{{ __('Cart') }}</div>

                    <div class="card-body">
                        @if ($errors->any())
                            <div class="alert alert-danger">
                                <ul>
                                    @foreach ($errors->all() as $error)
                                        <li>{{ $error }}</li>
                                    @endforeach
                                </ul>
                            </div>
                        @endif

                        @php
                            $total_price = 0;
                        @endphp

                        <div class="row">
                            @foreach ($carts as $cart)
                                <div class="col-md-4 mb-3">
                                    <div class="card">
                                        <img class="card-img-top" src="{{ url('storage/' . $cart->product->image) }}" alt="Card image cap">
                                        <div class="card-body">
                                            <h5 class="card-title">{{ $cart->product->name }}</h5>
                                            <form action="{{ route('update_cart', $cart) }}" method="post">
                                                @csrf
                                                @method('PATCH')
                                                <div class="input-group">
                                                    <input type="number" class="form-control" name="amount" value="{{ $cart->amount }}">
                                                    <div class="input-group-append">
                                                        <button class="btn btn-primary" type="submit">Update</button>
                                                    </div>
                                                </div>
                                            </form>
                                            <form action="{{ route('delete_cart', $cart) }}" method="post">
                                                @csrf
                                                @method('DELETE')
                                                <button type="submit" class="btn btn-danger mt-3">Remove Product</button>
                                            </form>
                                        </div>
                                    </div>
                                </div>
                                @php
                                    $total_price += $cart->product->price * $cart->amount;
                                @endphp
                            @endforeach
                        </div>

                        <hr class="my-md-6 mb-6">
                        <div class="d-flex flex-column justify-content-end align-items-end">
                            <p>Rp. {{ $total_price }}</p>
                            <form action="{{ route('checkout') }}" method="post">
                                @csrf
                                <button type="submit" class="btn btn-outline-success" @if ($carts->isEmpty()) disabled @endif>Checkout</button>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection
