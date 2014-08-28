<?php namespace Kalley\LaravelOauthClient;

use \Input;

abstract class AbstractOAuthClient {

  protected $provider;
  protected $providerName;
  protected $token;

  public static function factory($providerName, $config) {
    $providerName = strtolower($providerName);
    switch ( $providerName ) {
      case 'twitter':
      case 'bitbucket':
      case 'tumblr':
        return new OAuth1Client($providerName, $config);
      default:
        return new OAuth2Client($providerName, $config);
    }
  }

  public function __construct($providerName, $config) {
    $this->providerName = strtolower($providerName);
    $providerClass = $this->namespace . $this->mapped[$this->providerName];
    $this->provider = new $providerClass($config);
  }

  abstract public function getAccessToken($code);

  public function getUserDetails() {
    if ( ! $this->token ) {
      throw new \Exception('You must first get the access token before getting user details.');
    }
    return $this->provider->getUserDetails($this->token);
  }

  public function refreshToken() {
    return $this->token;
  }

  public function __call($method, $args) {
    if ( method_exists($this->provider, $method) ) {
      switch(count($args)) {
        case 0: return $this->provider->$method();
        case 1: return $this->provider->$method($args[0]);
        case 2: return $this->provider->$method($args[0], $args[1]);
        case 3: return $this->provider->$method($args[0], $args[1], $args[2]);
        case 4: return $this->provider->$method($args[0], $args[1], $args[2], $args[3]);
        case 5: return $this->provider->$method($args[0], $args[1], $args[2], $args[3], $args[4]);
        default: return call_user_func_array($method, $args);
      }
    }
    // Throw an Exception?
  }
}