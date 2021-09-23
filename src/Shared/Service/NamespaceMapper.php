<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Shared\Service;

use OxidEsales\GraphQL\Base\Framework\NamespaceMapperInterface;

final class NamespaceMapper implements NamespaceMapperInterface
{
    public function getControllerNamespaceMapping(): array
    {
        return [
            '\\OxidAcademy\\GraphQL\\Product\\Product\\Controller' => __DIR__ . '/../../Product/Controller/',
        ];
    }

    public function getTypeNamespaceMapping(): array
    {
        return [
            '\\OxidAcademy\\GraphQL\\Product\\Product\\DataType' => __DIR__ . '/../../Product/DataType/',
        ];
    }
}
