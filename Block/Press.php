<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Block;

use Magento\Framework\Stdlib\DateTime\DateTime;
use Magento\Framework\View\Element\Template\Context;
use Tde\Press\Model\Press as PressCollection;

class Press extends \Magento\Framework\View\Element\Template
{
    protected $_template = 'press_content.phtml';

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection111
     */
    public $items;
    /**
     * @var DateTime
     */
    private $date;

    /**
     * Press constructor.
     * @param Context $context
     * @param PressCollection $press
     * @param DateTime $date
     * @param array $data
     */
    public function __construct(
        Context $context,
        PressCollection $press,
        DateTime $date,
        array $data
    )
    {
        parent::__construct($context, $data);
        $this->items = $press->getCollection();
        $this->date = $date;
    }

    /**
     * @param $date
     * @return string
     */
    public function prepareDate($date)
    {
        return $this->date->date('F Y', $date);
    }

}
