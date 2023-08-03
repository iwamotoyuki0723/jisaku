@extends('layouts.app')

@section('content')
<div class="container">
    
    <!-- 在庫検索フォーム -->
    <div class="row mb-4">
        <div class="col-md-12">
            <form action="{{ route('user.search') }}" method="POST">
                @csrf
                <div class="row">
                    @if(Auth::user()->is_admin == 0)
                        <div class="col-md-3">
                            <div class="form-group">
                                <label for="store">店舗</label>
                                <select name="store" id="store" class="form-control">
                                    <option value="all">すべて</option>
                                    <option value="店舗A">店舗A</option>
                                    <option value="店舗B">店舗B</option>
                                    <option value="店舗C">店舗C</option>
                                    <option value="店舗D">店舗D</option>
                                    <option value="店舗E">店舗E</option>
                                </select>
                            </div>
                        </div>
                    @endif
                    <!-- <div class="col-md-3">
                        <div class="form-group">
                            <label for="name">名前</label>
                            <input type="text" name="name" id="name" class="form-control">
                        </div>
                    </div> -->
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
                            @if ($user->store_id === 1)
                                店舗A
                            @elseif ($user->store_id === 2)
                                店舗B
                            @elseif ($user->store_id === 3)
                                店舗C
                            @else
                                不明
                            @endif
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>

        <!-- ユーザー追加フォーム -->
        <div class="col-md-6">
            <h3>ユーザー追加</h3>
            <form action="{{ route('user.add') }}" method="POST">
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
                        <option value="店舗A">店舗A</option>
                        <option value="店舗B">店舗B</option>
                        <option value="店舗C">店舗C</option>
                    </select>
                </div>
                <button type="submit" class="btn btn-primary">ユーザー追加</button>
            </form>
        </div>
    </div>

</div>
@endsection
