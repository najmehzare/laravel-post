<?php

namespace App\Services;

use Elastic\Elasticsearch\ClientBuilder;

class ElasticClient
{
    public static function client()
    {
        return ClientBuilder::create()
            ->setHosts(['localhost:9200'])
            ->build();
    }
}
