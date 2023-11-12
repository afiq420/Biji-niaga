@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">{{ __('Products Detail') }}</div>

                <div class="card-body">
                    <div class="d-flex justify-content-around">
                        <div class="text-center">
                            <img src="{{ url('storage/' . $product->image) }}" alt="{{ $product->name }}" width="200px">
                        </div>
                        
                        <div class="product-details">
                            <h1>{{ $product->name }}</h1>
                            <h6>{{ $product->description }}</h6>
                            <h3>Rp. {{ $product->price }}</h3>
                            <hr>
                            <p>{{ $product->stock }} Left</p>
                            @if(!Auth::user()->is_admin)
                                <form action="{{ route('add_to_cart', $product) }}" method="post">
                                    @csrf
                                    <div class="input-group mb-3">
                                        <input type="number" name="amount" value="1" class="form-control">
                                        <div class="input-group-append">
                                            <button class="btn btn-primary" type="submit">Add to Cart</button>
                                        </div>
                                    </div>
                                </form>
                            @else
                                <form action="{{ route('edit_product', $product) }}" method="get">
                                    <button type="submit" class="btn btn-outline-primary">Edit</button>
                                </form>
                            @endif
                        </div>
                    </div>

                    @if ($errors->any())
                        <div class="alert alert-danger mt-3">
                            <ul>
                                @foreach ($errors->all() as $error)
                                    <li>{{ $error }}</li>
                                @endforeach
                            </ul>
                        </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
