<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\Service;

use OxidAcademy\GraphQL\Product\Product\DataType\Product as ProductDataType;
use OxidAcademy\GraphQL\Product\Product\Exception\ProductNotFound;
use OxidAcademy\GraphQL\Product\Product\Infrastructure\ProductRepository;
use OxidEsales\GraphQL\Base\Exception\NotFound;
use TheCodingMachine\GraphQLite\Types\ID;

final class Product
{
    /** @var ProductRepository */
    private $productRepository;

    public function __construct(
        ProductRepository $productRepository
    ) {
        $this->productRepository = $productRepository;
    }

    /**
     * @throws ProductNotFound
     */
    /*
    public function product(ID $productId): ProductDataType
    {
        try {
            $product = $this->productRepository->product($productId);
        } catch (NotFound $e) {
            throw ProductNotFound::byId($productId);
        }

        return $product;
    }
    */
    public function product(ID $itemNumber): ProductDataType
    {
        try {
            $product =  $this->productRepository->getProductByItemNumber($itemNumber);
        } catch (NotFound $e) {
            throw ProductNotFound::byId($itemNumber); //TODO? MK
        }

        return $product;
    }
}