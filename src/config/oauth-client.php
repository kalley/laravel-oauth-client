<?php

return [

  /*
  |--------------------------------------------------------------------------
  | Database Connection to use
  |--------------------------------------------------------------------------
  |
  | Set the default database connection to use for the repositories,
  | when set to default, it uses whatever connection you specified in your laravel db config.
  |
  */
  'database' => 'default',

  /*
  |--------------------------------------------------------------------------
  | Providers to use
  |--------------------------------------------------------------------------
  |
  | Available providers:
  |
  | OAuth 1 server:
  |   Twitter
  |   Bitbucket
  |   Tumblr
  |
  | OAuth 2:
  |   Eventbrite
  |   Facebook
  |   Github
  |   Google
  |   Instagram
  |   LinkedIn
  |   Microsoft
  |
  | Configure like (replace oauth1server with name from above, and oauth2provider with provider from above):
  |
  | 'providers' => [
  |   'oauth1server' => [
  |     'identifier' => 'your-identifier',
  |     'secret' => 'your-secret',
  |     'callback_uri' => 'http://your-callback-uri/'
  |   ],
  |   'oauth2provider' => [
  |     'clientId'  =>  'XXXXXXXX',
  |     'clientSecret'  =>  'XXXXXXXX',
  |     'redirectUri'   =>  'https://your-registered-redirect-uri/'
  |   ]
  | ]
  |
  */
  'providers' => [

  ],
];