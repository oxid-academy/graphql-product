<?php declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Product\Infrastructure;

use Doctrine\DBAL\ParameterType;
use OxidAcademy\GraphQL\Product\Product\Exception\ProductNotUpdatable;
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

    /**
     * Updates the given fields for a product by the product number.
     *
     * @param ID $itemNumber The item number of the product. Do not get confused with the oxid of the product.
     * @param array $keyValue Must have a format like ['table_field => value'], e.g.: ['oxtitle' => 'the new title']
     *                        Can also be multiple fields at once: ['k1' => 'v1', 'k2' => 'v2', ... 'kn' => 'vn']
     * @return string         On success, the method BaseModel::save returns the id (oxid) of the record.
     * @throws NotFound
     * @throws ProductNotUpdatable
     */
    public function changeProductFields(ID $itemNumber, array $keyValue): string
    {
        $productDataType = $this->getProductByItemNumber($itemNumber);

        $product = $productDataType->getEshopModel();
        $product->assign($keyValue);

        $returnValue = $product->save();

        if ($returnValue === false) {
            throw new ProductNotUpdatable(ProductNotUpdatable::ERROR_MESSAGE);
        }

        return (string) $returnValue;
    }
}
