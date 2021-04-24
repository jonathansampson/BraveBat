reddit secret: X2kXD9B_ttQHaZrdCaskBLiu3Rnetw
reddit ID: 2JcKAdFG8-cU3w

// reddit username
$username = 'YOUR-REDDIT-USERNAME';

// reddit password
$password = 'YOUR-REDDIT-PASSWORD';

// client id
$clientId = 'YOUR-REDDIT-APP-CLIENT-ID';

// client secret
$clientSecret = 'YOUR-REDDIT-APP-CLIENT-SECRET';

// post params
$params = array(
'grant_type' => 'password',
'username' => $username,
'password' => $password
);

// curl settings and call to reddit
$ch = curl_init( 'https://www.reddit.com/api/v1/access_token' );
curl_setopt( $ch, CURLOPT_USERPWD, $clientId . ':' . $clientSecret );
curl_setopt( $ch, CURLOPT_RETURNTRANSFER, true );
curl_setopt( $ch, CURLOPT_CUSTOMREQUEST, 'POST' );
curl_setopt( $ch, CURLOPT_POSTFIELDS, $params );
curl_setopt( $ch, CURLOPT_SSL_VERIFYPEER, FALSE );
