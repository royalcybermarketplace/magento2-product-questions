/*
 * @category    RoyalCyberMarketplace
 * @package     RoyalCyberMarketplace_ProductQuestions
 * @copyright   Copyright (c) 2022 RoyalCyberMarketplace (https://royalcyber.com/)
*/

define([
    'jquery'
], function ($) {
    'use strict';
    window.questionNextPage = null;
    function processQuestions(url, fromPages) {
        $.ajax({
            url: url,
            cache: true,
            dataType: 'html'
        }).done(function (data) {
            if (window.questionNextPage) {
                $('.img-loading').remove();
                var previousId = window.questionNextPage.attr('previous-page');
                window.questionNextPage.remove();
                $('#'+previousId).append(data);
            } else {
                $('#product-question-container').html(data);
            }
            $('[data-role="product-question"] .question-load-more a').each(function (index, element) {
                $(element).click(function (event) {
                    window.questionNextPage = $(element);
                    window.questionNextPage.hide();
                    $('.img-loading').show();
                    processQuestions($(element).attr('href'), true);
                    event.preventDefault();
                });
            });
        }).complete(function () {
            if (fromPages == true) {
                // $('html, body').animate({
                //     scrollTop: $('#questions').offset().top - 50
                // }, 300);
            }
        });
    }

    return function (config, element) {
        processQuestions(config.productQuestionUrl);
    };
});
