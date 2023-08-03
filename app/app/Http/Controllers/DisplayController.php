<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Inventory;
use App\Arrivalplan;
use App\Product;


use Illuminate\Support\Facades\Auth;

use Illuminate\Support\Facades\Hash;



class DisplayController extends Controller
{
    

    public function index() {

        return view('home');
    }

    // ユーザー追加画面
    public function useradd() {

        $users = User::Where('is_admin' , 1)->get();
        return view('useradd', compact('users'));

    }

    // ユーザー追加処理
    public function addUser(Request $request) {

        $users = new User;

        $users->name = $request->name;
        $users->email = $request->email;
        $users->password = Hash::make($request->password);
        if($request->store == '店舗A'){
            $users->store_id = 1;
        }else if($request->store == '店舗B'){
            $users->store_id = 2;
        }else if($request->store == '店舗C'){
            $users->store_id = 3;
        }else if($request->store == '店舗D'){
            $users->store_id = 4;
        }else if($request->store == '店舗E'){
            $users->store_id = 5;
        }
        $users->is_admin = 1;

        $users->save();

        return redirect()->route('home');

    }

    // ユーザー検索
    public function userSearch(Request $request)
    {
        $date = $request->input('store');
        if($date == "店舗A"){
            $date = 1;
            // 日付でユーザーを検索
            $users = User::where('store_id', $date)->get();

        }else if($date == "店舗B"){
            $date = 2;
            // 日付でユーザーを検索
             $users = User::where('store_id', $date)->get();

        }else if($date == "店舗C"){
            $date = 3;
            // 日付でユーザーを検索
            $users = User::where('store_id', $date)->get();
        
        }else {
            $users = User::all();
        }


        // ビューにデータを渡す
        return view('useradd', ['users' => $users]);
        
    }

    // 在庫管理
    public function inventory()
    {
        // ログインしているユーザーの管理権限をチェック
        $isAdmin = Auth::user()->is_admin;

        if ($isAdmin == 0) {
            // 管理ユーザーは全ての店舗の在庫を取得
            $inventories = Inventory::all();
        } else {
            // 一般ユーザーは自分の店舗IDに対応する在庫のみ取得
            $storeId = Auth::user()->store_id;
            $inventories = Inventory::where('store_id', $storeId)->get();
        }

        $inventoryNames = [];
        foreach ($inventories as $inventory) {
            $product = Product::find($inventory->product_id);
            if ($product) {
                $inventory->product_name = $product->name;
                $inventoryNames[] = $inventory;
            }
        }

        return view('inventory', ['inventories' => $inventoryNames]);
    }

    // 在庫検索
    public function inventorysearch(Request $request)
    {
        // フォームから検索キーワードを取得する
        $store = $request->input('store');
        $name = $request->input('name');
        $date = $request->input('date');

        // 入力に基づいて検索を実行する
        $query = Inventory::query();
        if ($store) {
            $query->where('store', $store);
        }
        if ($name) {
            $query->where('name', 'like', '%' . $name . '%');
        }
        if ($date) {
            $query->where('date', $date);
        }

        // 検索結果を取得する
        $inventories = $query->get();

        // 検索結果をビューに渡す
        return view('inventory', compact('inventories'));
    }

    // 在庫商品モーダル
    public function getProductDetail(Request $request)
    {
        $productId = $request->product_id;
        $inventory = Product::findOrFail($productId);
        // 商品詳細情報を取得するためのビューを返す
        return response()->json($inventory);
    }


    // 入荷予定一覧
    public function arrivalplan() {

        // ログインしているユーザーのstore_idを取得
        $storeId = Auth::user()->store_id;

        // ユーザーのstore_idに対応するアイテムをデータベースから取得
        $arrivalplans = Arrivalplan::where('store_id', $storeId)->get();

        $arrivalplansNames = [];
        foreach ($arrivalplans as $arrivalplan) {
            $product = Product::find($arrivalplan->product_id);
            if ($product) {
                $arrivalplan->product_name = $product->name;
                $arrivalplansNames[] = $arrivalplan;
            }
        }

        return view('arrivalplan', ['arrivalplans' => $arrivalplansNames]);

    }

    // 入荷予定検索
    public function arrivalplansearch(Request $request)
    {
        $query = ArrivalPlan::query();

        // 商品名が入力されている場合は検索条件に追加
        if ($request->filled('name')) {
            $productId = Product::where('name', 'like', '%' . $request->input('name') . '%')->pluck('id');
            $query->whereIn('product_id', $productId);
        }

        // 予定日が入力されている場合は検索条件に追加
        if ($request->filled('date')) {
            $query->where('planned_date', '>=', $request->input('date'));
        }

        // 検索結果を取得
        $arrivalplans = $query->get();

        $arrivalplansNames = [];
        foreach ($arrivalplans as $arrivalplan) {
            $product = Product::find($arrivalplan->product_id);
            if ($product) {
                $arrivalplan->product_name = $product->name;
                $arrivalplansNames[] = $arrivalplan;
            }
        }

        return view('arrivalplan', ['arrivalplans' => $arrivalplansNames]);
    }

    // 入荷予定一覧検索クリア
    public function clearArrivalplan()
    {
        // 入荷予定一覧を全て取得してビューに渡す
        $arrivalplans = Arrivalplan::all();

        $arrivalplansNames = [];
        foreach ($arrivalplans as $arrivalplan) {
            $product = Product::find($arrivalplan->product_id);
            if ($product) {
                $arrivalplan->product_name = $product->name;
                $arrivalplansNames[] = $arrivalplan;
            }
        }

        return view('arrivalplan', ['arrivalplans' => $arrivalplansNames]);
    }

    //　入荷予定登録
    public function arrivalplancreate() {

        $products = Product::all();

        return view('createarrivalplan', ['products' => $products]);

    }

    // 入荷予定追加
    public function arrivalplanadd(Request $request)
    {

        $arrivalplan = new Arrivalplan;

        $arrivalplan->product_id = $request->product_id;
        $arrivalplan->planned_date = $request->planned_date;
        $arrivalplan->quantity = $request->quantity;
        $arrivalplan->weight = $request->weight;
        $arrivalplan->store_id = Auth::user()->store_id;

        $arrivalplan->save();

        return redirect()->route('arrivalplan');
    }

    // 入荷確定処理
        public function confirmArrivalplan(Request $request, $id)
    {
        // 入荷予定を取得
        $arrivalPlan = ArrivalPlan::findOrFail($id);

        // 在庫を検索
        $inventory = Inventory::where('product_id', $arrivalPlan->product_id)
        ->where('store_id', $arrivalPlan->store_id)
        ->first();

        // 在庫が存在しない場合は新しく作成
        if (!$inventory) {
            $inventory = new Inventory();
            $inventory->product_id = $arrivalPlan->product_id;
            $inventory->quantity = $arrivalPlan->quantity;
            $inventory->weight = $arrivalPlan->weight;
            $inventory->store_id = Auth::user()->store_id;
        } else {
            // 在庫が既に存在する場合は数量と重量を加算
            $inventory->quantity += $arrivalPlan->quantity;
            $inventory->weight += $arrivalPlan->weight;
        }

        // 在庫を保存
        $inventory->save();

        // 入荷予定を削除
        $arrivalPlan->delete();

        return redirect()->route('home');
    }

    // 商品管理
    public function product() {

        $products = Product::all();
        return view('product', compact('products'));

    }

    // 商品登録
    public function productcreate() {

        return view('createproduct');

    }

    // 商品追加
    public function productadd(Request $request)
    {

        $product = new Product;

        $product->name = $request->product_name;
        $product->weight = $request->weight;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageFileName);
            $product->image = 'images/' . $imageFileName;
        }

        $product->save();

        return redirect()->route('product');
    }

    // 商品編集
    public function editproduct(int $productId)
    {

        $products = Product::find($productId);

        return view('editInventory', compact('products'));

    }

    // 商品編集処理
    public function productedit(Request $request, $id)
    {

        $product = Product::find($id);

        $product->name = $request->product_name;
        $product->weight = $request->weight;

        if ($request->hasFile('image')) {
            $image = $request->file('image');
            $imageFileName = time() . '_' . $image->getClientOriginalName();
            $image->move(public_path('images'), $imageFileName);
            $product->image = 'images/' . $imageFileName;
        }

        $product->save();

        return redirect()->route('product');
    }

    // ログアウト
    public function logout()
    {
        Auth::logout();
        return redirect()->route('login');
    }

}
