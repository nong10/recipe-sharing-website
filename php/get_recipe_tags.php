<?php

    // get all numerical values of tags contained in tag_value
function get_tags_values($tag_value) {
    $tags = array();
    global $mask_lookup;
    foreach ($mask_lookup as $value => $name) {
        if ($tag_value & $value) {
            array_push($tags, $value);
        }
    }
    return $tags;
}

function get_tags_values_with_id($conn, $id) {
    // retrieve recipe information
    $sql = "SELECT * FROM recipes WHERE recipe_id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tag_value = $row['tag'];
    $tags = get_tags_values($tag_value);
    return $tags;
}

function get_tags($tag_mask) {
    // get tags from mask value
    $tags = array();
    global $mask_lookup;
    foreach ($mask_lookup as $value => $name) {
        if ($tag_mask & $value) {
            array_push($tags, $name);
        }
    }

    return $tags;
}

function get_recipe_tags($conn, $id) {
    // retrieve recipe information
    $sql = "SELECT * FROM recipes WHERE recipe_id = $id";
    $result = $conn->query($sql);
    $row = $result->fetch_assoc();
    $tag_mask = $row['tag'];

    // get tags from mask value
    $tags = array();
    global $mask_lookup;
    foreach ($mask_lookup as $value => $name) {
        if ($tag_mask & $value) {
            array_push($tags, $name);
        }
    }

    return $tags;
}

// lookup table to get mask name from mask value
$mask_lookup = array(
    1 => "Chinese",
    2 => "Italian",
    4 => "French",
    8 => "Mexican",
    16 => "Japanese",
    32 => "Indian",
    64 => "Thai",
    128 => "Greek",
    256 => "Mediterranean",
    512 => "American",
    1024 => "Middle Eastern",
    2048 => "Spanish",
    4096 => "Korean",
    8192 => "Vietnamese",
    16384 => "Caribbean",
    32768 => "African",
    65536 => "Spicy",
    131072 => "Sweet",
    262144 => "Sour",
    524288 => "Salty",
    1048576 => "Bitter",
    2097152 => "Savory",
    4194304 => "Creamy",
    8388608 => "Crunchy",
    16777216 => "Smoky",
    33554432 => "Tangy",
    67108864 => "Rich",
    134217728 => "Refreshing",
    268435456 => "Herbaceous",
    536870912 => "Cheesy",
    1073741824 => "Garlicky",
    2147483648 => "Fruity"
);
?>
