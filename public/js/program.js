$(document).ready(function() {
  let hasUserOpenedAccordion = false;
  const mobileQuery = window.matchMedia('(max-width: 650px)');
  const desktopQuery = window.matchMedia('(min-width: 651px)');

  function toggleIcons($header, isExpanded) {
    const $expandIcon = $header.children('#expandProgram');
    const $collapseIcon = $header.children('#collapseProgram');

    if (isExpanded) {
      $expandIcon.addClass('hide');
      $collapseIcon.removeClass('hide');
    } else {
      $expandIcon.removeClass('hide');
      $collapseIcon.addClass('hide');
    }
  }

  function openAccordion($header) {
    const $content = $header.next('.oneProgramContent');
    if (!$content.length || $content.hasClass('active')) {
      toggleIcons($header, true);
      return;
    }

    $content.addClass('active');
    $content.stop(true, true).hide().slideDown(600, function() {
      $content.css('display', '');
    });
    toggleIcons($header, true);
  }

  function closeAccordion($header, animate = true) {
    const $content = $header.next('.oneProgramContent');
    if (!$content.length) {
      return;
    }

    if (!$content.hasClass('active') && !$content.is(':visible')) {
      toggleIcons($header, false);
      return;
    }

    $content.removeClass('active');

    if (animate) {
      $content.stop(true, true).slideUp(600, function() {
        $content.css('display', '');
      });
    } else {
      $content.stop(true, true);
      $content.css('display', '');
    }

    toggleIcons($header, false);
  }

  function closeAllAccordions() {
    $('.oneProgramHeader').each(function() {
      closeAccordion($(this), false);
    });
  }

  function ensureDesktopAccordion() {
    const $firstHeader = $('.oneProgram').first().find('.oneProgramHeader');
    if ($firstHeader.length && !$('.oneProgramContent.active').length) {
      openAccordion($firstHeader);
    }
  }

  function handleAccordionState() {
    const isDesktop = window.innerWidth > 650;

    if (isDesktop) {
      ensureDesktopAccordion();
    } else if (!hasUserOpenedAccordion) {
      closeAllAccordions();
    }
  }

  handleAccordionState();
  function onBreakpointChange() {
    handleAccordionState();
  }

  function attachMediaQueryListener(query) {
    if (!query) {
      return;
    }

    if (typeof query.addEventListener === 'function') {
      query.addEventListener('change', onBreakpointChange);
      return;
    }

    if (typeof query.addListener === 'function') {
      query.addListener(onBreakpointChange);
    }
  }

  attachMediaQueryListener(mobileQuery);
  attachMediaQueryListener(desktopQuery);

  window.addEventListener('orientationchange', function() {
    setTimeout(handleAccordionState, 200);
  });

  $('.oneProgramHeader').on('click', function() {
    const $header = $(this);
    const $content = $header.next('.oneProgramContent');

    hasUserOpenedAccordion = true;

    if ($content.hasClass('active')) {
      closeAccordion($header);
    } else {
      openAccordion($header);
    }
  });
});
