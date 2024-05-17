<?php

namespace MiraTech\ShopifyGraphqlOrm\Eloquent;

class Builder implements \MiraTech\ShopifyGraphqlOrm\Contracts\Eloquent\Builder
{
    protected Model $model;

    protected string $action;

    protected $argumentDefinition = [];

    protected $arguments = [];

    public function __construct(private \MiraTech\ShopifyGraphqlOrm\Query\Builder $query)
    {
    }

    public function setModel(Model $model)
    {
        $this->model = $model;
    }

    public function use(string $action)
    {
        $this->query->setAction($action);
        $this->query->setArgumentDefinition($this->model->getArguments($action));

        return $this;
    }

    public function args($args)
    {
        $this->query->setArguments($args);

        return $this;
    }

    public function select($fields)
    {
        foreach ($fields as $as => $field) {
            $this->select($field, is_int($as) ? null : $as);
        }

        return $this;
    }

    public function query()
    {
        return $this->execute('query');
    }

    public function mutation()
    {
        return $this->execute('mutation');
    }

    public function toGraphql(): string
    {
        return (string) $this->query;
    }

    protected function execute($mode)
    {
        return $this->query->execute($mode);
    }
}
