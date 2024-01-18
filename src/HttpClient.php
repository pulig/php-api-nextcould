<?php

namespace Pulig\NextCloudAPI;

use GuzzleHttp\Client;

class HttpClient
{
    public static function create(string $host, string $user, string $pass): Client
    {
        $url = parse_url($host);

        $scheme = $url['scheme'] ?? 'http';
        $host = $url['host'] ?? $host;
        $path = trim($url['path'] ?? '', '/');

        $base_uri = "$scheme://{$user}:{$pass}@{$host}{$path}";
        $base_uri .= '/ocs/v1.php/cloud/';

        return new Client([
            'base_uri' => $base_uri,
        ]);
    }
}
