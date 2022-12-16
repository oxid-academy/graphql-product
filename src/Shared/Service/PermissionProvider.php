<?php

declare(strict_types=1);

namespace OxidAcademy\GraphQL\Product\Shared\Service;

use OxidEsales\GraphQL\Base\Framework\PermissionProviderInterface;

final class PermissionProvider implements PermissionProviderInterface
{
    public function getPermissions(): array
    {
        return [
            'oxidadmin' => [
                'ADMINISTER_PRODUCT',
            ]
        ];
    }
}
