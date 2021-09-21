

## Install

Make sure to place the module in this directory: `source/modules/oxac/graphql-product`

```shell
composer config repositories.oxac-graphql-product path /var/www/html/source/modules/oxac/graphql-product/
composer require oxid-academy/graphql-product:"dev-master"
```

## Sources

- Background knowledge about the architecture of the module and the GraphQL Modules, since it differs to the eShop 
  Framework.  
  https://madewithlove.com/blog/software-engineering/hexagonal-architecture-demystified/
- The GraohQL Module documentation contains a tutorial which describes how to write own queries and mutations. Based of 
  this documentation this example module was written.  
  https://docs.oxid-esales.com/interfaces/graphql/en/latest/tutorials/introduction.html