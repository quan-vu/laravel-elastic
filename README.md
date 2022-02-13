# Laravel ElasticSearch By Example

Example for working with Elastic Search in Laravel

System

- PHP 8.0
- MySQL 8.0
- Composer 2.0
- Elastic 7.x

## Elastic

Check Elastic status

```shell
sudo systemctl status elasticsearch.service
```

Get Elastic information

```shell
curl -X GET "localhost:9200"
```

```json
{
  "name" : "laravel-elastic",
  "cluster_name" : "elasticsearch",
  "cluster_uuid" : "6d7xUKt1SECPQPkm3exR4w",
  "version" : {
    "number" : "7.17.0",
    "build_flavor" : "default",
    "build_type" : "deb",
    "build_hash" : "bee86328705acaa9a6daede7140defd4d9ec56bd",
    "build_date" : "2022-01-28T08:36:04.875279988Z",
    "build_snapshot" : false,
    "lucene_version" : "8.11.1",
    "minimum_wire_compatibility_version" : "6.8.0",
    "minimum_index_compatibility_version" : "6.0.0-beta1"
  },
  "tagline" : "You Know, for Search"
}
```

## Reference

- [Install Elastic 7.x](https://www.elastic.co/guide/en/elasticsearch/reference/7.17/install-elasticsearch.html)
- [Getting Started Elastic 7.x](https://www.elastic.co/guide/en/elasticsearch/reference/7.17/getting-started.html)
- [ElasticSearch PHP client](https://www.elastic.co/guide/en/elasticsearch/client/php-api/7.17/index.html)
