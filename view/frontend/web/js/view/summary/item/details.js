/**
 * Copyright © Magento, Inc. All rights reserved.
 * See COPYING.txt for license details.
 */

// define([
//     'uiComponent'
// ], function (Component) {
//     'use strict';

//     return Component.extend({
//         defaults: {
//             template: 'Magento_Checkout/summary/item/details'
//         },

//         /**
//          * @param {Object} quoteItem
//          * @return {String}
//          */
//         getValue: function (quoteItem) {
//             return quoteItem.name;
//         }
//     });
// });


define(
    [
        'uiComponent'
    ],
    function (Component) {
        "use strict";
        var quoteItemData = window.checkoutConfig.quoteItemData;
        return Component.extend({
            defaults: {
                template: 'Magento_Checkout/summary/item/details'
            },
            quoteItemData: quoteItemData,
            getValue: function(quoteItem) {
                return quoteItem.name;
            },
            getItemFlavor: function(quoteItem) {
                var itemProduct = this.getItemProduct(quoteItem.item_id);
                return itemProduct.flavor;
            },
            getItemProduct: function(item_id) {
                var itemElement = null;
                _.each(this.quoteItemData, function(element, index) {
                    if (element.item_id == item_id) {
                        itemElement = element;
                    }
                });
                return itemElement;
            }
    
        });
    }
    
    );