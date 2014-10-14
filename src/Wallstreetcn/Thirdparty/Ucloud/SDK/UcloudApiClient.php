<?php

// +----------------------------------------------------------------------
// | [ucloud-php-sdk]
// +----------------------------------------------------------------------
// | Author: Mr.5 <mr5.simple@gmail.com>
// +----------------------------------------------------------------------
// + Datetime: 2014-10-14 16:56
// +----------------------------------------------------------------------
// + UcloudApiClient.php
// +----------------------------------------------------------------------

namespace Wallstreetcn\Thirdparty\Ucloud\SDK;

function _verfy_ac($private_key, $params)
{
    ksort($params);
    print_r($params);
    $params_data = "";
    foreach ($params as $key => $value) {
        $params_data .= $key;
        $params_data .= $value;
    }
    $params_data .= $private_key;
    return sha1($params_data);
}

class UcloudApiClient
{

    function __construct($base_url, $public_key, $private_key)
    {
        $this->conn = new UConnection($base_url);
        $this->public_key = $public_key;
        $this->private_key = $private_key;
    }

    function get($api, $params)
    {
        $params["public_key"] = $this->public_key;
        $params["access_token"] = _verfy_ac($this->private_key, $params);

        print_r($params);
        return $this->conn->get($api, $params);
    }

    function post($api, $params)
    {
        $params["public_key"] = $this->public_key;
        $params["access_token"] = _verfy_ac($this->private_key, $params);
        return $this->conn->post($api, $params);
    }

    function put($api, $params)
    {
        $params["public_key"] = $this->public_key;
        $params["access_token"] = _verfy_ac($this->private_key, $params);
        return $this->conn->put($api, $params);
    }

    function delete($api, $params)
    {
        $params["public_key"] = $this->public_key;
        $params["access_token"] = _verfy_ac($this->private_key, $params);
        return $this->conn->delete($api, $params);
    }
}
