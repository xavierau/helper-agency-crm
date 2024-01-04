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
 * @Date        : 13/3/2021
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyFinance\Enums;

use MyCLabs\Enum\Enum;

/**
 * @method static InvoiceStatus ACTIVE()
 * @method static InvoiceStatus INACTIVE()
 * @method static InvoiceStatus VOID()
 */
final class InvoiceStatus extends Enum
{
    private const ACTIVE   = 'active';
    private const INACTIVE = 'inactive';
    private const VOID     = 'void';
}
