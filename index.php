<?php
/*
 * Plugin Name:       Koderstory: Woo Cart Renameweight
 * Description:       Rename Weight to volume
 * Version:           1.00.0
 * Requires at least: 5.2
 * Requires PHP:      7.2
 * Author:            Aldy Ahsandin
 * Author URI:        https://github.com/aldyahsn
 * License:           GPL v2 or later
 * License URI:       https://www.gnu.org/licenses/gpl-2.0.html
 */
// =============================================

add_action('woocommerce_init', 'on_woocommerce_init');

/**
 * Function for `woocommerce_init` action-hook.
 * 
 * @return void
 */
function on_woocommerce_init()
{   
    // change weight unit from Kg to M³
    update_option('woocommerce_weight_unit', 'M³');
    
    // replace 'weight' text to CBM
    add_filter('gettext_woocommerce', 'woo_replace_string', 20, 3);
    
    // add_filter('woocommerce_cart_no_shipping_available_html', 'change_no_shipping_text'); // Alters message on Cart page
    // add_filter('woocommerce_no_shipping_available_html', 'change_no_shipping_text'); // Alters message on Checkout page
    // add_filter(  'gettext',  'change_checkout_no_shipping_method_text', 10, 3 );

}



// -------------------------
// change label 'weight' to CBM
// -------------------------
function woo_replace_string($translation, $text, $domain)
{
    $search_string = 'Weight';
    if (strpos($translation, $search_string) !== false) {
        $translation = str_replace($search_string, 'Volume (CBM)', $translation);
    }
    return $translation;
}

// -------------------------
// TEST HOOK WOO
// -------------------------
// add_action( 'woocommerce_before_cart', 'custom_function');
// function custom_function(){
//     echo 'custom my plugin';
// }

// -------------------------
// LOOPING ITEM DATA
// -------------------------
// add_filter( 'woocommerce_get_item_data', 'display_cart_item_weight', 10, 2 );
// function display_cart_item_weight( $item_data, $cart_item ) {
//     return $item_data;
// }

// ========================================================================================
/*
add_action( 'woocommerce_widget_shopping_cart_before_buttons', 'show_total_weight' );
function show_total_weight(){
    echo "Total Weight";
}


add_filter('woocommerce_get_item_data', 'display_cart_item_weight', 10, 2);
function display_cart_item_weight($item_data, $cart_item)
{
    if (isset($cart_item['data'])) {
        // Display original weight
        if (isset($cart_item['weight']['default'])) {
            $item_data[] = array(
                'key' => __('Weight (original)', 'woocommerce'),
                'value' => wc_format_weight($cart_item['weight']['default']),
            );
        }

        // Display calculated weight
        if (isset($cart_item['weight']['new'])) {
            $item_data[] = array(
                'key' => __('Weight (new)', 'woocommerce'),
                'value' => wc_format_weight($cart_item['weight']['new']),
            );
        }
    }
    return $item_data;

}


function change_no_shipping_text()
{
    return "Products must be packed efficiently to reach the required 20 CBM total volume";
}

function change_checkout_no_shipping_method_text( $translated_text, $text, $domain ) {
    if ( is_checkout() && ! is_wc_endpoint_url() ) {
        $original_text = 'No shipping method has been selected. Please double check your address, or contact us if you need any help.';
        $new_text      = 'Ensure all shipments meet criteria. <a href="mailto:sales@hamesha.studio">Contact us</a> if you need help.';
        
        if ( $text === $original_text ) {
            $translated_text = $new_text;
        }
    }
    return $translated_text;
}
*/
// ======================================