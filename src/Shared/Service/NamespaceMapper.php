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
            self::SPACE . 'Product\\Controller' => dirname(__DIR__, 2) . '/Product/Controller/',
        ];
    }

    public function getTypeNamespaceMapping(): array
    {
        return [
            self::SPACE . 'Product\\DataType' => dirname(__DIR__, 2) . '/Product/DataType/',
        ];
    }
}
