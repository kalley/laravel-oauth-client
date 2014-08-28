<?php namespace Kalley\LaravelOauthClient;

use \Session;
use \Redirect;

class OAuth1Client extends AbstractOAuthClient {

  protected $namespace = 'League\OAuth1\Client\Server\\';
  protected $mapped = [
	  'twitter'    => 'Twitter',
	  'bitbucket'  => 'Bitbucket',
	  'tumblr'     => 'Tumblr',
  ];

  public function getTemporaryCredentials() {
    $temporaryCredentials = $this->provider->getTemporaryCredentials();
    return $temporaryCredentials;
  }

  public function authorize($temporaryCredentials = null) {
    if ( $temporaryCredentials === null ) {
      $temporaryCredentials = $this->getTemporaryCredentials();
    }
    Session::put('twitter_temporary_credentials', $temporaryCredentials);
    return Redirect::to($this->provider->getAuthorizationUrl($temporaryCredentials));
  }

  public function getAccessToken($code) {
    $temporaryCredentials = Session::get('twitter_temporary_credentials');
    $this->token = $this->provider->getTokenCredentials($temporaryCredentials, $code['oauth_token'], $code['oauth_verifier']);
    return $this->token;
  }

}