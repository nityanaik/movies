<?php
        function fetch_query_data($query){
            global $conn;
            $data =array();
            mysql_select_db('drupal');
            $sql = mysql_query($query,$conn);
            if(! $sql ) {
                die('Could not get data: ' . mysql_error());
            }
            while($row = mysql_fetch_assoc($sql)) {
                $data[]=$row;
            }
            return $data;
        }
        function get_number_of_rows($query){
            global $conn;
            mysql_select_db('drupal');
            $sql = mysql_query($query,$conn);
            return mysql_num_rows($sql); 
        }
        function getdata($data){
            $output = '';
            foreach ($data as $key => $row){ 
                $output .= '<div class = "movies">';
                $output .= '<div class="movie_img">';
                $output .= '<img src="'.$row['image'].'"width="90%" height="80%" style="margin:10px;">';
                $output .= '</div>';
                $output .=   '<div class ="moviedetails">';
                $output .=       '<div class="movie_title">'.$row['title'].'</div>';
                $output .=          '<div class="movie_desc">'.$row['description'].'</div>';
                $output .=          '<div class="movie_date">Release date: '.$row['date'].'</div>';
                $output .=          '<div class="movie_duration">'.$row['duration'].' minutes</div>';
                $output .=          '<div class="movie_category">'.$row['language'].'  '.$row['type'].'</div>';
                $output .=      '</div>';
                $output .= '</div>';
            }
            echo $output;
        }
?>
