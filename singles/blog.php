<?php

$id = get_the_ID();
$posttype = get_post_type();
$permalink = get_the_permalink();
$title = get_the_title();
$content = get_the_content();
// $feature_img = get_the_post_thumbnail_url();
// get thumbnail image
// $bannerImageID = (has_post_thumbnail()) ? get_post_thumbnail_id() : '';
$bannerImageID = (function_exists('get_field') && $fearure_image = get_field('fearure_image')) ? $fearure_image : '';
if (!$bannerImageID) {
    // get archive image as default
    $pageIdentify = $posttype . '_options';
    $bannerImageID = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';
}
$published_date = get_the_date('d M, Y');

$sub_heading = get_field('sub_heading');

$file_upload = get_field('file_upload');
$author = get_field('author');
// var_dump($author);
$feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
$title = get_the_title();

$additional_content = get_field('additional_content ');
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit', $pageIdentify)) ? $photo_credit : '';

$taxonomies = 'blog_tags';
$term_category = get_the_terms($id, $taxonomies);

?>
<section <?php echo $posttype ?>>
    <div id="hero-banner"
        class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">
        <?php if ($bannerImageID) {
            echo wp_get_attachment_image($bannerImageID, "full", false, array("class" => "absolute inset-0 w-full h-full object-cover"));
        }
        echo photo_credit_section($photo_credit);
        ?>


        <div class="container relative z-10 mt-auto hero__banner--content">
            <div class="text-white">
                <div class=" grid gap-4 relative z-10 max-w-xl">
                    <div class="grid gap-6">
                        <h1 class=" font-bigShouldersDisplay font-bold">
                            <?php echo $title; ?>
                        </h1>

                        <div class="flex gap-3 flex-wrap">
                            <div class="flex items-center gap-2">

                                <span class="text-xl">
                                    <?php echo useSvg('calender') ?>
                                </span>
                                <div class="text-sm ">
                                    <?php
                                    $date = array();
                                    $date[] = $published_date;

                                    echo join($date); ?>
                                </div>
                            </div>
                            <div class="flex items-center gap-2">
                                <span class=" text-xl">
                                    <?php echo useSvg('author') ?>
                                </span>
                                <div class="text-sm ">
                                    <?php echo $author->post_title; ?>
                                </div>

                            </div>
                        </div>
                    </div>
                    <p>
                        <a href="/blog" class="flex gap-2 items-center">
                            <span class="text-base">
                                <?php echo useSvg('left-arrow'); ?>
                            </span>
                            Back to Blogs
                        </a>
                    </p>

                </div>

            </div>
        </div>

    </div>

    <div class="container pt-[60px] pb-[60px] sm:pb-24">
        <div class="<?php echo $posttype; ?> event-single border-b border-grey93">

            <div class="max-w-[607px] m-auto pb-8 sm:pb-12">

                <div class="event-details mb-8 sm:mb-9">


                    <div class="event-images items-center">

                        <div class="relative pt-[54%] overflow-hidden rounded-lg">
                            <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                                class="absolute h-full w-full inset-0 object-cover">
                        </div>
                    </div>



                    <div class="text-n-400 paragraph wp-block-post-content entry-content">
                        <?php gutenbergEditorContent(); ?>
                    </div>

                    <?php if ($file_upload): ?>
                        <div class="inline-flex max-sm:justify-center mt-6">
                            <?php
                            $options = [
                                'url' => $file_upload,
                                'text' => 'Download File',

                            ];
                            echo btn_primary($options); ?>

                        </div>
                    <?php endif; ?>
                    <!-- tags Display -->
                    <!-- <div class="events-wrapper container pt-9 sm:pt-12"> -->
                    <div class="max-w-[725px] mx-auto mt-9 ">

                        <div class="font-medium text-sm grid gap-3">
                            <p> Relevant Tags </p>

                            <ul class="relevant-tags flex gap-2 flex-wrap">
                                <?php foreach ($term_category as $category) {
                                    ?>
                                    <a href="<?php echo esc_url(get_term_link($category)) ?>"
                                        class=" inline-flex p-2 bg-n-50 text-sm font-medium cursor-pointer hover:bg-primary-blue hover:text-white transition-all duration-[.4s] ease-in-out">
                                        <span class="tag" data-category="<?php echo $category->slug; ?>">
                                            <?php echo $category->name; ?>

                                        </span>
                                    </a>

                                <?php } ?>
                            </ul>
                        </div>
                    </div>

                    <!-- </div> -->

                </div>




                <div class="share-link-btn">
                    <div class="font-medium text-sm grid gap-3">
                        <?php echo __('Share this', 'nfa'); ?>
                        <?php echo $posttype; ?>

                        <?php echo yi_social_share(); ?>
                    </div>
                </div>
            </div>

        </div>


        <div class="other-event pt-9 sm:pt-12 grid gap-y-6 sm:gap-y-9">
            <?php
            $related_blogs = get_posts(
                array(
                    'post_type' => 'blog',
                    'post_status' => 'publish',
                    'posts_per_page' => 3,
                    'category__in' => wp_get_post_categories(get_the_ID()),
                    'order' => 'ASC',
                    'orderby' => 'ID',
                    'post__not_in' => array(get_the_ID()),
                )
            );

            if ($related_blogs) { ?>
                <h3 class="">OTHER BLOGS</h3>
                <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                    <?php foreach ($related_blogs as $post) {

                        setup_postdata($post); ?>

                        <?php echo blogsCard($id); ?>

                    <?php } ?>
                </div>
                <?php
                wp_reset_postdata();
            } else {
                ?>
                <div>
                    <p>No Event available </p>
                </div>
                <?php
            }

            ?>

        </div>

    </div>

</section>