<?php
    class Authorization {
        // Checks if an passed in author matches the post's author
        // Takes in a db connection, an author, and a post id
        public static function checkAuthor($db, $author, $id) {
            // Prepare
            $prepared_sql = "SELECT author
                             FROM posts
                             WHERE id = :id";
            $stmt = $db->prepare($prepared_sql);

            // Bind
            $stmt->bindParam(":id", $id);

            // Execute
            $stmt->execute();

            $postAuthor = $stmt->fetch(PDO::FETCH_OBJ);

            if ($author === $postAuthor->author) {
                return true;
            } else {
                return false;
            }
        }
    }
?>