@extends('layouts.app')

@section('content')
<div class="container">

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
                        <td>{{ $user->store }}</td>
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
