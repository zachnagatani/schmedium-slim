<?php
    class Post {
        private $properties;

        // Properties set to default of null to allow for different methods
        // which may not need every property a post could have
        // EX: "edit" method only needs the $content of a post.
        public function __construct($properties = array()) {
            $this->properties = $properties;
        }

        // Saves a post to the database
        // Only parameter is a database connection
        public function save($db) {
            // Query for prepared statement
            $prepared_sql = "INSERT INTO posts (title, tagline, image_url, content, author)
                            VALUES (:title, :tagline, :image_url, :content, :author)";
            // Prepare the query
            $stmt = $db->prepare($prepared_sql);
            // Bind the query parameters
            $stmt->bindParam(':title', $this->properties['title']);
            $stmt->bindParam(':tagline', $this->properties['tagline']);
            $stmt->bindParam(':image_url', $this->properties['image_url']);
            $stmt->bindParam(':content', $this->properties['content']);
            $stmt->bindParam(':author', $this->properties['author']);

            // Execute the query
            $stmt->execute();
        }

        // Updates a post and returns true or false, depending
        // on if the author is authorized to update the post or not
        // Takes in a JWT and the id of the post to be updated
        // public function update($token, $id) {
            // Connect to the db
            // $db = Db::connect();

            // Prepare
            // $prepared_sql = "SELECT author
                            //  FROM posts
                            //  WHERE id = :id";
            // $stmt = $db->prepare($prepared_sql);

            // Bind
            // $stmt->bindParam(":id", $id);

            // Execute
            // $stmt->execute();

            // $author = $stmt->fetch(PDO::FETCH_OBJ);

            // if ($author->author === $token->data->username) {
                // SQL for prepared statement
                // $prepared_sql = "UPDATE posts
                                // SET content = :content
                                // WHERE id = :id";

                // Prepare the statement
                // $stmt = $db->prepare($prepared_sql);
                // Bind the paramaters
                // $stmt->bindParam(':content', $this->content);
                // $stmt->bindParam(':id', $id);

                // Excecute the statement
                // $stmt->execute();

                // Close the db connection
                // $db = null;

        //         return true;
        //     } else {
        //         $db = null;
        //         return false;
        //     }
        // }

        public function update($db, $id) {
            // SQL for prepared statement
            $prepared_sql = "UPDATE posts
                            SET content = :content
                            WHERE id = :id";

            // Prepare the statement
            $stmt = $db->prepare($prepared_sql);
            // Bind the paramaters
            $stmt->bindParam(':content', $this->properties['content']);
            $stmt->bindParam(':id', $id);

            // Excecute the statement
            $stmt->execute();
        }
    }
?>