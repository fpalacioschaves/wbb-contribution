<div class="edit-item-message">
    
</div>

<input type="hidden" name="post_id" id="post_id" value="<?php echo $post_id;?>">
<label for="title">Title</label>
<input type="text" id="title" name="title" value="<?php echo $the_title; ?>">
<br>
<label for="content">Content</label>
<textarea id="content" name="content"><?php echo $the_content;?>
</textarea>
<br>
<?php echo get_the_post_thumbnail( $post_id, 'thumbnail' );?>
<label for="file">Filename:</label>
<input type="file" name="featured_image" id="featured_image"><br>
