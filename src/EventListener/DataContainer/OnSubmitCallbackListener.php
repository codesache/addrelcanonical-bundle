<?php

namespace Codesache\AddRelCanonicalBundle\EventListener\DataContainer;

use Codesache\AddRelCanonicalBundle\Helper\DcaHelper;
use Contao\CoreBundle\DependencyInjection\Attribute\AsCallback;
use Contao\DataContainer;
use Doctrine\DBAL\Connection;
use Doctrine\DBAL\Exception as DBALException;

#[AsCallback(table: 'tl_glossary_item', target: 'config.onsubmit')]
readonly class OnSubmitCallbackListener
{
    public function __construct(private Connection $connection)
    {
    }

    /**
     * @throws DBALException
     */
    public function __invoke(DataContainer $dc): void
    {
        if (!$dc->id) {
            return;
        }

        // if canonicalType is set to RELCANONICAL_SELF, reset 'canonicalJumpTo' to 0
        if (DcaHelper::RELCANONICAL_SELF === $dc->activeRecord->canonicalType && 0 !== $dc->activeRecord->canonicalJumpTo) {
            $this->connection->update('tl_glossary_item', ['canonicalJumpTo' => 0], ['id' => $dc->id]);
        }
        // TODO (?) reset 'canonicalWebsite' if 'canonicalType' is not DcaHelper::RELCANONICAL_EXTERNAL
        //   or can we ignore inconsistent settings all together?
    }
}