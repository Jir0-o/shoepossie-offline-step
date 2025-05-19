<?php

// SalesForm Data Helper

use App\Models\CartTemporary;

if (!function_exists('SalesFormDataHelper')) {

    function SalesFormDataHelper($id)
    {
        $cart_temporary_data = CartTemporary::join('cart_temporary_items', 'cart_temporary_items.temp_cart_id', '=', 'cart_temporary.temp_cart_id')
            ->join('products', 'products.product_id', '=', 'cart_temporary_items.product_id')
            ->join('product_materials', 'product_materials.product_material_id', '=', 'cart_temporary_items.product_id')
            ->join('final_stock_table', 'final_stock_table.stock_id', '=', 'cart_temporary_items.stock_id')
            ->join('colors', 'colors.colors_id', '=', 'cart_temporary_items.color_id')
            ->join('sizes', 'sizes.size_id', '=', 'cart_temporary_items.size_id')
            ->where('cart_temporary.temp_cart_id', $id)
            ->select(
                'cart_temporary_items.*',
                'cart_temporary.*',
                'products.product_id',
                'products.sc_one_id',
                'products.product_name',
                'product_materials.product_material_name',
                'final_stock_table.sales_price',
                'final_stock_table.wholesale_price',
                'final_stock_table.purchase_id',
                'products.unit_type',
                'products.image_path',
                'products.product_image',
                'colors.colors_name',
                'sizes.size_name',
                'products.sku_no',
                'products.is_active',
            )
            ->get();

        return $cart_temporary_data;
    }
}

if (!function_exists('SalesFormTransactionHelper')) {

    function SalesFormTransactionHelper($cart_temporary_data)
    {
        $items = $cart_temporary_data->count();
        $subtotal = 0;
        $quantity = 0;
        $total_discount = 0;
        $total = 0;
        $vat = 0;
        $temp_cart_id = null;

        foreach ($cart_temporary_data as $data) {
            $subtotal += $data->temp_net_amount;
            $total_discount += $data->total_discount;
            $quantity += $data->quantity;
            $temp_cart_id = $data->temp_cart_id;
            $vat += $data->vat;
        }
        $total = $subtotal - $total_discount + $vat;;
        $paid_amount = 0;
        $due_amount = $total;
        $transaction_data = array('temp_cart_id' => $temp_cart_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);

        return $transaction_data;
    }
}
