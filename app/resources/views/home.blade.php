@extends('layouts.app')

@section('content')
<div class="container">

    <!-- トップ画面コンテンツ -->
    <div class="content">
        <div class="menu-buttons">
            <a href="{{ route('inventory') }}" class="menu-button" style="background-color: #ff6f69; padding: 30px 50px; font-size: 24px;">在庫管理</a>
            <a href="{{ route('arrivalplan') }}" class="menu-button" style="background-color: #ffcc5c; padding: 30px 50px; font-size: 24px;">入庫予定管理</a>
            @if(Auth::user()->is_admin == 0)
            <a href="{{ route('product') }}" class="menu-button" style="background-color: #88d8b0; padding: 30px 50px; font-size: 24px;">商品管理</a>
            <a href="{{ route('user.add') }}" class="menu-button" style="background-color: #b0c4de; padding: 30px 50px; font-size: 24px;">ユーザー追加</a>
            @endif
        </div>
    </div>
</div>
@endsection

<!-- スタイルシートの追加 -->
@push('styles')
<style>
    body {
        padding-top: 70px; /* メニューバーの高さ分の余白を作成 */
    }
    .navbar {
        background-color: #333;
        color: #fff;
    }
    .navbar a {
        color: #fff;
        text-decoration: none;
        margin-right: 10px;
    }
    .navbar a:hover {
        color: #ddd;
    }
    .navbar .logout-btn {
        margin-left: auto;
    }
    .content {
        display: flex;
        justify-content: center;
        align-items: center;
        height: calc(100vh - 70px); /* 画面の高さからメニューバーの高さを引いた分の余白を作成 */
    }
    .menu-buttons {
        display: flex;
        flex-direction: column;
        align-items: center;
        gap: 20px;
        margin-top: 20px; /* ボタンの上に余白を作成 */
    }
    .menu-button {
        color: #fff;
        border: none;
        border-radius: 5px;
        cursor: pointer;
        width: 300px;
        text-align: center;
    }
</style>
@endpush

