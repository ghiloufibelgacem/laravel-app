<?php

/*
|--------------------------------------------------------------------------
| Web Routes
|--------------------------------------------------------------------------
|
| Here is where you can register web routes for your application. These
| routes are loaded by the RouteServiceProvider within a group which
| contains the "web" middleware group. Now create something great!
|
*/

Route::get('/', function () {
    return view('welcome');
});

Auth::routes();

Route::get('/home', 'HomeController@index')->name('home')->middleware('auth');

Route::group(['middleware' => 'auth'], function () {

	Route::get('/', function () {
    	return redirect('/home');
	});

	Route::get('table-list', function () {
        $clients = \App\Client::paginate(4);
		return view('pages.table_list',['clients'=>$clients]);
	})->name('table');

	Route::get('map', function () {
		return view('pages.map');
	})->name('map');

	Route::get('notifications', function () {
		return view('pages.notifications');
    })->name('notifications');

    Route::get('notifications/{id}', function ($id) {
		return view('pages.notifications',['clientKey'=>$id]);
	})->name('notifications');

	Route::post('notifications', function () {
		// TODO refactoring this code
		$data= request()->all();
    // dd($data);die();
		if($data['clientKey'])
		{
			$client = \App\Client::where('device_id',$data['clientKey'])->first();
			$client->sendPushNotification(['title'=>$data['title'],'content'=>$data['content']]);
      // flash screen to user
 	   session()->
 	   flash('statusNotification','notification has been pushed successfuly to '.$client['name'].'');
			return view('pages.notifications');
		}
		if($data['platform']=='all')
		{
			$clients = \App\Client::all();
			foreach($clients as $client)
			 	$client->sendPushNotification(['title'=>$data['title'],'content'=>$data['content']]);
        // flash screen to user
   	   session()->
   	   flash('statusNotification','notification has been pushed successfuly');
			return view('pages.notifications');
		}
		else
		{
			if($data['platform']=='both')
			{
			   $clients = \App\Client::where('lat','<=',$data['latitude'])
									   ->where('lng','<=',$data['longitude'])
									   ->get();
			  foreach($clients as $client)
			  $client->sendPushNotification(['title'=>$data['title'],'content'=>$data['content']]);
        // flash screen to user
   	   session()->
   	   flash('statusNotification','notification has been pushed successfuly');
			  return view('pages.notifications');
			}
			else
			{
				if($data['platform']=='android')
				{
				 $clients = \App\Client::where('lat','<=',$data['latitude'])
									   ->where('lng','<=',$data['longitude'])
									   ->where('device','android')
									   ->get();
				foreach($clients as $client)
			 	$client->sendPushNotification(['title'=>$data['title'],'content'=>$data['content']]);
        // flash screen to user
   	   session()->
   	   flash('statusNotification','notification has been pushed successfuly');
			    return view('pages.notifications');
				}
				else
				{
					$clients = \App\Client::where('lat','<=',$data['latitude'])
									   ->where('lng','<=',$data['longitude'])
									   ->where('device','ios')
									   ->get();
				foreach($clients as $client)
			 	$client->sendPushNotification(['title'=>$data['title'],'content'=>$data['content']]);
        // flash screen to user
   	   session()->
   	   flash('statusNotification','notification has been pushed successfuly');
			    return view('pages.notifications');
				}
			}

		}
	})->name('notifications');

});

Route::group(['middleware' => 'auth'], function () {
	Route::resource('user', 'UserController', ['except' => ['show']]);
	Route::get('profile', ['as' => 'profile.edit', 'uses' => 'ProfileController@edit']);
	Route::put('profile', ['as' => 'profile.update', 'uses' => 'ProfileController@update']);
	Route::put('profile/password', ['as' => 'profile.password', 'uses' => 'ProfileController@password']);
});
