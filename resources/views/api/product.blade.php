@extends('layouts.app')
@section('content')
<main>
    <div class="container-fluid px-4">
        <h3 class="mt-4">All Prodcuts(API)</h3>

        <div class="card">
            <div class="card-body">
                <table id="myTable">
                    <thead>
                        <tr>
                            <th>#</th>
                            <th>Title</th>
                            <th>Category</th>
                            <th>Brand</th>
                            {{-- <th>Description</th> --}}
                            <th>Price</th>
                            <th>Rating</th>
                            <th>Image</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                    <tbody>
                        @foreach ($products as $product)
                        <tr>
                            <td>{{ $product['id'] }}</td>
                            <td>{{ $product['title']}}</td>
                            <td>{{ $product['category']}}</td>
                            <td>{{ $product['brand'] }}</td>
                            {{-- <td>{{ Str::limit($product['description'], 25, '..') }}</td> --}}
                            {{-- <td>{{ $product['price']." $"  }} --}}
                            <td>
                                @php
                                    $productPrice = $product['price'];
                                    $dicountPrice = 50.00;

                                    if($productPrice >= 499)
                                    {
                                        $discountAmount = $productPrice * ($dicountPrice / 100);
                                        $finalAmount = $productPrice - $discountAmount;
                                    }
                                    else
                                    {
                                        $finalAmount = $product['price'];
                                    }

                                @endphp
                                <span>{{ $finalAmount." $"  }}</span>
                            </td>
                            <td>
                                @if (round($product['rating']) == 4 || round($product['rating']) == 5)
                                    @for ($i = 1; $i <= round($product['rating']); $i++)
                                        <span class="fa fa-star checked" style="color:green;"></span>
                                    @endfor
                                @endif
                            </td>
                            <td><img src="{{ $product['thumbnail'] }}" alt="" height="50px" width="50px"></td>
                            <td><a href="javascript:void(0)" class="btn btn-light btn-sm">Buy Now</a></td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</main>
@endsection
