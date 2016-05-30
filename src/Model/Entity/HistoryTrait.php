<?php
namespace App\Model\Entity;

use Cake\Utility\Inflector;
use Cake\ORM\TableRegistry;

trait HistoryTrait {

  public $entityName = 'Products';
  public $entityProperty = 'raw_product';
  public $entityForeignKey = 'product_id';

  //Permet de recupérer le nom du produit selon une hiérarchie de décision
  public function _getSavedEntity(){
    $Ptable = TableRegistry::get($this->entityName);
    // Sans produit on récupère la liaison

    if(is_null($this[Inflector::classify($this->entityName)])){
      return $Ptable->get($this[$this->entityForeignKey]);
    }
    else {
      if(empty($this[$this->entityProperty]))
      {
        // Si le raw_product n'est pas présent, c'est qu'il n'a pas été encore enregistré
        return $this[Inflector::classify($this->entityName)];
      }
      else {
        //Si un raw_product est présent il a priorité
        return $Ptable->newEntity((array)json_decode($this[$this->entityProperty]));
      }
    }
  }
  public function beforeSave($event, $entity, $options)
  {
    if(is_null($entity[$this->entityProperty]))
    {
      $entity[$this->entityProperty] = $this[$this->entityName]->get($entity[$this->entityForeignKey]);
    }
  }
}
