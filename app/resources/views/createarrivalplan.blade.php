@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 入荷予定登録フォーム -->
    <div class="row">
        <div class="col-md-6 offset-md-3">
            <h3>入荷予定登録</h3>
            <form action="{{ route('arrivalplans.add') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="product_id">商品</label>
                    <select name="product_id" id="product_id" class="form-control" required>
                        @foreach ($products as $product)
                            <option value="{{ $product->id }}">{{ $product->name }}</option>
                        @endforeach
                    </select>
                </div>
                <div class="form-group">
                    <label for="planned_date">入荷予定日</label>
                    <input type="date" name="planned_date" id="planned_date" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="quantity">数量</label>
                    <input type="number" name="quantity" id="quantity" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="weight">重量</label>
                    <input type="number" name="weight" id="weight" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">登録</button>
            </form>
        </div>
    </div>

</div>
@endsection
