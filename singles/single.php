<?php


while (have_posts()):

    the_post();
    the_title();
    gutenbergEditorContent();
    // the_content();

endwhile;

?>