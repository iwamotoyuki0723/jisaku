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
        <div class="col-md-9">
            <h3>入荷予定一覧</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>予定日</th>
                        <th>入荷確定</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($arrivalplans as $plan)
                    <tr>
                        <td>{{ $plan->id }}</td>
                        <td>{{ $plan->product_name }}</td>
                        <td>{{ $plan->planned_date }}</td>
                        <td>
                            <button class="btn btn-success">入荷確定</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- 入荷予定検索フォーム -->
        <div class="col-md-3">
            <h3>入荷予定検索</h3>
            <form action="{{ route('arrivalplans.search') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="scheduled_date">予定日</label>
                    <input type="date" name="date" id="date" class="form-control" required>
                </div>
                <button type="submit" class="btn btn-primary">検索</button>
            </form>
        </div>
    </div>


</div>
@endsection
