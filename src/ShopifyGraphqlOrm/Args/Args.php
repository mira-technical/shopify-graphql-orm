<?php

namespace MiraTech\ShopifyGraphqlOrm\Args;

class Args implements \MiraTech\ShopifyGraphqlOrm\Contracts\Args
{
    public function __invoke()
    {
        return $this->invoke();
    }
}
