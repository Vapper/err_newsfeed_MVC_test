<h1>ERR Uudised:</h1>

<div id="all_rows">
<?php foreach($posts as $post) { ?>
    <div class="row" id="row_<?php echo $post->id; ?>">
        <h2><?php echo $post->title; ?></h2>
        <p>
            <?php echo $post->description; ?>
        </p>
        <a href="<?php echo $post->link; ?>">Link</a>
        <p>
            <?php echo $post->published; ?>
        </p>
    </div>
<?php } ?>
</div>
<input type="hidden" id="row_no" value="<?php echo $post->id+1; ?> ">
    