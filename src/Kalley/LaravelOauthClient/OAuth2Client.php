<?php namespace Kalley\LaravelOauthClient;

class OAuth2Client extends AbstractOAuthClient {

  protected $namespace = 'League\OAuth2\Client\Provider\\';
  protected $mapped = [
    'eventbrite' => 'Eventbrite',
    'facebook'   => 'Facebook',
    'github'     => 'Github',
    'google'     => 'Google',
    'instagram'  => 'Instagram',
    'linkedin'   => 'LinkedIn',
    'microsoft'  => 'Microsoft',
  ];

  public function authorize() {
    return \Redirect::to($this->getAuthorizationUrl());
  }

  public function getAccessToken($code) {
    $params = ['code' => $code];
    if ( $this->providerName === 'eventbrite' ) {
      $params['grant_type'] = 'authorization_code';
    }
    $this->token = $this->provider->getAccessToken('authorization_code', $params);
    return $this->token;
  }

  public function refreshToken() {
    $grant = new \League\OAuth2\Client\Grant\RefreshToken();
    $this->token = $this->provider->getAccessToken($grant, ['refresh_token' => $this->token->refreshToken]);
    return $this->token;
  }

  public function __get($property) {
    switch ( $property ) {
      case 'accessToken': return $this->token->accessToken;
      case 'refreshToken': return $this->token->refreshToken;
      case 'expires': return $this->token->expires;
    }

  }

}
