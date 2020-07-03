<?php

namespace App\Http\Controllers\API;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

use Twilio\Jwt\AccessToken;
use Twilio\Jwt\Grants\VideoGrant;

class AccessTokenController extends Controller
{
    protected $sid;
	protected $token;
	protected $key;
	protected $secret;

	public function __construct()
	{
	   $this->sid = config('services.twilio.sid');
	   $this->token = config('services.twilio.token');
	   $this->key = config('services.twilio.key');
	   $this->secret = config('services.twilio.secret');
	}

	public function generate_token() 
	{
		
		$identity = uniqid();

		$token = new AccessToken(
			$this->sid,
			$this->key,
			$this->secret,
			3600,
			$identity
		);

		$videoGrant = new VideoGrant();
		$videoGrant->setRoom('my room');
		$token->addGrant($videoGrant);

		echo $token->toJWT();

	}
}
