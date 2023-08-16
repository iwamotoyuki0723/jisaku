@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- 在庫検索フォーム -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('user.search') }}" method="POST">
                @csrf
                <div class="row">
                    
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="store">店舗</label>
                                <select name="store" id="store" class="form-control">
                                    <option value="all">すべて</option>
                                    @foreach ($stores as $store)
                                        <option value="{{ $store->id }}">{{ $store->name }}</option>
                                    @endforeach
                                </select>
                            </div>
                        </div>

                    <div class="col-md-3">
                        <button type="submit" class="btn btn-primary mt-4">検索</button>
                    </div>
                </div>
            </form>
        </div>
    </div>

    <!-- ユーザー一覧 -->
    <div class="row">
        <div class="col-md-6">
            <h3>ユーザー一覧</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>名前</th>
                        <th>メールアドレス</th>
                        <th>店舗</th>
                    </tr>
                </thead>
                <tbody>
                @foreach ($users as $user)
                    <tr>
                        <td>{{ $user->id }}</td>
                        <td>{{ $user->name }}</td>
                        <td>{{ $user->email }}</td>
                        <td>
                            @foreach ($stores as $store)
                                @if ($user->store_id === $store->id)
                                    {{ $store->name }}
                                @endif
                            @endforeach
                        </td>
                    </tr>
                @endforeach
                </tbody>
            </table>
        </div>

        

        <!-- ユーザー追加フォーム -->
        <div class="col-md-6">
            <h3>ユーザー追加</h3>
            <form action="{{ route('user.store') }}" method="POST">
                @csrf
                <div class="form-group">
                    <label for="name">名前</label>
                    <input type="text" name="name" id="name" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="email">メールアドレス</label>
                    <input type="email" name="email" id="email" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="password">パスワード</label>
                    <input type="password" name="password" id="password" class="form-control" required>
                </div>
                <div class="form-group">
                    <label for="store">店舗</label>
                        <select name="store" id="store" class="form-control" required>
                            @foreach ($stores as $store)
                                <option value="{{ $store->id }}">{{ $store->name }}</option>
                            @endforeach
                        </select>
                </div>
                <button type="submit" class="btn btn-primary">ユーザー追加</button>
            </form>
            <a href="{{ route('store.add') }}" class="btn btn-secondary mt-2">店舗追加</a>
        </div>
    </div>

    <div class="row mt-4">
        <div class="col-md-6">
            <h3>店舗一覧</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>店舗名</th>
                        <th>住所</th>
                        <th>電話番号</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($stores as $store)
                        <tr>
                            <td>{{ $store->id }}</td>
                            <td>{{ $store->name }}</td>
                            <td>{{ $store->location }}</td>
                            <td>{{ $store->phone }}</td>
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>

</div>
@endsection
