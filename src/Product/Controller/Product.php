<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\Controller;

use OxidAcademy\GraphQL\Product\Product\DataType\Product as ProductDataType;
use OxidAcademy\GraphQL\Product\Product\Service\Product as ProductService;
use TheCodingMachine\GraphQLite\Annotations\Logged;
use TheCodingMachine\GraphQLite\Annotations\Mutation;
use TheCodingMachine\GraphQLite\Annotations\Query;
use TheCodingMachine\GraphQLite\Annotations\Right;
use TheCodingMachine\GraphQLite\Types\ID;

final class Product
{
    /** @var ProductService */
    private ProductService $productService;

    public function __construct(
        ProductService $productService
    ) {
        $this->productService = $productService;
    }

    /**
     * @Query(name="OxAcProduct")
     */
    public function product(ID $productNumber): ProductDataType
    {
        return $this->productService->product($productNumber);
    }

    /**
     * @Logged()
     * @Right("ADMINISTER_PRODUCT")
     * @Mutation(name="OxAcProductChangeTitle")
     */
    public function changeTitle(ID $productNumber, string $productTitle): ProductDataType
    {
        return $this->productService->changeTitle($productNumber, $productTitle);
    }
}
