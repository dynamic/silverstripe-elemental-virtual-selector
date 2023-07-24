<?php

namespace Dynamic\VirtualSelector\Extension;

use SilverStripe\ORM\DataExtension;

/***
 * @property-read BaseElement|BaseElementExtension $owner
 */
class BaseElementDataExtension extends DataExtension
{
    /**
     * @return string
     */
    public function getVirtualSummary()
    {
        $parent = $this->owner->Parent();
        $pageTitle = $parent->getOwnerPage() ? $parent->getOwnerPage()->Title : '';
        if ($pageTitle == '') {
            return;
        }

        if ($title = $this->owner->Title ? $this->owner->Title : $this->owner->getType()) {
        }

        return $title . ' - ' . $pageTitle;
    }
}
