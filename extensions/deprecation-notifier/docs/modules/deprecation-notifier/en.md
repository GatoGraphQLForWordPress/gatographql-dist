# Deprecation Notifier

Send deprecations in the response to the query (and not only when doing introspection), under the top-level entry `extensions`.

## Description

Whenever a deprecated field is queried, a deprecation message is returned in that same GraphQL response, under the top-level entry `extensions`.

This alerts users of our APIs to upgrade their use of the schema, even when they are not paying attention to the introspection query.

For instance, running this query, where field `isPublished` is deprecated:

```graphql
query {
  posts {
    title
    isPublished
  }
}
```

...will produce this response:

```json
{
  "extensions": {
    "deprecations": [
      {
        "message": "Use 'isStatus(status:published)' instead of 'isPublished'",
        "extensions": {
          ...
        }
      }
    ]
  },
  "data": {
    "posts": [
      ...
    ]
  }
}
```
<!-- 
## Bundles including extension

- [“All in One Toolbox for WordPress” Bundle](../../../../../bundle-extensions/all-in-one-toolbox-for-wordpress/docs/modules/all-in-one-toolbox-for-wordpress/en.md)
- [“Responsible WordPress Public API” Bundle](../../../../../bundle-extensions/responsible-wordpress-public-api/docs/modules/responsible-wordpress-public-api/en.md) -->
