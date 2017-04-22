<?php
    class Post {
        private $title;
        private $tagline;
        private $image_url;
        private $content;
        private $author;

        // Properties set to default of null to allow for different methods
        // which may not need every property a post could have
        // EX: "edit" method only needs the $content of a post.
        public function __construct($title = null, $tagline = null, $image_url = null, $content = null, $author = null) {
            $this->title = $title;
            $this->tagline = $tagline;
            $this->image_url = $image_url;
            $this->content = $content;
            $this->author = $author;
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
            $stmt->bindParam(':title', $this->title);
            $stmt->bindParam(':tagline', $this->tagline);
            $stmt->bindParam(':image_url', $this->image_url);
            $stmt->bindParam(':content', $this->content);
            $stmt->bindParam(':author', $this->author);

            // Execute the query
            $stmt->execute();
        }
    }
?>