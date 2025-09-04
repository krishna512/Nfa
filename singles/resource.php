<?php

$id = get_the_ID();
$posttype = get_post_type();
$permalink = get_the_permalink();
$title = get_the_title();
$content = get_the_content();

// get thumbnail image
$bannerImageID = (function_exists('get_field') && $fearure_image = get_field('fearure_image')) ? $fearure_image : '';
if (!$bannerImageID) {
    // get archive image as default
    $pageIdentify = $posttype . '_options';
    $bannerImageID = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';

    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
}
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit', $pageIdentify)) ? $photo_credit : '';

$published_date = get_field('published_date');
// var_dump($published_date);
$published_date = date_format(date_create($published_date), "d M, Y");
// $published_date = get_the_date('d M, Y');
$tags = get_the_tags();

$taxonomies = 'resource-category';
$country = 'country';
$term_category = get_the_terms($id, $taxonomies);
$term_country = get_the_terms($id, $country);

$upload_file = get_field('upload_file');
$external_link = get_field('external_link');
$cycle = get_field('cycle');
$preparedby = get_field('preparedby');
$author = get_field('author');

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
                        <a href="/resource" class="flex gap-2 items-center">
                            <span class="text-base">
                                <?php echo useSvg('left-arrow'); ?>
                            </span>
                            Back to Resources
                        </a>
                    </p>
                </div>

            </div>
        </div>

    </div>

    <div class="<?php echo $posttype; ?> resources-single container pt-[60px] pb-[60px] sm:pb-24">
        <div class="<?php echo $posttype . '-' . $id ?> grid sm:grid-cols-12 gap-6">

            <div class=" sm:col-span-4 lg:col-span-3">
                <div class="flex flex-col gap-6">
                    <div class="relative overflow-hidden pt-[104%] rounded-lg">
                        <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                            class="absolute w-full h-full inset-0 object-cover">
                    </div>


                    <?php
                    if (have_rows('upload_file_repeater')):
                        $upload_count = get_field('upload_file_repeater');
                        if (count($upload_count) > 1) {
                            function resource()
                            {
                                ob_start(); ?>

                                <div
                                    class="report-download border border-grey93 rounded sm:col-span-8 lg:col-span-5 mt-8 overflow-hidden">
                                    <div>
                                        <?php
                                        while (have_rows('upload_file_repeater')):
                                            the_row();

                                            $file_label = (function_exists('get_sub_field') && $file_label = get_sub_field('file_label')) ? $file_label : 'Download report';

                                            $upload_file = get_sub_field('upload_file');

                                            ?>

                                            <div
                                                class="flex max-xsm:flex-col max-xsm:gap-2 gap-x-1 report-download-wrapper justify-between">
                                                <div class="xsm:basis-[80%]"><?php echo $file_label; ?> </div>

                                                <div class="xsm:basis-[20%]">
                                                    <a href="<?php echo $upload_file; ?>" target="_blank"
                                                        class="flex items-center gap-1 text-sm  duration-200 ease-linear text-primary-blue font-medium hover:underline">
                                                        Download
                                                        <span>
                                                            <?php echo useSvg('download'); ?>
                                                        </span>
                                                    </a>
                                                </div>
                                            </div>
                                            <?php

                                        endwhile;

                                        ?>
                                    </div>
                                </div>

                                <?php

                            }

                        } else {
                            while (have_rows('upload_file_repeater')):
                                the_row();

                                $file_label = (function_exists('get_sub_field') && $file_label = get_sub_field('file_label')) ? $file_label : 'Download report';

                                $upload_file = get_sub_field('upload_file');

                                ?>
                                <div class="">
                                    <?php
                                    $options = [
                                        'url' => $upload_file,
                                        'text' => $file_label,
                                        'icon' => 'download',

                                    ];
                                    echo btn_primary($options); ?>

                                </div>


                                <?php

                            endwhile;
                        }
                    endif;

                    ?>


                    <?php if ($external_link): ?>
                        <div class="inline-flex max-sm:justify-center">
                            <?php
                            $options = [
                                'url' => $external_link,
                                'text' => 'View File',
                                'icon' => 'view-icon',
                            ];
                            echo btn_primary($options); ?>

                        </div>
                    <?php endif; ?>
                </div>
            </div>

            <!-- text-->
            <div class=" sm:col-span-8 lg:col-span-5">
                <h4 class="mb-4 sm:mb-6">
                    <?php echo $title; ?>
                </h4>

                <div class="text-n-400">
                    <?php echo $content; ?>
                </div>
                <?php if (count($upload_count) > 1) {
                    echo resource();
                }
                ?>

            </div>


            <div class="sm:col-span-12 lg:col-span-4">
                <div class="bg-n-50 p-4 sm:p-6 grid gap-3 sm:gap-4 md:gap-5 rounded-lg">

                    <?php
                    if ($term_category) {
                        ?>

                        <div class="">
                            <div class=" text-xs sm:text-sm text-subtext ">Category</div>
                            <ul class="flex flex-wrap">
                                <?php
                                foreach ($term_category as $category) {
                                    ?>
                                    <li class="category-tags">
                                        <a href="<?php echo home_url() . '/resource-category/' . $category->slug; ?>">
                                            <span class="sm:text-lg font-semibold"
                                                data-category="<?php echo $category->slug; ?>">
                                                <?php echo $category->name; ?>
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>
                        <?php
                    }
                    ?>
                    <?php
                    if ($term_country) {
                        ?>


                        <div class="">
                            <div class="text-xs sm:text-sm text-subtext">Country</div>
                            <ul class="flex flex-wrap">
                                <?php
                                foreach ($term_country as $category) {
                                    ?>
                                    <li class="category-tags">
                                        <a href="<?php echo home_url() . '/country/' . $category->slug; ?>">
                                            <span class="sm:text-lg font-semibold"
                                                data-category="<?php echo $category->slug; ?>">
                                                <?php echo $category->name; ?>
                                            </span>
                                        </a>
                                    </li>
                                    <?php
                                }
                                ?>
                            </ul>
                        </div>

                        <?php
                    }
                    ?>
                    <?php if ($cycle): ?>
                        <div class="">
                            <div class="text-xs sm:text-sm text-subtext">Cycle</div>
                            <div class="sm:text-lg font-semibold">

                                <?php echo $cycle; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <?php if ($preparedby): ?>
                        <div class="">
                            <div class="text-xs sm:text-sm text-subtext">Prepared By</div>
                            <div class="sm:text-lg font-semibold">

                                <?php echo $preparedby; ?>
                            </div>
                        </div>
                    <?php endif; ?>

                    <div class="">
                        <div class="text-xs sm:text-sm text-subtext">Published Year</div>
                        <div class="sm:text-lg font-semibold">
                            <?php echo $published_date; ?>
                        </div>
                    </div>


                    <div class="border-t border-grey93 pt-4 sm:pt-6 share-link-btn">
                        <div class="font-medium text-sm pb-4  sm:pb-6">
                            <?php echo __('Share', 'nfa'); ?>
                            <!-- < ?php echo $posttype; ?> -->

                        </div>
                        <div class="resources-share">
                            <?php echo yi_social_share(); ?>
                        </div>
                    </div>



                </div>
            </div>
        </div>
    </div>
</section>