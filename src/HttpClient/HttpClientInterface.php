<?php
namespace Luft\HttpClient;

interface HttpClientInterface
{
    public function request(string $method, string $endpoint);
}