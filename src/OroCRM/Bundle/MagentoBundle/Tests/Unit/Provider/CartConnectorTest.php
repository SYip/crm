<?php

namespace OroCRM\Bundle\MagentoBundle\Tests\Unit\Provider;

use Oro\Bundle\ImportExportBundle\Context\ContextRegistry;
use Oro\Bundle\IntegrationBundle\Logger\LoggerStrategy;
use Oro\Bundle\IntegrationBundle\Provider\ConnectorContextMediator;

use OroCRM\Bundle\MagentoBundle\Provider\CartConnector;

class CartConnectorTest extends MagentoConnectorTestCase
{
    /**
     * {@inheritdoc}
     */
    protected function getConnectorInstance(
        ContextRegistry $contextRegistry,
        LoggerStrategy $logger,
        ConnectorContextMediator $contextMediator
    ) {
        return new CartConnector($contextRegistry, $logger, $contextMediator);
    }

    /**
     * {@inheritdoc}
     */
    protected function getIteratorGetterMethodName()
    {
        return 'getCarts';
    }

    public function testPublicInterface()
    {
        $contextMediatorMock = $this
            ->getMockBuilder('Oro\\Bundle\\IntegrationBundle\\Provider\\ConnectorContextMediator')
            ->disableOriginalConstructor()->getMock();

        $connector = $this->getConnectorInstance(new ContextRegistry(), new LoggerStrategy(), $contextMediatorMock);

        $this->assertEquals('cart', $connector->getType());
        $this->assertEquals('mage_cart_import', $connector->getImportJobName());
        $this->assertEquals('OroCRM\\Bundle\\MagentoBundle\\Entity\\Cart', $connector->getImportEntityFQCN());
        $this->assertEquals('orocrm.magento.connector.cart.label', $connector->getLabel());
    }
}
