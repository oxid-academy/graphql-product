<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Shared\Service;

use OxidEsales\GraphQL\Base\Framework\NamespaceMapperInterface;

final class NamespaceMapper implements NamespaceMapperInterface
{
    private const SPACE = '\\OxidAcademy\\GraphQL\\Product\\';

    public function getControllerNamespaceMapping(): array
    {
        return [
            self::SPACE . 'Product\\Controller' => __DIR__ . '/../../Product/Controller/',
        ];
    }

    public function getTypeNamespaceMapping(): array
    {
        return [
            self::SPACE . 'Product\\DataType' => __DIR__ . '/../../Product/DataType/',
        ];
    }
}
