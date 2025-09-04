<?php
$bannerImageID = (has_post_thumbnail()) ? get_post_thumbnail_id() : '';
$pageIdentify = $posttype . '_options';
if (!$bannerImageID) {
    // get archive image as default
   
    $bannerImageID = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';

}
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit', $pageIdentify)) ? $photo_credit : '';
$title = get_the_title();

$taxonomies = 'multimedia-category';
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
                    <h1 class=" font-bigShouldersDisplay font-bold">
                        <?php echo $title; ?>
                    </h1>


                    <p>
                        <?php foreach ($term_category as $category) {
                                            ?>
                        <a href="<?php echo esc_url(get_term_link($category)) ?>" class="flex gap-2 items-center">
                            <span class="text-base">
                                <?php echo useSvg('left-arrow'); ?>
                            </span>
                            Back to <?php echo $category->name; ?>

                        </a>
                        <?php }?>

                    </p>
                </div>

            </div>
        </div>

    </div>

    <div class="container  pt-[60px] pb-[60px] sm:pb-24">
        <div class="grid lg:grid-cols-12 gap-6">
            <?php while (have_posts()) {
                the_post();
                $id = get_the_ID();
                $title = get_the_title();
                $video_url = get_field('video_url');
                preg_match('%(?:youtube(?:-nocookie)?\.com/(?:[^/]+/.+/|(?:v|e(?:mbed)?)/|.*[?&]v=)|youtu\.be/)([^"&?/ ]{11})%i', $video_url, $match);
                if ($match) {
                    $youtube_id = $match[1];
                    $embedUrl = "https://www.youtube.com/embed/" . $youtube_id;
                }

            } ?>

            <div class="lg:col-span-7">
                <div class="">
                    <div class="rounded-lg overflow-hidden mb-8 sm:mb-11">

                        <!-- video link -->
                        <div class="podcast-video">

                            <div class="">


                                <?php if ($video_url) { ?>

                                <div class="iframe-holder relative overflow-hidden pt-[65%]">
                                    <iframe loading="lazy" frameborder="0" allowfullscreen=""
                                        allow="accelerometer; autoplay; clipboard-write; encrypted-media; gyroscope; picture-in-picture; web-share"
                                        title="<?php echo $title; ?>" width="640" height="360"
                                        src="<?php echo ($embedUrl); ?>"
                                        class="absolute w-full h-full top-0 object-cover"></iframe>

                                </div>


                                <?php } elseif (has_post_thumbnail($id)) { ?>
                                <div class="relative  overflow-hidden pt-[65%]">
                                    <?php the_post_thumbnail($id, 'medium', array('class' => 'absolute h-full w-full inset-0 object-cover')); ?>
                                </div>
                                <?php } ?>

                            </div>

                        </div>

                        <div class="bg-n-50 p-4 sm:p-6">
                            <div class="sm:text-lg font-semibold">
                                <?php echo $title; ?>
                                </h1>
                            </div>
                        </div>
                    </div>

                    <div class="podcast-description">
                        <p class="text-primary-black font-medium mb-3 sm:mb-4">Description</p>
                        <div class="text-n-400">
                            <?php the_content(); ?>

                        </div>
                    </div>
                </div>
            </div>



            <div class="lg:col-span-5">
                <div class="grid gap-6  py-6 px-4 sm:px-9 bg-n-50 rounded-lg">
                    <?php
                    $related_posts = get_posts(array(
                        'post_type' => 'multimedia',
                        'post_status' => 'publish',
                        'posts_per_page' => 4,
                        'orderby' => 'rand',
                        'post__not_in' => array(get_the_ID()),
                        'tax_query' => array(
                            array(
                                'taxonomy' => 'multimedia-category',
                                'field' => 'slug',
                                'terms' => $term_category[0]->slug,
                            )
                        ),
                    ));

                    if ($related_posts) {

                        foreach ($related_posts as $post) {
                            $title = get_the_title();
                            $permalink = get_permalink();
                            $id = get_the_ID();

                            $oEmbed = get_field('video_url');
                        
                            $image = ($oEmbed) ? acf_youtube_thumbnail($oEmbed) : get_the_post_thumbnail($id, 'large');
                        
                            setup_postdata($post); ?>
                    <div class="<?php echo $taxoTermsSLug; ?>" data-id="<?php echo $id; ?>">
                        <div class="grid  xsm:grid-cols-2 gap-4">
                            <a href="<?php echo $permalink; ?>">
                                <div class="relative overflow-hidden pt-[51%] rounded-lg">

                                    <?php echo $image; ?>
                                </div>
                            </a>
                            <div class="">

                                <a href="<?php echo $permalink; ?>" class="sm:text-lg font-semibold ">
                                    <?php echo $title; ?>
                                </a>

                            </div>

                        </div>
                    </div>



                    <?php }

                       
                    }else { ?>
                    <?php foreach ($term_category as $category) {
                                            ?>
                    <div>
                        <p>No Others <?php echo $category->name; ?> </p>
                    </div>
                    <?php }?>
                    <?php

                    }
                    wp_reset_postdata();
                    ?>


                </div>
            </div>

        </div>
</section>