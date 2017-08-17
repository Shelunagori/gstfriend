<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseInvoiceRows Model
 *
 * @property \App\Model\Table\CgstLedgersTable|\Cake\ORM\Association\BelongsTo $CgstLedgers
 * @property \App\Model\Table\SgstLedgersTable|\Cake\ORM\Association\BelongsTo $SgstLedgers
 * @property \App\Model\Table\PurchaseInvoicesTable|\Cake\ORM\Association\BelongsTo $PurchaseInvoices
 *
 * @method \App\Model\Entity\PurchaseInvoiceRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseInvoiceRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoiceRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoiceRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseInvoiceRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoiceRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseInvoiceRow findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseInvoiceRowsTable extends Table
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

        $this->setTable('purchase_invoice_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        
        $this->belongsTo('PurchaseInvoices', [
            'foreignKey' => 'purchase_invoice_id',
            'joinType' => 'INNER'
        ]);
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
            ->decimal('cgst_amount')
            ->requirePresence('cgst_amount', 'create')
            ->notEmpty('cgst_amount');

        $validator
            ->decimal('sgst_amount')
            ->requirePresence('sgst_amount', 'create')
            ->notEmpty('sgst_amount');

        return $validator;
    }

    /**
     * Returns a rules checker object that will be used for validating
     * application integrity.
     *
     * @param \Cake\ORM\RulesChecker $rules The rules object to be modified.
     * @return \Cake\ORM\RulesChecker
     */
    public function buildRules(RulesChecker $rules)
    {
        
        $rules->add($rules->existsIn(['purchase_invoice_id'], 'PurchaseInvoices'));

        return $rules;
    }
}
