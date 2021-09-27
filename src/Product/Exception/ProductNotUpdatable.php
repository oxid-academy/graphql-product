<?php declare(strict_types=1);


namespace OxidAcademy\GraphQL\Product\Product\Exception;


use OxidEsales\GraphQL\Base\Exception\Error;

class ProductNotUpdatable extends Error
{
    public const ERROR_MESSAGE = 'Error while updating the record!';
}