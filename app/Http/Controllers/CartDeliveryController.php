<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\DeliveryAgent;
use App\Models\DeliveryAgency;
use App\Models\CartInformtion;
use App\Models\CartDelivery;
use App\Models\CartItem;
use App\Models\Product;
use App\Models\ConsumerLogin;
use App\Models\ConsumerInformation;
use App\Models\BackofficeLogin;
use App\Models\DeliveryStatusDefinition;
use App\Models\SizeDefinition;
use App\Models\ColorDefinition;
use App\Models\ConsumerBalanceSummary;
use Carbon\Carbon;
use Illuminate\Support\Facades\DB;

class CartDeliveryController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $Cartinformation = CartInformtion::where('delivery_status_id', '>=', 2)
            ->where('delivery_status_id', '<', 8)
            ->get();

        $DeliveryAgent = DeliveryAgent::all();
        $DeliveryAgency = DeliveryAgency::all();
        $DeliveryStatus = DeliveryStatusDefinition::all();
        $CartDelivery = CartDelivery::all();

        $user_id = session()->get('LoggedUser');

        $user_data = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')->where('login_id', $user_id)->get();
        foreach ($user_data as $user) {
            $role_name = $user->role_name;
        }

        return view('dashboard.delivery.cartDelivery', compact(['DeliveryAgent', 'DeliveryAgency', 'Cartinformation', 'role_name', 'DeliveryStatus', 'CartDelivery']));
    }



    public function completedDelivary()
    {
        $Cartinformation = CartInformtion::where('delivery_status_id', '>=', 8)->get();

        foreach ($Cartinformation as $info) {
            $cart_id = $info->cart_id;
        }


        $cartDelivery = CartDelivery::join('delivery_agency', 'delivery_agency.delivery_agency_id', '=', 'cart_delivery.delivery_agency_id')
            ->join('delivery_agent', 'delivery_agent.delivery_agent_id', '=', 'cart_delivery.delivery_agency_id')
            ->where('cart_delivery.cart_id', $cart_id)
            ->select('delivery_agent.*', 'delivery_agency.*', 'cart_delivery.*')
            ->get();

        $user_id = session()->get('LoggedUser');
        $user_data = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')->where('login_id', $user_id)->get();
        foreach ($user_data as $user) {
            $role_name = $user->role_name;
        }

        return view('dashboard.delivery.completedDelivary', compact(['Cartinformation', 'role_name', 'cartDelivery']));
    }



    public function acceptCart(Request $request, $id)
    {

        $cart_id = $id;
        $user_id = session()->get('LoggedUser');
        $user_data = BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')->where('login_id', $user_id)->get();
        foreach ($user_data as $user) {
            $role_name = $user->role_name;
        }

        if ($role_name == 'Office Staff' || $role_name == 'Administrator' || $role_name == 'Super Administrator') {


            $Cartinformation = CartInformtion::find($request->cart_id);

            if ($Cartinformation->delivery_status_id == 4) {
                $Cartinformation->delivery_status_id = 5;
                $Cartinformation->save();

                $CartDelivery = new CartDelivery;
                $CartDelivery->cart_id = $request->cart_id;
                $CartDelivery->delivery_agent_id = $request->delivery_agent_id;
                $CartDelivery->delivery_agency_id = $request->delivery_agency_id;
                $CartDelivery->delivery_charge_id = 1;
                $CartDelivery->payment_status = 0;
                $save = $CartDelivery->save();
            }

            if ($Cartinformation->delivery_status_id == 2) {
                $Cartinformation->delivery_status_id = 3;
                $save = $Cartinformation->save();
            }

            if ($Cartinformation->delivery_status_id == 7) {

                // select cd.delivery_id,ci.cart_id, coni.consumer_id, coni.accumulated_points, coni.cash_for_points from consumer_information coni, cart_informtion ci, cart_delivery cd
                // where coni.consumer_id = ci.consumer_id
                // and ci.cart_id = cd.cart_id
                // and cd.cart_id = 68

                $cart_delivery = CartDelivery::join('cart_informtion', 'cart_informtion.cart_id', '=', 'cart_delivery.cart_id')
                    ->join('consumer_information', 'consumer_information.consumer_id', '=', 'cart_informtion.consumer_id')
                    ->where('cart_delivery.cart_id', '=', $cart_id)
                    ->select('cart_delivery.delivery_id', 'cart_informtion.cart_id', 'consumer_information.consumer_id', 'consumer_information.accumulated_points', 'consumer_information.cash_for_points')
                    ->get();



                foreach ($cart_delivery as $cd) {
                    $accumulated_points = $cd->accumulated_points;
                    $cash_for_points = $cd->cash_for_points;
                    $consumer_id = $cd->consumer_id;
                }

                // SELECT cit.cart_id, sum(cit.point), sum(cit.point_value) 
                // FROM cart_items cit, cart_delivery cd
                // WHERE cit.cart_id = cd.cart_id
                // and cd.cart_id = 68

                $get_points = CartDelivery::join('cart_items', 'cart_items.cart_id', '=', 'cart_delivery.cart_id')
                    ->where('cart_delivery.cart_id', '=', $cart_id)
                    ->select(DB::raw("SUM(cart_items.point) as point"), DB::raw("SUM(cart_items.point_value) as point_value"), 'cart_items.cart_id')
                    ->groupBy('cart_items.cart_id')
                    ->get();

                foreach ($get_points as $get) {
                    $new_accumulated_points = $accumulated_points + $get->point;
                    $new_cash_value = $cash_for_points + $get->point_value;
                }



                $ConsumerBalanceSummary = ConsumerBalanceSummary::where('consumer_id', '=', $consumer_id)->first();
                $ConsumerBalanceSummary->last_updated_on = Carbon::now()->toDateTimeString();

                $ConsumerBalanceSummary->total_accumulated_points = $new_accumulated_points;
                // dd($new_accumulated_points);
                $ConsumerBalanceSummary->total_accumulated_taka_for_points = $new_cash_value;
                $ConsumerBalanceSummary->total_claimable_points = $new_accumulated_points;
                $ConsumerBalanceSummary->total_claimable_taka_for_points = $new_cash_value;
                $save = $ConsumerBalanceSummary->save();

                // $new_accumulated_points = coni.accumulated_points + sum(cit.point)
                // $new_cash_value = coni.cash_for_points + sum(cit.point_value)

                $cartinfo = CartInformtion::where('cart_id', '=', $cart_id)->select('consumer_id')->first();

                $CInfo = ConsumerInformation::where('consumer_id', '=', $cartinfo->consumer_id)->first();

                $CInfo->accumulated_points = $new_accumulated_points;
                $CInfo->cash_for_points = $new_cash_value;
                $CInfo->save();

                //update consumer_information set accumulated points = $new_accumulated_points, cash_for_points=$new_cash_value where consumer_id = (select consumer_id from cart_information where cart_id = 68)



                $Cartinformation->delivery_status_id = 8;
                $save = $Cartinformation->save();
            }
        }

        if ($role_name == 'Warehouse Incharge') {

            $Cartinformation = CartInformtion::find($request->cart_id);
            $Cartinformation->delivery_status_id = 4;
            $save = $Cartinformation->save();
        }

        if ($role_name == 'Delivery Agency') {

            $Cartinformation = CartInformtion::find($request->cart_id);
            $Cartinformation->delivery_status_id = 6;
            $save = $Cartinformation->save();
        }

        if ($role_name == 'Delivery Agent') {

            $Cartinformation = CartInformtion::find($request->cart_id);
            $Cartinformation->delivery_status_id = 7;
            $save = $Cartinformation->save();
        }

        if ($save) {
            return redirect()->back()->with('success', 'Delivery Confirmed');
        } else {
            return redirect()->back()->with('fail', 'Something went wrong, failed to register');
        }
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function getCartItem($id = 0)
    {
        // Fetch Agents by Agency
        $cartData['data'] = Product::join('cart_items', 'cart_items.product_id', '=', 'products.product_id')
            ->where('cart_items.cart_id', $id)
            ->select('products.*', 'cart_items.*')
            ->get();

        return response()->json($cartData);
    }


    public function orderDetails($id)
    {
        $cart_id = $id;
        $CartInfo = CartInformtion::where('cart_id', '=', $cart_id)->get();

        $CartItem = CartItem::join('cart_informtion', 'cart_informtion.cart_id', '=', 'cart_items.cart_id')
            ->join('products', 'products.product_id', '=', 'cart_items.product_id')
            ->join('purchase_details', 'purchase_details.product_id', '=', 'products.product_id')
            ->where('cart_informtion.cart_id', '=', $cart_id)
            ->select(
                'cart_informtion.*',
                'cart_items.size_id',
                'cart_items.quantity',
                'cart_items.color_id',
                'cart_items.total_price',
                'products.product_id',
                'products.product_name',
                'purchase_details.sales_price'
            )
            ->get();

        foreach ($CartItem as $Item) {
            $consumer_id = $Item->consumer_id;
        }


        $Consumer_details = ConsumerLogin::join('consumer_information', 'consumer_information.consumer_id', '=', 'consumer_Login.consumer_id')
            ->where('consumer_information.consumer_id', '=', $consumer_id)
            ->select('consumer_information.*', 'consumer_Login.*')
            ->get();

        $size_definition = SizeDefinition::all();
        $color_definition = ColorDefinition::all();

        return view('dashboard.delivery.orderDetails', compact(['CartItem', 'Consumer_details', 'CartInfo', 'color_definition', 'size_definition']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
}
