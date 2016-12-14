<?php

$name = $_GET['name'];
$b = [];

$connection = mysqli_connect('localhost', 'root', '', 'matfApp');
if(mysqli_connect_errno())
    die("Connection error!");

if ($name != '') {
    $search = explode(' ', $name);
    foreach ($search as &$s) {
        $s = trim($s);
    }

    $niz = [];
    foreach ($search as &$s) {
        array_push($niz, "(author like '%" . $s . "%' OR name like '%" . $s . "%')");
    }

//    $query = mysqli_prepare($connection,
//        "SELECT ID, NAME, AUTHOR, LYRICS FROM SONGS WHERE ?");
//    mysqli_stmt_bind_param($query, 'b', $niz);

    $query = "select id, name, author, lyrics from songs where " . implode(" AND ", $niz);
}
else{
    $query = "select id, name, author, lyrics from songs";
}

$result = mysqli_query($connection, $query);

while($a = mysqli_fetch_assoc($result)) {
    array_push($b, $a);
}

echo json_encode($b);

mysqli_close($connection);






//PROSLA VERZIJA, HARDKODOVAN NIZ

//$a = [
//    [
//        "id" => 1,
//        "name" => 'One',
//        "author" => 'Metallica',
//        "lyrics" => 'I can\'t remember anything'
//    ],
//    [
//        "id" => 3,
//        "name" => 'Enter Sandman',
//        "author" => 'Metallica',
//        "lyrics" => 'Exit light; Enter night;'
//    ],
//    [
//        "id" => 2,
//        "name" => 'Vivir Mi Vida',
//        "author" => 'Marc Anthony',
//        "lyrics" => 'Voy a reír, voy a bailar'
//    ]
//];

//sa proverom:
//
//if ($name != '') {
//    $search = explode(' ', $name);
//    foreach ($search as &$s) {
//        $s = trim($s);
//    }
//
//    echo json_encode(
//        array_values(array_filter($a, function ($element) use ($search) {
//            foreach ($search as $s) {
//                if (stripos($element['author'], $s) !== false || stripos($element['name'], $s) !== false) {
//                    continue;
//                }
//
//                return false;
//            }
//
//            return true;
//        }
//        )));
//} else {
//    echo json_encode($a);
//}
