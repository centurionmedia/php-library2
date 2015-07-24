<?php
/*
Copyright 2013 Urban Airship and Contributors
*/

namespace UrbanAirship\Devices;

use UrbanAirship\Airship;

class DeviceToken
{
    const cURL = "/api/device_tokens";

    private $airship;
    private $deviceToken;

    function __construct($airship, $deviceToken)
    {
        $this->airship = $airship;
        $this->deviceToken = $deviceToken;
    }

    public function info() {

        $url = $this->airship->buildUrl(self::cURL, array(
            "device_token" => $this->deviceToken
        ));

        $response = $this->airship->request("GET", null, $url);

        return $response;
    }
}
