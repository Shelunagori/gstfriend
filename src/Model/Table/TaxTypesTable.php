<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * TaxTypes Model
 *
 * @method \App\Model\Entity\TaxType get($primaryKey, $options = [])
 * @method \App\Model\Entity\TaxType newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\TaxType[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\TaxType|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\TaxType patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\TaxType[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\TaxType findOrCreate($search, callable $callback = null, $options = [])
 */
class TaxTypesTable extends Table
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

        $this->setTable('tax_types');
        $this->setDisplayField('gst_type');
        $this->setPrimaryKey('id');
		
		$this->hasMany('TaxTypeRows', [
            'foreignKey' => 'tax_type_id',
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
            ->requirePresence('gst_type', 'create')
            ->notEmpty('gst_type');

        $validator
            ->integer('percentage')
            ->requirePresence('percentage', 'create')
            ->notEmpty('percentage');

        return $validator;
    }
}
