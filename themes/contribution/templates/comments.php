<?php
$comments = get_comments ();
foreach ( $comments as $comment ) :
	echo ( $comment->comment_author . '<br />' . $comment->comment_content );
endforeach;
