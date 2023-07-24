<?php

namespace Dynamic\VirtualSelector\Test\Extension;

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
        $fields = $this->objFromFixture(ElementalVirtual::class, 'one')->getCMSFields();
        $this->assertNotNull($fields->dataFieldByName('BlockType'));
    }
}