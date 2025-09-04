<?php


add_action('wp_enqueue_scripts', function () {

    load_fonts_url();
    wp_enqueue_script('slick-script', 'https://cdnjs.cloudflare.com/ajax/libs/slick-carousel/1.8.1/slick.min.js', array('jquery'), _THEME_VERSION, true);

    wp_enqueue_script('gsap', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/gsap.min.js', array('jquery'), _THEME_VERSION, true);
    wp_enqueue_script('scrolltrigger', 'https://cdnjs.cloudflare.com/ajax/libs/gsap/3.12.5/ScrollTrigger.min.js', array('jquery'), _THEME_VERSION, true);

    wp_enqueue_script('lottie-script', 'https://unpkg.com/@lottiefiles/lottie-player@latest/dist/lottie-player.js', array('jquery'), _THEME_VERSION, true);



    // wp_enqueue_script('lottie-script', "https://cdnjs.cloudflare.com/ajax/libs/bodymovin/5.12.2/lottie.min.js", array('jquery'), _THEME_VERSION, true);


}, 11);

add_action('enqueue_block_editor_assets', function () {

    load_fonts_url();

}, 11);


if (!function_exists('load_fonts_url')) {
    function load_fonts_url()
    {
        wp_enqueue_style('theme-fonts', 'https://fonts.googleapis.com/css2?family=Big+Shoulders+Display:wght@400;700&family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet', array(), null);
    }
}