<?php

namespace App;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Notifications\Notifiable;
use App\Notifications\Push;
class Client extends Model
{
    use Notifiable;

    protected $fillable = ['name','email','device','location','device_id','lat','lng'];
    
    /**
     * The table associated with the model.
     *
     * @var string
     */
    protected $table = 'clients';
    /**
    * method to send push notification to the client
    *
    */
    public function sendPushNotification($data)
	{
		$this->notify(new Push($data));
	}
	public function routeNotificationForOneSignal()
    {
        return $this->device_id;
    }
}
