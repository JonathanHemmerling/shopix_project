<?php

declare(strict_types=1);

class SqlQueryFunctions
{
    //user
    public function findUserData(string $userName): bool|mysqli_result
    {
        global $db;
        $sql = "SELECT * FROM userData ";
        $sql .= "WHERE userName='" . $userName. "';";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject; // returns an assoc. array
    }
    public function updateUserData()
    {

    }
    public function deleteUserData()
    {

    }
    public function insertUserData()
    {

    }


    //Maincategorys
    public function findAllMainCategorys($options = []): mysqli_result|bool
    {
        global $db;

        $visible = $options['visible'] ?? false;

        $sql = "SELECT * FROM mainCategorys ";
        if ($visible) {
            $sql .= "WHERE visible = true ";
        }
        $sql .= "ORDER BY position ASC";
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        return $result;
    }
    public function updateMainCategorys()
    {

    }
    public function deleteMainCategory()
    {

    }
    public function insertMainCategory()
    {

    }

    //Subcategorys
    public function findAllSubCategorys(int $mainId, array $options = []): array
    {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM subCategorys ";
        $sql .= "WHERE id='" . db_escape($db, $mainId) . "' ";
        if ($visible) {
            $sql .= "AND visible = true";
        }
        // echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject; // returns an assoc. array
    }
    public function updateSubCategorys()
    {

    }
    public function deleteSubCategory()
    {

    }
    public function insertSubCategory()
    {

    }

    //Products
    public function findAllFromSingleProduct(int $id, array $options = []): array
    {
        global $db;
        $visible = $options['visible'] ?? false;
        $sql = "SELECT * FROM products ";
        $sql .= "WHERE id='" . db_escape($db, $id) . "' ";
        if ($visible) {
            $sql .= "AND visible = true";
        }
        // echo $sql;
        $result = mysqli_query($db, $sql);
        confirm_result_set($result);
        $subject = mysqli_fetch_assoc($result);
        mysqli_free_result($result);
        return $subject; // returns an assoc. array
    }
    public function updateProduct()
    {

    }
    public function deleteProduct()
    {

    }
    public function insertProduct()
    {

    }
}