<?php

/**
 * The site's entry point.
 *
 * Loads the relevant template part,
 * the loop is executed (when needed) by the relevant template part.
 *
 * @package Nfa
 */

if (!defined('ABSPATH')) {
    exit; // Exit if accessed directly.
}
get_header();
?>

<main id="primary" class="site-main">
    <?php
    $current_post_type = ($queried_object && $queried_object->name) ? $queried_object->name : "post";
    get_template_part( 'archives/archive', $current_post_type );
   
    ?>

</main>
<?php get_footer();?>