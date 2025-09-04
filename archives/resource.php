<?php

/**==============================
 * Current term object
 ================================*/
$queried_object = get_queried_object();
$post_type = ($queried_object) ? $queried_object->name : "post";
$post_type_name = ($post_type && $post_type != "resource") ? $post_type : "resource";
$taxonomies = get_taxonomies();

$_GET_country = (isset($_GET["search_country"])) ? $_GET["search_country"] : '';
$_GET_search_resource = (isset($_GET["search_resource"])) ? $_GET["search_resource"] : '';
if (is_tax()) {
    $queried_object = get_queried_object();
    $_GET_category = $queried_object->slug;
} else {
    $_GET_category = (isset($_GET["resource_category"])) ? $_GET["resource_category"] : '';
} ?>


<div class="<?php echo $posttype; ?>-archive">
    <?php
    echo get_archive_page_heading($post_type);
    ?>
    <div class="container py-[60px] sm:pt-16 sm:pb-20  md:pb-24">
        <div class="text-center mb-8 sm:mb-10">
            <h3 class="uppercase">
                Empowering You with Knowledge
            </h3>
            <p class="sm:text-xl text-n-400 ">
                Resourceful Solutions
            </p>
        </div>
        <div class="resources__search pb-10 sm:pb-12">
            <!-- Search And Filter -->
            <form action="<?php echo home_url() . '/resource'; ?>" class=" relative max-w-[1096px] mx-auto">
                <div class="flex gap-5 max-[1024px]:flex-wrap  resources_search-wrapper items-center justify-center">

                    <!-- <div class="search-icon-container">
                        < ?php echo useSvg('search') ?>
                    </div> -->


                    <input type="text" placeholder="Search By Title" name="search_resource"
                        class="search-form-input flex-1 basis-full  md:basis-[42%] p-3"
                        value="<?php echo $_GET_search_resource; ?>">


                    <select name="search_country" id="country" class="country-select basis-1/2  md:basis-[19%]">

                        <option value=''>Select Country</option>
                        <?php
                        $country_terms = get_terms(['taxonomy' => 'country']);
                        foreach ($country_terms as $key => $country) {
                            ?>
                        <option value="<?php echo $country->slug; ?>"
                            <?php echo ($_GET_country == $country->slug) ? 'selected' : ''; ?>>
                            <?php echo $country->name; ?>
                        </option>
                        <?php
                        }
                        ?>
                    </select>
                    <select name="resource_category" id="categories" class="resources-select basis-1/2  md:basis-[19%]">
                        <option value="">Category</option>
                        <?php
                        $category_data_terms = get_terms(['taxonomy' => 'resource-category']);
                        foreach ($category_data_terms as $key => $category) {
                            ?>
                        <option value="<?php echo $category->slug; ?>"
                            <?php echo ($_GET_category == $category->slug) ? 'selected' : ''; ?>>
                            <?php echo $category->name; ?>
                        </option>
                        <?php
                        }
                        ?>

                    </select>


                    <div class="max-md:basis-full inline-flex justify-center">
                        <button type="submit" class="btn-search group/item">
                            <div class="relative z-10 inline-flex">
                                Search
                            </div>
                            <div class="wave z-[-5] absolute w-[262px] h-[83px] top-full left-[-7px] translate-y-0 duration-[.4s] transition ease-linear group-hover/item:-translate-y-full group-hover/item:ease-linear
            ">
                                <?php echo useSvg('dark-btn-wave'); ?>
                            </div>

                        </button>
                    </div>

                </div>

            </form>

        </div>
        <?php
        if (have_posts()) {
            ?>
        <div
            class="<?php echo $posttype; ?> pt-12 border-t gap-6 border-grey93 grid sm:grid-cols-2 md:grid-cols-3 card-animate-wrapper ">

            <?php
                while (have_posts()) {
                    the_post();
                    $id = get_the_ID();

                    echo resourcesCard($id, $taxonomies);
                }

                ?>
        </div>
        <?php
        } else {
            ?>
        <div class="no-result pt-[60px]  sm:pt-20 border-t gap-6  border-grey93 grid place-items-center">
            <div class=" text-7xl sm:text-[116px]">
                <?php echo useSvg("no-result-found"); ?>
            </div>
            <div class="text-center">
                <h3 class="uppercase">No Results Found </h3>
                <p class="sm:text-xl text-n-400">Sorry, seems like there is no data available at the moment. </p>
            </div>
        </div>
        <?php
        }
        // echo main_query_pagination();
        ?>

        <?php if (main_query_pagination()) { ?>

        <div class=" pt-8 md:pt-[60px]">

            <?php echo main_query_pagination(); ?>

        </div>

        <?php } ?>
    </div>
</div>