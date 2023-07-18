<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>文具管理システム</title>
    <!-- Bootstrap CSS を読み込む（オプション） -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css">
    <!-- メニューバーのスタイル -->
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
            gap: 20px;
        }
        .menu-button {
            padding: 20px 30px;
            background-color: #007bff;
            color: #fff;
            border: none;
            border-radius: 5px;
            font-size: 18px;
            cursor: pointer;
        }
    </style>
</head>
<body>
    <!-- メニューバー -->
    <nav class="navbar fixed-top">
        <a href="#" class="navbar-brand">文具管理システム</a>
        <div class="logout-btn">
            <a href="#">ユーザー管理</a>
            <a href="#">ログアウト</a>
        </div>
    </nav>

    <!-- トップ画面コンテンツ -->
    <div class="content">
        <div class="menu-buttons">
            <button class="menu-button">在庫管理</button>
            <button class="menu-button">入庫予定管理</button>
            <button class="menu-button">商品管理</button>
        </div>
    </div>

    <!-- Bootstrap の JavaScript ファイルを読み込む（オプション） -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.min.js"></script>
</body>
</html>
