<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemMasters Model
 *
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 * @property \App\Model\Table\CgstLedgersTable|\Cake\ORM\Association\BelongsTo $CgstLedgers
 * @property \App\Model\Table\SgstLedgersTable|\Cake\ORM\Association\BelongsTo $SgstLedgers
 *
 * @method \App\Model\Entity\ItemMaster get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemMaster newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemMaster[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemMaster|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemMaster patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemMaster[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemMaster findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemMastersTable extends Table
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

        $this->setTable('item_masters');
        $this->setDisplayField('id');
        $this->setPrimaryKey('id');

        $this->belongsTo('Items', [
            'foreignKey' => 'item_id',
            'joinType' => 'INNER'
        ]);
       
		$this->belongsTo('CgstLedgers', [
			'className' => 'Ledgers',
			'foreignKey' => 'cgst_ledger_id',
			'propertyName' => 'cgst_ledger',
		]);
		
		$this->belongsTo('SgstLedgers', [
			'className' => 'Ledgers',
			'foreignKey' => 'sgst_ledger_id',
			'propertyName' => 'sgst_ledger',
		]);
		
		$this->belongsTo('Ledgers', [
            'foreignKey' => 'ledger_id',
            'joinType' => 'INNER'
        ]);
		
		$this->belongsTo('PurchaseVouchers', [
            'foreignKey' => 'purchase_voucher_id',
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
            ->decimal('price')
            ->requirePresence('price', 'create')
            ->notEmpty('price');

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
        $rules->add($rules->existsIn(['item_id'], 'Items'));
        $rules->add($rules->existsIn(['cgst_ledger_id'], 'CgstLedgers'));
        $rules->add($rules->existsIn(['sgst_ledger_id'], 'SgstLedgers'));

        return $rules;
    }
}
