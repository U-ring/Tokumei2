<?php
  
  return [
      'consumer_key' => env('TWITTER_CLIENT_ID', ''),
      'consumer_secret' => env('TWITTER_CLIENT_SECRET', ''),
      'access_token' => env('TWITTER_ACCESS_TOKEN', ''),
      'access_token_secret' => env('TWITTER_ACCESS_TOKEN_SECRET', ''),
      'callback_url' => env('CALLBACK_URL', ''),
  ];