<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\Service;

use OxidAcademy\GraphQL\Product\Product\DataType\Product as ProductDataType;
use OxidAcademy\GraphQL\Product\Product\Exception\ProductNotFound;
use OxidAcademy\GraphQL\Product\Product\Exception\ProductNotUpdatable;
use OxidAcademy\GraphQL\Product\Product\Infrastructure\ProductRepository;
use OxidEsales\GraphQL\Base\Exception\NotFound;
use TheCodingMachine\GraphQLite\Types\ID;

final class Product
{
    private ProductRepository $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws ProductNotFound
     */
    public function product(ID $productNumber): ProductDataType
    {
        try {
            $product = $this->productRepository->getProductByItemNumber($productNumber);
        } catch (NotFound $e) {
            throw new ProductNotFound((string) $productNumber);
        }

        return $product;
    }

    /**
     * @throws ProductNotFound
     * @throws ProductNotUpdatable
     */
    public function changeTitle(ID $productNumber, string $title): ProductDataType
    {
        try {
            $product = $this->productRepository->changeProductFields(
                $productNumber,
                [
                    'oxtitle' => $title
                ]
            );
        } catch (NotFound $e) {
            throw new ProductNotFound((string) $productNumber);
        }

        return $product;
    }
}
