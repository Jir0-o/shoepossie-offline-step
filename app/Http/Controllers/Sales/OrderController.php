<?php

namespace App\Http\Controllers\Sales;

use App\Http\Controllers\Controller;
use App\Models\BannerInformation;
use App\Models\CartInformtion;
use App\Models\CartItem;
use App\Models\CartTemporary;
use App\Models\ConsumerLogin;
use App\Models\PurchaseInfo;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Http;
use Illuminate\Support\Facades\DB;
use Carbon\Carbon;
use App\Jobs\SyncLogChunk;


use GuzzleHttp\Client;
use GuzzleHttp\Promise;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function suspendedOrders()
    {
        $CartTemporary = CartTemporary::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_temporary.created_by')->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_temporary.waiter_id')
            ->where('is_suspended', 1)
            ->select('cart_temporary.*', 'usr.full_name as created_by_name', 'wtr.full_name as waiter_name')
            ->get();
        return view('sales.suspendedOrder', compact(['CartTemporary']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function dailySalesReport()
    {
        $user_id = session()->get('LoggedUser');
        $user_data = \App\Models\BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->where('login_id', $user_id)
            ->first();
        if ($user_data->role_id == 4) {
            $current_date = Carbon::now()->format('Y-m-d');
            $CartInfo = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by') //->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
                ->where('cart_informtion.cart_date', 'like', '%' . $current_date . '%')
                ->where('cart_informtion.is_vat_show', 1)
                ->select('cart_informtion.*', 'usr.full_name as created_by_name') //, 'wtr.full_name as waiter_name')
                ->get();

            return view('sales.dailySalesReport', compact(['CartInfo']));
        } else {
            $current_date = Carbon::now()->format('Y-m-d');
            $CartInfo = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by')
                ->join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
                ->join('cart_payment_methods', 'cart_payment_methods.payment_method_id', '=', 'cart_informtion.payment_method_id')
                //->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
                ->where('cart_informtion.cart_date', 'like', '%' . $current_date . '%')
                ->select('cart_informtion.*', 'usr.full_name as created_by_name', 'consumer_login.mobile_no', 'cart_payment_methods.payment_method') //, 'wtr.full_name as waiter_name')
                ->get();



            return view('sales.dailySalesReport', compact(['CartInfo']));
        }
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function allSalesReport()
    {
        $user_id = session()->get('LoggedUser');
        $user_data = \App\Models\BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
            ->where('login_id', $user_id)
            ->first();
        if ($user_data->role_id == 4) {
            $CartInfo = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by') //->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
                ->where('cart_informtion.is_vat_show', 1)
                ->select('cart_informtion.*', 'usr.full_name as created_by_name') //, 'wtr.full_name as waiter_name')
                ->get();
            $consumer = ConsumerLogin::all();
            return view('sales.allSalesReport', compact(['CartInfo', 'consumer']));
        } else {
            $CartInfo = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by')
                ->join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
                ->join('cart_payment_methods', 'cart_payment_methods.payment_method_id', '=', 'cart_informtion.payment_method_id')
                //->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
                ->select('cart_informtion.*', 'usr.full_name as created_by_name', 'consumer_login.mobile_no', 'cart_payment_methods.payment_method') //, 'wtr.full_name as waiter_name')
                ->get();
            $consumer = ConsumerLogin::all();
            return view('sales.allSalesReport', compact(['CartInfo', 'consumer']));
        }
    }
    public function allSalesReportShowVatAdmin(Request $request)
    {
        $getAllId = $request->selectedRowIds;
        $CartInfo = CartInformtion::whereIn('cart_id', $getAllId)->get();
        foreach ($CartInfo as $CartInfo) {
            $CartInfo->is_vat_show = 1;
            $CartInfo->save();
        }
        return response()->json([
            'status' => 200,
            'success' => 'success'
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function aboutRestaurant()
    {
        $bannerInfo = BannerInformation::first();
        return view('sales.aboutRestaurant', compact(['bannerInfo']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function printInvoice($id)
    {
        $CartInformtionForPrint = CartInformtion::join('cart_items', 'cart_items.cart_id', '=', 'cart_informtion.cart_id')
            ->join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
            ->join('products', 'products.product_id', '=', 'cart_items.product_id')
            ->join('product_materials', 'product_materials.product_material_id', '=', 'cart_items.product_id')
            ->join('colors', 'colors.colors_id', '=', 'cart_items.colors_id')
            ->join('sizes', 'sizes.size_id', '=', 'cart_items.size_id')
            ->where('cart_informtion.cart_id', $id)
            ->select(
                'cart_informtion.*',
                'cart_items.*',
                'products.product_name',
                'products.cost_price',
                'products.sales_price',
                'products.bulk_price',
                'product_materials.product_material_name',
                'colors.colors_name',
                'sizes.size_name',
                'consumer_login.mobile_no'
            )
            ->get();

        $CartInformtion = CartInformtion::join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
            ->where('cart_informtion.cart_id', $id)
            ->select(
                'cart_informtion.*',
                'consumer_login.mobile_no'
            )
            ->first();
        // return 'Hello';
        return view('sales/print/printInvoice', compact(['CartInformtion', 'CartInformtionForPrint']));
    }

    public function CatWiseSell($consumer_id)
    {
        $sells = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by') //->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
            ->where('cart_informtion.consumer_id', $consumer_id)
            ->select('cart_informtion.*', 'usr.full_name as created_by_name') //, 'wtr.full_name as waiter_name')
            ->get();

        return response()->json($sells);
    }
    public function productNameQuantity($cart_id)
    {
        $cart_item_data = CartItem::join('products', 'products.product_id', '=', 'cart_items.product_id')
            ->where('cart_items.cart_id', $cart_id)
            ->select('cart_items.quantity', 'products.product_name')
            ->get();

        return response()->json($cart_item_data);
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }


    public function sync_data()
    { 
        set_time_limit(0); // Allow long process
        $chunkSize = 600;
        $failedChunks = [];

        $logDatas = DB::table('log_table')->where('status', 0)->get();

        if ($logDatas->isEmpty()) {
            return response()->json(['status' => 'no_data', 'message' => 'No data to synchronize.'], 200);
        }

        $logDatas->chunk($chunkSize)->each(function ($chunk) use (&$failedChunks) {
            $postData = [
                'logData' => $chunk->toArray()
            ];

            try {
                $response = Http::post('###', $postData);

                if ($response->successful()) {
                    DB::table('log_table')
                        ->whereIn('id', collect($chunk)->pluck('id'))
                        ->update(['status' => 1]);
                } else {
                    $ids = collect($chunk)->pluck('id')->toArray();
                    $failedChunks[] = $ids;

                    // Update status = 2 for failed rows
                    DB::table('log_table')
                        ->whereIn('id', $ids)
                        ->update(['status' => 2]);

                    Log::error('Failed to sync chunk', [
                        'response' => $response->body(),
                        'chunk' => $chunk->toArray()
                    ]);
                }
            } catch (\Exception $e) {
                $ids = collect($chunk)->pluck('id')->toArray();
                $failedChunks[] = $ids;

                DB::table('log_table')
                    ->whereIn('id', $ids)
                    ->update(['status' => 2]);

                Log::error('Exception during chunk sync', [
                    'error' => $e->getMessage(),
                    'chunk' => $chunk->toArray()
                ]);
            }
        });

        // Delete only successfully synced rows
        DB::table('log_table')->where('status', 1)->delete();

        // Final response
        if (!empty($failedChunks)) {
            return response()->json([
                'status' => 'partial_success',
                'message' => 'Some data failed to synchronize.',
                'failed_chunks' => $failedChunks
            ], 207);
        }

        return response()->json([
            'status' => 'success',
            'message' => 'Data synchronized successfully.'
        ]);
    }

    public function logCount()
    {
        $logCount = DB::table('log_table')->where('status', 0)->count();
        return response()->json(['logCount' => $logCount]);
    }

    public function monthly_sales()

    {

        // Get the current year

        $currentYear = Carbon::now()->year;

        $monthlyData = CartInformtion::select(

            DB::raw('MONTH(cart_date) as month'),

            DB::raw('SUM(total_cart_amount) as total_sum')

        )

            ->whereYear('cart_date', $currentYear)

            ->groupBy(DB::raw('MONTH(cart_date)'))

            ->get();



        // Create an array to hold month names

        $monthNames = [

            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',

            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'

        ];



        // Initialize result array with 0 counts for all months

        $result = [];



        foreach ($monthNames as $month) {

            $result[] = [

                'month' => $month,

                'total_sum' => 0,

            ];

        }



        // Transform the result to include month names and update counts

        foreach ($monthlyData as $item) {

            $result[$item->month - 1]['total_sum'] = $item->total_sum;

        }

        $d['monthNames'] = $monthNames;

        $d['monthlyData'] = $monthlyData;



        return response()->json($result);

    }



    public function monthly_purchase()

    {

        // Get the current year

        $currentYear = Carbon::now()->year;

        $monthlyData = PurchaseInfo::select(

            DB::raw('MONTH(pur_date) as month'),

            DB::raw('SUM(total_payable) as total_sum')

        )

            ->whereYear('pur_date', $currentYear)

            ->groupBy(DB::raw('MONTH(pur_date)'))

            ->get();



        // Create an array to hold month names

        $monthNames = [

            'Jan', 'Feb', 'Mar', 'Apr', 'May', 'Jun',

            'Jul', 'Aug', 'Sep', 'Oct', 'Nov', 'Dec'

        ];



        // Initialize result array with 0 counts for all months

        $result = [];



        foreach ($monthNames as $month) {

            $result[] = [

                'month' => $month,

                'total_sum' => 0,

            ];

        }



        // Transform the result to include month names and update counts

        foreach ($monthlyData as $item) {

            $result[$item->month - 1]['total_sum'] = $item->total_sum;

        }

        $d['monthNames'] = $monthNames;

        $d['monthlyData'] = $monthlyData;





        return response()->json($result);

    }
}
