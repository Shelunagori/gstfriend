<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseInvoices Model
 *
 * @method \App\Model\Entity\PurchaseInvoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseInvoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseInvoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoice findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseInvoicesTable extends Table
{

    /**
     * Initialize method
     *
     * @param array $config The configuration for the Table.
     * @return void
     */
    public function initialize(array $config)
    {
        parent::initialize($config);

        $this->setTable('purchase_invoices');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');
    }

    /**
     * Default validation rules.
     *
     * @param \Cake\Validation\Validator $validator Validator instance.
     * @return \Cake\Validation\Validator
     */
    public function validationDefault(Validator $validator)
    {
        $validator
            ->integer('id')
            ->allowEmpty('id', 'create');

        

        $validator
            ->integer('invoice_no')
            ->requirePresence('invoice_no', 'create')
            ->notEmpty('invoice_no');
		
		return $validator;
    }
}
