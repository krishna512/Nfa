<?php

/**
 * 
 * event post type archive template
 *   
 */

$event_type = (get_query_var('type')) ?: "upcoming";

?>

<div class="<?php echo $posttype; ?>-archive">
    <?php
    echo get_archive_page_heading($posttype);
    ?>
    <div class="events-wrapper container pt-[60px] pb-[60px] sm:pb-24">

        <div class="tab-menu sticky-menu">
            <ul class="flex  gap-3 tab-menu__wrapper sticky-menu__item border-b-2 border-primary-blue mb-[60px] overflow-x-auto">
                <li class="event-tab-menu__item sticky-menu__item cursor-pointer tablinks shrink-0 <?php echo ($event_type === 'upcoming') ? 'active' : ''; ?> " onclick="eventTab(event, 'upcoming-events')">
                    Upcoming events
                </li>
                <li class="event-tab-menu__item cursor-pointer sticky-menu__item tablinks shrink-0 <?php echo ($event_type === 'past') ? 'active' : ''; ?> " onclick="eventTab(event, 'past-events')">
                    Past events
                </li>
            </ul>
        </div>
        <?php
        include('parts/upcoming_events.php');
        include('parts/past_events.php');
        ?>
    </div>
</div>
<script>
    function eventTab(evt, eventName) {
        // Remove the "active" class from all tabs
        let tabs = document.getElementsByClassName("event-tab-menu__item");
        for (let i = 0; i < tabs.length; i++) {
            tabs[i].classList.remove("active");
        }

        // Add the "active" class to the clicked tab
        evt.currentTarget.classList.add("active");

        // Show/hide content based on the clicked tab
        document.getElementById("past-events").style.display = (eventName === 'past-events') ? 'block' : 'none';
        document.getElementById("upcoming-events").style.display = (eventName === 'upcoming-events') ? 'block' : 'none';

        // chang url when click
        if (eventName === 'past-events') {
            var page_number = document.querySelector('#past-events .pagination .current');
            if (page_number) {
                page_number = page_number.textContent;
                if (page_number > 1) {
                    page_number = '/page/' + page_number;
                } else {
                    page_number = '';
                }
            } else {
                page_number = '';
            }
            window.history.replaceState("", "url", '/events/past' + page_number);
        }
        if (eventName === 'upcoming-events') {
            var page_number = document.querySelector('#upcoming-events .pagination .current');
            if (page_number) {
                page_number = page_number.textContent;
                if (page_number > 1) {
                    page_number = '/page/' + page_number;
                } else {
                    page_number = '';
                }
            } else {
                page_number = '';
            }
            window.history.replaceState("", "url", '/events/upcoming' + page_number);
        }
    }
</script>