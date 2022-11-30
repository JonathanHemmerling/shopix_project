<?php

declare(strict_types=1);

namespace App\Controller\FrontendController;

interface HomeControllInterface
{
    public function setStrForLinks(string $link): void;

    public function getStrForLinks(): array;

    public function getDataFromModel(): array;

    public function addMenuToLinkArray(): void;

    public function renderView(): void;
}