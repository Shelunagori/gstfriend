<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Invoices Model
 *
 * @method \App\Model\Entity\Invoice get($primaryKey, $options = [])
 * @method \App\Model\Entity\Invoice newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Invoice[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Invoice|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Invoice patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Invoice findOrCreate($search, callable $callback = null, $options = [])
 */
class InvoicesTable extends Table
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

        $this->setTable('invoices');
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

        $validator
            ->date('invoice_date')
            ->requirePresence('invoice_date', 'create')
            ->notEmpty('invoice_date');

        $validator
            ->requirePresence('state', 'create')
            ->notEmpty('state');

        $validator
            ->requirePresence('party_name', 'create')
            ->notEmpty('party_name');

        $validator
            ->requirePresence('party_address', 'create')
            ->notEmpty('party_address');

        $validator
            ->requirePresence('party_mobile', 'create')
            ->notEmpty('party_mobile');

        $validator
            ->requirePresence('party_state', 'create')
            ->notEmpty('party_state');

        $validator
            ->requirePresence('party_gst', 'create')
            ->notEmpty('party_gst');

        $validator
            ->decimal('total_amount_before_tax')
            ->requirePresence('total_amount_before_tax', 'create')
            ->notEmpty('total_amount_before_tax');

        $validator
            ->decimal('total_cgst')
            ->requirePresence('total_cgst', 'create')
            ->notEmpty('total_cgst');

        $validator
            ->decimal('total_sgst')
            ->requirePresence('total_sgst', 'create')
            ->notEmpty('total_sgst');

        $validator
            ->decimal('total_amount_after_tax')
            ->requirePresence('total_amount_after_tax', 'create')
            ->notEmpty('total_amount_after_tax');

        return $validator;
    }
}
