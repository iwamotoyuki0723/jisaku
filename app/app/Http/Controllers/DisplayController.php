<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Inventory;
use App\Arrivalplan;
use App\Product;


use Illuminate\Support\Facades\Auth;


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
        $users->password = $request->password;
        if($request->store == '店舗A'){
            $users->store_id = 1;
        }else if($request->store == '店舗B'){
            $users->store_id = 2;
        }else if($request->store == '店舗C'){
            $users->store_id = 3;
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
    public function inventory() {

        $inventories = Inventory::all();

        $inventoryNames = [];
        foreach ($inventories as $inventorys) {
            $product = Product::find($inventorys->product_id);
            if ($product) {
                $inventorys->product_name = $product->name;
                $inventoryNames[] = $inventorys;
            }
        }

        return view('inventory', ['inventorys' => $inventoryNames]);

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

    // 入荷予定一覧
    public function arrivalplan() {

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

    // 入荷予定検索
    public function arrivalplansearch(Request $request)
    {
        $date = $request->input('date');

        // 日付で入荷予定を検索
        $arrivalplans = ArrivalPlan::where('planned_date', $date)->get();

        // productsテーブルから対応する商品名を取得して、配列に追加
        $arrivalplansWithProductNames = [];
        foreach ($arrivalplans as $arrivalplan) {
            $product = Product::find($arrivalplan->product_id);
            if ($product) {
                $arrivalplan->product_name = $product->name;
                $arrivalplansWithProductNames[] = $arrivalplan;
            }
        }

        // ビューにデータを渡す
        return view('arrivalplan', ['arrivalplans' => $arrivalplansWithProductNames]);
        
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

        $arrivalplan->save();

        return redirect()->route('arrivalplan');
    }

    // 入荷確定処理
    public function confirmArrivalplan(Request $request, $id) {

        $arrivalPlan = ArrivalPlan::findOrFail($id);

        $inventory = new Inventory();
        $inventory->product_id = $arrivalPlan->product_id;
        // $inventory->store_id = $arrivalPlan->store_id;
        $inventory->quantity = $arrivalPlan->quantity;
        $inventory->weight = $arrivalPlan->weight;

        $inventory->save();

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

}
