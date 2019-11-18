<?php
    require("config.php");
    $mysqli = new mysqli(DB_HOST, DB_USER, DB_PASS, DB_NAME);
    if($mysqli->connect_errno) {
        echo "MySQL Connection Error: " . $mysqli->connect_error;
        exit();
    }
    $result = $mysqli->query("SELECT clubs.id, clubs.name, categories.category, clubs.short_desc,clubs.long_desc, ".
    "images.image_path FROM clubs, categories, images WHERE clubs.category_id = categories.id ".
    "AND clubs.image_id = images.id ORDER BY category;");
    $categories = [];
    $category = null;
    $currentCategoryList = [];
//    var_dump($result->fetch_assoc());
    while($row = $result->fetch_assoc()){
        if($row['category'] != $category){
            // if this is a new category
            if($category != null){
                // makes sure this isn't the first case
                // and push it into data/categories
                $categoryObject = [
                    'clubs' => $currentCategoryList,
                    'category' => $category
                ];
                array_push($categories, $categoryObject);
                $currentCategoryList = []; // a new list
            }
            $category = $row['category'];
        }
        $club = [
            'name' => $row['name'],
            'category' => $row['category'],
            'short_desc' => $row['short_desc'],
            'long_desc' => $row['long_desc'],
            'image_path' => $row['image_path'],
            'id' => $row['id']
        ];
        array_push($currentCategoryList, $club);
    }
    // push the last category into the list
    $categoryObject = [
        'clubs' => $currentCategoryList,
        'category' => $category
    ];
    array_push($categories, $categoryObject);

//    var_dump($clubsList);
    $json = json_encode($categories);
    echo $json;

//array(5) { ["name"]=> string(9) "duck club" ["category"]=> string(8) "Academic" ["short_desc"]=> string(12) "we pet ducks" ["long_desc"]=> string(36) "this is a very nice club about ducks" ["image_id"]=> NULL }