<?php
class Imdbdatabase {
private $DB;
public function __construct() {
    $db = 'mysql:dbname=imdb;charset=utf8;host=127.0.0.1';
    $user = 'root';
    $password = '';

    try {
        $this->DB = new PDO ( $db, $user, $password );
        $this->DB->setAttribute ( PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION );
    } catch ( PDOException $e ) {
        echo ('Error establishing Connection');
        exit ();
    }
}
public function getArrayOfRecords($input1, $input2, $input3) {
    // Need the "%" symbols to allow like something like a search like 1952*
    $title = $input1 . "%";
    $first_name = $input2 . "%";
    $last_name = $input3 . "%";

        $stmt = $this->DB->prepare ( "SELECT name, first_name, last_name, movies.year FROM actors
            JOIN roles ON roles.actor_id = actors.id
            JOIN movies ON roles.movie_id = movies.id
            WHERE movies.name LIKE :title
            AND actors.first_name LIKE :first_name
            AND actors.last_name LIKE :last_name
            LIMIT 50" );


        $stmt->bindParam ( ':title', $title );
        $stmt->bindParam ( ':last_name', $last_name);
        $stmt->bindParam ( ':first_name', $first_name);
        $stmt->execute ();
        return $stmt->fetchAll ( PDO::FETCH_ASSOC );

    }
}
?>
