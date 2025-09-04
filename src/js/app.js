jQuery(function ($) {
  /**
   * =================================================
   * Header Scroll
   * =================================================
   */
  // const mainHeader = $('.header');
  // let lastScrollTop = 0;

  // // $(window).on('load scroll', function () {
  // //   const scrollTop = $(window).scrollTop();
  // //   mainHeader.toggleClass('scrolled', scrollTop > 0);

  // //   checkSimpleNavigation(scrollTop);
  // // });

  $(function () {
    const mainHeader = $('.header');
    let scrolling = false;
    let previousTop = 0;
    let lastScrollTop = 0;

    function scrollTrigger() {
      const scrollTop = $(window).scrollTop();

      mainHeader.toggleClass('scrolled', scrollTop > 0);

      checkSimpleNavigation(scrollTop);
    }

    function checkSimpleNavigation(currentTop) {
      const scrollDelta = 1;
      const scrollOffset = 0;
      const isScrollingUp = currentTop < previousTop;

      if (currentTop === 0 || isScrollingUp) {
        // If scrolled to the top, remove translateY transformation
        mainHeader.css({ top: '0', transition: 'all 0.2s ease' });
        mainHeader.addClass('is-hidden');
      } else if (currentTop - previousTop > scrollDelta && currentTop > scrollOffset) {
        mainHeader.css({ top: '-100%', transition: 'all 0.2s ease' });
        mainHeader.removeClass('is-hidden');
      }

      previousTop = currentTop;
    }

    function autoHideHeader() {
      const currentTop = $(window).scrollTop();
      checkSimpleNavigation(currentTop);
      scrolling = false;
    }

    $(window).on('load scroll', function () {
      scrollTrigger();
      if (!scrolling) {
        scrolling = true;
        !window.requestAnimationFrame ? setTimeout(autoHideHeader, 0) : requestAnimationFrame(autoHideHeader);
      }
    });
  });

  // calculate the height of the hero-section

  // $(function () {
  //   let lastScrollTop = 0;

  //   $(window).on(scroll, function () {
  //     let scrollTop = $(this).scrollTop();
  //     if (scrollTop > lastScrollTop) {
  //       // Scrolling down
  //       header.addClass('scrolled').removeClass('');
  //     } else {
  //       // Scrolling up
  //       header.addClass('show').removeClass('hidden');
  //     }
  //     lastScrollTop = scrollTop <= 0 ? 0 : scrollTop;
  //   });
  // });

  // $(function () {
  //   // Check if hero-banner section exists
  //   if ($('#hero-banner').length > 0) {
  //     // Calculate the height of the hero-banner section
  //     const heroBannerHeight = $('#hero-banner').outerHeight();

  //     // Add scroll event listener
  //     $(window).on('scroll', function () {
  //       // Get the current scroll position
  //       const scrollPos = $(this).scrollTop();

  //       // Check if scrolled past the hero-banner section
  //       if (scrollPos > heroBannerHeight) {
  //         $('.header').addClass('scrolled-past-hero');
  //       } else {
  //         $('.header').removeClass('scrolled-past-hero');
  //       }
  //     });
  //   }
  // });

  /**
   * =================================================
   * Header test
   * =================================================
   */
  // const tab = $('.tab-menu__wrapper');

  // $(window).on('resize', function () {
  //   let tabWidth = tab.width();
  //   // tab.css('width', tabWidth + 'px');
  //   if (tabWidth < 768) {
  //     tab.css('overflow-x', 'auto');
  //   } else {
  //     tab.removeClass('responsive');
  //   }
  // });

  // //auto hide header
  // let stickyHeader = $('.header');
  // let tabMenu = $('.tab-menu');
  // let headerHeight = stickyHeader.height();

  // $(window).on('resize', function () {
  //   headerHeight = stickyHeader.height();

  //   if (stickyHeader.hasClass('is-hidden')) {
  //     tabMenu.addClass('sticky-tab').css('top', headerHeight + 'px');
  //   } else {
  //     tabMenu.removeClass('sticky-tab').css('top', '0px');
  //   }
  // });

  // $(window).on('scroll', function () {
  //   if (stickyHeader.hasClass('is-hidden')) {
  //     tabMenu.addClass('sticky-tab').css('top', headerHeight + 'px');
  //   } else {
  //     tabMenu.removeClass('sticky-tab').css('top', '0px');
  //   }
  // });

  $(function () {
    let stickyHeader = $('.header');
    let tabMenu = $('.sticky-menu');
    let headerHeight = stickyHeader.height();

    // Function to handle tab-menu positioning based on header visibility
    function adjustTabMenuPosition() {
      headerHeight = stickyHeader.height();

      if (stickyHeader.hasClass('is-hidden')) {
        tabMenu.addClass('sticky-tab').css('top', headerHeight + 'px');
      } else {
        tabMenu.removeClass('sticky-tab').css('top', '0px');
      }
    }

    // Window resize event
    $(window).on('resize', function () {
      adjustTabMenuPosition();
    });

    // Window scroll event
    $(window).on('scroll', function () {
      adjustTabMenuPosition();
    });

    // Initial positioning of tabMenu based on header visibility
    adjustTabMenuPosition();

    // Scroll event for tab-menu__wrapper
    $('.sticky-menu__wrapper').on('scroll', function () {
      const $tabContainer = $(this);
      const $tabList = $tabContainer.find('.sticky-menu__item');

      // Check if scrolled to the beginning
      if ($tabContainer.scrollLeft() === 0) {
        $tabContainer.removeClass('right-end').addClass('left-end');
      } else {
        $tabContainer.removeClass('left-end');
      }

      // Check if scrolled to the end
      if ($tabContainer.scrollLeft() + $tabContainer.innerWidth() >= $tabContainer[0].scrollWidth) {
        $tabContainer.removeClass('left-end').addClass('right-end');
      } else {
        $tabContainer.removeClass('right-end');
      }
    });
  });

  // $(function () {
  //   $('.tab-menu__wrapper').on('scroll', function () {
  //     const $tabContainer = $(this);
  //     const $tabList = $tabContainer.find('.tab-menu__item');

  //     // Check if scrolled to the beginning
  //     if ($tabContainer.scrollLeft() === 0) {
  //       $tabContainer.removeClass('right-end').addClass('left-end');
  //     } else {
  //       $tabContainer.removeClass('left-end');
  //     }

  //     // Check if scrolled to the end
  //     if ($tabContainer.scrollLeft() + $tabContainer.innerWidth() >= $tabContainer[0].scrollWidth) {
  //       $tabContainer.removeClass('left-end').addClass('right-end');
  //     } else {
  //       $tabContainer.removeClass('right-end');
  //     }
  //   });
  // });

  /**
   * =================================================
   *Header end check
   * =================================================
   */

  /**
   * =================================================
   * Check if there is Hero-banner
   * =================================================
   */

  $(function () {
    if (!$('#hero-banner').length > 0) {
      $('.header').addClass('no-heroSection');
    }
  });

  /**
   * =================================================
   * Search Modal
   * =================================================
   */

  $('body').on('click', '.search__icon--btn, .search-modal__overlay, .close-btn', () => {
    $('.search-modal, #search-modal__overlay').toggleClass('open-search-modal');

    $('#search-modal__overlay').toggleClass('search-modal__overlay');
    $('body').toggleClass('overflow-hidden');
  });

  /**
   * =================================================
   * Hamburger-menu
   * =================================================
   */
  $('#hamburger').on('click', function (e) {
    e.stopPropagation();

    $(this).toggleClass('open');
    $('.hamburger-content').toggleClass('open');
    $('.hamburger-menu').toggleClass('active');
    $('body').toggleClass('no-scroll');
    $('#overlay').toggleClass('overlay');

    $(document).on('keydown.closeNav', function (e) {
      if (e.keyCode === 27) {
        closeNav();
      }
    });
  });

  $('#overlay').on('click', function () {
    closeNav();
  });

  $(document).on('click,closeNav', function (e) {
    if (!$(e.target).closest('.hamburger-content, #hamburger').length > 0) {
      closeNav();
    }
  });

  function closeNav() {
    $('#hamburger').removeClass('open');
    $('.hamburger-content').removeClass('open');
    $('body').removeClass('no-scroll');
    $('#overlay').removeClass('overlay');
    $('.hamburger-menu').removeClass('active');
    $(document).off('closeNav');
  }

  // Nav content toggle
  $('.hamburger-nav__menu .menu-item-has-children').on('click', function () {
    $(this).toggleClass('active');
    $(this).children().next().slideToggle();
  });

  $(window).on('resize', function (e) {
    if ($(window).width() > 1024) {
      if (!$(e.target).closest('.hamburger-content, #hamburger').length > 0) {
        closeNav();
      }
      // closeNav();
    }
  });
  /**
   * =================================================
   *  Resources Homepage Slider
   * =================================================
   */

  $('.resources-slider').slick({
    infinite: true,
    slidesToShow: 3,
    // centerMode: true,
    slidesToScroll: 1,
    swipeToSlide: true,
    // draggable: false,
    autoplay: true,
    speed: 600,
    cssEase: 'ease-in',
    prevArrow: false,
    nextArrow: false,
    dots: true,
    appendDots: '.resources-slider__dots',
    lazyLoad: 'ondemand',

    responsive: [
      {
        breakpoint: 768,
        settings: {
          slidesToShow: 2,
        },
      },

      {
        breakpoint: 640,
        settings: {
          slidesToShow: 1,
        },
      },
    ],
  });

  /**
   * =================================================
   *  partner slider
   * =================================================
   */

  let $partnerSlider = $('.partner-slider');

  $partnerSlider.slick({
    slidesToShow: 3,
    // slidesToScroll: 1,
    infinite: true,
    autoplay: true,
    autoplaySpeed: 2000,
    speed: 500,
    cssEase: 'linear',
    arrows: false,
    variableWidth: true,
    centerMode: true,
    dots: true,
    appendDots: '.partners-slider__dots',
    lazyLoad: 'ondemand',
  });

  /**
   * =================================================
   * Team filter
   * =================================================
   */

  // const tabMenu = $('.tab-menu__item');

  // if (tabMenu.length > 0) {
  //   const teamData = $('.team .team__card');

  //   tabMenu.on('click', function () {
  //     const filterValue = $(this).attr('data-filter');

  //     if (filterValue === 'all') {
  //       teamData.show();
  //     } else {
  //       teamData.hide();
  //       teamData.filter('.' + filterValue).show();
  //     }

  //     $(this).addClass('active').siblings().removeClass('active');
  //   });
  // }

  $(function () {
    const tabMenu = $('.tab-menu__item');
    let teamData = $('.team__card');

    if (tabMenu.length > 0) {
      $('.tab-menu__wrapper').each(function () {
        const filterValue = $(this).children(':first').attr('data-filter');

        teamData.filter('.' + filterValue).show();
        teamData.not('.' + filterValue).hide();

        $(this).children(':first').addClass('active');
      });

      tabMenu.on('click', function () {
        const filterValue = $(this).attr('data-filter');

        teamData.hide();
        // if (filterValue === 'all') {
        //   teamData.show(); // Show all elements if filter is 'all'
        // } else {
        teamData.filter('.' + filterValue).show(); // Show elements that match the filter
        // }

        $(this).addClass('active').siblings().removeClass('active');
      });
    }
  });

  //   const tabMenu = $('.tab-menu__item');
  // const tlTeam = gsap.timeline();

  // if (tabMenu.length > 0) {
  //   const teamData = $('.team .team__card');

  //   tabMenu.on('click', function () {
  //     const filterValue = $(this).attr('data-filter');

  //     if ($(this).hasClass('active')) {
  //       e.preventDefault();
  //     }

  //     if (filterValue === 'all') {
  //       // teamData.show();
  //       gsap.fromTo(
  //         teamData,
  //         {
  //           display: 'none',
  //           opacity: 0,
  //           scale: 0,
  //           duration: 0.3,
  //         },
  //         {
  //           display: 'block',
  //           opacity: 1,
  //           scale: 1,
  //           duration: 0.2,
  //         }
  //       );
  //     } else {
  //       // teamData.hide();
  //       tlTeam.to(
  //         teamData,
  //         // {
  //         //   display: 'block',
  //         //   opacity: 1,
  //         //   scale: 1,
  //         //   duration: 0.2,
  //         //   // ease: 'nonepower1.in',
  //         // },
  //         {
  //           display: 'none',
  //           opacity: 0,
  //           scale: 0,
  //           duration: 0.2,
  //         }
  //       );
  //       // teamData.filter('.' + filterValue).show();
  //       tlTeam.to(
  //         teamData.filter('.' + filterValue),
  //         // {
  //         //   display: 'none',
  //         //   opacity: 0,
  //         //   scale: 0,
  //         // },
  //         {
  //           display: 'block',
  //           opacity: 1,
  //           scale: 1,
  //           duration: 0.2,

  //           // ease: 'nonepower1.in',
  //         }
  //       );
  //     }

  //     // $(this).addClass('active').siblings().removeClass('active');
  //     tabMenu.removeClass('active');
  //     $(this).addClass('active');
  //   });
  // }

  /**
   * =================================================
   * Vacancy filter
   * =================================================
   */

  // const menuTab = $('.opportunity__tab-menu--item');
  // const filterValue = $(this).attr('data-filter');

  // $('.tab-menu__wrapper').each(function () {
  //   $(this).children(':first').toggleClass('active');
  //   teamData.hide();
  //   teamData.filter('.' + filterValue).show();
  // });

  // if (menuTab.length > 0) {
  //   const teamData = $('.opportunity .opportunity__card');

  //   menuTab.on('click', function () {
  //     const filterValue = $(this).attr('data-filter');

  //     // if (filterValue === 'vacancy') {
  //     teamData.hide();
  //     teamData.filter('.' + filterValue).show();
  //     // } else {
  //     //   teamData.hide();
  //     //   teamData.filter('.' + filterValue).show();
  //     // }

  //     $(this).addClass('active').siblings().removeClass('active');
  //   });
  // }

  $(function () {
    const menuTab = $('.opportunity__tab-menu--item');
    const opportunityData = $('.opportunity .opportunity__card');

    if (menuTab.length > 0) {
      $('.tab-menu__wrapper').each(function () {
        const value = $(this).children(':first').attr('data-filter');

        opportunityData.filter('.' + value).show();
        opportunityData.not('.' + value).hide();

        $(this).children(':first').addClass('active');
      });

      menuTab.on('click', function () {
        const value = $(this).attr('data-filter');

        opportunityData.hide();

        opportunityData.filter('.' + value).show(); // Show elements that match the filter

        $(this).addClass('active').siblings().removeClass('active');
      });
    }
  });

  /**
   * =================================================
   * Loader
   * =================================================
   */

  // loader//

  // $(function () {
  //   const animation = bodymovin.loadAnimation({
  //     container: $('#lottie-animation')[0],
  //     renderer: 'svg',
  //     loop: true,
  //     autoplay: true,
  //     path: ' /dist/lottie/logo_animation.json',
  //   });
  // });

  // document.addEventListener('DOMContentLoaded', function() {

  // window.addEventListener('DOMContentLoaded', function () {
  //   const loader = document.querySelector('.loader');
  //   $('body').toggleClass('no-scroll');
  //   //   preloader.style.display = "none";
  //   console.log(loader);
  //   if (loader) {
  //     setTimeout(function () {
  //       $('body').removeClass('no-scroll');
  //       // preloader.style.display = 'none';
  //       loader.remove();
  //     }, 500);
  //   }
  // });

  // $(function () {
  //   const $loader = $('.loader');
  //   $('body').toggleClass('no-scroll');

  //   $(window).on('load', function () {
  //     setTimeout(function () {
  //       $('body').removeClass('no-scroll');
  //       $loader.fadeOut(300, function () {
  //         $(this).remove();
  //       });
  //     }, 500);
  //   });
  // });

  // $(window).on('load', function () {
  // const $loader = $('.loader');
  // $('body').toggleClass('no-scroll');

  // if ($loader.length) {
  //   setTimeout(function () {
  //     $('body').removeClass('no-scroll');
  //     $loader.fadeOut(300, function () {
  //       $(this).remove();
  //     });
  //   }, 500);
  // }
  // });

  // $(window).on('load', function () {
  //   const $loader = $('.loader');
  //   $('body').toggleClass('no-scroll');

  //   setTimeout(function () {
  //     $('body').removeClass('no-scroll');
  //     $loader.fadeOut(300, function () {
  //       $(this).remove();
  //       console.log(this);
  //     });
  //   }, 500);
  // });

  // $(function () {
  //   const menuItems = $('.work-menu .menu-item');
  //   const storageKey = 'currentMenuItem';

  //   // Retrieve the stored current menu item from localStorage
  //   const storedItemPath = localStorage.getItem(storageKey);

  //   menuItems.each(function () {
  //     const itemPath = $(this).find('a').attr('href');
  //     const pathname = window.location.href;

  //     if (pathname === itemPath || storedItemPath === itemPath) {
  //       $(this).addClass('current-menu-item active');
  //     } else {
  //       $(this).removeClass('current-menu-item active');
  //     }

  //     $(this).on('click', function (e) {
  //       // Remove the 'current-menu-item active' class from all menu items
  //       $('.work-menu .menu-item').removeClass('current-menu-item active');

  //       // Check if the clicked URL's pathname matches the current item's URL
  //       if (pathname === itemPath) {
  //         // Add the 'current-menu-item active' class to the clicked menu item
  //         $(this).addClass('current-menu-item active');

  //         // Store the current menu item in localStorage
  //         localStorage.setItem(storageKey, itemPath);
  //       } else {
  //         // Remove the item from localStorage if the clicked URL's pathname doesn't match
  //         localStorage.removeItem(storageKey);
  //       }
  //     });
  //   });
  // });

  // $(function () {
  //   // Attach click event to all 'a' elements inside the document
  //   $(document).on('click', 'a', function () {
  //     // Call the highlightCurrentMenuItem function with the clicked element
  //     highlightCurrentMenuItem($(this));
  //   });

  //   // Call the highlightCurrentMenuItem function on page load
  //   highlightCurrentMenuItem();

  //   function highlightCurrentMenuItem(clickedLink) {
  //     // Get the current URL
  //     let currentURL = window.location.href;

  //     // Remove existing 'current-menu-item' class from all menu items
  //     $('.work-menu .menu-item').removeClass('current-menu-item');

  //     // Add 'current-menu-item' class to the corresponding menu item
  //     let $currentMenuItem;

  //     if (clickedLink) {
  //       // If a link is clicked, use its href attribute
  //       $currentMenuItem = $('.work-menu .menu-item a[href="' + clickedLink.attr('href') + '"]').parent();
  //     } else {
  //       // If not clicked, use the current URL
  //       $currentMenuItem = $('.work-menu .menu-item a[href="' + currentURL + '"]').parent();
  //     }

  //     $currentMenuItem.addClass('current-menu-item');
  //   }
  // });

  /**
   * =================================================
   * Contact-us Float
   * =================================================
   */

  $(document).ready(function () {
    $('.ff-el-input--content').on('focus blur', 'input, textarea', function () {
      const $label = $(this).closest('.ff-el-group').find('.ff-el-input--label');
      $label.toggleClass('float', $(this).is(':focus') || $(this).val().trim() !== '');
    });
  });

  /**
   * =================================================
   * place this placeholder ath bottom of the code
   *
   * @if no bugs this code will appear in console
   * =================================================
   */
  console.log('App Loaded Successfully.');
});

// window.addEventListener('DOMContentLoaded', function () {
//   const loader = document.querySelector('.loader');
//   const body = this.document.getElementsByTagName('body')[0];
//   body.classList.add('no-scroll');
//   //   preloader.style.display = "none";
//   console.log(loader);
//   if (loader) {
//     setTimeout(function () {
//       body.classList.remove('no-scroll');
//       loader.style.display = 'none';
//       // loader.remove();
//     }, 500);
//   }
// });
