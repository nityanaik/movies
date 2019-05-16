<?php
    include 'databaseConn.php';
    include 'template.php';
    $data =array();
    $query;
    if(isset($_POST['sorting'])){
        $query = "SELECT m.title title,m.description description, m.image image,m.duration duration, m.date date, c.language language, c.type type FROM movies m, category c, relation r WHERE m.moviesid = r.movieid AND r.categoryid = c.categoryid ";
        $value = $_POST['sorting'];
        if($value == 'newest'){
            $query .= "ORDER BY date desc";
        }elseif ($value == 'oldest'){
            $query .= "ORDER BY date";
        }elseif ($value == 'shorter'){
            $query .= "ORDER BY duration";
        }elseif ($value == 'longer'){
            $query .= "ORDER BY duration desc";
        }
        $data = fetch_query_data($query);
        echo getdata($data);
    }

?>