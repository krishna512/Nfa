<?php


$title = get_the_title();
if (is_archive()) {
    $queried_object = get_queried_object();

    if (is_tax()) {
        $pageIdentify = $queried_object;
        $label = $queried_object->name;
    } else {
        $posttype = $queried_object->name;
        $label = $queried_object->label;
        $pageIdentify = $posttype . '_options';
    }
    $photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit', $pageIdentify)) ? $photo_credit : '';
    $heading = (function_exists('get_field') && $heading = get_field('heading', $pageIdentify)) ? $heading : $label;
    $background_image = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';

} else {

    $heading = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
    $photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';
}
$title = ($heading) ? $heading : get_the_title();

?>

<div class="<?php echo $posttype; ?>-archive">
    <div id="hero-banner"
        class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">
        <?php if ($background_image) {
            echo wp_get_attachment_image($background_image, "full", false, array("class" => "absolute inset-0 w-full h-full object-cover"));
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

                        Keyword related blogs

                    </p>


                </div>

            </div>
        </div>

    </div>
    <div class="events-wrapper container pt-[60px] pb-[60px] sm:pb-24">

        <div class="grid gap-10 sm:gap-[60px] divide-y divide-grey93">
            <div class="event-card ">
                <?php
                if (have_posts()) {
                    ?>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6">
                        <?php
                        while (have_posts()) {
                            the_post();
                            $id = get_the_ID();

                            echo blogsCard($id);
                        }

                        ?>
                    </div>

                    <?php

                } else {
                    ?>
                    <div>
                        <p>No Event available </p>
                    </div>
                    <?php
                }
                // $pagination = main_query_pagination();
                // echo $pagination;
                
                ?>

                <?php if (main_query_pagination()) { ?>

                    <div class=" pt-8 md:pt-[60px]">

                        <?php echo main_query_pagination(); ?>

                    </div>

                <?php } ?>



            </div>


            <div class="events-wrapper container pt-9 sm:pt-12">
                <div class="max-w-[725px] mx-auto ">
                    <div class="text-center mb-6">
                        <h3 class="">
                            EXPLORE BLOGS BY RELEVANT DATES
                        </h3>
                    </div>

                    <ul class=" relevant-dates flex gap-2 flex-wrap justify-center">
                        <?php wp_get_archives(
                            array(
                                'post_type' => 'blog',
                                'order' => 'ASC',
                                'orderby' => 'ID',
                            )
                        ); ?>

                    </ul>
                </div>

            </div>
        </div>

    </div>
</div>