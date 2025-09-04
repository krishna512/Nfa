<?php
// $bannerImageID = (has_post_thumbnail()) ? get_post_thumbnail_id() : '';

// if (!$bannerImageID) {
// get archive image as default
$title = get_the_title();

$designation = get_field('designation');
$pageIdentify = $posttype . '_options';
$bannerImageID = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';
// }
$photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';
$id = get_the_ID();
$title = get_the_title();

$designation = get_field('designation');
$linkedin = get_field('linkedin');
$email = get_field('e-mail'); ?>

<section <?php echo $posttype ?>>
    <div id="hero-banner"
        class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">
        <?php if ($bannerImageID) {
            echo wp_get_attachment_image($bannerImageID, "full", false, array("class" => "absolute inset-0 w-full h-full object-cover"));
        } ?>

        <?php echo photo_credit_section($photo_credit); ?>
        <div class="container relative z-10 mt-auto hero__banner--content">
            <div class="text-white">
                <div class=" grid gap-6 relative z-10 max-w-xl">
                    <div class=" grid gap-4">
                        <h2 class=" font-bigShouldersDisplay font-bold">
                            <?php the_title(); ?>
                        </h2>

                        <p class=" text-sm md:pr-7">
                            <?php echo $designation; ?>
                        </p>
                    </div>

                    <p>
                        <a href="/team" class="flex gap-2 items-center">
                            <span class="text-base">
                                <?php echo useSvg('left-arrow'); ?>
                            </span>
                            Back to Teams
                        </a>
                    </p>
                </div>



            </div>

        </div>

    </div>



    <div class="approach-container">

        <div class="pt-[60px] pb-[60px] sm:pb-24 grid md:flex gap-6">
            <div class=" grid md:basis-1/2">
                <div class="">
                    <div class="relative rounded-lg overflow-hidden pt-[98%]">
                        <?php if (has_post_thumbnail($id)) {
                            $class = "absolute inset-0 h-full w-full object-cover ";
                            echo get_the_post_thumbnail($id, 'medium', array('class' => $class));
                        }

                        ?>
                    </div>
                </div>
            </div>

            <div class="md:basis-1/2">

                <?php if ($email || $linkedin): ?>
                    <div class="mb-3 sm:mb-5 grid gap-1">
                        <div>
                            <span class="text-sm grid gap-2">
                                <?php if ($email): ?>
                                    <a href="mailto:<?php echo $email; ?>" class="flex gap-1 items-center ">
                                        <span class="inline-flex text-lg text-current">
                                            <?php echo useSvg('email'); ?>
                                        </span>
                                        <?php echo $email; ?>
                                    </a>
                                <?php endif; ?>
                                <?php if ($linkedin): ?>
                                    <a href="<?php echo $linkedin; ?>">
                                        <span class="bg-[#0077b5] inline-flex p-1 text-white rounded-sm">
                                            <?php echo useSvg('linkedin'); ?>
                                    </a>
                                </span>
                            <?php endif; ?>

                            </span>

                        </div>
                    </div>
                <?php endif; ?>

                <div class="text-n-400 team-paragraph">
                    <?php the_content(); ?>
                </div>
            </div>

        </div>
    </div>
</section>