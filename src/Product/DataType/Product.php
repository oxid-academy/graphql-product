<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\DataType;

use OxidEsales\Eshop\Application\Model\Article as EshopModelProduct;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Types\ID;

/**
 * @Type(name="OxAcProduct")
 */
final class Product
{
    /** @var EshopModelProduct */
    private $product;

    public function __construct(
        EshopModelProduct $product
    ) {
        $this->product = $product;
    }

    public function getEshopModel(): EshopModelProduct
    {
        return $this->product;
    }

    /**
     * @Field()
     */
    public function getProductNumber(): string
    {
        return (string) $this->product->getFieldData('oxartnum');
    }

    /**
     * @Field()
     */
    public function getProductTitle(): string
    {
        return (string) $this->product->getFieldData('oxtitle');
    }
}
