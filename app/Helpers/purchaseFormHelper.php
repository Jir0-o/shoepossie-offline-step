<?php

// purchaseForm Data Helper

use App\Models\PurchaseTemporary;

if (!function_exists('purchaseFormDataHelper')) {

    function purchaseFormDataHelper($id)
    {
        $cart_temporary_data = PurchaseTemporary::join('purchase_temporary_items', 'purchase_temporary_items.purchase_temporary_id', '=', 'purchase_temporaries.purchase_temporary_id')
            ->join('products', 'products.product_id', '=', 'purchase_temporary_items.product_id')
            ->where('purchase_temporaries.purchase_temporary_id', '=', $id)
            ->select(
                'purchase_temporary_items.*',
                'purchase_temporaries.*',
                'products.product_id',
                'products.product_name',
                'products.unit_type',
                'products.image_path',
                'products.product_image',
                'products.sku_no',
                'products.is_active',
            )
            ->get();
        return $cart_temporary_data;
    }
}

if (!function_exists('purchaseFormTransactionHelper')) {

    function purchaseFormTransactionHelper($cart_temporary_data)
    {
        $items = $cart_temporary_data->count();
        $subtotal = 0;
        $quantity = 0;
        $total_discount = 0;
        $total = 0;
        $vat = 0;
        foreach ($cart_temporary_data as $data) {
            $subtotal += $data->temp_net_amount;
            $total_discount += $data->discount;
            $quantity += $data->quantity;
            $purchase_temporary_id = $data->purchase_temporary_id;
            $vat += $data->vat;
        }
        $total = $subtotal - $total_discount + $vat;
        $paid_amount = 0;
        $due_amount = $total;
        $transaction_data = array('purchase_temporary_id' => $purchase_temporary_id, 'quantity' => $quantity, 'items' => $items, 'subtotal' => $subtotal, 'discount_amount' => $total_discount, 'total_payable' => $total, 'paid_amount' => $paid_amount, 'due_amount' => $due_amount, 'vat' => $vat);
        return $transaction_data;
    }
}
