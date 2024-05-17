<?php

namespace MiraTech\ShopifyGraphqlOrm\Contracts;

use MiraTech\ShopifyGraphqlOrm\Contracts\Query\Builder;

interface Connection
{
    public function query(): Builder;

    public function getAccessToken(): string;
}
