<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\DataType;

use OxidEsales\Eshop\Application\Model\Article as EshopProductModel;
use TheCodingMachine\GraphQLite\Annotations\Field;
use TheCodingMachine\GraphQLite\Annotations\Type;
use TheCodingMachine\GraphQLite\Types\ID;

/**
 * @Type()
 */
final class Product
{
    /** @var EshopProductModel */
    private $product;

    public function __construct(
        EshopProductModel $product
    ) {
        $this->product = $product;
    }

    public function getEshopModel(): EshopProductModel
    {
        return $this->product;
    }

    /**
     * @Field()
     */
    public function getId(): ID
    {
        return new ID(
            $this->product->getId()
        );
    }

    /**
     * @Field()
     */
    public function getItemNumber(): string
    {
        return $this->product->getFieldData('oxartnum');
    }

    /**
     * @Field()
     */
    public function getTitle(): string
    {
        return (string) $this->product->getFieldData('oxtitle');
    }
}
