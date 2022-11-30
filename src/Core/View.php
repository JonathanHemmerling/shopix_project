<?php

declare(strict_types=1);

namespace App\Core;


class View implements ViewInterface
{
    private array $params = [];
    private string $template;

    public function __construct(private readonly \Smarty $smarty)
    {
    }

    public function getParams(): array
    {
        return $this->params;
    }

    public function addTemplateParameter(string $tplIdentifier, array $itemsToDisplay): void
    {
        $this->params[$tplIdentifier] = $itemsToDisplay;
    }

    public function setTemplate(string $templateName): void
    {
        $this->template = $templateName;
    }

    public function getTemplate(): string
    {
        return $this->template;
    }

    public function renderTemplate(): void
    {
        $this->smarty->assign($this->params);

        $this->smarty->display(__DIR__ . '/../templates/' . $this->getTemplate());
    }

}
