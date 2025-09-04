<?php
$id = '' . $block['id'];
$className = '';

if (!empty($block['className'])) {
    $className .= ' ' . $block['className'];
}
if (!empty($block['align'])) {
    $className .= ' align' . $block['align'];
}

$heading = (function_exists('get_field') && $heading = get_field('heading')) ? $heading : '';
$contact_form_shortcode = (function_exists('get_field') && $contact_form_shortcode = get_field('contact_form_shortcode')) ? $contact_form_shortcode : '';
$address_heading = (function_exists('get_field') && $address_heading = get_field('address_heading')) ? $address_heading : '';
$background_image = (function_exists('get_field') && $background_image = get_field('background_image')) ? $background_image : '';
$email = (function_exists('get_field') && $email = get_field('email')) ? $email : '';
$address = (function_exists('get_field') && $address = get_field('address')) ? $address : '';
$phone_number = (function_exists('get_field') && $phone_number = get_field('phone_number')) ? $phone_number : '';

$showhide = (function_exists('get_field') && $showhide = get_field('show_hide_block')) ? $showhide : '0';



?>
<?php if ($showhide): ?>
    <section id="<?php echo $id; ?>" class="<?php echo esc_attr($className); ?> contact-us">
        <div class="container py-[60px]">
            <div class="grid lg:grid-cols-12 gap-6">
                <div class="contact-us__form lg:col-span-7 bg-n-50 p-6 sm:pt-12 sm:px-12 sm:pb-[72px] rounded-lg">

                    <h3 class="uppercase mb-7">
                        <?php echo $heading; ?>
                    </h3>
                    <?php echo $contact_form_shortcode; ?>

                </div>
                <div class="lg:col-span-5 relative overflow-hidden rounded-lg">
                    <img loading="lazy" src="<?php echo $background_image; ?>"
                        class="absolute h-full w-full inset-0 object-cover">
                    <div class="contact-us-overlay"> </div>
                    <div class=" relative z-10 text-white p-6 sm:pt-12 sm:px-12 sm:pb-14">
                        <h3 class="uppercase mb-4 sm:mb-6  md:mb-12">
                            <?php echo $address_heading; ?>
                        </h3>
                        <div class="grid gap-y-4 sm:gap-y-6 md:gap-y-9 pb-6 sm:pb-10 contact-info">
                            <?php if ($email): ?>
                                <div class="email flex gap-4 items-start">
                                    <span class="contact-icons">
                                        <?php echo useSvg('envelope'); ?>
                                    </span>
                                    <div>
                                        <div class="text-sm sm:text-base">Email</div>
                                        <div class=" sm:text-lg font-medium">
                                            <a href="mailto: <?php echo $email; ?>">
                                                <?php echo $email; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($address): ?>
                                <div class="address inline-flex gap-4 items-start">
                                    <span class="contact-icons">
                                        <?php echo useSvg('contact-location'); ?>
                                    </span>
                                    <div>
                                        <div class="text-sm sm:text-base">Our location</div>
                                        <div class="sm:text-lg font-medium">
                                            <?php echo $address; ?>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                            <?php if ($phone_number): ?>
                                <div class="phone flex gap-4 items-start">
                                    <span class="contact-icons">
                                        <?php echo useSvg('phone'); ?>
                                    </span>
                                    <div>
                                        <div class="text-sm sm:text-base">Phone Number</div>
                                        <div class=" sm:text-lg font-medium">
                                            <a href="tel: <?php echo $phone_number; ?>">
                                                <?php echo $phone_number; ?>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            <?php endif; ?>
                        </div>


                        <div
                            class=" pt-6 sm:pt-8 social-media flex justify-center items-center gap-x-[18px] text-lg sm:text-2xl">
                            <?php $sitesocials = (function_exists('get_field') && $sitesocial = get_field('site_social_media', 'option')) ? $sitesocial : [];
                            ?>

                            <?php if ($sitesocials): ?>

                                <?php foreach ($sitesocials as $sitesocial) {
                                    $socialName = $sitesocial['social_media_name'];
                                    $url = $sitesocial['social_media_url'];
                                    ?>
                                    <div class="<?php echo $socialName; ?> social-icons text-primary-black">
                                        <a href="<?php echo $url; ?>" target="_blank" rel="">
                                            <?php echo useSvg($socialName); ?>
                                        </a>
                                    </div>
                                <?php } ?>

                            <?php endif; ?>


                        </div>
                    </div>
                </div>
            </div>
        </div>
    </section>

<?php endif;