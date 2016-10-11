<?php

/**
 * @author Matthew Cooper
 * @author Matthew Cooper <matthew.cooper@thedailyedited.com>
 */
namespace Tde\Press\Model\Press;

use Magento\Framework\App\Request\DataPersistorInterface;
use Tde\Press\Model\Press;

/**
 * Class DataProvider
 */
class DataProvider extends \Magento\Ui\DataProvider\AbstractDataProvider
{

    /**
     * @var \Magento\Framework\Model\ResourceModel\Db\Collection\AbstractCollection
     */
    protected $collection;

    /**
     * @var DataPersistorInterface
     */
    protected $dataPersistor;

    /**
     * @var array
     */
    protected $loadedData;

    /**
     * @var \Magento\Framework\DataObject[]
     */
    protected $items;

    /**
     * Constructor
     *
     * @param string $name
     * @param string $primaryFieldName
     * @param string $requestFieldName
     * @param Press $press
     * @param array $meta
     * @param array $data
     * @internal param CollectionFactory $blockCollectionFactory
     * @internal param DataPersistorInterface $dataPersistor
     */
    public function __construct(
        $name,
        $primaryFieldName,
        $requestFieldName,
        Press $press,
        array $meta = [],
        array $data = []
    )
    {
        $this->collection = $press->getCollection();
        $this->items = $this->collection->getItems();
        parent::__construct($name, $primaryFieldName, $requestFieldName, $meta, $data);
    }

    /**
     * Get data
     *
     * @return array
     */
    public function getData()
    {
        /** @var  $block */
        foreach ($this->items as $item) {
            $this->loadedData[$item->getEntityId()] = $item->getData();
        }
        return $this->loadedData;
    }

}
