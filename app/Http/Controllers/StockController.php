<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Stock;
use Illuminate\Support\Facades\DB;

class StockController extends Controller
{
    public function index()
    {
        dd(Request::segment(1));
        $categories = Product::where('category_id', 0)->orderBy('name')->get(['id', 'name']);
        
        // Поставки
        $supplies = DB::select('SELECT a.id, 
                                       a.supply_number,
                                       a.amount,
                                       a.price,
                                       a.day,
                                       b.name product_name
                                FROM (stocks a, products b)
                                WHERE a.product_id=b.id AND 
                                      a.supply_order=1');
        // Заказы
        $orders = DB::select('SELECT a.id, 
                                     a.order_number,
                                     a.amount,
                                     a.price,
                                     a.day,
                                     b.name product_name
                              FROM (stocks a, products b)
                              WHERE a.product_id=b.id AND 
                                    a.supply_order=-1');

        return view('stock.index', compact('categories', 'supplies', 'orders'));
    }

    // Поставки
    public function add_supply(Request $request)
    {
        Stock::create([
            'category_id'   => $request->category_id,
            'product_id'    => $request->product_id,
            'supply_number'     => $request->supply_number,
            'amount'        => $request->amount,
            'price'         => $request->price,
            'supply_order'  => 1,    
            'day'           => date('Y-m-d', strtotime($request->date))
        ]);

        return redirect()->route('stocks')->with("message", "Поставка успешно создалась.");
    }

    public function show_supply(Stock $supply)
    {
        $categories = Product::where('category_id', 0)->orderBy('name')->get(['id', 'name']);
        $products = Product::where('category_id', $supply->category_id)->get(['id', 'name']);
        
        return view('stock.edit_supply', compact('supply', 'categories', 'products'));
    }

    public function update_supply(Request $request, $id)
    {
        $date = date('Y-m-d H:i:s');
        Stock::where('id', $id)->update([
            'category_id'    => $request->update_category,
            'product_id'     => $request->product_id,
            'supply_number'  => $request->supply_number,
            'amount'         => $request->amount,
            'price'          => $request->price,
            'day'            => date('Y-m-d', strtotime($request->date)),
            'updated_at'     => $date
        ]);

        return redirect()->route('stocks')->with('message', "Поставка успешно сохранена.");
    }

    public function destroy_supply($id)
    {
        Stock::where('id', $id)->delete();

        return redirect()->route('stocks')->with('message', 'Поставка удалена.');
    }

    // Заказы
    public function add_order(Request $request)
    {
        if ($request->last_amount >= $request->amount) {
            $query = DB::select('SELECT price FROM stocks WHERE supply_number=?', [$request->supply_number]);
            $price = $query[0]->price * 1.3; // себестоимость товара с 30% наценкой.
            Stock::create([
                'category_id'   => $request->category_id,
                'product_id'    => $request->product_id,
                'supply_number' => $request->supply_number,
                'order_number'  => $request->order_number,
                'amount'        => $request->amount,
                'price'         => $price,
                'supply_order'  => -1,    
                'day'           => date('Y-m-d', strtotime($request->date))
            ]);

            return redirect()->route('stocks')->with("message", "Заказ успешно создался.");
        } else {
            return redirect()->route('stocks')->with("message", "Извините, количество продукта в складе недостаточно.");
        }
    }

    public function show_order(Stock $order)
    {
        $categories = Product::where('category_id', 0)->orderBy('name')->get(['id', 'name']);
        
        $products = Product::where('category_id', $order->category_id)->get(['id', 'name']);
        
        $query = DB::select('SELECT a.supply_number,
                                    a.amount-COALESCE((SELECT SUM(b.amount)
                                                       FROM stocks b
                                                       WHERE a.category_id=b.category_id AND
                                                             a.product_id=b.product_id AND
                                                             a.supply_number=b.supply_number AND
                                                             b.supply_order=-1
                                                       GROUP BY b.category_id, b.product_id, b.supply_number
                                                     ), 0) AS last_amount
                            FROM stocks a
                            WHERE a.supply_order=1 AND a.supply_number=?', [$order->supply_number]);
        $last_amount = $query[0]->last_amount;

        $supplies = DB::select('SELECT a.product_id, 
                                       a.supply_number,
                                       a.amount-COALESCE((SELECT SUM(b.amount)
                                                          FROM stocks b
                                                          WHERE a.category_id=b.category_id AND
                                                                a.product_id=b.product_id AND
                                                                a.supply_number=b.supply_number AND
                                                                b.supply_order=-1
                                                          GROUP BY b.category_id, b.product_id, b.supply_number
                                                         ), 0) AS last_amount
                                FROM stocks a
                                WHERE a.supply_order=1 AND a.product_id=?
                                HAVING last_amount>0', [ $order->product_id ]);

        return view('stock.edit_order', compact('order', 'categories', 'products', 'last_amount', 'supplies'));
    }

    public function update_order(Request $request, $id)
    {
        if ($request->amount - $request->last_amount_saved <= $request->last_amount) {
            
            $date = date('Y-m-d H:i:s');
            
            $query = DB::select('SELECT price FROM stocks WHERE supply_number=?', [$request->supply_number]);
            
            $price = $query[0]->price * 1.3; // себестоимость товара с 30% наценкой.
            
            Stock::where('id', $id)->update([
                'order_number'  => $request->order_number,
                'category_id'   => $request->category_id,
                'product_id'    => $request->product_id,
                'supply_number' => $request->supply_number,
                'amount'        => $request->amount,
                'day'           => date('Y-m-d', strtotime($request->date)),
                'updated_at'    => $date
            ]);

            return redirect()->route('stocks')->with('message', "Заказ успешно сохранен.");
        } else {
            return redirect()->route('stocks')->with('message', 'Количество продукта в складе недостаточно.');
        }
    }

    public function destroy_order($id)
    {
        Stock::where('id', $id)->delete();
        return redirect()->route('stocks')->with('message', 'Заказ удален.');
    }
}
