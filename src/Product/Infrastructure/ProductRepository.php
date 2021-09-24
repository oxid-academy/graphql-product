<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\Infrastructure;

use Doctrine\DBAL\ParameterType;
use OxidEsales\EshopCommunity\Internal\Container\ContainerFactory;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidAcademy\GraphQL\Product\Product\DataType\Product as ProductDataType;
use OxidEsales\Eshop\Application\Model\Article as EshopProductModel;
use OxidEsales\GraphQL\Base\Exception\NotFound;
use TheCodingMachine\GraphQLite\Types\ID;

final class ProductRepository
{
    /**
     * @throws NotFound
     */
    public function product(ID $id): ProductDataType
    {
        /** @var EshopProductModel */
        $product = oxNew(EshopProductModel::class);

        if (!$product->load($id)) {
            throw new NotFound('');
        }

        return new ProductDataType(
            $product
        );
    }

    public function getProductByItemNumber(ID $itemNumber): ProductDataType
    {
        $queryBuilder = ContainerFactory::getInstance()
            ->getContainer()
            ->get(QueryBuilderFactoryInterface::class)
            ->create();

        $queryBuilder
            ->select('oxid')
            ->from('oxarticles')
            ->where('oxartnum = :itemNumber')
            ->setParameter(':itemNumber', $itemNumber, ParameterType::STRING);

        $oxid = $queryBuilder->execute()->fetchOne();

        $product = oxNew(EshopProductModel::class);

        if (!$product->load($oxid)) {
            throw new NotFound('');
        }

        return new ProductDataType($product);
    }
}
