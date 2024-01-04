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
 * @method static CreditNoteStatus ACTIVE()
 * @method static CreditNoteStatus PENDING()
 * @method static CreditNoteStatus USED()
 * @method static CreditNoteStatus VOID()
 */
final class CreditNoteStatus extends Enum
{
    private const ACTIVE  = 'active';
    private const PENDING = 'pending';
    private const USED    = 'used';
    private const VOID    = 'void';
}
http://127.0.0.1:8080/api/agencyfinance/credit_notes?filter[search]=v
