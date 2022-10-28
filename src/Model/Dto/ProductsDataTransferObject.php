<?php

declare(strict_types=1);

namespace app\Model\Dto;

class ProductsDataTransferObject
{
    private string $productId;
    private string $detail;
    private string $productDisplayName;
    private string $description;

    private string $categoryId;
    private string $category;
    private string $categoryDisplayName;

    /**
     * @return string
     */
    public function getProductId(): string
    {
        return $this->productId;
    }

    /**
     * @param string $productId
     */
    public function setProductId(string $productId): void
    {
        $this->productId = $productId;
    }

    /**
     * @return string
     */
    public function getDetail(): string
    {
        return $this->detail;
    }

    /**
     * @param string $detail
     */
    public function setDetail(string $detail): void
    {
        $this->detail = $detail;
    }

    /**
     * @return string
     */
    public function getProductDisplayName(): string
    {
        return $this->productDisplayName;
    }

    /**
     * @param string $productDisplayName
     */
    public function setProductDisplayName(string $productDisplayName): void
    {
        $this->productDisplayName = $productDisplayName;
    }

    /**
     * @return string
     */
    public function getDescription(): string
    {
        return $this->description;
    }

    /**
     * @param string $description
     */
    public function setDescription(string $description): void
    {
        $this->description = $description;
    }

    /**
     * @return string
     */
    public function getCategoryId(): string
    {
        return $this->categoryId;
    }

    /**
     * @param string $categoryId
     */
    public function setCategoryId(string $categoryId): void
    {
        $this->categoryId = $categoryId;
    }

    /**
     * @return string
     */
    public function getCategory(): string
    {
        return $this->category;
    }

    /**
     * @param string $category
     */
    public function setCategory(string $category): void
    {
        $this->category = $category;
    }

    /**
     * @return string
     */
    public function getCategoryDisplayName(): string
    {
        return $this->categoryDisplayName;
    }

    /**
     * @param string $categoryDisplayName
     */
    public function setCategoryDisplayName(string $categoryDisplayName): void
    {
        $this->categoryDisplayName = $categoryDisplayName;
    }
}