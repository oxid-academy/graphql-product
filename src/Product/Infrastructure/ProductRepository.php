<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\Infrastructure;

use Doctrine\DBAL\ParameterType;
use OxidAcademy\GraphQL\Product\Product\Exception\ProductNotUpdatable;
use OxidEsales\EshopCommunity\Internal\Framework\Database\QueryBuilderFactoryInterface;
use OxidAcademy\GraphQL\Product\Product\DataType\Product as ProductDataType;
use OxidEsales\Eshop\Application\Model\Article as EshopModelProduct ;
use OxidEsales\GraphQL\Base\Exception\NotFound;
use TheCodingMachine\GraphQLite\Types\ID;

final class ProductRepository
{
    /** @var QueryBuilderFactoryInterface */
    private $queryBuilderFactory;

    public function __construct(
        QueryBuilderFactoryInterface $queryBuilderFactory
    ) {
        $this->queryBuilderFactory = $queryBuilderFactory;
    }

    /**
     * @throws NotFound
     */
    public function getProductByItemNumber(ID $productNumber): ProductDataType
    {
        $result = $this->queryBuilderFactory
            ->create()
            ->select('oxid')
            ->from('oxarticles')
            ->where('oxartnum = :productNumber')
            ->setParameter(':productNumber', (string) $productNumber, ParameterType::STRING)
            ->execute();

        $oxid = is_object($result) ? (string) $result->fetchOne() : '';

        return $this->product($oxid);
    }

    /**
     * Updates the given fields for a product by the product number.
     *
     * @param ID $productNumber  The oxarticles.oxartnum number of the product.
     *                           Do not get confused with the oxid of the product.
     * @param array $keyValue Must have a format like ['table_field => value'], e.g.: ['oxtitle' => 'the new title']
     *                        Can also be multiple fields at once: ['k1' => 'v1', 'k2' => 'v2', ... 'kn' => 'vn']
     *
     * On success, the method BaseModel::save returns the id (oxid) of the record.
     *
     * @throws NotFound
     * @throws ProductNotUpdatable
     */
    public function changeProductFields(ID $productNumber, array $keyValue): ProductDataType
    {
        $productDataType = $this->getProductByItemNumber($productNumber);

        /** @var EshopModelProduct  $productModel */
        $productModel = $productDataType->getEshopModel();
        $productModel->assign($keyValue);

        if (false === $productModel->save()) {
            throw new ProductNotUpdatable(ProductNotUpdatable::ERROR_MESSAGE);
        }

        //return object should be created from updated database state
        return $this->product((string) $productModel->getId());
    }

    /**
     * @throws NotFound
     */
    private function product(string $productId): ProductDataType
    {
        /** @var EshopModelProduct  */
        $product = oxNew(EshopModelProduct ::class);

        if (!$product->load($productId)) {
            throw new NotFound('');
        }

        return new ProductDataType(
            $product
        );
    }
}
