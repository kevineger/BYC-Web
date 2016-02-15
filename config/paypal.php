<?php
return array(
    'client_id' => 'AVhpQKX6Oi1dbBpTLhCUupiT2Zej0bzM3i54mIPdWwXfisy5vW9HrbTomTbgugkDcM4aVKTl3G0U1nD1',
    'secret'    => 'EJ7ueU5EuFy8Qhg5NjrodqyjEN2Yti0B5_ECK9iBmziwBLSYAHHrdZA0iByqrOyWCcA12N4oaxP1wYg8',

    /*
     * SDK Config
     * */

    'settings' => array(
        /**
         * Available option 'sandbox' or 'live'
         */
        'mode'                   => 'sandbox',

        /**
         * Specify the max request time in seconds
         */
        'http.ConnectionTimeOut' => 30,

        /**
         * Whether want to log to a file
         */
        'log.LogEnabled'         => true,

        /**
         * Specify the file that want to write on
         */
        'log.FileName'           => storage_path() . '/logs/paypal.log',

        /**
         * Available option 'FINE', 'INFO', 'WARN' or 'ERROR'
         *
         * Logging is most verbose in the 'FINE' level and decreases as you
         * proceed towards ERROR
         */
        'log.LogLevel'           => 'FINE'
    ),
);