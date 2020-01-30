(function (window, document, $, ms2Bundle) {
    var ms2Bundle = ms2Bundle || {};
    var _this = ms2Bundle;
    _this.config = _this.config || {};

    _this.config = $.extend(_this.config, {
        groupElement: '.ms2bundle-group',
        inputParentElement: '.ms2bundle-input-parent',
        inputElement: '[name^="options[bundle]"]',
        priceElement: '.ms2bundle-total-price',
    });

    _this.initialize = function () {
        _this.getTotalPrice();
        _this.updateTotalPrice();
        _this.validateMaxOptions();
    };

    _this.getTotalPrice = function () {
        var $totalPriceElement = $(_this.config.priceElement);
        var totalPrice = parseFloat($totalPriceElement.data('original-price'));
        $(_this.config.inputElement).filter(':checked').each(function () {
            var ingredientPrice = $(this).data('price');
            totalPrice += parseFloat(ingredientPrice);
        });
        $totalPriceElement.html(totalPrice);
    };

    _this.updateTotalPrice = function () {
        $(document).on('change', _this.config.inputElement, function () {
            _this.getTotalPrice();
        });
    };

    _this.validateMaxOptions = function () {
        $(document).on('change', _this.config.inputElement, function () {
            var $groupElement = $(this).parents(_this.config.groupElement);
            var max = $groupElement.data('max');
            if (!max) {
                return;
            }

            $groupElement.find(_this.config.inputElement).removeAttr('disabled')
                .parents(_this.config.inputParentElement).removeClass('disabled');
            var checkedCount = $groupElement.find(_this.config.inputElement).filter(':checked').length;
            if (max == checkedCount) {
                $groupElement.find(_this.config.inputElement)
                    .filter('[type="checkbox"]').not(':checked').attr('disabled', 'disabled')
                    .parents(_this.config.inputParentElement).addClass('disabled');
            }
        });
    };

    $(document).ready(function ($) {
        _this.initialize();
    });
    window.ms2Bundle = _this;
})(window, document, jQuery, ms2Bundle);