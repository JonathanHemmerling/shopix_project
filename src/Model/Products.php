<?php

declare(strict_types=1);

namespace App\Model;

use JsonException;
use RuntimeException;

class Products
{
    private string $pathToJsonFile;

    public function __construct(string $pathToJsonFile = __DIR__ . '/../jsons/products.json')
    {
        if (!file_exists($pathToJsonFile)) {
            throw new \InvalidArgumentException(sprintf('Path %s does not exist.', $pathToJsonFile));
        }
        $this->pathToJsonFile = $pathToJsonFile;
    }

    /**
     * @return array
     * @throws RuntimeException
     */
    public function getProductsFromJson(): array
    {
        $jsonFile = file_get_contents($this->pathToJsonFile);

        try {
            $mainMenuContent = json_decode($jsonFile, true, 512, JSON_THROW_ON_ERROR);
        } catch (JsonException $exception) {
            throw new RuntimeException(sprintf('Invalid JSON stored in file "%s".', $this->pathToJsonFile),0, $exception);
        }
        return $mainMenuContent;
    }

}
