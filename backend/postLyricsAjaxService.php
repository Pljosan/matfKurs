<?php

$postdata = file_get_contents("php://input");
$request = json_decode($postdata);
@$newName = $request->name;
@$newAuthor = $request->author;
@$newLyrics = $request->text;

$connection = mysqli_connect('localhost', 'root', '', 'matfApp');
if(mysqli_connect_errno())
    die("Connection error!");


$query = "select max(ID) as maxID from songs";
$result = mysqli_query($connection, $query);
if(mysqli_num_rows($result) == 0){
    echo "Error with the select query!";
}
$resultArray = mysqli_fetch_assoc($result);
$newID = $resultArray['maxID'] + 1;


$query = mysqli_prepare($connection, "INSERT INTO songs VALUES (?, ?, ?, ?)");
//dsss - kog su tipa stvari koje ubacujemo
//d integer, s string
mysqli_stmt_bind_param($query, 'dsss', $newID, $newName, $newAuthor, $newLyrics);
$result = mysqli_stmt_execute($query);

if($result === true)
    echo "Insert successful! ";
else
    echo "Error with the insert query!";

mysqli_close($connection);

