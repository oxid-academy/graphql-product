## About
This module shows how to implement your own queries and mutations.

## Install
```shell
composer require oxid-academy/graphql-product
vendor/bin/oe-console oe:module:activate oe_graphql_base
vendor/bin/oe-console oe:module:activate oxac_graphql_product
```
[ ! ] The modules Storefront and/or oxid-academy/graphql-product-extension must be deactivated:
```shell
vendor/bin/oe-console oe:module:deactivate oe_graphql_storefront
vendor/bin/oe-console oe:module:deactivate oxac_graphql_productextension
```
## Usage

You can use your favourite GraphQL client to explore the API, if you do not already have one installed, you may use
[Altair GraphQL Client](https://altair.sirmuel.design/).

### Query 
URL: `http://localhost/graphql/?shp=1&lang=0`
#### Request
```
query {
  product (itemNumber: "1402") {
    itemNumber,
    title
  }
}
```
#### Response
```
{
  "data": {
    "product": {
      "itemNumber": "1402",
      "title": "Trapez ION MADTRIXX"
    }
  }
}
```  

### Mutation
URL: `http://localhost/graphql/?shp=1&lang=0`
#### Request
```
mutation{
  changeTitle(itemNumber: "1501", title: "Changed Title")
}
```
#### Response
```
{
  "data": {
    "changeTitle": "0584e8b766a4de2177f9ed11d1587f55"
  }
}
```

## Sources

- Background knowledge about the architecture of the module and the GraphQL Modules, since it differs to the eShop
  Framework.  
  https://madewithlove.com/blog/software-engineering/hexagonal-architecture-demystified/
- The GraohQL Module documentation contains a tutorial which describes how to write own queries and mutations. Based of
  this documentation this example module was written.  
  https://docs.oxid-esales.com/interfaces/graphql/en/latest/tutorials/introduction.html
