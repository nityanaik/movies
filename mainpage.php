<?php
    include 'fetch_data.php';
    $data = array();
    $limit = 5;
    $page = isset($_GET['page'])?$_GET['page'] : 1;
    $start = ($page - 1) * $limit;
    $query = "SELECT m.title title,m.description description, m.image image,m.duration duration, m.date date, c.language language, c.type type FROM movies m, category c, relation r WHERE m.moviesid = r.movieid AND r.categoryid = c.categoryid ORDER BY m.date desc LIMIT $start,$limit";
    $query1 = "SELECT m.title title,m.description description, m.image image,m.duration duration, m.date date, c.language language, c.type type FROM movies m, category c, relation r WHERE m.moviesid = r.movieid AND r.categoryid = c.categoryid";
    $data = fetch_query_data($query);
    $count = get_number_of_rows($query1);

    $total_pages = ceil($count / $limit);
    $prev = $page - 1;
    if($page == 1){
        $prev = 1;
    }
    $next = $page + 1;
    if($page == $total_pages){
        $next = $total_pages;
    }
?>
<html>
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <title>Movies</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" type="text/css" href="style.css">
    <script src="jquerylibrary.js"></script>
    <script src="jquery-3.3.1.min.js"></script>
    <script src="main.js"></script>
</head>
<body>
<div class="main-content">
   <div class = "container">
        <div class = "header">
            <img src="logo.jpg">
            
        </div>
        <div class = "category">
           <span class="categ">Sort By</span> <select class = "sorting">
                <option value="newest">Newest Movies</option>
                <option value="oldest">Oldest Movies</option>
                <option value="shorter">Short Duration</option>
                <option value="longer">Long Duration</option>
            </select>
        </div>  
        <div class="filter">
            <div class="list">
            <h2> Language</h2>
            <?php
                $out = '';
                $lang_data = array();
                $query_lang = "SELECT DISTINCT(language) FROM category ORDER BY language";
                $lang_data = fetch_query_data($query_lang);
                foreach($lang_data as $key => $row){
                    $out .= '<input type="checkbox" class = "lang" method = "post" action="filter_data.php" value="'.$row['language'].'">'.$row['language'].'<br>';
                }
                echo $out
            ?>
        </div>
        <div class="list">
            <h2> Genre</h2>
            <?php
                $out = '';
                $type_data = array();
                $query_type = "SELECT DISTINCT(type) FROM category ORDER BY type";
                $type_data = fetch_query_data($query_type);
                foreach($type_data as $key => $row){
                    $out .= '<input type="checkbox" class = "type" value="'.$row['type'].'">'.$row['type'].'<br>';
                }
                echo $out
            ?>
        </div>
            </div>
        
        <div class = "body">
        <?php
           echo getdata($data);           
        ?>
    </div>
    <div class="pagination_required">
        <ul class="pagination" >
            <li>
            <a href="index.php?page=<?= $prev; ?>">Prev </a>
            </li>
            <?php for($i = 1; $i<= $total_pages; $i++):?>
                <li>
                <a href="index.php?page=<?= $i; ?>"><?= $i; ?> </a>
                </li>
            <?php endfor;?>
            <li>
                <a href="index.php?page=<?= $next; ?>">Next </a>
            </li>
        </ul>
    </div>
   </div>
</div>
</body>
</html>
