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

    // ユーザー追加
    public function useradd() {

        $users = User::Where('is_admin' , 1)->get();
        return view('useradd', compact('users'));

    }

    // 在庫管理
    public function inventory() {

        $inventorys = Inventory::all();
        return view('inventory', compact('inventorys'));

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
        // // 入力された情報をバリデーション（適切なフォーマットかどうか）する
        // $validatedData = $request->validate([
        //     'name' => 'required|string|max:255',
        //     'planned_date' => 'required|date',
        //     'quantity' => 'required|integer|min:1',
        //     'weight' => 'required|numeric|min:0',
        // ]);

        // // バリデーションを通過した場合、データベースに登録
        // ArrivalPlan::create($validatedData);

        // // 登録後にリダイレクトする先を指定する（ここでは入荷予定一覧画面にリダイレクト）
        // return redirect()->route('arrivalplan');

        $arrivalplan = new Arrivalplan;

        $arrivalplan->product_id = $request->product_id;
        $arrivalplan->planned_date = $request->planned_date;
        $arrivalplan->quantity = $request->quantity;
        $arrivalplan->weight = $request->weight;

        $arrivalplan->save();

        return redirect()->route('arrivalplan');
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

        $product->save();

        return redirect()->route('product');
    }

    // 商品編集
    public function editproduct(Request $request)
    {

        return view('editInventory');

    }

}
