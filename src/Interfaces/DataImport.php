<?php

declare(strict_types=1);

namespace App\Interfaces;

class DataImport
{
    private string $fileName;

    public function __construct(string $fileName)
    {
        $this->fileName = $fileName;
    }

    public function importDatafromFile(): array
    {
        $file = file_get_contents(__DIR__ . '/../jsons/' . $this->fileName);
        return json_decode($file, true);
    }
}