<?php

namespace Dynamic\VirtualSelector\Test\Extension;

use DNADesign\ElementalVirtual\Model\ElementVirtual;
use SilverStripe\Dev\SapphireTest;

class ElementVirtualDataExtensionTest extends SapphireTest
{
    /**
     * @var string
     */
    protected static $fixture_file = 'ElementVirtualDataExtensionTest.yml';

    /**
     * @var array
     */
    protected static $reqiured_extensions = [
        DNADesign\ElementalVirtual\Models\ElementalVirtual::class => [
            Dynamic\VirtualSelector\Extension\ElementVirtualDataExtension::class,
        ],
    ];

    public function testUpdateCMSFields()
    {
        $obj = $this->objFromFixture(ElementVirtual::class, 'one');
        $fields = $obj->getCMSFields();
        $this->assertNotNull($fields->dataFieldByName('BlockType'));
    }
}
