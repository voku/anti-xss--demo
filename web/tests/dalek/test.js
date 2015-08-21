/*global module*/

module.exports = {
  // Checks if the index-page is working
  'index testing': function (test) {
    'use strict';
    test
        .open('http://openrheinruhr.localhost/')
        .assert.title('OpenRheinRuhr')
        .screenshot('tests/dalek/results/index_:browser_.:version.png')
        .click('.navbar-nav>li:last-child')
        .wait(1000)
        .type('#js-contact-email', 'lars@moelleken.org')
        .type('#js-contact-lastName', 'Moelleken')
        .type('#js-contact-firstName', 'Lars')
        .type('#js-contact-phone', '123456789987654321')
        .type('#js-contact-text', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.')
        .assert.val('#js-contact-email', 'lars@moelleken.org', 'E-Mail has been set')
        .assert.val('#js-contact-lastName', 'Moelleken', 'Lastname has been set')
        .assert.val('#js-contact-firstName', 'Lars', 'Firstname has been set')
        .assert.val('#js-contact-phone', '123456789987654321', 'Phone has been set')
        .assert.val('#js-contact-text', 'Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet. Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Stet clita kasd gubergren, no sea takimata sanctus est Lorem ipsum dolor sit amet.', 'Text has been set')
        .screenshot('tests/dalek/results/index_form_:browser_.:version.png')
        .wait(1000)
        .done();
  }
};
