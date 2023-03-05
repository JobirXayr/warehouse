<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\DB;

class ActionController extends Controller
{
    public function category_products(Request $request)
    {  
        if ($request->category_id != 0) {
            $products = Product::where('category_id', $request->category_id)->orderBy('name')->get(['id', 'name']);
            
            if (count($products) == 0) {
                echo '<option value="0">Ничего не найдено.</option>';
            } else {
                echo '<option value="0">Выберите продукт</option>';
                foreach ($products as $key => $value) {
                    echo '<option value="'.$value->id.'">'.$value->name.'</option>';            
                }
            } 
        }
    }

    // проверить то, из какой партии сколько количество продуктов осталось в складе 
    public function rest_supplies(Request $request)
    {
        if ($request->product_id != 0) {
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
                                    HAVING last_amount>0', [ $request->product_id ]);

            if (count($supplies) == 0) {
                echo '<option value="0">Ничего не найдено.</option>';
            } else {
                echo '<option value="0">Выберите подходящую поставку</option>';
                foreach ($supplies as $key => $value) {
                    echo '<option value="'.$value->supply_number.'">'.$value->supply_number.'</option>';            
                }
            }
        }
    }

    public function rest_products(Request $request)
    {
        if ($request->supply_number != 0) {
            $product = DB::select('SELECT a.supply_number,
                                          a.amount-COALESCE((SELECT SUM(b.amount)
                                                             FROM stocks b
                                                             WHERE a.category_id=b.category_id AND
                                                                   a.product_id=b.product_id AND
                                                                   a.supply_number=b.supply_number AND
                                                                   b.supply_order=-1
                                                             GROUP BY b.category_id, b.product_id, b.supply_number
                                                            ), 0) AS last_amount
                                    FROM stocks a
                                    WHERE a.supply_order=1 AND a.supply_number=?', [ $request->supply_number ]);

            return $product[0]->last_amount;
        }
    }
}
