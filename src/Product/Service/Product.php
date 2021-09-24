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
     */
    public function changeTitle(ID $itemNumber, string $title): ProductDataType
    {
        /*
        if (!((string) $id = $this->authenticationService->getUserId())) {
            throw new InvalidLogin('Unauthorized');
        }
        */

        if (!strlen($title)) {
            //throw 
        }

        try {
            $product = $this->productRepository->getProductByItemNumber($itemNumber);
        } catch (NotFound $e) {
            throw ProductNotFound::byId((string) $itemNumber);
        }

        $model = $product->getEshopModel();
        $model->assign(['oxtitle' => $title]);
        $model->save();

        return $product;
    }
}
