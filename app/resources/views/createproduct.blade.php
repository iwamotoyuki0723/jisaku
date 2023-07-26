@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 商品登録フォーム -->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3>商品登録</h3>
            <form action="{{ route('products.add') }}" method="POST" enctype="multipart/form-data">
                @csrf
                <div class="form-group">
                    <label for="product_name">商品名</label>
                    <input type="text" name="product_name" id="product_name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="weight">重量</label>
                    <input type="number" name="weight" id="weight" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="image">画像</label>
                    <input type="text" name="image" id="image" class="form-control-file" required>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>

</div>
@endsection
