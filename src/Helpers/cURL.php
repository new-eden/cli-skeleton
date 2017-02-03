<?php

namespace App\Helpers;

class cURL {
    public function getData(string $url, array $headers = array()) {
        // Merge the headers from the request with the default headers
        $headers = array_merge(array("Connection: keep-alive", "Keep-Alive: timeout=60, max=1000"), $headers);

        // Init curl
        $curl = curl_init();

        // Setup cURL
        curl_setopt_array($curl, array(
            CURLOPT_USERAGENT => "",
            CURLOPT_TIMEOUT => 180,
            CURLOPT_POST => false,
            CURLOPT_FORBID_REUSE => false,
            CURLOPT_ENCODING => "",
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_FAILONERROR => true,
        ));

        // Get the data
        return curl_exec($curl);
    }

    public function sendData(string $url, $postData = array(), $headers = array()) {
        // Define default headers
        if (empty($headers)) {
            $headers = array("Connection: keep-alive", "Keep-Alive: timeout=10, max=1000");
        }

        // Init curl
        $curl = curl_init();

        // Init postLine
        $postLine = "";

        // Populate the $postData
        if (!empty($postData)) {
            foreach ($postData as $key => $value) {
                $postLine .= $key . "=" . $value . "&";
            }
        }

        if(empty($postData))
            return null;

        // Trim the last &
        rtrim($postLine, "&");

        // Setup cURL
        curl_setopt_array($curl, array(
            CURLOPT_USERAGENT => "",
            CURLOPT_POST => count($postData),
            CURLOPT_POSTFIELDS => $postData,
            CURLOPT_URL => $url,
            CURLOPT_HTTPHEADER => $headers,
            CURLOPT_SSL_VERIFYPEER => true,
            CURLOPT_SSL_VERIFYHOST => 2,
            CURLOPT_RETURNTRANSFER => 1,
        ));

        // Execute the curl request
        $result = curl_exec($curl);

        // Close curl, we're not reusing this one..
        curl_close($curl);

        // Return the result
        return $result;
    }
}