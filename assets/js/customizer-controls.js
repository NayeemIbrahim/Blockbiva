// Blockbiva Customizer Controls
(function ($) {
    'use strict';

    wp.customize.bind('ready', function () {

        /**
         * 1. Responsive Toggle Switching
         */
        $(document).on('click', '.blockbiva-responsive-toggle button', function (e) {
            e.preventDefault();
            var $button = $(this);
            var device = $button.data('device');
            var $control = $button.closest('.blockbiva-range-control');

            // Toggle active class on buttons
            $control.find('.blockbiva-responsive-toggle button').removeClass('active');
            $button.addClass('active');

            // Toggle visibility of input fields
            $control.find('.blockbiva-range-field').removeClass('active');
            $control.find('.blockbiva-range-field-' + device).addClass('active');
        });

        /**
         * 2. Sync Range Slider <-> Number Input
         * We bind to 'input' for immediate visual feedback and 'change' for final commit.
         */

        // A. Range Slider -> Number Input
        $(document).on('input change', '.blockbiva-range-input-wrapper input[type="range"]', function () {
            var $slider = $(this);
            var value = $slider.val();
            var $control = $slider.closest('.blockbiva-range-input-wrapper');
            var $numberInput = $control.find('input[type="number"]');

            if ($numberInput.length) {
                // Update visible number
                $numberInput.val(value);
                // Trigger events for Customizer preview
                $numberInput.trigger('change').trigger('keyup');
            }
        });

        // B. Number Input -> Range Slider
        $(document).on('input keyup change', '.blockbiva-range-input-wrapper input[type="number"]', function () {
            var $numberInput = $(this);
            var value = $numberInput.val();
            var $control = $numberInput.closest('.blockbiva-range-input-wrapper');
            var $slider = $control.find('input[type="range"]');

            if ($slider.length) {
                $slider.val(value);
            }
        });

        // FORCE REFRESH: Sometimes sliders get stuck on load.
        $('.blockbiva-range-input-wrapper input[type="range"]').each(function () {
            $(this).trigger('input');
        });

    });
})(jQuery);
