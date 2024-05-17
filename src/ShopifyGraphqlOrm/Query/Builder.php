<?php

namespace MiraTech\ShopifyGraphqlOrm\Query;

use MiraTech\ShopifyGraphqlOrm\Contracts\Connection;

class Builder implements \MiraTech\ShopifyGraphqlOrm\Contracts\Query\Builder
{
    private $action;

    private $argumentDefinition;

    private $arguments;

    private $selects;

    public function __construct(private Connection $connection)
    {
    }

    public function setAction(string $action)
    {
        $this->action = $action;
    }

    public function setArgumentDefinition(string $argumentDefinition)
    {
        $this->argumentDefinition = app($argumentDefinition);
    }

    public function setArguments(array $arguments)
    {
        $this->arguments = $arguments;
    }

    public function select(mixed $select, $as = null)
    {
        $this->select = $select;
    }

    public function execute(string $mode)
    {
        return $this->connection->call($this->buildQuery(), $this->getArgs());
    }

    public function __toString(): string
    {
        return $this->buildQuery();
    }

    protected function getArgs()
    {
        return [];
    }

    private function buildQuery()
    {
        return '';
    }
}
