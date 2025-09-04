<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$image = (function_exists('get_field') && $image = get_field('image')) ? $image : '';
$title = (function_exists('get_field') && $title = get_field('title')) ? $title : '';

$sub_title = (function_exists('get_field') && $sub_title = get_field('sub_title')) ? $sub_title : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> block-card custom-animate-wrapper">
        <div class="container pt-[60px] pb-[60px] md:pb-[136px]">
            <div class="grid md:flex  items-center custom-card-animate ">
                <div class="block-card__image relative overflow-hidden md:basis-[40%] rounded-lg animate-image">
                    <div class="relative overflow-hidden pt-[99%] ">
                        <img loading="lazy" src="<?php echo $image; ?>"
                            class=" absolute w-full h-full inset-0 object-cover">
                        <!-- aspect-[502/495] -->
                    </div>
                </div>

                <div class="block-card__content md:basis-[60%] bg-n-50 ">
                    <div class="max-w-[607px] grid gap-3 px-6  md:px-9 py-10 md:pt-12 md:pb-[72px]">
                        <h3 class="leading-[1.2]">
                            <?php echo $title; ?>
                        </h3>
                        <p class="max-sm:text-sm text-n-400">
                            <?php echo $sub_title; ?>
                        </p>
                    </div>
                </div>

            </div>
        </div>
    </section>


<?php endif; ?>