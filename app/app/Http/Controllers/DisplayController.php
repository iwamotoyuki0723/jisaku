<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

use App\User;
use App\Inventory;


use Illuminate\Support\Facades\Auth;


class DisplayController extends Controller
{
    

    public function index() {

        return view('home');
    }

    public function useradd() {

        $users = User::all();
        return view('useradd', compact('users'));

    }

    public function inventory() {

        $inventorys = Inventory::all();
        return view('inventory', compact('inventorys'));

    }

    public function search(Request $request)
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
        return view('inventory.index', compact('inventories'));
    }
}
