<?php

return [
    /*
      |--------------------------------------------------------------------------
      | Api Key
      |--------------------------------------------------------------------------
      |
      | The connectus API key.
     */
    'api_key' => env('CONNECTUS_API_KEY'),
    /*
      |--------------------------------------------------------------------------
      | Account ID
      |--------------------------------------------------------------------------
      |
      | The connectus account id.
     */
    'account_id' => env('CONNECTUS_ACCOUNT_ID'),
    /*
      |--------------------------------------------------------------------------
      | Is Channel Active
      |--------------------------------------------------------------------------
      |
      | Activates or deactivates the Connectus channel.
     */
    'is_channel_active' => (bool) env('CONNECTUS_CHANNEL_ACTIVE', true),
    /*
      |--------------------------------------------------------------------------
      | Request Retries
      |--------------------------------------------------------------------------
      |
      | Specifies the number of retries when receiving a 500 error response.
     */
    'request_retries' => (int) env('CONNECTUS_REQUEST_RETRIES', 3),
    /*
      |--------------------------------------------------------------------------
      | Throw Exception On Error
      |--------------------------------------------------------------------------
      |
      | Specifies if an exception has to be thrown when an error occurs in the channel.
     */
    'throw_exception_on_error' => (bool) env('CONNECTUS_THROW_EXCEPTION_ON_ERROR', false),
];
