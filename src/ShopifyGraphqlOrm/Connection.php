<?php

namespace MiraTech\ShopifyGraphqlOrm;

use MiraTech\ShopifyGraphqlOrm\Contracts\Query\Builder as QueryBuilderInterface;
use MiraTech\ShopifyGraphqlOrm\Query\Builder;

class Connection implements \MiraTech\ShopifyGraphqlOrm\Contracts\Connection
{
    public function __construct()
    {
    }

    public function query(): QueryBuilderInterface
    {
        return new Builder($this);
    }

    public function getAccessToken(): string
    {
        return config('shopify_graphql_orm.access_token');
    }
}
