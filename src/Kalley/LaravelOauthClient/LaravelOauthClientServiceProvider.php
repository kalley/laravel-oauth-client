<?php namespace Kalley\LaravelOauthClient;

use Illuminate\Support\ServiceProvider;
use Kalley\LaravelOauthClient\Console\MigrationCommand;

class LaravelOauthClientServiceProvider extends ServiceProvider {

  /**
   * Indicates if loading of the provider is deferred.
   *
   * @var bool
   */
  protected $defer = false;

  protected function config($key) {
  	return isset($_ENV['oauth-client'][$key]) ? $_ENV['oauth-client'][$key] : $this->app['config']->get('laravel-oauth-client::oauth-client.' . $key);
  }

  /**
   * Bootstrap the application events.
   *
   * @return void
   */
  public function boot() {
    $this->package('kalley/laravel-oauth-client');
  	$providers = $this->config('providers');
  	foreach ( $providers as $provider => $config ) {
  	  $provider = strtolower($provider);
      $this->app->bindShared('oauth-client.' . $provider, function($app) use($provider, $config) {
        return AbstractOAuthClient::factory($provider, $config);
      });
  	}
  }

  /**
   * Register the service provider.
   *
   * @return void
   */
  public function register() {
    $this->registerCommands();
  }

  public function registerCommands() {
  	$this->app->bindShared('command.oauth-client.migration', function ($app) {
      return new MigrationCommand($app);
    });
    $this->commands('command.oauth-client.migration');
  }

  /**
   * Get the services provided by the provider.
   *
   * @return array
   */
  public function provides() {
  	return [];//array_map('strtolower', array_keys($this->config('providers')));
  }

}
