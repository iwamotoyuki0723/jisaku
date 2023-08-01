@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 入荷予定登録ボタン -->
    <div class="row mt-3">
        <div class="col-md-12">
            <a href="{{ route('arrivalplans.create') }}" class="btn btn-primary">入荷予定登録</a>
        </div>
    </div>

    <!-- 空間 -->
    <div class="row mt-3">
        <div class="col-md-12">
            <!-- ここに空間のコンテンツを追加する -->
        </div>
    </div>

    <!-- 入荷予定一覧 -->
    <div class="row">
        <div class="col-md-12">
            <h3>入荷予定一覧</h3>
            <form action="{{ route('arrivalplans.search') }}" method="POST">
                @csrf
                <div class="form-row mb-3">
                    <div class="col-md-4">
                        <label for="product_name">商品名</label>
                        <!-- <input type="text" name="product_name" id="product_name" class="form-control" placeholder="商品名を入力"> -->
                        <input type="text" name="name" id="name" class="form-control" value="{{ request('name') }}" placeholder="商品名を入力">
                    </div>
                    <div class="col-md-4">
                        <label for="date">予定日</label>
                        <input type="date" name="date" id="date" class="form-control">
                    </div>
                    <div class="col-md-4">
                        <button type="submit" class="btn btn-primary mt-4">検索</button>
                        <a href="{{ route('arrivalplans.clear') }}" class="btn btn-secondary mt-4">クリア</a>
                    </div>
                </div>
            </form>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>予定日</th>
                        <th>数量</th>
                        <th>重量</th>
                        <th>入荷確定</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrivalplans as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->product_name }}</td>
                        <td>{{ $plan->planned_date }}</td>
                        <td>{{ $plan->quantity }}</td>
                        <td>{{ $plan->weight }}</td>
                        <td>
                            <form action="{{ route('confirm.arrivalplans', ['id' => $plan->id]) }}" method="POST">
                                @csrf
                                <button type="submit" class="btn btn-success">入荷確定</button>
                            </form>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
