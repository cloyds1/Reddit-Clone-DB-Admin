<?php 



$u = 'Bootink';
$p = hash('sha256', 'Smokey2018');
$b = 'hello';
$e = 'Bootink1400@gmail.com';

$uID = 1;
$title = "hello";
$content = "hello";



$db = mysqli_connect('localhost', 'cloyds1', 'reCxJWbyoUxEx82E', 'redditclonedb');

$user = new User(null, "admin", $u, $p, $b, $e);
$post = new Post(null, $uID, null, $title, $content);


DatabaseUtil::(1, $user, $db);
$read_user = DatabaseUtil::readEntry(1, "users", $db);









?>