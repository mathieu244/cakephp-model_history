<?php
namespace App\Model\Behavior;

use Cake\ORM\Behavior;
use Cake\ORM\Table;

/**
 * History behavior
 */
class HistoryBehavior extends Behavior
{

    /**
     * Default configuration.
     *
     * @var array
     */
    protected $_defaultConfig = ['entityProperty' => 'raw_product', 'entityName' => 'Products', 'entityForeignKey' => 'product_id'];

    public function beforeSave($event, $entity, $options)
    {
      $config = $this->config();

      if(is_null($entity[$config['entityProperty']]))
      {
        $entity[$config['entityProperty']] = $event->subject()->{$config['entityName']}->get($entity[$config['entityForeignKey']]);
      }
    }
}
