## About
This module shows how to implement your own queries and mutations.

## Install
```shell
composer require oxid-academy/graphql-product
vendor/bin/oe-console oe:module:activate oe_graphql_base
vendor/bin/oe-console oe:module:activate oxac_graphql_product
```

## Usage

You can use your favourite GraphQL client to explore the API, if you do not already have one installed, you may use
[Altair GraphQL Client](https://altair.sirmuel.design/).

### Query 
URL: `http://localhost/graphql
#### Request
```
query {
  OxAcProduct(
    productNumber: "1402"
  ){
    productNumber
    title
  }
}
```
#### Response
```
{
  "data": {
    "OxAcProduct": {
      "productNumber": "1402",
      "title": "Trapez ION MADTRIXX"
    }
  }
}
```  

### Mutation
URL: `http://localhost/graphql
#### Request
```
mutation  {
  OxAcProductChangeTitle
  ( 
    productNumber: "1402"
    title: "changed title"
  )
    {
       productNumber
        title
    }
}
```
#### Response
```
{
  "data": {
    "OxAcProduct": {
      "productNumber": "1402",
      "title": "changed title"
    }
  }
}
```

## Sources

- Background knowledge about the architecture of the module and the GraphQL Modules, since it differs to the eShop
  Framework.  
  https://madewithlove.com/blog/software-engineering/hexagonal-architecture-demystified/
- The GraphQL Module documentation contains a tutorial which describes how to write own queries and mutations. Based of
  this documentation this example module was written.  
  https://docs.oxid-esales.com/interfaces/graphql/en/latest/tutorials/introduction.html
