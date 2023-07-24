<?php

namespace Dynamic\VirtualSelector\Extension;

use Sheadawson\DependentDropdown\Forms\DependentDropdownField;
use SilverStripe\Core\ClassInfo;
use SilverStripe\Forms\FieldList;
use SilverStripe\ORM\DataExtension;
use SilverStripe\Forms\DropdownField;
use DNADesign\Elemental\Models\BaseElement;
use DNADesign\ElementalVirtual\Model\ElementVirtual;

class ElementVirtualDataExtension extends DataExtension
{
    /**
     * @var array
     */
    private static $db = [
        'BlockType' => 'Varchar(255)',
    ];

    /**
     * @param FieldList $fields
     * @return void
     */
    public function updateCMSFields(FieldList $fields)
    {
        $blocks = ClassInfo::subclassesFor(BaseElement::class);

        $source = [];
        foreach ($blocks as $key => $block) {
            $type = $block::singleton()->getType();

            $source[$block] = $type;
        }
        asort($source);

        $fields->insertBefore(
            'LinkedElementID',
            $fieldOne = DropdownField::create('BlockType')
                ->setTitle(_t(ElementVirtual::class . '.BlockType', 'Block Type'))
                ->setSource($source)
                ->setEmptyString('Select a type')
        );

        $dataSource = function ($val) {
            return BaseElement::get()->filter(['ClassName' => $val])->map('ID', 'VirtualSummary');
        };

        $fields->replaceField(
            'LinkedElementID',
            DependentDropdownField::create('LinkedElementID')
                ->setTitle(_t(ElementVirtual::class . '.LinkedElement', 'Linked Element'))
                ->setSource($dataSource)
                ->setEmptyString('Select an element')
                ->setDepends($fieldOne)
        );
    }
}
