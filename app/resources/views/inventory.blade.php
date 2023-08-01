<!-- resources/views/inventory.blade.php -->

@extends('layouts.app')

@section('content')
<div class="container">
    <!-- 在庫検索フォーム -->
    <!-- ...（省略）... -->

    <!-- 在庫一覧 -->
    <div class="row">
        <div class="col-md-12">
            <h3>在庫一覧</h3>
            <table class="table table-bordered">
                <thead>
                    <tr>
                        <th>ID</th>
                        <th>商品名</th>
                        <th>数量</th>
                        <th>重量</th>
                        <th>詳細</th>
                    </tr>
                </thead>
                <tbody>
                    @foreach ($inventories as $inventory)
                    <tr>
                        <td>{{ $inventory->id }}</td>
                        <td>{{ $inventory->product_name }}</td>
                        <td>{{ $inventory->quantity }}</td>
                        <td>{{ $inventory->weight }}</td>
                        <td>
                            <!-- 商品詳細ボタンを作成 -->
                            <button class="btn btn-success btn-show-product-detail" data-product-id="{{ $inventory->product_id }}">詳細</button>
                        </td>
                    </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </div>
</div>

<!-- 商品詳細用のモーダル -->
@include('product_detail_modal')

@endsection

@section('scripts')
<script>
    // 商品詳細ボタンがクリックされた時の処理
    $('.btn-show-product-detail').on('click', function() {
    
        // 商品IDを取得
        var productId = $(this).data('product-id');

        // Ajaxリクエストを送信して商品詳細情報を取得
        $.ajax({
            url: "{{ route('get.product.detail') }}",
            type: "GET",
            data: { product_id: productId },
            success: function(response) {
                // 商品詳細情報をモーダルに表示
                $('#productDetailModal .modal-body').html(response);
                // モーダルを表示
                $('#productDetailModal').modal('show');
            },
            error: function() {
                alert('商品詳細情報の取得に失敗しました。');
            }
        });
    });
</script>
@endsection
