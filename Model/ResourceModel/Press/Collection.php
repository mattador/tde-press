<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Model\ResourceModel\Press;

use Magento\Sales\Model\ResourceModel\Collection\AbstractCollection;

/**
 * Press entity collection
 *
 * @author     Magento Core Team <core@magentocommerce.com>
 */
class Collection extends AbstractCollection
{
    /**
     * Internal constructor
     *
     * @return void
     */
    protected function _construct()
    {
        $this->_init('Tde\Press\Model\Press', 'Tde\Press\Model\ResourceModel\Press');
    }
}
