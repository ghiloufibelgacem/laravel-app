<?php

namespace App\Http\Controllers;
use App\Client;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\View\View
     */
    public function index()
    {

        $count=$this->getDataFromOneSignalApi();

        $android = DB::table('clients')
                ->where('device', 'android')
                ->count();
        $ios = DB::table('clients')
                ->where('device', 'ios')
                ->count();
                
        return view('dashboard',['totalNotification'=>$count,'totalAndroid'=>$android,'totalIos'=>$ios,'totalDevice'=>$android+$ios]);
    }

    public function getDataFromOneSignalApi()
    {
        $client = new \GuzzleHttp\Client(['base_uri' => 'https://onesignal.com/api/v1/']);
        $app_id = env('ONESIGNAL_APP_ID','471295b1-920f-4815-b3d1-3b9c3ae76d5f');
        $rest_api_key= env('ONESIGNAL_REST_API_KEY','ZGE5Y2I2ZTktMmNjOS00YWM2LWJmOGMtMmRiMzNmNDg2ZjBi');
        $response = $client->request('GET', 'notifications?app_id='.$app_id,
            ['headers'=>['Authorization'=> 'Basic '.$rest_api_key]]);
        $data = json_decode($response->getBody());
        return $data->total_count;
    }
}
