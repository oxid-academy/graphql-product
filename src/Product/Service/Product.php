<?php declare(strict_types=1);

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
    public function product(ID $itemNumber): ProductDataType
    {
        try {
            $product = $this->productRepository->getProductByItemNumber($itemNumber);
        } catch (NotFound $e) {
            throw ProductNotFound::byId((string) $itemNumber);
        }

        return $product;
    }

    /**
     * @throws ProductNotFound
     * @throws ProductNotUpdatable
     */
    public function changeTitle(ID $itemNumber, string $title): string
    {
        try {
            $success = $this->productRepository->changeProductFields($itemNumber, ['oxtitle' => $title]);
        } catch (NotFound $e) {
            throw ProductNotFound::byId((string) $itemNumber);
        }

        return $success;
    }
}
