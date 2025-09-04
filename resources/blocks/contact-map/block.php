<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}


$map = (function_exists('get_field') && $map = get_field('map')) ? $map : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?>">
        <div class="contact-us-map container pb-[60px]  md:pb-24">
            <div class="relative overflow-hidden rounded-lg pt-[55%] sm:pt-[32%]">
                <iframe src="<?php echo $map; ?>" class="w-full h-full absolute inset-0 object-cover"></iframe>
            </div>
        </div>
    </section>

<?php endif;