<?php
/**
 * The main template file
 *
 * @link https://developer.wordpress.org/themes/basics/template-hierarchy/
 *
 * @package Nfa
 */

//   Header
get_header(); ?>
<!-- Header End -->
<?php

$imageId = get_field('background_image', 'option');
$title = get_the_title();
?>
<!-- Hero-Section -->

<div id="hero-banner"
    class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">

    <img src="<?php echo $imageId; ?>" class="absolute inset-0 w-full h-full object-cover">
    <div class="container relative z-10 mt-auto hero__banner--content">
        <div class="text-white">
            <div class=" grid gap-4 relative z-10 max-w-xl">
                <h1 class=" font-bigShouldersDisplay font-bold">
                    Search
                </h1>
            </div>

        </div>

    </div>

</div>
<!-- Hero-Section End -->


<div class="container pt-[60px] pb-24">
    <div class="search-field border-b border-grey93 pb-8 sm:pb-12">
        <div class="relative max-w-[498px] mx-auto ">
            <div class="grid gap-4 sm:gap-6">
                <div class="text-center">
                    <h3 class=" text-primary-black">
                        Search
                    </h3>

                </div>

                <form role="search" method="get" id="search-form" action="<?php echo esc_url(home_url('/')); ?>"
                    class="input-group w-full pointer-events-auto relative">
                    <div class="input-group flex bg-n-50 rounded-lg overflow-hidden ">
                        <input type="search" class="search-input text-primary-black bg-n-50  w-full"
                            placeholder="Search" aria-label="search nico" name="s" id="search-input"
                            value="<?php echo esc_attr(get_search_query()); ?>">
                        <button class="search-button bg-primary-blue text-[28px] leading-normal rounded-lg">
                            <?php echo useSvg('search-icon'); ?>
                            <button>

                    </div>
                </form>
            </div>
        </div>

    </div>


    <div class="container mt-8 sm:mt-12">
        <div class=" mb-8 md:mb-12">
            <h4 class="text-n-400 font-bold">
                <?php $allsearch = new WP_Query("s=$s&showposts=0");
                echo $allsearch->found_posts . ' results found'; ?>
                <span class="text-primary-blue relative search-text">
                    <?php echo get_search_query(); ?>
                </span>

            </h4>
        </div>

        <div id="search-results" class="search-results max-w-[1133px]">
            <div class=" grid gap-y-8 search-results-container divide-y divide-grey93">

                <?php while (have_posts()) {

                    the_post();

                    $id = get_the_ID();

                    $title = get_the_title();

                    $post_type = get_post_type();

                    $permalink = get_the_permalink();

                    $content = excerpt('183');

                    $s = get_query_var('s');

                    $keys = explode(" ", $s);

                    // $content = preg_replace('/(' . implode('|', $keys) . ')/iu', '<strong>\0</strong>', $content);
                    ?>

                    <div class="result relative">
                        <div>
                            <a class="max-sm:flex-col flex search-result-card gap-x-6 group relative group"
                                href="<?php echo $permalink; ?>">
                                <div class="sm:basis-[26%]  border-grey93 border-2  rounded-lg  overflow-hidden  ">
                                    <div class="max-sm:mb-2 relative pt-[57%] search-img rounded-lg  overflow-hidden">
                                        <?php $classes = "search-card-images group-hover:scale-105 transition-all duration-[.4s] ease-in-out";
                                        if (has_post_thumbnail()) {
                                            echo
                                                get_the_post_thumbnail($id, 'medium_large', array('class' => $classes));
                                        } else {
                                            $default_img = get_template_directory_uri() . '/dist/images/default_image.jpg';
                                            ?>
                                            <img loading="lazy" src="<?php echo $default_img; ?>" alt=""
                                                class="search-card-images group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
                                        <?php } ?>

                                    </div>
                                </div>
                                <div class="sm:flex-1">

                                    <p class="flex items-center gap-x-1 text-sm font-medium text-n-400 mb-3">
                                        <span class="text-primary-yellow">
                                            <?php echo useSvg('send') ?>
                                        </span>

                                        <?php $post_type = get_post_type($post->ID);
                                        if ($post_type == "resource") {
                                            $tagText = "Resource";
                                        } else if ($post_type == "blog") {
                                            $tagText = "Blog";
                                        } else if ($post_type == "event") {
                                            $tagText = "Event";
                                        } else if ($post_type == "partner") {
                                            $tagText = "Partner";
                                        } else if ($post_type == "team") {
                                            $tagText = "Team";
                                        } else if ($post_type == "multimedia") {
                                            $tagText = "Multimedia";
                                        } else if ($post_type == "work") {
                                            $tagText = "Work";
                                        } else if ($post_type == "opportunity") {
                                            $tagText = "Opportunity";
                                        } else if ($post_type == "page") {
                                            $tagText = "Page";
                                        }
                                        $tagText ? $tagText : $post_type;
                                        echo $tagText;
                                        ?>

                                    </p>

                                    <p class="text-lg font-medium">
                                        <?php echo $title; ?>

                                    </p>
                                    <div class="text-n-400 line-clamp-4">
                                        <?php echo $content; ?>
                                    </div>
                                </div>
                            </a>

                        </div>
                    </div>
                <?php }
                ?>


                <?php if (main_query_pagination()) { ?>

                    <div class=" pt-8 md:pt-[60px]">

                        <?php echo main_query_pagination(); ?>

                    </div>

                <?php } ?>





                <!-- < ?php if (have_posts()): ?>
                    < ?php while (have_posts()): ?>
                        < ?php the_post(); ?>
                        <div class="results">
                            < ?php
                            $classes = "stories-image";
                            if (has_post_thumbnail()) {
                                echo get_the_post_thumbnail($id, 'medium_large', array('class' => $classes));
                            } else {
                                $default_img = get_template_directory_uri() . '/dist/images/default_image.jpg';
                                ?>
                                <img loading="lazy" src="< ?php echo $default_img; ?>" alt="" class="stories-image">
                            < ?php }
                            ?>
                            <a href="< ?php the_permalink(); ?>" class="read-more-link">
                                <h2>
                                    < ?php the_title(); ?>
                                </h2>
                            </a>
                            <p>
                                < ?php the_content(); ?>
                            </p>

                        </div>
                    < ?php endwhile; ?>




                < ?php else: ?>
                    <p>
                        < ?php _e('No Search Results found', 'nfa'); ?>
                    </p>
                < ?php endif; ?> -->
                <!-- Search results -->
            </div>

        </div>
    </div>
</div>

<?php get_footer(); ?>