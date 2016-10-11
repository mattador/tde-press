<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Model\Press\Source;

class Enabledisable implements \Magento\Framework\Option\ArrayInterface
{
    /**
     * @return array
     */
    public function toOptionArray()
    {
        return [
            ['value' => 1, 'label' => __('Enable')],
            ['value' => 0, 'label' => __('Disable')]
        ];
    }
}
