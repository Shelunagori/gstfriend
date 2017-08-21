<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * PurchaseVoucherRows Model
 *
 * @property \App\Model\Table\PurchaseVouchersTable|\Cake\ORM\Association\BelongsTo $PurchaseVouchers
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\PurchaseVoucherRow get($primaryKey, $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\PurchaseVoucherRow findOrCreate($search, callable $callback = null, $options = [])
 */
class PurchaseVoucherRowsTable extends Table
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

        $this->setTable('purchase_voucher_rows');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('PurchaseVouchers', [
            'foreignKey' => 'purchase_voucher_id',
            'joinType' => 'INNER'
        ]);
        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'LEFT'
        ]);

		$this->belongsTo('CgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'cgst_ledger_id',
			'propertyName' => 'cgst_ledger',
		]);
		
		$this->belongsTo('SgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'sgst_ledger_id',
			'propertyName' => 'sgst_ledger',
		]);

		$this->belongsTo('IgstLedger', [
			'className' => 'Ledgers',
			'foreignKey' => 'igst_ledger_id',
			'propertyName' => 'igst_ledger',
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
            ->decimal('quantity')
            ->requirePresence('quantity', 'create')
            ->notEmpty('quantity');

        $validator
            ->decimal('rate_per')
            ->requirePresence('rate_per', 'create')
            ->notEmpty('rate_per');

        $validator
            ->decimal('amount')
            ->requirePresence('amount', 'create')
            ->notEmpty('amount');

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
        $rules->add($rules->existsIn(['purchase_voucher_id'], 'PurchaseVouchers'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));

        return $rules;
    }
}
