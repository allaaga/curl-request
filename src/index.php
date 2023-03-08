<?php

namespace DoskaYkt\HTTP;

class CURLRequest
{
    /**
     * Undocumented function
     *
     * @param string $requestUrl
     * @param float  $httpVersion
     * @param array  $requestHeaders
     *
     * @return string
     */
    public function get(string $requestUrl, float $httpVersion = 1.1, array $requestHeaders = []): string
    {
        $curlSession = curl_init();

        $curlParameters = [
            CURLOPT_FRESH_CONNECT  => true,
            CURLOPT_HEADER         => true,
            CURLOPT_RETURNTRANSFER => true,
            CURLOPT_SSL_VERIFYPEER => false,
            CURLOPT_CONNECTTIMEOUT => 60,
            CURLOPT_URL            => $requestUrl,
            CURLOPT_HTTP_VERSION   => $httpVersion,
            CURLOPT_HTTPHEADER     => $requestHeaders
        ];

        curl_setopt_array($curlSession, $curlParameters);

        $response = curl_exec($curlSession);
        $response = $this->separateResponse($curlSession, $response);

        curl_close($curlSession);

        return $response['body'];
    }

    /**
     * Undocumented function
     *
     * @param string $requestUrl
     * @param float  $httpVersion
     * @param array  $requestHeaders
     *
     * @return string
     */
    public function post()
    {
        // here code...
    }

    /**
     * Undocumented function
     *
     * @param string $requestUrl
     * @param float  $httpVersion
     *
     * @return array
     */
    private function separateResponse($curlSession, string $response): array
    {
        $headerSize = curl_getinfo($curlSession, CURLINFO_HEADER_SIZE);

        $headers = substr($response, 0, $headerSize);
        $headers = trim($headers);

        $body = substr($response, $headerSize);

        return [
            'headers' => $headers,
            'body'    => $body
        ];
    }

    /**
     * Undocumented function
     *
     * @param string $requestUrl
     * @param float  $httpVersion
     * @param array  $requestHeaders
     *
     * @return string
     */
    public function toArray()
    {
        // here code...
    }
}
