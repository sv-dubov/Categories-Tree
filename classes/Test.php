<?php

class Test
{
    public function getCategoriesTree($conn)
    {
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $resultArr = [];
        while ($row = ($stmt->fetch(PDO::FETCH_ASSOC))) {
            if ($row['parent_id'] == 0) {
                $resultArr[$row['categories_id']] = [];
            } else {
                self::buildTree($row['parent_id'], $resultArr, $row['categories_id']);
            }
        }
        return $resultArr;
    }

    public static function buildTree($parentId, &$arr, $val)
    {
        foreach ($arr as $key => &$value) {
            if ($key == $parentId) {
                if (!is_array($value))
                    $value = array($val => $val);
                else {
                    $value[$val] = $val;
                }
                return;
            } else if (is_array($value)) {
                self::buildTree($parentId, $value, $val);
            }
        }
    }
}
