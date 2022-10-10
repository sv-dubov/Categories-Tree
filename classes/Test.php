<?php

class Test
{
    public static function getCategoriesTree($conn)
    {
        $sql = "SELECT * FROM categories";
        $stmt = $conn->prepare($sql);
        $stmt->execute();
        $result = $stmt->fetchAll();
        $resultArr = [];

        for ($i = 1; $i <= 10; $i++) {
            foreach ($result as $k => $value) {
                if ($value['parent_id'] == $i) {
                    $newParent = $value['categories_id'];
                    foreach ($result as $k => $value) {
                        if ($value['parent_id'] === $newParent) {
                            $resultArr[$i][$newParent][$value['categories_id']] = $value['categories_id'];
                        }
                    }
                    if (empty($resultArr[$i][$newParent])) {
                        $resultArr[$i][$newParent] = $newParent;
                    }
                }
            }
        }
        return $resultArr;
    }
}
