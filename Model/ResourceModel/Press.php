<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Model\ResourceModel;

use Magento\Framework\Model\ResourceModel\Db\AbstractDb;

class Press extends AbstractDb
{

    protected function _construct()
    {
        $this->_init('tde_press', 'entity_id');
    }
}