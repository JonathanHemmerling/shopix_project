# Build Docker image

```bash
export PHP_VERSION=8.1 && docker build --build-arg php_version=$PHP_VERSION --tag local/php:$PHP_VERSION build/
```