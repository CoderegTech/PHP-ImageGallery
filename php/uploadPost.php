<?php
header('Access-Control-Allow-Origin: *');
header("Access-Control-Allow-Methods: GET, POST, OPTIONS, PUT, DELETE");
header("Access-Control-Allow-Headers: Content-Type, Access-Control-Allow-Headers, X-Requested-With");
header("Content-Type: application/json; charset=UTF-8");

include_once 'model/Dbh.class.php';
include_once 'controller/PostContrl.class.php';
include_once 'controller/Post.class.php';

$method = $_SERVER['REQUEST_METHOD'];
if ($method === "POST") {

    $postTitle = $_POST['postTitle'];
    $postDescription = $_POST['postDescription'];
    $postImage = $_FILES['postImage'];
    $postCreated = $_POST['postCreated'];

    $post = new Post();
    $post->createPost(uniqid(""), $postTitle, $postDescription, $postImage, $postCreated);
}