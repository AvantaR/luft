<?php

namespace Luft\ApiClient;

interface ApiClientInterface
{
    /**
     * @return mixed
     */
    public function getMetaIndexes();

    /**
     * @param array $headers
     * @return mixed
     */
    public function setHeaders(array $headers);
}
