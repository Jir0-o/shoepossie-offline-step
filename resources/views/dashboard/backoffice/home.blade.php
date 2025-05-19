@php
    use Carbon\Carbon;
    use Illuminate\Support\Facades\DB;
    use App\Models\CartInformtion;
    $user_id = session()->get('LoggedUser');
    $user_data = \App\Models\BackofficeLogin::join('backoffice_role', 'backoffice_role.role_id', '=', 'backoffice_login.role_id')
        ->where('login_id', $user_id)
        ->first();
@endphp

@extends('layouts.layout')

@section('content')
    @php
        $all_cart_info = \App\Models\CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by')
            ->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
            ->select('cart_informtion.*', 'usr.full_name as created_by_name', 'wtr.full_name as waiter_name')
            ->get();
    @endphp 

    <style>
        .uni-card {
            gap: 16px;
            height: 100%;
            padding: 16px;
            display: flex;
            color: #1c293d;
            border-radius: 8px;
            align-items: center;
            box-shadow: 0px 2px 34px #1d185c22;
        }
    </style>

    <div class="container-scroller">
        @include('dashboard.pertials.sideNav')
        <div class="container-fluid page-body-wrapper">
            <div id="theme-settings" class="settings-panel">
                <i class="settings-close mdi mdi-close"></i>
                <p class="settings-heading">SIDEBAR SKINS</p>
                <div class="sidebar-bg-options selected" id="sidebar-default-theme">
                    <div class="img-ss rounded-circle bg-light border mr-3"></div> Default
                </div>
                <div class="sidebar-bg-options" id="sidebar-dark-theme">
                    <div class="img-ss rounded-circle bg-dark border mr-3"></div> Dark
                </div>
                <p class="settings-heading mt-2">HEADER SKINS</p>
                <div class="color-tiles mx-0 px-4">
                    <div class="tiles light"></div>
                    <div class="tiles dark"></div>
                </div>
            </div>
            @include('dashboard.pertials.topNav')
            <div class="main-panel">
                <div class="content-wrapper pb-0">
                    <div class="page-header flex-wrap">
                        <h3 class="mb-0"> Hi, welcome back!</h3>
                    </div>
                    <div id="sync-status" class="alert d-none mt-2" role="alert"></div>
                    @php
                        $all_sell = \App\Models\CartInformtion::join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
                            ->where('cart_informtion.cart_date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
                            ->select('cart_informtion.*', 'consumer_login.mobile_no')
                            ->get();

                        $all_expense = \App\Models\ExpenseDetail::where('expense_details.date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
                            ->select('expense_details.*')
                            ->get();

                            $all_sell = \App\Models\CartInformtion::join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
                        ->where('cart_informtion.cart_date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
                        ->select('cart_informtion.*', 'consumer_login.mobile_no')
                        ->get();

                        $all_expense = \App\Models\ExpenseDetail::where('expense_details.date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
                        ->select('expense_details.*',)
                        ->get();

                        $PurchaseInfo = \App\Models\PurchaseInfo::where('pur_date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
                        ->select('purchase_info.*',)
                        ->get();
                        
                        $currentMonth = now()->month;
                        $currentYear = now()->year;
                        
                        $monthly_sales = \App\Models\CartInformtion::whereYear('cart_date', $currentYear)
                            ->whereMonth('cart_date', $currentMonth)
                            ->OrderBy('cart_id','DESC')
                            ->get();
                        
                        $monthly_expense = \App\Models\ExpenseDetail::whereYear('date', $currentYear)
                            ->whereMonth('date', $currentMonth)
                            ->select('expense_details.*',)
                            ->get();

                        $monthly_purchase = \App\Models\PurchaseInfo::whereYear('pur_date', $currentYear)
                            ->whereMonth('pur_date', $currentMonth)
                            ->select('purchase_info.*',)
                            ->get();
                    @endphp

                    @php
                        $singleDateSales = \App\Models\CartPaymentInformation::join('cart_informtion', 'cart_informtion.cart_id', '=', 'cart_payment_information.cart_id')
                ->join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
                ->join('cart_items', 'cart_items.cart_id', '=', 'cart_informtion.cart_id')
                ->join('product_materials', 'product_materials.product_material_id', '=', 'cart_items.product_id')
                ->join('foot_ware_categories', 'product_materials.foot_ware_categories_id', '=', 'foot_ware_categories.foot_ware_categories_id')
                ->join('types', 'product_materials.type_id', '=', 'types.type_id')
                ->join('material_types', 'product_materials.material_type_id', '=', 'material_types.material_type_id')
                ->join('brand_types', 'product_materials.brand_type_id', '=', 'brand_types.brand_type_id')
                ->join('sizes', 'sizes.size_id', '=', 'cart_items.size_id')
                ->join('colors', 'colors.colors_id', '=', 'cart_items.colors_id')
                ->join('cart_payment_methods', 'cart_payment_methods.payment_method_id', '=', 'cart_payment_information.payment_method_id')
                            ->where('cart_informtion.cart_date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
                            ->select('cart_informtion.*', 'cart_payment_information.*', 'cart_items.barcode', 'brand_types.brand_type_name', 'cart_items.quantity', 'consumer_login.mobile_no', 'cart_payment_methods.payment_method')
                ->get();
                $getId = [];
            foreach ($singleDateSales as $singleDateSale) {
                $getId[] = $singleDateSale->cart_id;
            }
            $getId = array_unique($getId);
            // dd($getId);

            $matchingCarts = [];

            foreach ($getId as $cartId) {
                foreach ($singleDateSales as $cart) {
                    // Check if the current cart matches the given cartId
                    if ($cart["cart_id"] === $cartId) {
                        $isMatched = false;

                        // Check if the cart_id and payment_method combination is already in $matchingCarts
                        foreach ($matchingCarts as $matchingCart) {
                            if ($matchingCart["cart_id"] === $cart["cart_id"] && $matchingCart["payment_method"] === $cart["payment_method"]) {
                                $isMatched = true;
                                break; // No need to continue checking once a match is found
                            }
                        }

                        // If not matched, insert into $matchingCarts
                        if (!$isMatched) {
                            $matchingCarts[] = $cart;
                        }
                    }
                }
            }

            // dd($matchingCarts);
            $serializedCarts = [];
            foreach ($matchingCarts as $cart) {
                $serializedCarts[] = serialize($cart);
            }
            $uniqueSerializedCarts = array_unique($serializedCarts);
            $uniqueCarts = array_map("unserialize", $uniqueSerializedCarts);


            $getSpecificCardId = \App\Models\CartInformtion::whereIn('cart_id', $getId)->get();
            $getSpecificItem = \App\Models\CartItem::whereIn('cart_id', $getId)->get();

            $quantityArr = [];
            foreach ($getSpecificItem as $item) {
                if (!isset($quantityArr[$item->cart_id])) $quantityArr[$item->cart_id] = $item->quantity;
                else $quantityArr[$item->cart_id] += $item->quantity;
            }
            $mergedCarts = [];
            foreach ($uniqueCarts as $cart) {
                $cartId = $cart['cart_id'];
                $paidAmount = $cart['paid_amount'];
                $paymentMethod = $cart['payment_method'];
                // $quantity = $cart['quantity'];
                $barcode = $cart['barcode'];

                if (!isset($mergedCarts[$cartId])) {
                    $mergedCarts[$cartId] = $cart;
                } else {
                    $mergedCarts[$cartId]['paid_amount'] = "{$mergedCarts[$cartId]['paid_amount']} + {$paidAmount}";
                    $mergedCarts[$cartId]['payment_method'] = $mergedCarts[$cartId]['payment_method'] . " + " . $paymentMethod;
                    // $mergedCarts[$cartId]['barcode'] = $mergedCarts[$cartId]['barcode']. " + " . $barcode;
                    // $mergedCarts[$cartId]['quantity'] += $quantity;
                }
            }

            // dd($mergedCarts);
            $mergedCarts = array_values($mergedCarts);
            $singleDateSales = [];
            foreach ($mergedCarts as $singleCart) {
                $singleCart['quantity'] = $quantityArr[$singleCart->cart_id];
                $singleDateSales[] = $singleCart;
            }
            $discountAmount = 0;
            $paidAmount = 0;
            foreach ($singleDateSales as $single) {
                $discountAmount += floatval($single->discount_amount) ;
                $paidAmount +=  floatval($single->final_total_amount);
            }


            $total_orders = count($singleDateSales);
            $invoice_amount = $getSpecificCardId->sum('total_cart_amount');

            $vat = $getSpecificCardId->sum('vat_amount');
            $payable = $getSpecificCardId->sum('total_payable_amount');
            $due = $getSpecificCardId->sum('due_amount');
            $totalQuantity = $getSpecificItem->sum('quantity');





            $getOnlyExchnageValue = \App\Models\CartPaymentInformation::join('cart_informtion', 'cart_informtion.cart_id', '=', 'cart_payment_information.cart_id')
            ->join('cart_payment_methods', 'cart_payment_methods.payment_method_id', '=', 'cart_payment_information.payment_method_id')
            ->where('cart_informtion.cart_date', 'like', '%' . Carbon::today()->format('Y-m-d') . '%')
            ->where('cart_payment_information.payment_method_id', '=', 9)
            ->select('cart_payment_information.*')
            ->get();
            $getextotal = $getOnlyExchnageValue->sum('paid_amount');

            // $getPaidTotal = $total_sum_paid->sum('total_payable');
            // dd($paidAmount);
            $paid_amount = $paidAmount- $getextotal;
            $rowCount = DB::table('log_table')->count();

            $singleDateSales = CartInformtion::join('consumer_login', 'consumer_login.login_id', '=', 'cart_informtion.consumer_id')
                ->join('cart_payment_methods', 'cart_payment_methods.payment_method_id', '=', 'cart_informtion.payment_method_id')
                ->whereDate('cart_informtion.cart_date', Carbon::today())
                ->select('cart_informtion.*', 'consumer_login.mobile_no', 'cart_payment_methods.payment_method')
                ->get();

                $paid_amount = $singleDateSales->sum('total_payable_amount');
                    @endphp

                    @if ($user_data->role_id == 1 || $user_data->role_id == 2)
                    <h4 class="mt-2">Daily Transaction Information</h4>
                    <div class="row">
                        <!-- Today's Sales -->
                        <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #CB9DF0">
                                <i class="card-icon-indicator mdi mdi-currency-usd bg-inverse-icon-warning p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Today's Sales</p>
                                    <h3>Tk.</h3>
                                    <h5>{{ number_format($all_sell->sum('final_total_amount'), 2) }}</h5>     
                                </div>                                
                            </div>
                        </div>
                    
                        <!-- Invoice Count -->
                        <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #3498db">
                                <i class="card-icon-indicator mdi mdi-receipt bg-inverse-icon-primary p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Today's Invoice Count</p>
                                    <h3>Total</h3>
                                    <h5>{{ $all_sell->count('final_total_amount') }}</h5>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Net Profit -->
                         {{-- <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #72BAA9">
                                <i class="card-icon-indicator mdi mdi-finance bg-inverse-icon-danger p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Today's Net Profit</p>
                                    <h3>Tk.</h3>
                                    <h5>{{ number_format($all_sell->sum('net_profit'), 2) }}</h5>
                                </div>
                            </div>
                        </div>  --}}
                    
                        <!-- Orders -->
                        <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #28a745">
                                <i class="card-icon-indicator mdi mdi-briefcase-outline bg-inverse-icon-primary p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Orders</p>
                                    <h3>Total</h3>
                                    <h5>{{ $all_sell->count('final_total_amount') }}</h5>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Expense -->
                        <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #17a2b8">
                                <i class="card-icon-indicator mdi mdi-margin bg-inverse-icon-danger p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Expense</p>
                                    <h3>Tk.</h3>
                                    <h5>{{ $all_expense->sum('amount') }}.00</h5>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Today's Purchase -->
                        <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #A7D477">
                                <i class="card-icon-indicator mdi mdi-cart-arrow-down bg-inverse-icon-success p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Today's Purchase</p>
                                    <h3>Tk.</h3>
                                    <h5>{{ number_format($PurchaseInfo->sum('total_item_price'), 2) }}</h5>
                                </div>
                            </div>
                        </div>
                    
                        <!-- Unsync Data -->
                        <div class="col-md-3 mb-3">
                            <div class="uni-card" style="background-color: #6c757d">
                                <i class="card-icon-indicator mdi mdi-cloud-upload bg-inverse-icon-dark p-2 rounded-circle text-white"></i>
                                <div class="uni-card-content">
                                    <p class="mb-0 color-card-head">Total Unsync Data</p>
                                    <h3>Total</h3>
                                    <h5 id="unsync-data-count">0</h5>
                                    <a class="btn btn-sm btn-light mt-2" id="sync-btn" href="javascript:void(0);">Sync Now</a>
                                </div>
                            </div>
                        </div>
                    </div>
                        <h4 class="mt-2">Monthly Transaction Information</h4>
                        <div class="row">
                            <!-- This Month's Sales -->
                            <div class="col-md-3 mb-3">
                                <div class="uni-card" style="background-color: #79c2f7">
                                    <i class="card-icon-indicator mdi mdi-cart-outline bg-inverse-icon-warning p-2 rounded-circle text-white"></i>
                                    <div class="uni-card-content">
                                        <p class="mb-0 color-card-head">This Month's Sales</p>
                                        <h3>Tk.</h3>
                                        <h5>{{ number_format($monthly_sales->sum('final_total_amount'), 2) }}</h5>     
                                    </div>                                
                                </div>
                            </div>
                        
                            <!-- This Month's Orders -->
                            <div class="col-md-3 mb-3">
                                <div class="uni-card" style="background-color: #72BAA9">
                                    <i class="card-icon-indicator mdi mdi-calendar-text bg-inverse-icon-primary p-2 rounded-circle text-white"></i>
                                    <div class="uni-card-content">
                                        <p class="mb-0 color-card-head">This Month's Orders</p>
                                        <h3>Total</h3>
                                        <h5>{{ $monthly_sales->count('final_total_amount') }}</h5>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- This Month's Net Profit -->
                            {{-- <div class="col-md-3 mb-3">
                                <div class="uni-card" style="background-color: #6af078">
                                    <i class="card-icon-indicator mdi mdi-chart-line bg-inverse-icon-danger p-2 rounded-circle text-white"></i>
                                    <div class="uni-card-content">
                                        <p class="mb-0 color-card-head">This Month's Net Profit</p>
                                        <h3>Tk.</h3>
                                        <h5>{{ number_format($monthly_sales->sum('net_profit'), 2) }}</h5>
                                    </div>
                                </div>
                            </div> --}}
                        
                            <!-- This Month's Expense -->
                            <div class="col-md-3 mb-3">
                                <div class="uni-card" style="background-color: #a086f7">
                                    <i class="card-icon-indicator mdi mdi-credit-card-minus bg-inverse-icon-success p-2 rounded-circle text-white"></i>
                                    <div class="uni-card-content">
                                        <p class="mb-0 color-card-head">This Month's Expense</p>
                                        <h3>Tk.</h3>
                                        <h5>{{ number_format($monthly_expense->sum('amount'), 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        
                            <!-- This Month's Purchase -->
                            <div class="col-md-3 mb-3">
                                <div class="uni-card" style="background-color: #5ef0ed">
                                    <i class="card-icon-indicator mdi mdi-shopping bg-inverse-icon-success p-2 rounded-circle text-white"></i>
                                    <div class="uni-card-content">
                                        <p class="mb-0 color-card-head">This Month's Purchase</p>
                                        <h3>Tk.</h3>
                                        <h5>{{ number_format($monthly_purchase->sum('total_item_price'), 2) }}</h5>
                                    </div>
                                </div>
                            </div>
                        </div>
                                            
                      <div class="row">
                        <div class="col-lg-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Sales chart</h4>
                              <canvas id="lineChart" style="height: 250px;"></canvas>
                            </div>
                          </div>
                        </div>
                        <div class="col-lg-6 grid-margin stretch-card">
                          <div class="card">
                            <div class="card-body">
                              <h4 class="card-title">Purchase chart</h4>
                              <canvas id="barChart" style="height: 230px;"></canvas>
                            </div>
                          </div>
                        </div>
                      </div>
                    </div>
                    @endif
                </div>
            </div>
            <!-- main-panel ends -->
        </div>
        <!-- page-body-wrapper ends -->
    </div>
    <!-- container-scroller -->
@endsection

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script>
    function unsync_data_count() {
        $.ajax({
            url: "{{ route('backoffice.logCount') }}",
            method: 'GET',
            success: function (response) {
                console.log('response', response);
                $('#unsync-data-count').text(response.logCount);
            },
            error: function () {
                console.log('Error fetching unsync data count.');
            }
        });
    }
    
    $(document).ready(function () {
        unsync_data_count(); // Call the function to fetch the count on page load
        $('#sync-btn').on('click', function () {
            var $btn = $(this);

            $btn.prop('disabled', true).text('Syncing...');

            $.ajax({
                url: "{{ route('backoffice.sync_data') }}",
                method: 'POST',
                headers: {
                    'X-CSRF-TOKEN': '{{ csrf_token() }}'
                },
                success: function (response) {
                    console.log('response', response);
                    $('#sync-status')
                        .removeClass('d-none alert-danger')
                        .addClass('alert-success')
                        .text(response.message);

                    $btn.prop('disabled', false).text('Sync Now');
                    unsync_data_count(); // Call the function to fetch the count on page load
                },
                error: function () {
                    $('#sync-status')
                        .removeClass('d-none alert-success')
                        .addClass('alert-danger')
                        .text('Sync failed. Please try again.');

                    $btn.prop('disabled', false).text('Sync Now');
                }
            });
        });
    });

    $(function() {
  /* ChartJS
   * -------
   * Data and config for chartjs
   */
  'use strict';
  const get_months_and_count = async () => {
    try {
      let months = [];
      let salesAmount = [];
  
      const response = await fetch("{{ route('backoffice.get_sales_data') }}");
      const data = await response.json();
      
  
      data.forEach(d => {
        months.push(d.month);
        salesAmount.push(d.total_sum);
      });
      return { months, salesAmount };
    } catch (error) {
      throw error;
    }
    
  };
  
  // subscribe
  const get_sub_months_and_count = async () => {
    try {
      let pMonths = [];
      let purchaseAmount = [];
  
      const response = await fetch("{{ route('backoffice.get_purchase_data') }}");
      const data = await response.json();
  
      data.forEach(d => {
        pMonths.push(d.month);
        purchaseAmount.push(d.total_sum);
      });
      return { pMonths, purchaseAmount };
    } catch (error) {
      throw error;
    }
    
  };
  
  // Call chartjs function
  chartjs();

  // Define chartjs function
  async function chartjs() {
    const salesChart = document.getElementById('lineChart');
    
    let { months, salesAmount } = await get_months_and_count();

    new Chart(salesChart, {
      type: 'line',
      data: {
        labels: months,
        datasets: [{
          label: 'Sales Chart',
          data: salesAmount,
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: true,
      }
    });

    const Bar = document.getElementById('barChart');
    let { pMonths, purchaseAmount } = await get_sub_months_and_count();
    console.log(Bar);
    new Chart(Bar, {
      type: 'bar',
      data: {
        labels: pMonths,
        datasets: [{
          label: 'Purchase Chart',
          data: purchaseAmount,
          borderWidth: 1,
        }]
      },
      options: {
        indexAxis: 'y',
        responsive: true,
        maintainAspectRatio: true,
      }
    });
  }
});
</script>

