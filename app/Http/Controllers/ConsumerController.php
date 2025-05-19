<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Crypt;

use App\Http\Traits\ConsumerLoginTrait;
use Illuminate\Support\Facades\Mail;

use App\Models\DeliveryAgent;
use App\Models\DeliveryAgency;
use App\Models\CartInformtion;
use App\Models\ConsumerInformation;
use App\Models\CartDelivery;
use App\Models\DeliveryStatusDefinition;

use App\Mail\InvitationMail;
use App\Models\ConsumerLogin;

class ConsumerController extends Controller
{
    private $ConsumerLoginTrait;

    function __construct(ConsumerLoginTrait $ConsumerLoginTrait)
    {

        $this->ConsumerLoginTrait = $ConsumerLoginTrait;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $consumerLogin = ConsumerLogin::orderBy('login_id', 'DESC')->get();

        return view('dashboard.consumer.allConsumer', compact(['consumerLogin']));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function viewConsumer($id)
    {
        $consumer_id = Crypt::decryptString($id);

        $allConsumerInfo = $this->ConsumerLoginTrait->allConsumerInfo($consumer_id);

        return view('dashboard.consumer.viewConsumer', compact(['allConsumerInfo']));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function CompletedDelivary($id)
    {
        $login_id = Crypt::decryptString($id);
        $CartInfo = CartInformtion::join('backoffice_login as usr', 'usr.login_id', '=', 'cart_informtion.created_by')
            ->join('backoffice_login as wtr', 'wtr.login_id', '=', 'cart_informtion.waiter_id')
            ->where('cart_informtion.consumer_id', '=', $login_id)
            ->select('cart_informtion.*', 'usr.full_name as created_by_name', 'wtr.full_name as waiter_name')
            ->get();


        return view('dashboard.consumer.completedDelivary', compact(['CartInfo']));
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function RunningOrders($id)
    {
        $consumer_id = Crypt::decryptString($id);

        $Cartinformation = CartInformtion::where('cart_informtion.delivery_status_id', '<', 8)
            ->where('cart_informtion.consumer_id', $consumer_id)
            ->get();

        $DeliveryStatus = DeliveryStatusDefinition::all();

        return view('dashboard.consumer.runningOrders', compact(['Cartinformation', 'DeliveryStatus']));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function viewChilds($id)
    {
        $consumer_id = Crypt::decryptString($id);

        $ConsumerInformation = ConsumerInformation::where('parent_id', $consumer_id)->get();

        $ParentInfo = ConsumerInformation::join('consumer_image', 'consumer_image.consumer_id', '=', 'consumer_information.consumer_id')
            ->where('consumer_information.consumer_id', $consumer_id)
            ->select('consumer_information.*', 'consumer_image.image')
            ->get();

        return view('dashboard.consumer.viewChilds', compact(['ConsumerInformation', 'ParentInfo']));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function sendMail()
    {
        $details = [
            'title' => 'Mail from Your Online Shop Ltd.',
            'body' => 'This is a test mail'
        ];

        Mail::to("contact@yyooss.com")->send(new InvitationMail($details));

        return "email sent";
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
