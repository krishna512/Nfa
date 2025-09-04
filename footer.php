<footer class="bg-b-900 footer">
    <div class="container text-text-grey">
        <?php

        //footer menu
        $updateLinksPages = (function_exists('get_field') && $updateLinksPages = get_field('footer_menu', 'option')) ? $updateLinksPages : '';
        $updateMenus = ($updateLinksPages) ? wp_get_nav_menu_items($updateLinksPages) : [];

        //social media
        $scialmedia = (function_exists('get_field') && $socialmedia = get_field('social_media', 'option')) ? $socialmedia : '';

        $footer_logo = (function_exists('get_field') && $footer_logo = get_field('footer_logo', 'option')) ? $footer_logo : '';
        $footer_content = (function_exists('get_field') && $footer_content = get_field('footer_content', 'option')) ? $footer_content : '';


        $copyright = (function_exists('get_field') && $copyright = get_field('copyright_text', 'option')) ? $copyright : '&copy {year} Nationality for All. All rights reserved';
        $currentYear = date('Y');
        // var_dump($currentYear);
        $copyright_text = str_replace(
            array(
                '{year}'
            ),
            array(
                $currentYear
            ),
            $copyright
        );
        // var_dump($copyright_text);

        $terms_and_condition = (function_exists('get_field') && $terms_and_condition = get_field('terms_and_condition', 'option')) ? $terms_and_condition : '';

        $privacy_policy = (function_exists('get_field') && $privacy_policy = get_field('privacy_policy', 'option')) ? $privacy_policy : '';
        $cookies_policy = (function_exists('get_field') && $cookies_policy = get_field('cookies_policy', 'option')) ? $cookies_policy : '';



        ?>

        <div>
            <div class=" max-sm:pb-8 max-sm:pt-10 sm:py-16 flex justify-between gap-8 sm:gap-6 flex-wrap">
                <div class="max-w-[391px]">
                    <?php if ($footer_logo) { ?>
                    <div class="footer__logo max-sm:max-w-[194px] mb-6">
                        <a href="<?php echo site_url(); ?>">

                            <img loading="lazy" src="<?php echo $footer_logo; ?>" class="" />
                        </a>
                    </div>
                    <?php } ?>
                    <div class="mb-8 text-xs">
                        <p>
                            <?php echo $footer_content; ?>
                        </p>
                    </div>

                    <div class=" footer__social-media flex text-[18px] items-center gap-x-2">


                        <?php $sitesocials = (function_exists('get_field') && $sitesocial = get_field('site_social_media', 'option')) ? $sitesocial : [];
                        ?>

                        <?php if ($sitesocials): ?>

                        <?php foreach ($sitesocials as $sitesocial) {
                                $socialName = $sitesocial['social_media_name'];
                                $url = $sitesocial['social_media_url'];
                                ?>
                        <div class="<?php echo $socialName; ?> footer__social-icons">
                            <a href="<?php echo $url; ?>" target="_blank" rel="">
                                <?php echo useSvg($socialName); ?>



                            </a>

                        </div>
                        <?php } ?>

                        <?php endif; ?>


                    </div>
                </div>

                <div class="footer__nav flex flex-col sm:flex-row gap-6  gap-x-20">
                    <div class="footer__nav--items">
                        <p class="footer__link--title">About</p>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-about-menu',
                                'menu_id' => 'primary-menu',
                                'menu_class' => ' grid gap-y-2 text-xs ',
                            )
                        );

                        ?>

                    </div>
                    <div class="footer__nav--items">
                        <p class="footer__link--title">Resources</p>
                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-resources-menu',
                                'menu_id' => 'primary-menu',
                                'menu_class' => 'grid gap-y-2 text-xs  ',
                            )
                        );

                        ?>
                    </div>
                    <div class="footer__nav--items">
                        <p class="footer__link--title">Works</p>

                        <?php
                        wp_nav_menu(
                            array(
                                'theme_location' => 'footer-works-menu',
                                'menu_id' => 'primary-menu',
                                'menu_class' => ' grid gap-y-2 text-xs ',
                            )
                        );

                        ?>
                    </div>

                </div>
            </div>

            <div
                class=" footer__bottom py-8 flex flex-col sm:flex-row gap-6 justify-center sm:justify-between text-center items-center gap-x-4 text-xs">
                <?php echo $copyright_text; ?>


                <div class="">
                    <div class="flex gap-3 sm:gap-x-4 mb-4 sm:mb-0">
                        <?php if($privacy_policy):?>

                        <div class="footer__bottom--item cursor-pointer">
                            <?php echo $privacy_policy; ?>

                        </div>
                        <?php endif;
                        
                        if($cookies_policy): ?>
                        <div class="footer__bottom--item cursor-pointer">
                            <?php echo $cookies_policy; ?>

                        </div>
                        <?php endif; 
                        if($terms_and_condition):
                        ?>

                        <div class="footer__bottom--item cursor-pointer">
                            <?php echo $terms_and_condition; ?>

                        </div>
                        <?php endif; ?>
                    </div>
                </div>
            </div>

        </div>

        <!-- <div class="back-to-top-btn">
            <a onClick="document.querySelector('body').scrollIntoView();">
                <div class="back-to-top-btn__inner">
                    <p>Back to top</p>
                    <?php echo useSvg('up-icon') ?>
                </div>
            </a>
        </div> -->
</footer>
</div><!-- #page from header.php -->
<?php wp_footer(); ?>
</body>

</html>