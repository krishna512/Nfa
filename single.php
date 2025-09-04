<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nfa
 */

get_header(); ?>

<div class="single-page">
    <?php
            $posttype = get_post_type();
            $filepath = dirname(__FILE__) . '/singles/' . $posttype . '.php';
            if (file_exists($filepath)) {
                include_once($filepath);
            } else {
                include_once(dirname(__FILE__) . '/singles/single.php');
            }
            ?>
</div>

<?php get_footer(); ?>