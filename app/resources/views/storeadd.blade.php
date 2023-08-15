@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card">
                <div class="card-header">店舗追加</div>

                <div class="card-body">
                    <form action="{{ route('store.add') }}" method="POST">
                        @csrf

                        <div class="form-group">
                            <label for="name">店舗名</label>
                            <input type="text" name="name" id="name" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="address">住所</label>
                            <input type="text" name="address" id="address" class="form-control" required>
                        </div>

                        <div class="form-group">
                            <label for="phone">電話番号</label>
                            <input type="text" name="phone" id="phone" class="form-control" required>
                        </div>

                        <button type="submit" class="btn btn-primary">追加</button>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
