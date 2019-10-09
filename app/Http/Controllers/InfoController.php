<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
// use App\Client;

class InfoController extends Controller
{

   public function getAllClients()
	{
	   return Response()->json(\App\Client::all(),200);
	}

  public function getDataForSessionChart()
  {
    $client = new \GuzzleHttp\Client(['base_uri' => 'https://onesignal.com/api/v1/']);
    $app_id = env('ONESIGNAL_APP_ID','471295b1-920f-4815-b3d1-3b9c3ae76d5f');
    $rest_api_key= env('ONESIGNAL_REST_API_KEY','ZGE5Y2I2ZTktMmNjOS00YWM2LWJmOGMtMmRiMzNmNDg2ZjBi');
    $response = $client->request('GET', 'players?app_id='.$app_id,
        ['headers'=>['Authorization'=> 'Basic '.$rest_api_key]]);
    $data = json_decode($response->getBody());
    $m=0;$t=0;$w=0;$tw=0;$f=0;$s=0;$ss=0;
    // set users
    $players = $data->players;

    //$weekday = date('N', $timestamp); // 1-7
    //$month = date('m', $timestamp); // 1-12
    //$day = date('d', $timestamp); // 1-31
    //$results = objectToArray( $results );
      //foreach ($object->values as $arr)
      //
      //
      //
      //
      // foreach ($data->players as $key => $player)
      // {
      //
      // }
      //
      // return $data->total_count;

    foreach ($players as $key => $player) {
      $weekday = date('N',$player->last_active);
      switch ($weekday) {
        case '1':
          $m+=1;
          break;
        case '2':
          $t+=1;
          break;
        case '3':
          $w+=1;
          break;
        case '4':
            $tw+=1;
            break;
        case '5':
            $f+=1;
            break;
        case '6':
            $s+=1;
            break;
        case '7':
            $ss+=1;
            break;
      }
    }

  $sessions = array($m,$t,$w,$tw,$f,$s,$ss);

  return Response()->json(["sessions"=>$sessions],200);

  }

	public function getDataForInscriptionChart()
	{
    $times = \App\Client::all('created_at');
		$m1=0;$m2=0;$m3=0;$m4=0;$m5=0;$m6=0;$m7=0;$m8=0;$m9=0;$m10=0;$m11=0;$m12=0;
		foreach ($times as $key => $time) {
			$time =strtotime($time);
			$mon = date("m",$time);
			switch ($mon) {
				case '01':
					$m1++;
					break;
				case '02':
					$m2++;
					break;
				case '03':
					$m3++;
					break;
				case '04':
					$m4++;
					break;
				case '05':
					$m5++;
					break;
				case '06':
					$m6++;
					break;
				case '07':
					$m7++;
					break;
				case '08':
					$m8++;
					break;
				case '09':
					$m9++;
					break;
				case '10':
					$m10++;
					break;
				case '11':
					$m11++;
					break;
				case '12':
					$m12++;
					break;
			}
		}
    $data = array($m1,$m2,$m3,$m4,$m5,$m6,$m7,$m8,$m9,$m10,$m11,$m12);
    return Response()->json(['inscriptions'=>$data],200);
    }

	public function getDataForChartNotification()
	 {

     $client = new \GuzzleHttp\Client(['base_uri' => 'https://onesignal.com/api/v1/']);
     $app_id=env('ONESIGNAL_APP_ID','471295b1-920f-4815-b3d1-3b9c3ae76d5f');
     $rest_api_key=env('ONESIGNAL_REST_API_KEY','ZGE5Y2I2ZTktMmNjOS00YWM2LWJmOGMtMmRiMzNmNDg2ZjBi');
     $response = $client->request('GET', 'notifications?app_id='.$app_id,
         ['headers'=>['Authorization'=> 'Basic '.$rest_api_key]]);
     $data = json_decode($response->getBody());
     $m1=0;$m2=0;$m3=0;$m4=0;$m5=0;$m6=0;$m7=0;$m8=0;$m9=0;$m10=0;$m11=0;$m12=0;
     // set notification
     $notifications = $data->notifications;
     foreach ($notifications as $key => $notification) {
       	$month = date('m', $notification->completed_at);
        switch ($month) {
  				case '01':
  					$m1 += $notification->successful;
  					break;
  				case '02':
  					$m2 += $notification->successful;
  					break;
  				case '03':
  					$m3 += $notification->successful;
  					break;
  				case '04':
  					$m4 += $notification->successful;
  					break;
  				case '05':
  					$m5 += $notification->successful;
  					break;
  				case '06':
  					$m6 += $notification->successful;
  					break;
          case '07':
    					$m7 += $notification->successful;
    					break;
    			case '08':
    					$m8 += $notification->successful;
    					break;
    			case '09':
    					$m9 += $notification->successful;
    					break;
    			case '10':
    					$m10 += $notification->successful;
    					break;
    			case '11':
    					$m11 += $notification->successful;
    					break;
    			case '12':
    					$m12 += $notification->successful;
    					break;
    			}
     }

     $data = array($m1,$m2,$m3,$m4,$m5,$m6,$m7,$m8,$m9,$m10,$m11,$m12);
     return Response()->json(['notifications'=>$data],200);

	 }


	public function storeClient()
	{
		$data = request()->all();
		$client =\App\Client::where('device_id',$data['push'])->first();
		if($client)
		{
		  $client->sendPushNotification(['title'=>'registration status','content'=>'you are already registred']);
			return Response()->json(['status'=>'you are already registred'],200);
		}
		else
		{
			$client =\App\Client::create(
			['name' =>$data['username'],'email'=>$data['email'],'device'=>$data['device'],
			'location'=>$data['location'],'device_id'=>$data['push'],
			'lat'=>$data['lat'],'lng'=>$data['lng']]);
		$client->sendPushNotification(['title'=>'registration status','content'=>'you are registred successfuly']);
			return Response()->json(['status'=>'you are registred successfuly'],200);
		}
	}

  public function storeLocation() 
  {
    $data = request()->all();
    $client =\App\Client::where('device_id',$data['device_id'])
                          ->update(['location' => $data['location'],'lat'=>$data['lat'],'lng'=>$data['lng']]);
    
    $client =\App\Client::where('device_id',$data['device_id'])->first();
    $client->sendPushNotification(['title'=>'your location :','content'=>' is set successfuly']);
    return Response()->json(['status'=>'your location is set successfuly'],200);
  }
}
