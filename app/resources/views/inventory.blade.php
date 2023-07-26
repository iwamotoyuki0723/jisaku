@extends('layouts.app')

@section('content')
<div class="container">

    <!-- 在庫検索フォーム -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('inventory.search') }}" method="GET">
                <div class="row">
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="store">店舗</label>
                            <select name="store" id="store" class="form-control">
                                <option value="">すべて</option>
                                <option value="店舗A">店舗A</option>
                                <option value="店舗B">店舗B</option>
                                <option value="店舗C">店舗C</option>
                            </select>
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <div class="form-group">
                            <label for="date">日付</label>
                            <input type="date" name="date" id="date" class="form-control">
                        </div>
                    </div>
                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- 在庫一覧 -->
    <div class="row">
        <div class="col-md-12">
            <h3>在庫一覧</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>店舗名</th>
                        <th>名前</th>
                        <th>日付</th>
                        <th>数量</th>
                        <th>コメント</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventorys as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->store }}</td>
                        <td>{{ $inventory->name }}</td>
                        <td>{{ $inventory->date }}</td>
                        <td>{{ $inventory->amount }}</td>
                        <td>{{ $inventory->comment }}</td>
                        <td>
                            <a href="#" class="btn btn-info">詳細</a>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
