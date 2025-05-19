<?php

use App\Http\Controllers\Account\AccountController;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\BackofficeLoginController;

use App\Http\Controllers\ProductController;
use App\Http\Controllers\ProductCategoryController;
use App\Http\Controllers\SubCategory1Controller;
use App\Http\Controllers\SubCategory2Controller;
use App\Http\Controllers\ColorDefinitionController;
use App\Http\Controllers\DeliveryAgencyController;
use App\Http\Controllers\DeliveryAgentController;
use App\Http\Controllers\DeliveryChargeController;
use App\Http\Controllers\SupplierController;
use App\Http\Controllers\SizeController;
use App\Http\Controllers\UnitController;
use App\Http\Controllers\BrandController;
use App\Http\Controllers\CartDeliveryController;
use App\Http\Controllers\PurchaseController;
use App\Http\Controllers\WalletController;
use App\Http\Controllers\WebController;
use App\Http\Controllers\ConsumerController;
use App\Http\Controllers\BackofficeProfileController;
use App\Http\Controllers\ReturnController;
use App\Http\Controllers\AttributeController;
use App\Http\Controllers\BankController;
use App\Http\Controllers\ExpenseCategoryController;
use App\Http\Controllers\ExpenseController;
use App\Http\Controllers\Possie\SalesInfoController;
use App\Http\Controllers\Purchase\PurchaseInvoiceController;
use App\Http\Controllers\Purchase\PurchaseReportController;
use App\Http\Controllers\Purchase\SupplierPaymentController;
use App\Http\Controllers\Report\ReportController;
use App\Http\Controllers\Sales\CustomerPaymentController;
use App\Http\Controllers\Sales\OrderController;
use App\Http\Controllers\Sales\SalesController;
use App\Http\Controllers\SettingsController;
use App\Http\Controllers\StockReportController;
use App\Http\Controllers\StoreController;
use Illuminate\Support\Facades\Auth;

Route::get('/', function () {
    return view('welcome');
});

Route::prefix('backoffice')->name('backoffice.')->group(function () {

    Route::view('/login', 'dashboard.backoffice.login')->name('login');
    Route::post('/check', [BackofficeLoginController::class, 'check'])->name('check');
    Route::post('/create', [BackofficeLoginController::class, 'create'])->name('create');


    Route::group(['middleware' => ['AuthCheck']], function () {


        Route::view('/home', 'dashboard.backoffice.home')->name('home');
        Route::get('/backoffice-profile/{id}', [BackofficeProfileController::class, 'index'])->name('backoffice-profile');
        Route::post('/update-profile', [BackofficeProfileController::class, 'update'])->name('update-profile');
        Route::post('/update-password', [BackofficeProfileController::class, 'updatePassword'])->name('update-password');

        Route::get('/system-settings', [SettingsController::class, 'index'])->name('system-settings');
        Route::post('/update-settings/{id}', [SettingsController::class, 'update'])->name('update-settings');


        Route::group(['middleware' => ['administrator']], function () {

            // Backoffice register

            Route::get('/register', [BackofficeLoginController::class, 'index'])->name('register');
            Route::get('/all-backoffice-user', [BackofficeLoginController::class, 'show'])->name('all-backoffice-user');
            Route::get('/edit-backoffice-user/{id}', [BackofficeLoginController::class, 'edit'])->name('edit-backoffice-user');
            Route::post('/update-backoffice-user', [BackofficeLoginController::class, 'update'])->name('update-backoffice-user');

            //All Consumer
            Route::get('/all-consumer', [ConsumerController::class, 'index'])->name('all-consumer');
            Route::get('/view-consumer/{id}', [ConsumerController::class, 'viewConsumer'])->name('view-consumer');
            Route::get('/consumer-completed-delivery/{id}', [ConsumerController::class, 'CompletedDelivary'])->name('consumer-completed-delivery');
            Route::get('/consumer-running-orders/{id}', [ConsumerController::class, 'RunningOrders'])->name('consumer-running-orders');
            Route::get('/consumer-childs/{id}', [ConsumerController::class, 'viewChilds'])->name('consumer-childs');
            Route::get('/send-invitation-mail', [ConsumerController::class, 'sendMail'])->name('send-invitation-mail');

            // Product

            Route::get('/all-products', [ProductController::class, 'AllProducts'])->name('all-products');
            Route::get('/product', [ProductController::class, 'index'])->name('product');
            Route::post('/create-product', [ProductController::class, 'create'])->name('create-product');
            Route::get('/edit-product/{id}', [ProductController::class, 'edit'])->name('edit-product');
            Route::post('/update-product', [ProductController::class, 'store'])->name('update-product');

            // Purchase

            Route::get('/all-purchase', [PurchaseController::class, 'AllPurchase'])->name('all-purchase');
            Route::get('/purchase', [PurchaseController::class, 'index'])->name('purchase');
            Route::post('/create-purchase', [PurchaseController::class, 'create'])->name('create-purchase');
            Route::get('/edit-purchase/{id}', [PurchaseController::class, 'edit'])->name('edit-purchase');
            Route::post('/update-purchase', [PurchaseController::class, 'store'])->name('update-purchase');
            Route::get('/view-purchase/{id}', [PurchaseController::class, 'viewPurchase'])->name('view-purchase');

            // Category 

            Route::get('/all-product-cat', [ProductCategoryController::class, 'AllProductCategory'])->name('all-product-cat');
            Route::view('/product-cat', 'dashboard.product.addProductCat')->name('addProductCat');
            Route::post('/create-cat', [ProductCategoryController::class, 'createCategory'])->name('create-cat');
            Route::get('/edit-category/{id}', [ProductCategoryController::class, 'edit'])->name('edit-category');
            Route::post('/update-category', [ProductCategoryController::class, 'update'])->name('update-category');

            // Sub Category One

            Route::get('/all-subCat1', [SubCategory1Controller::class, 'AllSubCat1'])->name('all-subCat1');
            Route::get('/sub-cat1', [SubCategory1Controller::class, 'index'])->name('subCat1');
            Route::post('/create-cat1', [SubCategory1Controller::class, 'createSubCategoryOne'])->name('create-cat1');
            Route::get('/edit-subCat1/{id}', [SubCategory1Controller::class, 'edit'])->name('edit-subCat1');
            Route::post('/update-subCat1', [SubCategory1Controller::class, 'update'])->name('update-subCat1');

            // Sub Category Two

            Route::get('/all-subCat2', [SubCategory2Controller::class, 'AllSubCat2'])->name('all-subCat2');
            Route::get('/sub-cat2', [SubCategory2Controller::class, 'index'])->name('subCat2');
            Route::post('/create-cat2', [SubCategory2Controller::class, 'createSubCategoryTwo'])->name('create-cat2');
            Route::get('/edit-subCat2/{id}', [SubCategory2Controller::class, 'edit'])->name('edit-subCat2');
            Route::post('/update-subCat2', [SubCategory2Controller::class, 'update'])->name('update-subCat2');

            // Color Definition

            Route::get('/all-colors', [ColorDefinitionController::class, 'index'])->name('all-colors');
            Route::get('/add-color', [ColorDefinitionController::class, 'show'])->name('add-color');
            Route::post('/create-color', [ColorDefinitionController::class, 'store'])->name('create-color');
            Route::get('/edit-color/{id}', [ColorDefinitionController::class, 'edit'])->name('edit-color');
            Route::post('/update-color', [ColorDefinitionController::class, 'update'])->name('update-color');

            // Attribute Definition

            Route::get('/all-attributes', [AttributeController::class, 'index'])->name('all-attributes');
            Route::get('/add-attribute', [AttributeController::class, 'show'])->name('add-attribute');
            Route::post('/create-attribute', [AttributeController::class, 'store'])->name('create-attribute');
            Route::get('/edit-attribute/{id}', [AttributeController::class, 'edit'])->name('edit-attribute');
            Route::post('/update-attribute', [AttributeController::class, 'update'])->name('update-attribute');
            Route::get('/get-color', [AttributeController::class, 'getColor'])->name('get-color');
            Route::get('/get-size', [AttributeController::class, 'getSize'])->name('get-size');
            Route::get('/get-ajax-attribute/{id}', [AttributeController::class, 'getAjaxAttribute'])->name('get-ajax-attribute');
            Route::get('/get-ajax-product/{id}', [AttributeController::class, 'getAjaxProduct'])->name('get-ajax-product');
            Route::get('/edit-purchase-ajax-attribute/{id}/{product_id}', [AttributeController::class, 'editPurchaseAjaxAttribute'])->name('edit-purchase-ajax-attribute');

            // Delivery Agency

            Route::get('/all-agency', [DeliveryAgencyController::class, 'index'])->name('all-agency');
            Route::get('/add-agency', [DeliveryAgencyController::class, 'show'])->name('add-agency');
            Route::post('/create-agency', [DeliveryAgencyController::class, 'store'])->name('create-agency');
            Route::get('/edit-agency/{id}', [DeliveryAgencyController::class, 'edit'])->name('edit-agency');
            Route::post('/update-agency', [DeliveryAgencyController::class, 'update'])->name('update-agency');

            // Delivery Agent

            Route::get('/all-agent', [DeliveryAgentController::class, 'index'])->name('all-agent');
            Route::get('/add-agent', [DeliveryAgentController::class, 'show'])->name('add-agent');
            Route::post('/create-agent', [DeliveryAgentController::class, 'store'])->name('create-agent');
            Route::get('/edit-agent/{id}', [DeliveryAgentController::class, 'edit'])->name('edit-agent');
            Route::post('/update-agent', [DeliveryAgentController::class, 'update'])->name('update-agent');
            Route::get('/getAgent/{id}', [DeliveryAgentController::class, 'getAgent'])->name('getAgent');

            // Delivery Charge

            Route::get('/all-charge', [DeliveryChargeController::class, 'index'])->name('all-charge');
            Route::get('/add-charge', [DeliveryChargeController::class, 'show'])->name('add-charge');
            Route::post('/create-charge', [DeliveryChargeController::class, 'store'])->name('create-charge');
            Route::get('/edit-charge/{id}', [DeliveryChargeController::class, 'edit'])->name('edit-charge');
            Route::post('/update-charge', [DeliveryChargeController::class, 'update'])->name('update-charge');


            // withdraw

            Route::get('/all-withdraw-request', [WalletController::class, 'index'])->name('all-withdraw-request');
            Route::get('/verify/{id}', [WalletController::class, 'verify'])->name('verify');
            Route::get('/payment-given/{id}', [WalletController::class, 'payment_given'])->name('payment-given');

            // Suppliers

            Route::get('/all-suppliers', [SupplierController::class, 'index'])->name('all-suppliers');
            Route::get('/add-supplier', [SupplierController::class, 'show'])->name('add-supplier');
            Route::post('/create-supplier', [SupplierController::class, 'store'])->name('create-supplier');
            Route::get('/edit-supplier/{id}', [SupplierController::class, 'edit'])->name('edit-supplier');
            Route::post('/update-supplier', [SupplierController::class, 'update'])->name('update-supplier');

            // Size

            Route::get('/all-size', [SizeController::class, 'index'])->name('all-size');
            Route::get('/add-size', [SizeController::class, 'show'])->name('add-size');
            Route::post('/create-size', [SizeController::class, 'store'])->name('create-size');
            Route::get('/edit-size/{id}', [SizeController::class, 'edit'])->name('edit-size');
            Route::post('/update-size', [SizeController::class, 'update'])->name('update-size');


            // Unit

            Route::get('/all-unit', [UnitController::class, 'index'])->name('all-unit');
            Route::get('/add-unit', [UnitController::class, 'show'])->name('add-unit');
            Route::post('/create-unit', [UnitController::class, 'store'])->name('create-unit');
            Route::get('/edit-unit/{id}', [UnitController::class, 'edit'])->name('edit-unit');
            Route::post('/update-unit', [UnitController::class, 'update'])->name('update-unit');


            // Brand

            Route::get('/all-brand', [BrandController::class, 'index'])->name('all-brands');
            Route::get('/add-brand', [BrandController::class, 'show'])->name('add-brand');
            Route::post('/create-brand', [BrandController::class, 'store'])->name('create-brand');
            Route::get('/edit-brand/{id}', [BrandController::class, 'edit'])->name('edit-brand');
            Route::post('/update-brand', [BrandController::class, 'update'])->name('update-brand');


            //Web Actions
            Route::get('/all-new-arraival', [WebController::class, 'new_arraival'])->name('all-new-arraival');
            Route::get('/add-new-arraival', [WebController::class, 'add_new_arraival'])->name('add-new-arraival');
            Route::post('/create-new-arraival', [WebController::class, 'store_new_arraival'])->name('create-new-arraival');

            Route::get('/all-on-sale', [WebController::class, 'on_sale'])->name('all-on-sale');
            Route::get('/add-on-sale', [WebController::class, 'add_on_sale'])->name('add-on-sale');
            Route::post('/create-on-sale', [WebController::class, 'store_on_sale'])->name('create-on-sale');

            //Stock
            Route::get('/all-stock-report', [StockReportController::class, 'stock_report'])->name('all-stock-report');
            Route::get('/store-stock-report', [StockReportController::class, 'store_stock_report'])->name('store-stock-report');
            Route::get('/stock-transfer', [StockReportController::class, 'stock_transfer'])->name('stock-transfer');
            Route::post('/transfer-stock', [StockReportController::class, 'store_stock_transfer'])->name('transfer-stock');
            Route::get('/p-w-a-q/{product_id}', [StockReportController::class, 'PWAQ'])->name('p-w-a-q');
            Route::get('/p-w-s/{product_id}', [StockReportController::class, 'PWS'])->name('p-w-s');
            Route::get('/p-w-r/{product_id}', [StockReportController::class, 'PWR'])->name('p-w-r');
            Route::get('/p-w-s-d/{store_id}/{product_id}', [StockReportController::class, 'PWSD'])->name('p-w-s-d');
            Route::get('/p-w-s-q/{store_id}/{product_id}', [StockReportController::class, 'PWSQ'])->name('p-w-s-d');
            Route::get('/cat-wise-stock/{category_id}', [StockReportController::class, 'CatWiseStock'])->name('cat-wise-stock');
        });

        // Cart Delivary

        Route::get('/all-cart-delivary', [CartDeliveryController::class, 'index'])->name('all-cart-delivary');
        Route::get('/completed-delivary', [CartDeliveryController::class, 'completedDelivary'])->name('completed-delivary');
        Route::post('/accept-cart/{id}', [CartDeliveryController::class, 'acceptCart'])->name('accept-cart');
        Route::get('/getCartItem/{id}', [CartDeliveryController::class, 'getCartItem'])->name('getCartItem');
        Route::get('/orderDetails/{id}', [CartDeliveryController::class, 'orderDetails'])->name('orderDetails');


        // Cart Return

        Route::get('/all-return', [ReturnController::class, 'index'])->name('all-return');
        Route::get('/completed-return', [ReturnController::class, 'completedReturns'])->name('completed-return');
        Route::get('/create-return', [ReturnController::class, 'create'])->name('create-return');
        Route::post('/store-return', [ReturnController::class, 'store'])->name('store-return');
        Route::get('/view-return/{id}', [ReturnController::class, 'view'])->name('view-return');
        Route::get('/get-return-cart/{id}', [ReturnController::class, 'getReturnCart'])->name('get-return-cart');
        Route::get('/get-return-item/{id}', [ReturnController::class, 'getReturnItem'])->name('get-return-item');
        Route::get('/return-authorization/{id}{authorize_status}', [ReturnController::class, 'Authorization'])->name('return-authorization');
        Route::get('/recived-to-warehouse/{id}', [ReturnController::class, 'recivedToWarehouse'])->name('recived-to-warehouse');

        // Sales Actions
        Route::get('/sales-form', [SalesController::class, 'index'])->name('sales-form');
        Route::get('/get_sales_temp_cart_data/{id}/{sales_type}', [SalesController::class, 'salesTempCartData'])->name('get_sales_temp_cart_data');
        Route::get('/get-ajax-category', [SalesController::class, 'getAjaxCategory'])->name('get-ajax-category');
        Route::get('/sales-cat-wise-items/{id}', [SalesController::class, 'salesCategoryWiseItems'])->name('sales-cat-wise-items');
        Route::get('/sales-sub-category/{id}', [SalesController::class, 'salesSubCategory'])->name('sales-sub-category');
        Route::get('/autocomplete-mobile-no/{id}', [SalesController::class, 'autocompleteMobileNo'])->name('autocomplete-mobile-no');
        Route::post('/add-sales-items-to-temp', [SalesController::class, 'addSalesItemToTempCart'])->name('add-sales-items-to-temp');
        Route::get('/add-sales-items-with-barcode/{barcode}/{msg}/{sales_type}', [SalesController::class, 'addSalesItemsWithBarcode'])->name('add-sales-items-with-barcode');
        Route::get('/delete_sales_form', [SalesController::class, 'destroy'])->name('delete_sales_form');
        Route::get('/delete_temporary_payment/{id}', [SalesController::class, 'destroyTemporaryPayment'])->name('delete_temporary_payment');
        Route::get('/delete_sales_temp_cart_item/{id}/{sales_type}', [SalesController::class, 'destroyTempCart'])->name('delete_sales_temp_cart_item');
        Route::get('/price_calculation/{id}/{qty}/{sales_price}/{sales_type}', [SalesController::class, 'priceCalculation'])->name('price_calculation');
        Route::post('/store-sales-temp-payment', [SalesController::class, 'salesTempPayment'])->name('store-sales-temp-payment');
        Route::post('/store-sales', [SalesController::class, 'storeSales'])->name('store-sales');
        Route::get('/add_suspense/{id}/{waiter_id}/{table_no}', [SalesController::class, 'addSuspense'])->name('add_suspense');
        Route::get('/get-suspended-items', [SalesController::class, 'getSuspendedItems'])->name('get-suspended-items');
        Route::get('/get_suspended_data/{id}', [SalesController::class, 'getSuspendedData'])->name('get_suspended_data');
        Route::get('/get-waiter', [SalesController::class, 'getWaiter'])->name('get-waiter');
        Route::get('/sales-type-wise-price/{id}/{msg}', [SalesController::class, 'salesTypeWisePrice'])->name('sales-type-wise-price');

        //Order Section
        Route::get('/suspended_orders', [OrderController::class, 'suspendedOrders'])->name('suspended_orders');
        Route::get('/daily_sales_report', [OrderController::class, 'dailySalesReport'])->name('daily_sales_report');
        Route::get('/all_sales_report', [OrderController::class, 'allSalesReport'])->name('all_sales_report');
        Route::get('/about-company', [OrderController::class, 'aboutRestaurant'])->name('about-company');
        Route::get('/printInvoice/{id}', [OrderController::class, 'printInvoice'])->name('printInvoice');

        Route::get('/logout', [BackofficeLoginController::class, 'logout'])->name('logout');

        //Barcode
        Route::get('/create-barcode/{id}', [ProductController::class, 'createBarcode'])->name('create-barcode');
        Route::get('/print-barcode/{id}', [ProductController::class, 'printBarcode'])->name('print-barcode');

        //Purchase
        Route::group(['prefix' => 'purchase'], function () {
            Route::get('/purchase-form', [PurchaseInvoiceController::class, 'index'])->name('purchase-form');
            Route::get('/purchase-cat-wise-items/{id}', [PurchaseInvoiceController::class, 'purchaseCategoryWiseItems'])->name('purchase-cat-wise-items');
            Route::get('/add-purchased-items-to-temp/{id}/{msg}', [PurchaseInvoiceController::class, 'addPurchaseItemToTempCart'])->name('add-purchased-items-to-temp');
            Route::get('/get_purchased_temp_cart_data/{id}', [PurchaseInvoiceController::class, 'purchasedTempCartData'])->name('get_purchased_temp_cart_data');
            Route::get('/delete_purchase_temp_cart_item/{id}', [PurchaseInvoiceController::class, 'deleteTempPurchaseItem'])->name('delete_purchase_temp_cart_item');
            Route::get('/edit_purchase_temp_cart_item/{id}', [PurchaseInvoiceController::class, 'editTempPurchaseItem'])->name('edit_purchase_temp_cart_item');
            Route::post('/store-purchase-product-data', [PurchaseInvoiceController::class, 'storePurchaseProductData'])->name('store-purchase-product-data');
            Route::post('/store-purchase-form', [PurchaseInvoiceController::class, 'storePurchaseForm'])->name('store-purchase-form');
            Route::get('/delete_purchase_form', [PurchaseInvoiceController::class, 'deletePurchaseForm'])->name('delete_purchase_form');
            Route::get('/ajax-get-unit', [PurchaseInvoiceController::class, 'ajaxGetUnit'])->name('ajax-get-unit');
            Route::get('/ajax-get-supplyer', [PurchaseInvoiceController::class, 'ajaxGetSupplyer'])->name('ajax-get-supplyer');
            Route::get('/ajax-get-location', [PurchaseInvoiceController::class, 'ajaxGetLocation'])->name('ajax-get-location');
            Route::post('/ajax-store-supplier-data', [PurchaseInvoiceController::class, 'ajaxStoreSupplierData'])->name('ajax-store-supplier-data');
            Route::post('/ajax-store-location-data', [PurchaseInvoiceController::class, 'ajaxStoreLocationData'])->name('ajax-store-location-data');
            Route::get('/get_purchase_temp_cart_data/{id}', [PurchaseInvoiceController::class, 'purchaseTempCartData'])->name('get_purchase_temp_cart_data');
            Route::get('/purchase_price_calculation/{id}/{qty}/{sales_price}', [PurchaseInvoiceController::class, 'priceCalculation'])->name('price_calculation');


            Route::get('/daily-purchase-report', [PurchaseReportController::class, 'dailyPurchaseReport'])->name('daily-purchase-report');
            Route::get('/range-purchase-report', [PurchaseReportController::class, 'rangePurchaseReport'])->name('range-purchase-report');
            Route::get('/all-purchase-report', [PurchaseReportController::class, 'allPurchaseReport'])->name('all-purchase-report');
            Route::get('/ajax-get-balance/{bank_id}', [BankController::class, 'ajaxGetBalance'])->name('ajax-get-balance');
        });
        Route::get('/supplier-payment', [SupplierPaymentController::class, 'index'])->name('supplier-payment');
        Route::post('/store-supplier-payment', [SupplierPaymentController::class, 'store'])->name('store-supplier-payment');
        Route::get('/edit-supplier-payment/{id}', [SupplierPaymentController::class, 'edit'])->name('edit-supplier-payment');
        Route::post('/update-supplier-payment/{id}', [SupplierPaymentController::class, 'update'])->name('update-supplier-payment');
        Route::get('/ajax-get-sup-invoice/{id}', [SupplierPaymentController::class, 'ajaxGetSupInvoice'])->name('ajax-get-sup-invoice');
        Route::get('/ajax-get-pur-data/{id}', [SupplierPaymentController::class, 'ajaxGetPurData'])->name('ajax-get-pur-data');

        Route::get('/customer-payment', [CustomerPaymentController::class, 'index'])->name('customer-payment');
        Route::post('/store-customer-payment', [CustomerPaymentController::class, 'store'])->name('store-customer-payment');
        Route::get('/edit-customer-payment/{id}', [CustomerPaymentController::class, 'edit'])->name('edit-customer-payment');
        Route::post('/update-customer-payment/{id}', [CustomerPaymentController::class, 'update'])->name('update-customer-payment');
        Route::get('/ajax-get-cus-invoice/{id}', [CustomerPaymentController::class, 'ajaxGetCusInvoice'])->name('ajax-get-cus-invoice');
        Route::get('/ajax-get-cus-data/{id}', [CustomerPaymentController::class, 'ajaxGetCusData'])->name('ajax-get-cus-data');



        Route::get('/accounts-receivable', [AccountController::class, 'accountsReceivable'])->name('accounts-receivable');
        Route::get('/accounts-payable', [AccountController::class, 'accountsPayable'])->name('accounts-payable');
        Route::get('/payment-report', [AccountController::class, 'paymentReport'])->name('payment-report');
        Route::get('/cashflow', [AccountController::class, 'cashflow'])->name('cashflow');

        Route::get('/income-statement', [AccountController::class, 'incomeStatement'])->name('income-statement');
        Route::get('/ajax-get-income-stat/{id}', [AccountController::class, 'ajaxGetIncomeStat'])->name('ajax-get-income-stat');
        Route::get('/multi-date-income-stat/{from}/{to}', [AccountController::class, 'multiDateIncomeStat'])->name('multi-date-income-stat');
        Route::get('/day-end/{id}', [AccountController::class, 'dayEnd'])->name('day-end');
        Route::get('/supplier-payments', [AccountController::class, 'supplierPayments'])->name('supplier-payments');
        Route::get('/customer-payments', [AccountController::class, 'customerPayments'])->name('customer-payments');

        //reports
        Route::get('/salesReport', [ReportController::class, 'salesReport'])->name('salesReport');
        Route::get('/single-date-sales/{id}', [ReportController::class, 'singleDateSales'])->name('single-date-sales');
        Route::get('/multi-date-sales/{from}/{to}', [ReportController::class, 'multiDateSales'])->name('multi-date-sales');

        Route::get('/purchaseReport', [ReportController::class, 'purchaseReport'])->name('purchaseReport');
        Route::get('/single-date-purchase/{id}', [ReportController::class, 'singleDatePurchase'])->name('single-date-purchase');
        Route::get('/multi-date-purchase/{from}/{to}', [ReportController::class, 'multiDatePurchase'])->name('multi-date-purchase');

        Route::get('/stockReport', [ReportController::class, 'stockReport'])->name('stockReport');
        Route::get('/profitLossReport', [ReportController::class, 'profitLossReport'])->name('profitLossReport');

        Route::get('/expenseReport', [ReportController::class, 'expenseReport'])->name('expenseReport');
        Route::get('/single-date-expense/{id}', [ReportController::class, 'singleDateExpense'])->name('single-date-expense');
        Route::get('/multi-date-expense/{from}/{to}', [ReportController::class, 'multiDateExpense'])->name('multi-date-expense');

        Route::get('/salaryReport', [ReportController::class, 'salaryReport'])->name('salaryReport');

        Route::get('/supplier-balance', [ReportController::class, 'SupplierBalance'])->name('supplier-balance');
        Route::get('/customer-balance', [ReportController::class, 'CustomerBalance'])->name('customer-balance');
        Route::get('/ajax-get-customer', [ReportController::class, 'ajaxGetCustomer'])->name('ajax-get-customer');
        Route::get('/ajax-get-customer-details/{id}', [ReportController::class, 'ajaxGetCustomerDetails']);
        Route::get('/ajax-get-supplier', [ReportController::class, 'ajaxGetSupplier'])->name('ajax-get-supplier');
        Route::get('/ajax-get-supplier-details/{id}', [ReportController::class, 'ajaxGetSupplierDetails']);

        Route::view('/bank-actions', 'bank.bankActions')->name('bank-actions');
        Route::get('/ajax-all-bank', [BankController::class, 'ajaxAllBank'])->name('ajax-all-bank');
        Route::post('/ajax-store-dw-data', [BankController::class, 'ajaxStoreDWData'])->name('ajax-store-dw-data');
        Route::get('/ajax-all-transactions', [BankController::class, 'ajaxAllTransactions'])->name('ajax-all-transactions');
        Route::post('/ajax-generate-report', [BankController::class, 'ajaxGenerateReport'])->name('ajax-generate-report');
        Route::get('/trx-reports', [BankController::class, 'TrxReport'])->name('trx-reports');

        Route::get('/all-expenses', [ExpenseController::class, 'allExpenses'])->name('all-expenses');
    });
});


Route::get('/table', [TableController::class, 'index']);
Route::get('/genarate-pdf', [TableController::class, 'generate_pdf']);

//purchase Route
Route::get('/purchase-report', [ExpenseController::class, 'purchase_view']);

//export excel file
Route::get('/excel-export', [ExpenseController::class, 'excel_export']);

//export csv file
Route::get('/csv-export', [ExpenseController::class, 'csv_export']);

//payment route
Route::get('/payment-insert', [ExpenseController::class, 'payment_field']);

//expense and Salary
Route::get('/expense', [ExpenseController::class, 'expense'])->name('expense');
Route::post('/expense', [ExpenseController::class, 'insert'])->name('insert-expense');
Route::get('/fetch-expense', [ExpenseController::class, 'getdata'])->name('fetch-expense');
Route::get('/edit-expense/{id}', [ExpenseController::class, 'edit_expense'])->name('edit-expense');
Route::put('/update-expense/{id}', [ExpenseController::class, 'update_expense'])->name('update-expense');
Route::get('/delete-expense/{id}', [ExpenseController::class, 'delete_expense'])->name('delete-expense');

//store section
Route::get('/store-list', [StoreController::class, 'store_list'])->name('store-list');
Route::get('/add-store', [StoreController::class, 'add_store'])->name('add-store');

Route::post('/insert-store', [StoreController::class, 'insert_store'])->name('insert-store');
Route::get('/edit-store/{id}', [StoreController::class, 'edit_store'])->name('edit-store');
Route::put('/update-store/{id}', [StoreController::class, 'update_store'])->name('update-store');

//Expense section

Route::get('/expense-category-list', [ExpenseCategoryController::class, 'expense_category_list'])->name('expense_category_list');
Route::get('/add-expense-category', [ExpenseCategoryController::class, 'add_expense_category'])->name('add-expense-category');
Route::post('/insert-expense-category', [ExpenseCategoryController::class, 'insert_expense_category'])->name('insert-expense-category');
Route::get('/edit-expense-category/{id}', [ExpenseCategoryController::class, 'edit_expense_category'])->name('edit-expense-category');
Route::put('/update-expense-category/{id}', [ExpenseCategoryController::class, 'update_expense_category'])->name('update-expense-category');

//Bank Section
Route::get('/bank-list', [BankController::class, 'bank_list'])->name('bank_list');
Route::get('/add-bank', [BankController::class, 'add_bank'])->name('add-bank');
Route::post('/insert-bank', [BankController::class, 'insert_bank'])->name('insert-bank');
Route::get('/edit-bank/{id}', [BankController::class, 'edit_bank'])->name('edit-bank');
Route::put('/update-bank/{id}', [BankController::class, 'update_bank'])->name('update-bank');

Auth::routes();
