<?php

namespace MiraTech\ShopifyGraphqlOrm\Eloquent;

use MiraTech\ShopifyGraphqlOrm\Connection;
use MiraTech\ShopifyGraphqlOrm\Eloquent\Concerns\HasAttributes;

/**
 * @abstract Model
 * @Collection
 */
abstract class Model
{
    use HasAttributes;

    protected $arguments = [];

    /**
     * The connection name for the model.
     *
     * @var string|null
     */
    protected $connection;

    protected function forwardCallTo($object, $method, $parameters)
    {
        return $object->{$method}(...$parameters);
    }

    public function getArguments(string $key = null)
    {
        if (! $key) {
            return $this->arguments;
        }

        if (! array_key_exists($key, $this->arguments)) {
            throw new \Exception('Error');
        }

        return $this->arguments[$key];
    }

    public function newEloquentBuilder($query)
    {
        return new Builder($query);
    }

    public function newQueryBuilder()
    {
        return $this->getConnection()->query();
    }

    public function registerGlobalScopes($builder)
    {
        return $builder;
    }

    public static function resolveConnection()
    {
        return new Connection();
    }

    /**
     * Get the database connection for the model.
     */
    public function getConnection()
    {
        return static::resolveConnection();
    }

    protected function newQuery()
    {
        return tap($this->registerGlobalScopes(
            $this->newEloquentBuilder($this->newQueryBuilder())
        ))->setModel($this);
    }

    public function __call(string $method, array $parameters)
    {
        return $this->forwardCallTo($this->newQuery(), $method, $parameters);
    }

    public static function __callStatic(string $method, array $arguments)
    {
        return (new static)->{$method}(...$arguments);
    }
}
