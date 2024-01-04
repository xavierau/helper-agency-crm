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
 * @package
 * @Date        : 28/7/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\CMS\Database;


class DefaultSetting
{
    private const pages = [
        [
            'url'       => '/',
            'view'      => 'welcome',
            'is_active' => true,
            'contents'  => [
                [
                    'key' => 'banner_1',
                ],
                [
                    'key' => 'banner_1_link',
                ],
                [
                    'key' => 'banner_2',
                ],
                [
                    'key' => 'banner_2_link',
                ],
                [
                    'key' => 'banner_3',
                ],
                [
                    'key' => 'banner_3_link',
                ],
                [
                    'key' => 'banner_4',
                ],
                [
                    'key' => 'banner_4_link',
                ],
                [
                    'key' => 'banner_5',
                ],
                [
                    'key' => 'banner_5_link',
                ],
            ],
        ],
        [
            'url'       => 'about_us',
            'view'      => 'about_us',
            'is_active' => true,
            'contents'  => [
                [
                    'key' => 'banner',
                ],
                [
                    'key' => 'content',
                ],
            ],
        ],
        [
            'url'       => 'news',
            'view'      => 'news',
            'is_active' => true,
            'contents'  => [
                [
                    'key' => 'banner',
                ],
            ],
        ],
        [
            'url'       => 'contact_us',
            'view'      => 'contact_us',
            'is_active' => true,
            'contents'  => [
                ['key' => 'banner',],
                ['key' => 'shop_1',],
                ['key' => 'shop_1_address',],
                ['key' => 'shop_1_tel',],
                ['key' => 'shop_1_fax',],
                ['key' => 'shop_1_whatsapp',],
                ['key' => 'shop_1_pic',],
                ['key' => 'shop_2',],
                ['key' => 'shop_2_address',],
                ['key' => 'shop_2_tel',],
                ['key' => 'shop_2_fax',],
                ['key' => 'shop_2_whatsapp',],
                ['key' => 'shop_2_pic',],
                ['key' => 'shop_3',],
                ['key' => 'shop_3_address',],
                ['key' => 'shop_3_tel',],
                ['key' => 'shop_3_fax',],
                ['key' => 'shop_3_whatsapp',],
                ['key' => 'shop_3_pic',],
                ['key' => 'shop_4',],
                ['key' => 'shop_4_address',],
                ['key' => 'shop_4_tel',],
                ['key' => 'shop_4_fax',],
                ['key' => 'shop_4_whatsapp',],
                ['key' => 'shop_4_pic',],
                ['key' => 'shop_5',],
                ['key' => 'shop_5_address',],
                ['key' => 'shop_5_tel',],
                ['key' => 'shop_5_fax',],
                ['key' => 'shop_5_whatsapp',],
                ['key' => 'shop_5_pic',],
            ],
        ],
        [
            'url'       => 'cart',
            'view'      => 'cart',
            'is_active' => true,
        ],
        [
            'url'       => 'search',
            'view'      => 'search',
            'is_active' => true,
            'contents'  => [
                [
                    'key' => 'banner',
                ],
            ],
        ],
    ];

    private const commonContents = [
        [
            'key' => 'contact_us_email',
        ],
        [
            'key' => 'contact_number',
        ],
        [
            'key' => 'philippines_license_number',
        ],
        [
            'key' => 'indonesia_license_number',
        ],
        [
            'key' => 'labour_department_license_number',
        ],
        [
            'key' => 'whatsapp_number',
        ],

    ];

    public static function getPages(): array
    {
        return static::pages;
    }


    public static function getCommonContents(): array
    {
        return static::commonContents;
    }


}
