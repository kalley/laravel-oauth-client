# OAuth 1.0 and 2.0 Client for Laravel

This package is built upon [The PHP League's](https://github.com/thephpleague) OAuth Client libraries.

It provides facades for the packaged servers/providers and unites the API across both.

*I understand that may seem strange, since there is different language associated with each version, but it makes it easier to use both*

### Disclaimer

This has only been tested using authentication and getting user details. I haven't attempted to use these to make further API calls yet.

## Requirements

*from [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client)*

The following versions of PHP are supported.

* PHP 5.4
* PHP 5.5
* PHP 5.6
* HHVM

## Servers/Providers included

* OAuth 1.0
  * Bitbucket
  * Tumblr
  * Twitter
* OAuth 2.0
  * Eventbrite
  * Facebook
  * Github
  * Google
  * Instagram
  * LinkedIn
  * Microsoft

## Package Installation

Add the following line to your composer.json file:

```javascript
"kalley/laravel-oauth-client": "dev-master"
```

or run `composer require kalley/laravel-oauth-client:dev-master` from the command line

Add this line of code to the ```providers``` array located in your ```app/config/app.php``` file:
```php
'Kalley\LaravelOauthClient\LaravelOauthClientServiceProvider',
```

### Configuration

In order to use the OAuth Client, publish its configuration first

```
php artisan config:publish kalley/laravel-oauth-client
```

Afterwards edit the file ```app/config/packages/kalley/laravel-oauth-client/oauth-client.php``` to suit your needs.

You will probably want to go ahead and add Facades for the providers you're planning to use as well. For example, if you were integration Facebook:

```
'Facebook' => 'Kalley\LaravelOauthClient\Facades\FacebookFacade',
```

and so on. If you don't do this, you can call them using `App::make('oauth-client.facebook')`;

These will return an instance of the `AbstractOAuthClient` class.

### Migrations

This package comes with all the migrations you need to run a full featured oauth2 server. Run:

```
php artisan oauth-client:migrations
```

## Usage

#### User authorization

This will take care of everything, including the redirection to the service

```
Facebook::authorize();
```

#### Getting the access token

    For OAuth 1.0:
    ```
    $token = Twitter::getAccessToken(['oauth_token' => Input::get('oauth_token'), 'oauth_verifier' => Input::get('oauth_verifier')]);
    ```

    For OAuth 2.0:
    ```
    $token = Facebook::getAccessToken(Input::get('code'));
    ```

#### Getting user details

__You will need to get the access token first.__

```
$social_user = Facebook::getUserDetails();
```

After that, it's pretty much up to you at this point. If you want to get a better idea of what is going on, please take a look at the required packages:

* [OAuth 1.0 Client](https://github.com/thephpleague/oauth1-client)
* [OAuth 2.0 Client](https://github.com/thephpleague/oauth2-client)

## Support

Bugs and feature request are tracked on [GitHub](https://github.com/kalley/laravel-oauth-client/issues)

## License

This package is released under the MIT License.

## Credit

The code on which this package is based is primarily developed and maintained by [Alex Bilbie](https://twitter.com/alexbilbie).