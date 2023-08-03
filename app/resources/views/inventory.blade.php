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
<div class="modal fade" id="productDetailModal" tabindex="-1" role="dialog" aria-labelledby="productDetailModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header">
                <h5 class="modal-title" id="productDetailModalLabel">商品詳細</h5>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <div class="modal-body">
                <p>商品名：<span id="product-name"></span></p>
                <p>重量：<span id="product-weight"></span></p>
                <div id="product-image"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-secondary" data-dismiss="modal">閉じる</button>
            </div>
        </div>
    </div>
</div>

@endsection

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

<script>
    $(function(){
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
                    // 商品詳細情報
                    $('#product-name').text(response.name);
                    $('#product-weight').text(response.weight);
                    $('#product-image').html('<img src="{{ asset('') }}' + response.image + '" class="img-thumbnail" alt="商品画像" style="width: 100px; height: 100px;">');
                    
                    // モーダルを表示
                    $('#productDetailModal').modal('show');
                },
                error: function() {
                    alert('商品詳細情報の取得に失敗しました。');
                }
            });
        });

    });
</script>
