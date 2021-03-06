<?php declare(strict_types=1);

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
     * @Query()
     */
    public function product(ID $itemNumber): ProductDataType
    {
        return $this->productService->product($itemNumber);
    }

    /**
     * @Logged()
     * @Right("ADMINISTER_PRODUCT")
     * @Mutation()
     */
    public function changeTitle(ID $itemNumber, string $title): string
    {
        return $this->productService->changeTitle($itemNumber, $title);
    }
}
