

<?php
$row_id="row_".$post->id;
$row_title=$post->title;
$row_desc=$post->description;
$row_link=$post->link;
$row_pub = $post->published;


echo "<div class='row' id=$row_id><h2>$row_title</h2><p>$row_desc</p><a href='$row_link'>Link</a><p>$row_pub</p></div><br>";

?>