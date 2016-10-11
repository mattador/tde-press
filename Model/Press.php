<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Model;

use Magento\Framework\Model\AbstractModel;

class Press extends AbstractModel
{

    const STATUS_ENABLED = 1;
    const STATUS_DISABLED = 0;

    protected function _construct()
    {
        $this->_init('Tde\Press\Model\ResourceModel\Press');
    }
}