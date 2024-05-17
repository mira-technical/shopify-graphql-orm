<?php

namespace MiraTech\ShopifyGraphqlOrm\Types;

/**
 * @method static nullable()
 * @method static required()
 * @method static array()
 */
class Type implements \MiraTech\ShopifyGraphqlOrm\Contracts\Type
{
    public $isNullable = true;

    public $isRequired = false;

    public $isArray = false;

    public function nullable(bool $flg = true)
    {
        $this->setIsNullable($flg);

        return $this;
    }

    public function required(bool $flg = true)
    {
        $this->setIsRequired($flg);

        return $this;
    }

    public function array(bool $flg = true)
    {
        $this->setIsArray($flg);

        return $this;
    }

    private function setIsNullable(bool $flg = true): void
    {
        $this->isNullable = $flg;
    }

    private function setIsRequired(bool $flg = true)
    {
        $this->isRequired = $flg;
    }

    private function setIsArray(bool $flg = true)
    {
        $this->isArray = $flg;
    }

    public function __toString(): string
    {
        $type = method_exists($this, 'resolveType') ? $this->resolveType() : class_basename($this);

        if (! $this->isNullable || $this->isRequired) {
            $type .= '!';
        }

        return $this->isArray ? "[$type]" : $type;
    }

    public static function __callStatic(string $name, array $arguments): static
    {
        return (new static())->{$name}(...$arguments);
    }
}
