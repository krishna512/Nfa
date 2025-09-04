<?php
/**
 * The page template
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package nunito
 */
get_header();
?>

<main id="primary" class="site-main ">
    <?php
    if (!is_front_page()) {

        // echo get_archive_page_heading($posttype);
    
    }
    ?>
    <?php
    if (have_posts()) {
        while (have_posts()) {
            the_post();
            gutenbergEditorContent();
        }
    }
    ?>
</main>
<?php
get_footer();