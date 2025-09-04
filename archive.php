<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nfa
 */

get_header(); ?>

<div class="archive-page">
    <?php
            $queried_object = get_queried_object();
            $posttype = $queried_object->name;?>

            

            <?php

            
            if (is_tag() || is_tax()) {
                $current_taxonomy = $queried_object->taxonomy;
                $filepath = dirname(__FILE__) . '/taxonomy/' . $current_taxonomy . '.php';
            } else {
                $filepath = dirname(__FILE__) . '/archives/' . $posttype . '.php';
            }

            if (file_exists($filepath)) {
                include_once($filepath);
            } else {
                $block_content = '';

                echo $block_content;
            }
            ?>
</div>



<?php get_footer(); ?>