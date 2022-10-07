<?php

class PostContrl extends Dbh
{

    protected function selectedPost($uid)
    {

        try {
            $sql = "SELECT * FROM gallery WHERE uid = ?;";
            $stmt = $this->connect()->prepare($sql);

            $execute = $stmt->execute([$uid]);

            if ($execute && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($results);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    protected function addPost($uid, $postTitle, $postDescription, $postImageName, $postCreated)
    {
        try {
            $sql = "INSERT INTO gallery (uid, postTitle, postDescription, postImage, postCreated) VALUES (:uid, :postTitle, :postDescription, :postImage, :postCreated);";
            $stmt = $this->connect()->prepare($sql);

            $stmt->bindParam(":uid", $uid, PDO::PARAM_STR);
            $stmt->bindParam(":postTitle", $postTitle, PDO::PARAM_STR);
            $stmt->bindParam(":postDescription", $postDescription, PDO::PARAM_STR);
            $stmt->bindParam(":postImage", $postImageName, PDO::PARAM_STR);
            $stmt->bindParam(":postCreated", $postCreated, PDO::PARAM_STR);

            $execute = $stmt->execute();

            if ($execute && $stmt->rowCount() > 0) {
                echo "Post Added Succesfully";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }


    protected function getPosts()
    {
        try {
            $sql = "SELECT * FROM gallery ORDER BY postCreated DESC;";
            $stmt = $this->connect()->prepare($sql);

            $execute = $stmt->execute();

            if ($execute && $stmt->rowCount() > 0) {
                $results = $stmt->fetchAll(PDO::FETCH_ASSOC);
                echo json_encode($results);
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function removePost($uid)
    {
        try {
            $sql = "DELETE FROM gallery WHERE uid = ?;";
            $stmt = $this->connect()->prepare($sql);

            $execute = $stmt->execute([$uid]);

            if ($execute && $stmt->rowCount() > 0) {
                echo "Post Deleted!";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }

    protected function editPost($uid, $newPostTitle, $newPostDescription)
    {
        try {
            $sql = "UPDATE gallery SET postTitle = :postTitle, postDescription = :postDescription WHERE uid = :uid ;";
            $stmt = $this->connect()->prepare($sql);

            $stmt->bindParam(":uid", $uid, PDO::PARAM_STR);
            $stmt->bindParam(":postTitle", $newPostTitle, PDO::PARAM_STR);
            $stmt->bindParam(":postDescription", $newPostDescription, PDO::PARAM_STR);

            $execute = $stmt->execute();
            if ($execute && $stmt->rowCount() > 0) {
                echo "Post Updated!";
            }
        } catch (Exception $e) {
            echo $e->getMessage();
        }
    }
}