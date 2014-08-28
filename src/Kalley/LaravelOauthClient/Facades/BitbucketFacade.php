<?php namespace Kalley\LaravelOauthClient\Facades;

use Illuminate\Support\Facades\Facade;

class BitbucketFacade extends Facade {
  /**
   * Get the registered name of the component
   * @return string
   * @codeCoverageIgnore
   */
  protected static function getFacadeAccessor() {
    return 'oauth-client.butbucket';
  }
}