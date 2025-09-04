<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nfa
 */

get_header(); ?>
<!-- Header End -->
<?php
$imageId = get_field('background_image', 'option');
$title = get_the_title();
$permalink = get_home_url();
;
?>
<div class="">
    <div class="pt-32 pb-[60px]  md:h-screen  page-not-found flex items-center">
        <div class="container">
            <div class="page-not-found-wrapper text-center max-w-[398px] mx-auto">
                <div class="grid space-y-3">
                    <div class="grid sm:gap-2">
                        <div
                            class="flex gap-3 sm:gap-4 items-center text-7xl sm:text-[102px] sm:leading-[1.07] justify-center">
                            <span class="page-not-found-number font-bold uppercase">4 </span>
                            <span class="nfa-logo text-6xl sm:text-8xl">
                                <?php echo useSvg('nfa-logo'); ?>
                            </span>
                            <span class="page-not-found-number font-bold uppercase"> 4 </span>
                        </div>

                        <p class="uppercase text-n-400 text-2xl sm:text-3xl font-semibold">
                            Page not found
                        </p>
                    </div>

                    <div class="relative px-6">
                        <div class=" border-t w-full border-text-grey">
                        </div>
                    </div>
                    <div class="grid gap-6 sm:gap-10">
                        <p class="text-sm sm:text-base text-n-400">Sorry, the page you are looking for couldn’t be found
                        </p>

                        <div>
                            <?php
                            $options = [
                                'url' => $permalink,
                                'text' => 'Go to home',


                            ];
                            echo btn_primary($options); ?>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<?php get_footer(); ?>