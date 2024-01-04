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
 * @Date        : 7/11/2020
 * @copyright   Copyright (c) A & A Creation (https://anacreation.com/)
 */

namespace Modules\AgencyContract\Actions;


use App\Services\DocumentStorageManager;
use Modules\AgencyContract\Entities\Contract;
use Modules\AgencyContractDoc\Entities\ContractDoc;

class RemoveContractDocumentContent
{
    /**
     * @var \App\Services\DocumentStorageManager
     */
    private DocumentStorageManager $manager;

    public function __construct(DocumentStorageManager $manager) {
        $this->manager = $manager;
    }

    public function execute(Contract $contract, ContractDoc $document): void {
        $storedDocument = $contract->storedDocuments()
                                   ->where('contract_doc_id',
                                           $document->id)
                                   ->first();

        if($storedDocument) {
            $this->manager->delete($storedDocument->value ?? null);
            $storedDocument->value = null;
            $storedDocument->save();
        }
    }
}
