<?php

namespace App\Helpers;

/**
 * Helper class to manage store data
 * Helper class
 * @package App\Helpers
 */
class Store
{
    /**
     * Shopify Api url
     * @var string
     */
    private static $store = 'dev-giraffe.myshopify.com';

    /**
     * Api key
     * @var string
     */
    private static  $key = '8522e497732817fa8a36d4a36b6749da';

    /**
     * Api password
     * @var string
     */
    private static  $password = 'bb2adc93b8016981af2d0f45c4d3a38d';

    /**
     * Get customers from store API
     * @return mixed
     */
    public static function getCustomers()
    {
        $endpoint = 'https://' . self::$key . ':' . self::$password . '@' . self::$store . '/admin/customers.json';
        $curl = curl_init();
        curl_setopt_array($curl, array(
            CURLOPT_URL => $endpoint,
            CURLOPT_RETURNTRANSFER => 1
        ));
        $result = curl_exec($curl);
        return $result;
    }
}