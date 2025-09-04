<?php

// get post id and Taxonomy then return the string of all the taxonomy slug associated with post id
function taxoTermsSLug($id, $taxonomy_val)
{
    $termsArray = get_the_terms($id, $taxonomy_val);
    $termsSLug = [];
    if ($termsArray) {
        foreach ($termsArray as $term) {
            $termsSLug[] = $term->slug;
        }
    }

    // print_r($termsSLug);

    $termsSLug = join(' ', $termsSLug);


    return $termsSLug;
}



/**
 * =======================================================
 * Gutenberg Editor Content
 * =======================================================
 */

if (!function_exists('gutenbergEditorContent')) {
    function gutenbergEditorContent()
    {
        ?>

<div class="wp-block-post-content entry-content">
    <?php the_content(); ?>
</div>
<?php
    }
}



/**
 * =========================================================
 * Youtube Video Thumbnail
 * =========================================================
 */
if (!function_exists('acf_youtube_thumbnail')) {
    function acf_youtube_thumbnail($oembed)
    {

        preg_match('/src="(.+?)"/', $oembed, $matches_url);
        $src = $matches_url[1];

        preg_match('/embed(.*?)?feature/', $src, $matches_id);
        $id = $matches_id[1];
        $id = str_replace(str_split('?/'), '', $id);

        return '<img loading="lazy" class ="absolute w-full h-full inset-0 object-cover" src="http://img.youtube.com/vi/' . $id . '/hqdefault.jpg">';
    }
}


/**
 * =========================================================
 * post-category- card
 * =========================================================
 */

function resourcesCard($id, $taxonomies)
{


    $published_date = get_field('published_date', $id) ? esc_html(get_field('published_date')) : '';

    //  $term_category = get_the_terms($id, $taxonomies);
    $upload_file = get_field('upload_file', $id);
    $external_link = get_field('external_link', $id);
    $country = 'country';
    $term_country = get_the_terms($id, $country);

    $id = get_the_ID();
    $permalink = get_the_permalink($id);
    $title = get_the_title($id);
    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
    $excerpt = excerpt();
    $taxonomies = 'resource-category';
    $term_category = get_the_terms($id, $taxonomies);
    ob_start();
    ?>

<div class="border card-animate border-grey93 px-5 py-6 relative rounded-lg overflow-hidden"
    data-id="<?php echo $id; ?>">
    <a href="<?php echo $permalink; ?>" class="group">
        <div class="relative overflow-hidden pt-[104%] rounded-lg">
            <img loading="lazy" src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                class="absolute w-full h-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
        </div>
    </a>

    <div class=" pt-4 sm:pt-6 z-10">
        <div class="tags flex gap-2 flex-wrap mb-3 sm:mb-4">
            <?php if ($term_category) { ?>
            <div class="<?php echo $taxonomies; ?> ">
                <div class="card-tag">
                    <ul class="card-tag-inner flex flex-wrap gap-2">
                        <li class="flex gap-1">
                            <span class="relative top-[6px] sm:top-[5px]  text-sm sm:text-base text-primary-yellow">
                                <?php echo useSvg('send'); ?>
                            </span>

                            <div class="flex flex-wrap">
                                <?php
                                        foreach ($term_category as $category) {
                                            ?>
                                <div class="category-tags">
                                    <a href="<?php echo esc_url(get_term_link($category)) ?>" class=" text-xs
                                        sm:text-sm leading-normal font-medium text-n-400">
                                        <span class="tag" data-category="<?php echo $category->slug; ?>">
                                            <?php echo $category->name; ?>
                                        </span>
                                    </a>
                                </div>
                                <?php
                                        }
                                        ?>

                            </div>
                        </li>
                    </ul>
                </div>

            </div>
            <?php } ?>

            <?php
                if ($term_country) {
                    ?>

            <div class="<?php echo $country; ?> ">
                <div class="card-tag">
                    <ul class="card-tag-inner">

                        <li class="flex gap-1">
                            <span class="relative  top-[6px] sm:top-[5px] text-sm sm:text-base text-primary-yellow">
                                <?php echo useSvg('global'); ?>
                            </span>
                            <div class="flex flex-wrap">
                                <?php
                                        foreach ($term_country as $category) {
                                            ?>
                                <div class="category-tags">
                                    <a href="<?php echo esc_url(get_term_link($category)) ?>"
                                        class=" text-xs sm:text-sm leading-normal font-medium text-n-400">
                                        <span class="tag" data-category="<?php echo $category->slug; ?>">
                                            <?php echo $category->name; ?>
                                        </span>

                                    </a>

                                </div>
                                <?php
                                        }
                                        ?>
                            </div>
                        </li>
                    </ul>
                </div>
            </div>
            <?php } ?>
        </div>



        <div class=" text-base sm:text-lg font-medium line-clamp-2">
            <a href="<?php echo $permalink; ?>">
                <?php echo $title; ?>
            </a>

        </div>

        <div class="flex flex-wrap  mt-4 sm:mt-6">

            <?php if ($external_link): ?>
            <a href="<?php echo $external_link; ?>">
                <button
                    class="flex items-center gap-2 font-medium text-xs sm:text-sm duration-200 ease-linear hover:text-primary-blue">
                    View report
                    <span>
                        <?php echo useSvg('view-icon'); ?>
                    </span>
                </button>
            </a>
            <?php endif; ?>

            <?php if ($external_link && $upload_file): ?>
            <div class="flex items-center mx-2 sm:mx-4 py-[2px] flex-wrap">
                <div class=" border-r h-full border-text-grey ">
                </div>
            </div>
            <?php endif; ?>

            <?php

if( have_rows('upload_file_repeater') ):
$key =0;
    
    while( have_rows('upload_file_repeater') ) : the_row();

        // $file_label = get_sub_field('file_label');
        $file_label = (function_exists('get_sub_field') && $file_label = get_sub_field('file_label')) ? $file_label : 'Download report';
        
        $upload_file = get_sub_field('upload_file'); ?>

            <a href="<?php echo $upload_file; ?>">
                <button
                    class="flex items-center gap-2 font-medium text-xs sm:text-sm duration-200 ease-linear hover:text-primary-blue">

                    <?php echo $file_label; ?>

                    <span>
                        <?php echo useSvg('download'); ?>
                    </span>
                </button>
            </a>
            <?php
            if ($key != array_key_last(get_field('upload_file_repeater'))) {?>

            , &nbsp;

            <?php  
            }
           $key++;
      endwhile;
  endif; ?>
        </div>
    </div>

</div>

<?php
    return ob_get_clean();
}

// Event Cards
function eventCard($id)
{
    $id = get_the_ID();
    $permalink = get_the_permalink();
    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
    $title = get_the_title();
    $excerpt = excerpt();
    $published_date = get_the_date('d M, Y');
    $event_location = get_field('event_location');

    $event_published_date = get_field('event_published_date');
    $event_published_date = ($event_published_date) ? date_format(date_create($event_published_date), "d M, Y") : '';

    $event_end_date = get_field('event_end_date');
    $event_end_dates = ($event_end_date) ? date_format(date_create($event_end_date), "d M, Y") : '';
    $today_date = date('d M, Y');
    $project_status = (strtotime($today_date) > strtotime($event_end_date)) ? date_format(date_create($event_end_date), "d M, Y") : 'Current Event';
    ob_start();
    ?>
<div class="rounded-lg card-animate overflow-hidden flex flex-col" data-id="<?php echo $id; ?>">
    <a href="<?php echo $permalink; ?>" class="group">
        <div class="relative pt-[58%] overflow-hidden">
            <img src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                class="absolute h-full w-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
        </div>
    </a>

    <div class="events-card--content flex-1  py-6 px-4 bg-n-50">

        <div class="flex gap-y-2 gap-x-4 flex-wrap mb-4">
            <div class="flex items-center gap-2">

                <?php if ($event_published_date): ?>
                <span class="text-primary-blue text-lg">
                    <?php echo useSvg('calender') ?>
                </span>
                <?php endif; ?>

                <div class="text-sm text-n-400">
                    <?php echo $event_published_date; ?>
                    <?php if ($event_end_dates): ?>
                    -
                    <?php echo $event_end_dates; ?>
                    <?php endif; ?>

                </div>


            </div>
            <?php if ($event_location): ?>
            <div class="flex items-center gap-2">
                <span class="text-primary-blue text-lg">
                    <?php echo useSvg('location') ?>
                </span>
                <div class="text-sm text-n-400">
                    <?php echo $event_location; ?>
                </div>

            </div>

            <?php endif; ?>
        </div>

        <div class="sm:text-lg text-primary-black font-semibold mb-6">
            <a href="<?php echo $permalink; ?>">
                <?php echo $title; ?>
            </a>

        </div>

        <div>
            <?php
                $options = [
                    'url' => $permalink,
                    'text' => 'View Detail',
                    'icon' => '',

                ];
                echo btn_outline($options); ?>
        </div>

    </div>


</div>


<?php
    return ob_get_clean();

} 

function podcast($id)
{
    $title = get_the_title();
    $permalink = get_permalink();
    $id = get_the_ID();

    $oEmbed = get_field('video_url');

    $image = ($oEmbed) ? acf_youtube_thumbnail($oEmbed) : get_the_post_thumbnail($id, 'large');
    ob_start();
    ?>
<div class="group podcast-card flex flex-col bg-n-50  rounded-lg overflow-hidden transition duration-[0.6s] ease-linear"
    data-id="<?php echo $id; ?>">

    <div class="relative overflow-hidden">
        <a href="<?php echo $permalink; ?>">
            <div class="relative overflow-hidden pt-[52%] ">
                <?php echo $image; ?>

            </div>
        </a>

        <a href="<?php echo $permalink; ?>">
            <div
                class=" cursor-pointer play-btn invisible group-hover:visible opacity-0 group-hover:opacity-100  scale-0 group-hover:scale-100 transition duration-[0.6s] ease-linear absolute top-1/2 left-1/2 -translate-x-1/2 -translate-y-1/2 text-5xl">
                <?php echo useSvg('play-btn'); ?>
            </div>
        </a>

    </div>

    <a href="<?php echo $permalink; ?>" class="sm:text-lg font-semibold p-4 flex-1">

        <?php echo $title; ?>

    </a>

</div>


<?php
    return ob_get_clean();
} 

function blogsCard($id)
{
    $id = get_the_ID();
    $permalink = get_the_permalink();
    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
    $title = get_the_title();

    $published_date = get_the_date('d M, Y');
    ob_start();

    ?>
<div class="rounded-lg overflow-hidden flex flex-col" data-id="<?php echo $id; ?>">
    <a href="<?php echo $permalink; ?>" class="group">
        <div class=" relative pt-[58%] overflow-hidden">
            <img src="<?php echo $feature_img; ?>" alt="<?php echo $title; ?>"
                class="absolute h-full w-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
        </div>
    </a>

    <div class="events-card--content flex-1  py-6 px-4 bg-n-50">

        <div class="flex gap-y-2 gap-x-4 flex-wrap mb-4">
            <div class="flex items-center gap-2">

                <span class="text-primary-blue text-lg">
                    <?php echo useSvg('calender') ?>
                </span>
                <div class="text-sm text-n-400">
                    <?php echo $published_date; ?>
                </div>
            </div>

        </div>

        <div class="sm:text-lg text-primary-black font-semibold mb-6">
            <a href="<?php echo $permalink; ?>">
                <?php echo $title; ?>
            </a>

        </div>

        <div>
            <?php
                $options = [
                    'url' => $permalink,
                    'text' => 'Read blog',
                    'icon' => '',

                ];
                echo btn_outline($options); ?>
        </div>

    </div>


</div>


<?php
    return ob_get_clean();
} 

function noticeCard($id)
{
    $id = get_the_ID();
    $permalink = get_the_permalink();
    $feature_img = (has_post_thumbnail()) ? get_the_post_thumbnail_url() : get_template_directory_uri() . '/dist/images/default_image.jpg';
    $title = get_the_title();

    $published_date = get_the_date('d M, Y');

    ob_start();

    ?>
<div class="rounded-lg overflow-hidden flex flex-col" data-id="<?php echo $id; ?>">
    <!-- <a href="< ?php echo $permalink; ?>" class="group">
        <div class=" relative pt-[58%] overflow-hidden">
            <img src="< ?php echo $feature_img; ?>" alt="< ?php echo $title; ?>"
                class="absolute h-full w-full inset-0 object-cover group-hover:scale-105 transition-all duration-[.4s] ease-in-out">
        </div>
    </a> -->

    <div class="notice-card--content flex-1  py-6 px-4 bg-n-50">

        <div class="flex gap-y-2 gap-x-4 flex-wrap mb-3">
            <div class="flex items-center gap-2">

                <span class="text-primary-blue text-lg">
                    <?php echo useSvg('calender') ?>
                </span>
                <div class="text-sm text-n-400">
                    <?php echo $published_date; ?>
                </div>
            </div>

        </div>

        <div class="sm:text-lg text-primary-black font-semibold mb-6">
            <a href="<?php echo $permalink; ?>">
                <?php echo $title; ?>
            </a>

        </div>

        <div>
            <?php
                $options = [
                    'url' => $permalink,
                    'text' => 'View Detail',
                    'icon' => '',

                ];
                echo btn_outline($options); ?>
        </div>

    </div>


</div>


<?php
    return ob_get_clean();
} 

function editor_content($id = '', $content = '')
{
    $postID = ($id) ? $id : get_the_ID();

    $html = '';
    $html .= '<div class="mce-content-body">';
    $html .= ($content) ? $content : get_the_content($postID);
    $html .= '</div>';

    return $html;
}


// get limit value then retuen post excerpt value of certain limit
function excerpt($limit = 115)
{
    $excerpt = get_the_excerpt();
    if ($excerpt) {
        $excerpt = substr($excerpt, 0, $limit) . '...';
    }
    return $excerpt;
}

// get limit value then retuen post post_title value of certain limit
function post_title_limit($limit = 45)
{
    $post_title = get_the_title();
    if ($post_title) {
        $post_title = substr($post_title, 0, $limit) . '...';
    }
    return $post_title;
}


/**
 * =========================================================
 * Social Share Icons
 * =========================================================
 */
if (!function_exists('yi_social_share')) {
    function yi_social_share()
    {

        $permalink = get_the_permalink();
        $title = get_the_title();
        $facebookURL = 'https://www.facebook.com/sharer/sharer.php?u=' . $permalink;
        $twitterURL = 'https://twitter.com/intent/tweet?via=nationalityforall&text=' . $permalink;
        $linkedinURL = 'https://www.linkedin.com/feed/?shareActive=true&text=' . $permalink;

        ?>
<div class="flex items-center social-share-icon tet-lg sm:text-2xl gap-x-[18px]">
    <a href="javascript:void(0)"
        onclick="window.open('<?php echo $facebookURL; ?>','pop','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,copyhistory=0,width=800,height=' + screen.availHeight + ',left=0,top=0')"
        ;="" rel="noreferrer nofollow noopener" class="facebook-icon bg-n-50 rounded-full p-3 hover:bg-primary-yellow">
        <?php echo useSvg('facebook'); ?>
    </a>
    <a href="javascript:void(0)"
        onclick="window.open('<?php echo $twitterURL; ?>','pop','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,copyhistory=0,width=800,height=' + screen.availHeight + ',left=0,top=0')"
        ;="" rel="noreferrer nofollow noopener" class="twitter-icon bg-n-50 rounded-full p-3 hover:bg-primary-yellow">
        <?php echo useSvg('twitter'); ?>
    </a>

    <a href="javascript:void(0)"
        onclick="window.open('<?php echo $linkedinURL; ?>','pop','toolbar=0,location=0,directories=0,status=0,menubar=0,scrollbars=1,resizable=0,copyhistory=0,width=800,height=' + screen.availHeight + ',left=0,top=0')"
        ;="" rel="noreferrer nofollow noopener" class="twitter-icon bg-n-50 rounded-full p-3 hover:bg-primary-yellow">
        <?php echo useSvg('linkedin'); ?>
    </a>

</div>

<script>
function unsecuredCopyToClipboard(e) {
    e.preventDefault();

    const textArea = document.createElement("textarea");

    textArea.value = '<?php echo $permalink; ?>';

    var copyurl = document.getElementById("copyurl");

    copyurl.appendChild(textArea);

    textArea.focus();

    textArea.select();

    try {

        document.execCommand('copy');

    } catch (err) {

        alert('Unable to copy to clipboard');

    }

    copyurl.removeChild(textArea);

    // Alert the copied text
    alert("Link Copied");
}
</script>
<?php
    }
}

// photo credit 
function photo_credit_section($photo_credit)
{
    ob_start();
    ?>

<div class="photo-credit absolute bottom-3 right-3 text-white p-2 text-xs z-[40] font-medium italic opacity-70">
    <div class="flex items-center">
        <?php if ($photo_credit): ?>
        <span> &copy; </span>
        <?php endif; ?>
        <span>
            <?php echo $photo_credit; ?>
        </span>
    </div>
</div>



<?php

    $content = ob_get_contents();
    ob_end_clean();
    return $content;

}

/**
 * =========================================================
 * get heading and sub-heading for archive pages.
 * =========================================================
 */

function get_archive_page_heading($posttype)
{
    if (is_tax()) {
        $queried_object = get_queried_object();
        $pageIdentify = $queried_object;
    } else {
        $pageIdentify = $posttype . '_options';
    }


    // header-info
    $background_image = (function_exists('get_field') && $background_image = get_field('background_image', $pageIdentify)) ? $background_image : '';

    ob_start();

    echo heroContent($background_image);

    $archive_page_heading = ob_get_contents();

    ob_end_clean();

    return $archive_page_heading;
}

/**
 * =========================================================
 * Hero-content
 * =========================================================
 */

function heroContent($imageId = '')
{

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

        $sub_heading = (function_exists('get_field') && $sub_heading = get_field('sub_heading', $pageIdentify)) ? $sub_heading : '';

    } else {

        $heading = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';

        $sub_heading = (function_exists('get_field') && $sub_heading = get_field('sub_heading')) ? $sub_heading : '';
        $photo_credit = (function_exists('get_field') && $photo_credit = get_field('photo_credit')) ? $photo_credit : '';
    }

    $title = ($heading) ? $heading : get_the_title();

    if (!$imageId)
        $imageId = (function_exists('get_field') && $fearure_image = get_field('featured_image')) ? $fearure_image : '';

    ob_start();
    ?>
<div id="hero-banner"
    class=" hero__banner relative flex min-h-[430px] pt-20 pb-8 md:pt-32 md:pb-20 overflow-hidden hero-content">
    <?php if ($imageId) {
            echo wp_get_attachment_image($imageId, "full", false, array("class" => "absolute inset-0 w-full h-full object-cover"));
        }
        echo photo_credit_section($photo_credit);

        ?>
    <div class="container relative z-10 mt-auto hero__banner--content">
        <div class="text-white">
            <div class=" grid gap-2 sm:gap-4 relative z-10 max-w-xl">
                <h1 class="">
                    <?php echo $title; ?>
                </h1>
                <?php if ($sub_heading) { ?>
                <p class=" text-base sm:text-xl md:pr-7">
                    <?php echo $sub_heading; ?>
                </p>
                <?php } ?>
            </div>

        </div>

    </div>

</div>
<?php
    return ob_get_clean();
}
function taxnomycontent()
{

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

       $title = (function_exists('get_field') && $title = get_field('title', $pageIdentify)) ? $title : $label;
       $sub_title = (function_exists('get_field') && $sub_title = get_field('sub_title', $pageIdentify)) ? $sub_title : '';

    }

   
    ob_start();
    ?>
<div class="text-center mb-8 sm:mb-[60px]">
    <h3 class="uppercase sm:mb-1">
        <?php echo $title; ?>
    </h3>
    <p class="sm:text-xl text-n-400 ">
        <?php echo $sub_title; ?>
    </p>
</div>
<?php
    return ob_get_clean();
}

function prefix_post_register_template($content) {
    global $post;

    // Ensure $post is an object before accessing properties
    if (!is_object($post) || !isset($post->post_type)) {
        return $content; // Return default content if $post is not valid
    }

    // Check if it's a page
    if ($post->post_type === 'page') {
        $content = '<!-- wp:acf/static-page-header {"name":"acf/static-page-header","data":{"field_64479912715b0":"","field_6447996cd4600":"","field_6447999b983dc":"","field_6447991275019":"1"},"align":"full","mode":"preview"} /-->';
    }

    return $content;
}
add_filter('default_content', 'prefix_post_register_template', 10, 1);
