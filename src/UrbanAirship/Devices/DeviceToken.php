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

    function __construct(Airship $airship, $deviceToken)
    {
        $this->airship = $airship;
        $this->deviceToken = $deviceToken;
    }

    public function info() {

        $url = $this->airship->buildUrl(self::cURL, [
            "device_token" => $this->deviceToken
        ]);

        $response = $this->airship->request("GET", null, $url);

        return $response;
    }


    /**
     * Takes the current page and retrieves the next
     * page of results. Returns
     * @return bool
     */
    private function loadNextPage()
    {
        if (!isset($this->page)) {
            $next = $this->start_url;
        } elseif (isset($this->page->{static::NEXT_PAGE_KEY})) {
            $next = $this->page->{static::NEXT_PAGE_KEY};
        } else {
            return false;
        }

        $response = $this->airship->request("GET", null, $next, null, 3);
        $this->page = json_decode($response->raw_body);
        $this->position = 0;
        return true;
    }
}
