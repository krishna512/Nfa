<?php

//default archive page template card layout

?>

<div class="<?php echo $posttype; ?>-archive">
    <?php
    echo get_archive_page_heading($posttype);
    ?>
    <div class="events-wrapper container pt-[60px] pb-[60px] sm:pb-24">
        <div class="text-center mb-10">
            <h3 class="uppercase mb-1">
                Insights Hub
            </h3>
            <p class="sm:text-xl text-n-400 ">
                Explore a Wealth of Knowledge, Ideas, and Perspectives
            </p>
        </div>


        <div class="grid gap-10 sm:gap-[60px] divide-y divide-grey93">
            <div class="event-card">
                <?php
                if (have_posts()) {
                    ?>

                    <div class="grid sm:grid-cols-2 md:grid-cols-3 gap-6 card-animate-wrapper">
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
                        <p>No Blogs available </p>
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
                        <h3 class="uppercase">
                            Explore Blogs By relevant dates
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