@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 商品編集フォーム -->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3>商品編集</h3>
            <form action="{{ route('products.editprocess',['product_id' => $products['id'] ] ) }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" required value="{{ $products['name'] }}">
                </div>
                <div class="form-group">
                    <label for="weight">重量</label>
                    <input type="number" name="weight" id="weight" class="form-control" required value="{{ $products['weight'] }}">
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="file" name="image" id="image" class="form-control-file" required value="{{ $products['image'] }}">
                </div>
                <button type="submit" class="btn btn-primary">編集</button>
            </form>
        </div>
    </div>

</div>
@endsection
