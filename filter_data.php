<?php
    include 'databaseConn.php';
    include 'template.php';


    $data =array();
    $query1 = "SELECT m.title title,m.description description, m.image image,m.duration duration, m.date date, c.language language, c.type type FROM movies m, category c, relation r WHERE m.moviesid = r.movieid AND r.categoryid = c.categoryid ";
    if(isset($_POST['lang'])){
        $lang = implode("','", $_POST["lang"]);
        $query1 .= " AND c.language IN('".$lang."') ";
        
    }
    if(isset($_POST['gen'])){
        $gen = implode("','", $_POST["gen"]);
        $query1 .= " AND c.type IN('".$gen."') ";
    }
    $query1 .= " ORDER BY m.date desc";
    $data = fetch_query_data($query1);
    
    echo getdata($data);

?>
