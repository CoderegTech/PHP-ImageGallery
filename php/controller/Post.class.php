<?php

class Post extends PostContrl
{
    // Create Post
    public function createPost($uid, $postTitle, $postDescription, $postImage, $postCreated)
    {


        $postImageName = $this->uploadImg($postImage);
        $this->addPost($uid, $postTitle, $postDescription, $postImageName, $postCreated);
    }


    // Get all posts from the Database
    public function posts()
    {
        $this->getPosts();
    }

    // Update Post from the Database
    public function updatePost($uid, $newPostTitle, $newPostDescription)
    {

        $this->editPost($uid, $newPostTitle, $newPostDescription);
    }


    // Delete Post from the Database
    public function deletePost($uid, $postImageName)
    {
        $this->removePost($uid);

        // Delete file to folder
        $folder = "uploads/";
        unlink($folder . $postImageName);
    }

    // Get Selected Post
    public function getSelectedPost($uid)
    {
        $this->selectedPost($uid);
    }


    // Upload Image to folder
    public function uploadImg($postImage)
    {

        $fileName = $postImage['name'];
        $fileTmpName = $postImage['tmp_name'];
        $fileSize = $postImage['size'];
        $fileError = $postImage['error'];

        $fileExt = explode(".", $fileName);
        $fileActualExt = strtolower(end($fileExt));

        if ($fileError === 0) {

            $fileNewName = uniqid('') . "." . $fileActualExt;
            $folder = "uploads/";

            if (!is_dir($folder)) {
                mkdir($folder, 0777, true);
            }
            $fileDestination = $folder . $fileNewName;

            if (move_uploaded_file($fileTmpName, $fileDestination)) {
                return $fileNewName;
            } else {
                echo "Upload Failed";
            }
        } else {
            echo "There was an error uploading your file!";
        }
    }
}