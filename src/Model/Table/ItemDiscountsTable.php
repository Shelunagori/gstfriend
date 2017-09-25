<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * ItemDiscounts Model
 *
 * @property \App\Model\Table\CustomerLedgersTable|\Cake\ORM\Association\BelongsTo $CustomerLedgers
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\BelongsTo $Items
 *
 * @method \App\Model\Entity\ItemDiscount get($primaryKey, $options = [])
 * @method \App\Model\Entity\ItemDiscount newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\ItemDiscount[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\ItemDiscount|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\ItemDiscount patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\ItemDiscount[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\ItemDiscount findOrCreate($search, callable $callback = null, $options = [])
 */
class ItemDiscountsTable extends Table
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

        $this->setTable('item_discounts');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->belongsTo('CustomerLedgers', [
			'className' =>'Ledgers',
            'foreignKey' =>'customer_ledger_id',
			'propertyName' => 'customer_ledger',
        ]);
        $this->belongsTo('Items',[
			'foreignKey' =>'item_id' 
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
        $rules->add($rules->existsIn(['customer_ledger_id'], 'CustomerLedgers'));
        $rules->add($rules->existsIn(['item_id'], 'Items'));

        return $rules;
    }
}
