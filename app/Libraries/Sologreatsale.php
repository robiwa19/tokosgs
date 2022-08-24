<?php

namespace App\Libraries;

use GuzzleHttp\Client;

class Sologreatsale {
    const APP_URL = 'https://sologreatsale.com/api';

    public static function news() {
        $url = self::APP_URL . '/activities';

        $client = new Client;
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() !== 200) {
            return [];
        } else {
            $result = [];
            $data = json_decode($response->getBody(), true);
            foreach ($data as $value) {
                if ($value['type'] == 'News') {
                    $result[] = $value;
                }
            }

            return $result;
        }
    }

    public static function sponsors() {
        $url = self::APP_URL . '/supporting';

        $client = new Client;
        $response = $client->request('GET', $url);
        if ($response->getStatusCode() !== 200) {
            return [];
        } else {
            $result = [];
            $data = json_decode($response->getBody(), true);
            foreach ($data['data'] as $value) {
                $value['image'] = $data['url_image'] . $value['image']['image'];
                $result[] = $value;
            }

            return $result;
        }
    }
}
