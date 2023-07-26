@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 商品一覧 -->
    <div class="row">
        <div class="col-md-9">
            <h3>商品一覧</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>重量</th>
                        <th>編集</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($products as $product)
                    <tr>
                        <td>{{ $product->id }}</td>
                        <td>{{ $product->name }}</td>
                        <td>{{ $product->weight }}</td>
                        <td>
                            <a href="{{ route('products.edit', ['product_id' => $product->id]) }}" class="btn btn-info">編集</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 商品登録ボタン -->
        <div class="col-md-3">
            <a href="{{ route('products.create') }}" class="btn btn-primary">商品登録</a>
        </div>
    </div>

</div>
@endsection
