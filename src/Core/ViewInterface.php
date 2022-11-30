<?php

declare(strict_types=1);

namespace App\Core;

interface ViewInterface
{
    public function getParams(): array;

    public function addTemplateParameter(string $tplIdentifier, array $itemsToDisplay): void;

    public function setTemplate(string $templateName): void;

    public function getTemplate(): string;

    public function renderTemplate(): void;
}