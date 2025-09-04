<?php
echo get_archive_page_heading($posttype);
$taxonomies = get_taxonomies();
?>
<div class="container py-[60px] sm:py-16">
    <div class="paragraph wp-block-post-content entry-content mb-6">

        <p class="sm:text-xl text-n-400 ">
            NFA was formed as a partnership based organization to have a targeted approach to addressing statelessness
            and to strengthen organizations that are led by persons with lived and learned experiences of statelessness.
            NFA identified four partners after a rigorous mapping of all the stakeholders working on statelessness in
            the region and after meeting with more than 30 organizations. Partners were chosen based on their alignment
            of values with NFA and the need experienced by our partners for NFA to fulfill. Three of the four
            organizations are led by affected persons and one of them is led by a person with learned experience of
            statelessness, who work closely with affected persons.
        </p>
    </div>
    <!-- <div class="text-center mb-6">
        <h2 class="uppercase mb-1">
            Synergizing for Impact
        </h2>
        <p class="sm:text-xl text-n-400 ">
            Empowering Change Through Collaborative Partnerships
        </p>
    </div> -->
    <div class="pb-9 sm:pb-14 max-w-[817px] m-auto">
        <div class="partner-slider grid grid-cols-2  sm:grid-cols-4 justify-center items-end gap-4 ">
            <?php
            while (have_posts()) {
                the_post();
                $id = get_the_ID();
                $title = get_the_title();
                // $taxoTermsSLug = taxoTermsSLug($id, $taxonomies);
                $website_link = get_field('website_link');

                if ($website_link) {
                    $linkStart = '<a href="' . $website_link . '" target="_blank">';
                    $linkEnd = '</a>';
                } else {
                    $linkStart = '';
                    $linkEnd = '';
                }
                ?>
            <div class="h-full grid" data-id="<?php echo $id; ?>">

                <div class="relative  overflow-hidden border rounded-lg border-grey93">
                    <!-- pt-[65%] -->
                    <?php

                        echo $linkStart;

                        if (has_post_thumbnail($id)) {
                            $class = "inset-0 w-full h-full max-h-[120px]  object-contain p-4 aspect-square";

                            echo get_the_post_thumbnail($id, 'medium', array('class' => $class));
                        }

                        ?>
                    <?php echo $linkEnd; ?>
                </div>

            </div>
            <?php
            }
            ?>


        </div>

        <div class="partners-slider__navigation">
            <div class="partners-slider__dots"></div>
        </div>
    </div>

    <div class="relative">
        <div class="flex inset-0 items-center absolute">
            <div class=" border-t w-full border-text-grey ">
            </div>
        </div>

        <div class="flex relative justify-center">
            <span class=" text-5xl sm:text-[56px]">
                <?php echo useSvg('partner-icon'); ?>
            </span>
        </div>

    </div>


    <div class="pt-10 sm:pt-[60px] grid gap-10">
        <?php
        while (have_posts()) {
            the_post();
            $id = get_the_ID();
            $title = get_the_title();
            $website_link = get_field('website_link');

            if ($website_link) {
                $linkStart = '<a href="' . $website_link . '" target="_blank">';
                $linkEnd = '</a>';
            } else {
                $linkStart = '';
                $linkEnd = '';
            }
            ?>
        <div class="grid lg:grid-cols-12 items-center" data-id="<?php echo $id; ?>">
            <div class="lg:col-span-4 max-lg:px-8 group">
                <div class=" bg-white relative overflow-hidden  pt-[60%] border border-grey93 rounded-lg">
                    <?php

                        echo $linkStart;

                        if (has_post_thumbnail($id)) {
                            $class = "p-6  absolute h-full w-full inset-0 object-contain p-16 group-hover:scale-105 transition-all duration-[.4s] ease-in-out";
                            echo get_the_post_thumbnail($id, 'medium', array('class' => $class));
                        }

                        ?>
                    <?php echo $linkEnd; ?>
                </div>
            </div>
            <div class="lg:col-span-7 max-lg:mt-[-16px]  lg:ml-[-26px] bg-n-50 rounded-lg overflow-hidden">
                <div class=" py-9 px-6  sm:py-10 sm:px-[50px] ">
                    <h4 class="text-2xl uppercase mb-2">
                        <?php echo $title; ?>
                    </h4>

                    <div class="text-n-400">
                        <?php echo the_content(); ?>
                    </div>

                    <?php 
                        if($website_link):
                        echo $linkStart; 
                        
                        ?>
                    <div class="mt-3 text-sm animate-cursor ">
                        <p class="inline-flex gap-1 items-center text-primary-blue hover:underline font-medium">Visit
                            Website
                            <span class="text-xs arrow-move">
                                <?php echo useSvg('long-arrow'); ?>
                            </span>
                        </p>

                    </div>
                    <?php 
                        endif;
                        echo $linkEnd; ?>

                </div>
            </div>
        </div>
        <?php
        }
        ?>


    </div>
</div>