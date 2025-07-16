@extends('layouts.app')

@section('content')
<div class="container mt-4">
    <h2>Product Details</h2>
    <div class="card">
        <div class="card-body">
            <h5 class="card-title">{{ $product->name }}</h5>
            <p class="card-text">{{ $product->details }}</p>
            <a href="{{ route('products.index') }}" class="btn btn-secondary">Back to List</a>
        </div>
    </div>
</div>
@endsection 