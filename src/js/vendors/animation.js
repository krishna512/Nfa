// import { gsap } from 'gsap';

// import ScrollTrigger from 'gsap/ScrollTrigger';
// gsap.registerPlugin(ScrollTrigger);

jQuery(function ($) {
  gsap.registerPlugin(ScrollTrigger);

  // /**
  //  * =================================================
  //  * Homepage Hero-Section
  //  * =================================================
  //  */

  if ($('.hero__banner')[0]) {
    const hero_tl = gsap.timeline();
    hero_tl.fromTo(
      '.hero__banner--image img, .hero__banner > img ',
      {
        scale: 1,
      },
      {
        scale: 1.09,
        duration: 4.5,
        ease: 'power2.out',
      }
    );

    // gsap.to(
    //   '.hero-mask',

    //   {
    //     scale: 1.02,
    //     duration: 6,
    //     ease: 'bounce',
    //   }
    // );
    // check
    // Wrap each word within span elements for the text content of h1 and remove unnecessary spaces
    const heroContentElements = $('.hero__banner--content h1, .hero__banner--content p');
    if (heroContentElements[0]) {
      const heroContent_tl = gsap.timeline();
      heroContentElements
        .contents()
        .filter(function () {
          return this.nodeType === Node.TEXT_NODE && $.trim(this.nodeValue) !== '';
        })
        .each(function () {
          let cleanedText = this.nodeValue.replace(/\s+/g, ' '); // Replace multiple spaces with a single space
          let words = cleanedText.trim().split(' '); // Split by single spaces
          let newContent = words
            .map((word) => `<span class="word" style="display: inline-block; opacity: 0;">${word}</span>`)
            .join(' ');
          $(this).replaceWith(newContent);
        });
      // Add space between existing span elements within h1
      $('h1').find('span').after(' ');
      // Wrap each span element within span elements with the word class and set opacity to 0
      $('h1').find('span').addClass('word').css('opacity', 0);
      // GSAP animation to reveal each word
      heroContent_tl.to('.word', {
        opacity: 1,
        duration: 0.2,
        ease: 'power2.inOut',
        stagger: 0.1, // Adjust the stagger value to control the speed of animation
      });

      let heroBtn = $('.hero__banner--content .outline-btn');

      if (heroBtn[0]) {
        heroContent_tl.fromTo(
          heroBtn,
          {
            opacity: 0,
          },
          {
            opacity: 1,
            duration: 0.15,
            ease: 'power2.inOut',
          }
        );
      }
    }
  }

  // // nofnsnkldsncxkcnknd
  // // Function to apply channel noise effect to the text
  // function applyChannelNoise(element) {
  //   const letters = $(element).text().split('');
  //   $(element).empty();
  //   letters.forEach((letter) => {
  //     const span = $('<span class="glitch-letter">' + letter + '</span>');
  //     $(element).append(span);
  //     gsap.to(span, {
  //       duration: Math.random() * 0.5 + 0.1,
  //       opacity: Math.random(),
  //       x: (Math.random() - 0.5) * 20,
  //       y: (Math.random() - 0.5) * 20,
  //       repeat: -1,
  //       yoyo: true,
  //       ease: 'none',
  //     });
  //   });
  // }
  // // Apply channel noise effect to elements with class 'glitch' on document ready
  // $(document).ready(function () {
  //   $('.glitch').each(function (index, element) {
  //     applyChannelNoise(element);
  //   });
  // });
  // /**
  //  * =================================================
  //  * Homepage Our-Work block
  //  * =================================================
  //  */

  if ($('.our-work')[0]) {
    const tlWorkBlock = gsap.timeline({
      scrollTrigger: {
        trigger: '.our-work',
        start: 'top 80%',
        end: 'bottom bottom',
        // scrub: true,
        // markers: true, // Remove this in production; it shows scrollTrigger markers
      },
    });
    tlWorkBlock.from('.our-work-top h2, .our-work-top p', {
      opacity: 0,
      y: '50%',
      duration: 0.2,
      stagger: 0.2,
    });
    $('.our-work__content').each(function (index, element) {
      tlWorkBlock.from(element, {
        opacity: 0,
        y: '50%',
        duration: 0.2,
        stagger: 0.2,
      });
    });
  }
  // /**
  //  * =================================================
  //  * Homepage  Register Block
  //  * =================================================
  //  */

  if ($('.register__wrapper')[0]) {
    const tlRegisterBlock = gsap.timeline({
      scrollTrigger: {
        trigger: '.register__wrapper',
        start: 'top 60%',
        end: 'bottom center',
        //   scrub: true,
        // markers: true, // Remove this in production; it shows scrollTrigger markers
      },
    });
    tlRegisterBlock.from('.register__wrapper', {
      opacity: 0,
      // : '50%',
      duration: 0.2,
      transformOrigin: 'bottom center',
      ease: 'power2.inOut',
    });
    tlRegisterBlock.from('.register__content h2, .register__content  p, .register__content .button ', {
      opacity: 0,
      y: '20%',
      duration: 0.4,
      stagger: 0.3,
      transformOrigin: 'bottom bottom',
    });
  }
  // /**
  //  * =================================================
  //  * Homepage  Stateless Block
  //  * =================================================
  //  */
  if ($('.stateless-block')[0]) {
    const tlStatelessBlock = gsap.timeline({
      scrollTrigger: {
        trigger: '.stateless-block',
        start: 'top 90%',
        end: 'bottom center',
        //   scrub: true,
      },
    });
    tlStatelessBlock.from('.stateless-block', {
      opacity: 0,
      duration: 0.5,
      y: '50%',
      transformOrigin: 'bottom center',
    });
    tlStatelessBlock.from(
      '.stateless-block-content .title, .stateless-block-content p, .stateless-block-content .button ',
      {
        opacity: 0,
        duration: 1,
        y: '50%',
        transformOrigin: 'bottom center',
        stagger: 0.3,
      }
    );
  }
  // /**
  //  * =================================================
  //  * Homepage Latest Block
  //  * =================================================
  //  */
  if ($('.latest-block')[0]) {
    const tlLatestBlock = gsap.timeline({
      scrollTrigger: {
        trigger: '.latest-block ',
        start: 'top 80%',
        end: 'bottom bottom',
        //   scrub: true,
        //   markers: true,
      },
    });
    tlLatestBlock.from('.latest-block h3, .latest-block p', {
      opacity: 0,
      duration: 0.2,
      y: '50%',
      transformOrigin: 'bottom center',
      stagger: 0.5,
    });

    tlLatestBlock.from('.latest-block-wrapper .update-feature', {
      opacity: 0,
      duration: 0.2,
      x: '-50%',
      transformOrigin: 'bottom center',
    });

    tlLatestBlock.from('.latest-update-side .latest-side-content', {
      opacity: 0,
      duration: 0.3,
      x: '50%',
      transformOrigin: 'bottom right',
      stagger: 0.2,
    });

    $(document).load().scrollTop(0);
  }

  // /**
  //  * =================================================
  //  * Homepage Resources Block
  //  * =================================================
  //  */

  if ($('.resources-container')[0]) {
    gsap.from('.resources-info', {
      scrollTrigger: {
        trigger: '.resources-container',
        start: 'top 50%',
        end: 'bottom center',
        // scrub: true,
      },
      duration: 0.4,
      x: '-50%',
      opacity: 0,
      stagger: 0.2,
      transformOrigin: 'bottom left',
    });

    gsap.from('.resources-slider .slick-slide', {
      scrollTrigger: {
        trigger: '.resources-container',
        start: 'top 50%',
        end: 'bottom center',
      },
      duration: 0.4,
      y: '-40%',
      opacity: 0,
      stagger: 0.2,
      transformOrigin: 'bottom left',
    });
  }

  // /**
  //  * =================================================
  //  * Homepage Donation Block
  //  * =================================================
  //  */
  if ($('.make-donation')[0]) {
    const tlMakeDonation = gsap.timeline({
      scrollTrigger: {
        trigger: '.make-donation ',
        start: 'top 75%',
        end: 'bottom center',
        duration: 0.2,
        //   scrub: true,
        //   markers: true, });
      },
    });
    tlMakeDonation.from('.make-donation img', {
      opacity: 0,
      y: '20%',
      transformOrigin: 'bottom center',
    });

    tlMakeDonation.from('.make-donation-content h1, .make-donation-content p ', {
      opacity: 0,
      y: '-20%',
      stagger: 0.2,
      transformOrigin: 'bottom bottom',
    });

    tlMakeDonation.from(
      '.make-donation-btn',
      {
        opacity: 0,
        y: '-20%',
        transformOrigin: 'bottom bottom',
      },
      '-=0.15'
    );
  }

  // /**
  //  * =================================================
  //  * Footer
  //  * =================================================
  //  */

  // const tlfooter = gsap.timeline({
  //   scrollTrigger: {
  //     trigger: '.footer',
  //     start: 'top 75%',
  //     end: 'bottom center',
  //     duration: 1,
  //     //   scrub: true,
  //     //   markers: true, });
  //   },

  // if ($('.footer')[0]) {
  //   gsap.from('.footer', {
  //     scrollTrigger: {
  //       trigger: '.footer',
  //       start: 'top 80%',
  //       end: 'bottom center',
  //       // scrub: true,
  //     },
  //     duration: 0.2,
  //     opacity: 0,
  //     transformOrigin: 'bottom left',
  //   });
  // }

  // /**
  //  * =================================================
  //  * Team, Blog, Resources, Events Section
  //  * =================================================
  //  */

  if ($('.card-animate-wrapper .card-animate, .opportunity')[0]) {
    gsap.set('.card-animate', {
      opacity: 0,
      y: '30%',
    });

    function archiveScroll() {
      ScrollTrigger.batch('.card-animate, .opportunity__card', {
        onEnter: (batch) => {
          gsap.to(batch, {
            duration: 0.4,
            opacity: 1,
            y: '0%',
            ease: 'Power1.inOut',
            stagger: 0.2,
          });
        },
        once: true,
        start: 'top 80%',
        end: 'bottom center',
      });
    }

    archiveScroll();

    $(window).on('scroll', function () {
      archiveScroll();
    });
  }

  // /**
  //  * =================================================
  //  * content with images (Side)
  //  * =================================================
  //  */

  // if ($('.custom-animate-wrapper')[0]) {
  //   gsap.set('.custom-card-animate', {
  //     opacity: 0,
  //     y: '20%',
  //     scrub: true,
  //   });

  //   function archiveScroll() {
  //     ScrollTrigger.batch(
  //       '.custom-card-animate, .block-card__image, .block-card__content h3, .block-card__content p ',
  //       {
  //         onEnter: (batch) => {
  //           gsap.to(batch, {
  //             duration: 1,
  //             opacity: 1,
  //             y: '0%',
  //             ease: 'Power1.inOut',
  //             stagger: 0.2,
  //           });
  //         },
  //         // once: true,
  //         start: 'top 75%',

  //         end: 'bottom center',
  //       }
  //     );
  //   }

  //   archiveScroll();

  //   $(window).scroll(function () {
  //     archiveScroll();
  //   });
  // }

  // if ($('.custom-animate-wrapper')[0]) {
  //   gsap.set('.block-card__image', {
  //     opacity: 0,
  //     y: '20%',
  //     // scrub: true,
  //   });

  //   gsap.set('.custom-card-animate', {
  //     x: '20%',
  //     opacity: 0,
  //   });

  //   function archiveScroll() {
  //     ScrollTrigger.batch(
  //       '.block-card__image, .custom-card-animate, .block-card__content h3, .block-card__content p ',
  //       {
  //         onEnter: (batch) => {
  //           gsap.to(batch, {
  //             duration: 0.4,
  //             opacity: 1,
  //             y: '0%',
  //             x: '0%',
  //             ease: 'Power1.inOut',
  //             stagger: 0.4,
  //             delay: 0.2,
  //           });
  //         },
  //         // once: true,
  //         start: 'top 75%',
  //         end: 'bottom center',
  //       }
  //     );
  //   }

  //   archiveScroll();

  //   $(window).scroll(function () {
  //     archiveScroll();
  //   });
  // }

  // const tlBlockCard = gsap.timeline({
  //   scrollTrigger: {
  //     trigger: '.animate-block-card ',
  //     start: 'top 50%',
  //     end: 'bottom center',
  //     duration: 0.2,
  //     //   scrub: true,
  //     // markers: true,
  //   },
  // });
  // tlBlockCard.from('.block-card-animate .block-card__image, .block-card__content', {
  //   opacity: 0,
  //   y: '20%',
  //   stagger: 0.2,
  // });

  // tlBlockCard.from(' .block-card__content h3, .block-card__content  p ', {
  //   y: '20%',
  //   opacity: 0,
  //   stagger: 0.2,
  // });

  /**
   * =================================================
   * place this placeholder ath bottom of the code
   *
   * @if no bugs this code will appear in console
   * =================================================
   */
  //   console.log('Animation Loaded Successfully.');
});
