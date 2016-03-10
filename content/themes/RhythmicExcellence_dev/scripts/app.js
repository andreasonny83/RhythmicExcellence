/**
 *
 *  RhythmicExcellence
 *  Copyright 2016 SonnY. All rights reserved.
 *
 *  Licensed under the MIT License
 *  You may obtain a copy of the License at
 *
 *  http://andreasonny.mit-license.org
 *
 */
$(document).ready(function() {
  fixImages.init();
  readMore.init();
  fixElements.init();
  responsiveMenu.init();
  scrollTop.init();
  submitForm.init();

  if (window.googleMaps && window.googleMaps === true) {
    gMap.init();
  }
});
