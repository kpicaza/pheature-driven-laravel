@extends('base')

@push('heading')
    <div class="jumbotron">
        <div class="container">
            <h1 class="display-4 text-center">
                @if($show_brand_logo)
                    <i class="material-icons">pets</i>
                @endif
                @if($show_commercial_name)
                    {{ $commercial_name }}
                @else
                    Welcome to Site A
                @endif
            </h1>
            <hr class="my-4">
            <p class="lead text-center">
                <a class="btn btn-primary btn-lg" href="#" role="button">The Amigurumi artisan Shop</a>
            </p>
        </div>
    </div>
@endpush

@push('body')
    @if($show_home_dynamic_catalog)
        <div class="text-center">
            @foreach($catalog as $product)
                <img src="{{ $product->attachment()->find($product->picture)['relative_url'] }}" width="180px"/>
            @endforeach
        </div>
    @else
        <div class="text-center">
            <img src="/images/pink-doll.png"/>
            <img src="/images/ice-cream.png"/>
            <img src="/images/red-rabbit.png"/>
        </div>
    @endif

    @if($show_contact_info)
        <div class=" text-center mt-5">
            <i class="material-icons">twitter</i>
            <p class="lead">Make your order via DM at <strong>@amigunerumi</strong>'s Twitter account.</p>
        </div>
    @endif
@endpush
