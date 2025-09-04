<?php
/**
 * The header for our theme
 *
 * This is the template that displays all of the <head> section
 *
 * @link https://developer.wordpress.org/themes/basics/template-files/#template-partials
 *
 * @package nfa
 */
$site_logo_ID = (function_exists('get_field') && $logo = get_field('site_logo', 'option')) ? $logo : '';
$website_logo_white = (function_exists('get_field') && $logo = get_field('website_logo_white', 'option')) ? $logo : '';
$logo_animateIn = get_template_directory_uri() . '/dist/lottie/logoAnim.json';
$donate_button = (function_exists('get_field') && $donate_button = get_field('donate_button_url', 'option')) ? $donate_button : '';
?>


<!DOCTYPE html>
<html <?php language_attributes(); ?> style="">

<head>
    <meta charset="<?php bloginfo('charset'); ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1, maximum-scale=1, user-scalable=0">
    <link rel="profile" href="https://gmpg.org/xfn/11">
    <link rel="icon" href="<?php echo get_template_directory_uri(); ?>/dist/images/icons/favicon.png" sizes="32x32" />
    <?php wp_head(); ?>
</head>

<body <?php body_class(); ?>>
    <?php wp_body_open(); ?>
    <!-- - loader -->
    <!-- <div class="loader">
        <div id="lottie-animation" class="lottie-container">
            <lottie-player src="< ?php echo $logo_animateIn; ?> " speed="0.7" background="transparent" loop autoplay>
            </lottie-player>


        </div>
    </div> -->
    <!-- loader end -->
    <div id=" page" class="site">
        <header id="masthead">
            <div class="header fixed top-0 left-0 right-0 bg-transparent z-50 ">
                <div class="container py-4 sm:py-6">
                    <?php
                    if (function_exists('the_custom_logo')) {
                        $custom_logo_id = get_theme_mod('custom_logo');
                        $logo = wp_get_attachment_image_url($custom_logo_id, 'full');

                    } ?>
                    <nav class="nav flex justify-between items-center text-white gap-x-4">
                        <div class="nav__logo max-w-[180px] sm:max-w-full">
                            <a class="site-logo" href="<?php echo esc_url(home_url('/')); ?>" rel="home" title="Home">
                                <img src="<?php echo $logo; ?>" alt="nfa"></a>
                            </a>

                        </div>

                        <div class="main-menu hidden lg:block">
                            <?php
                            wp_nav_menu(
                                array(
                                    'theme_location' => 'menu-1',
                                    'menu_id' => 'primary-menu',
                                    'menu_class' => 'nav__menu flex gap-x-2 text-normal',
                                )
                            );

                            ?>
                        </div>
                        <div class="flex items-center gap-x-6">


                            <div class="search search-form-wrapper">
                                <button class="search__icon flex ">
                                    <span class=" search__icon--btn  cursor-pointer text-xl">
                                        <?php echo useSVG('search-icon'); ?>
                                    </span>
                                </button>

                                <div class="search-modal p-5">
                                    <div id="search-modal__overlay"></div>
                                    <div class="w-full h-full  relative flex justify-center items-center">
                                        <!-- <div md:max-w-3xl mx-auto  class="relative pointer-events-none z-50 top-[50%] -translate-y-2/4 flex justify-center items-center w-full"> -->
                                        <div
                                            class="relative pointer-events-auto  z-50 basis-[609px]  max-w-[609px] bg-white rounded-lg px-6 md:px-14 py-10 md:py-20">
                                            <div class="grid gap-4 sm:gap-6">
                                                <div class="text-center max-w-[409px] mx-auto">
                                                    <h3 class="uppercase text-primary-black">
                                                        Search
                                                    </h3>
                                                </div>

                                                <form role="search" method="get" id="search-form"
                                                    action="<?php echo esc_url(home_url('/')); ?>"
                                                    class="input-group w-full pointer-events-auto relative">
                                                    <div class="input-group flex bg-n-50 rounded-lg overflow-hidden ">
                                                        <input type="search"
                                                            class="search-input text-primary-black bg-n-50  w-full"
                                                            placeholder="Search" aria-label="search nico" name="s"
                                                            id="search-input"
                                                            value="<?php echo esc_attr(get_search_query()); ?>">
                                                        <button
                                                            class="search-button bg-primary-blue text-[28px] leading-normal rounded-lg">
                                                            <?php echo useSvg('search-icon'); ?>
                                                            <button>

                                                    </div>
                                                </form>
                                            </div>

                                            <button
                                                class="absolute top-[26px] right-[26px] text-normal cursor-pointer close-btn text-primary-black  z-30">
                                                <?php echo useSvg('close-icon'); ?>
                                            </button>
                                        </div>



                                    </div>
                                </div>
                            </div>
                            <div class="hidden lg:block">
                                <?php
                                $options = [
                                    'url' => $donate_button,
                                    //  $button_url,
                                    'text' => 'Donate',
                                    'size' => 'small',
                                    'icon' => '',

                                ];
                                echo btn_primary($options); ?>


                            </div>

                            <div id="hamburger"
                                class=" lg:hidden hamburger-toggle relative w-6 h-[18px] cursor-pointer flex flex-col items-center justify-between z-[15]">

                                <span class="w-full h-0.5 bg-white rounded-3xl  "> </span>
                                <span class="w-full h-0.5 bg-white rounded-3xl"> </span>
                                <span class="w-full h-0.5 bg-white rounded-3xl"> </span>
                            </div>

                        </div>
                    </nav>

                    <!-- Hamburger Menu -->
                    <nav class="hamburger-menu px-4 invisible ">
                        <div id="overlay"> </div>


                        <div class="hamburger-content absolute bg-n-50  pt-16  pb-6">

                            <div class="main-menu px-6 max-h-[95vh] overflow-auto">
                                <?php
                                wp_nav_menu(
                                    array(
                                        'theme_location' => 'menu-1',
                                        'menu_id' => 'primary-menu',
                                        'menu_class' => ' text-sm hamburger-nav__menu  ',

                                    )
                                );

                                ?>
                            </div>


                        </div>

                    </nav>


                </div>
            </div>

        </header>