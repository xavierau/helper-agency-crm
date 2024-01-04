<?php

/**
 * A & A Creation Co.
 *
 * DISCLAIMER
 *
 * Do not edit or add to this file if you wish to upgrade this extension to newer
 * version in the future.
 *
 * @category    A & A Creation
 * @package     ${PACKAGE}
 * @Date        : 27/7/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

use Modules\CMS\Entities\Content;

if (!function_exists('common_content')) {

    function common_content($key, $default = null, string $language = null)
    {
        $language = $language ?? app()->getLocale();

        $content = Content::common()
            ->key($key)
            ->first();


        return optional($content)->content ?? $default;
    }
}

if (!function_exists('embed_google_map')) {

    function embed_google_map(string $address)
    {

        $address = $address;
        echo "<iframe
                                                        src='https://www.google.com/maps/{$address}'
                                                        width='100%'
                                                        height='220'
                                                        style='border:0; display: block;'
                                                        allowfullscreen=''
                                                        loading='lazy'></iframe>";
    }
}


if (!function_exists('in_cart')) {

    function in_cart(string $value): bool
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return false;
        }

        return in_array($value, array_keys($cart));
    }
}
