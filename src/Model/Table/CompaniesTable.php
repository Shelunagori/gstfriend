<?php
namespace App\Model\Table;

use Cake\ORM\Query;
use Cake\ORM\RulesChecker;
use Cake\ORM\Table;
use Cake\Validation\Validator;

/**
 * Companies Model
 *
 * @property \App\Model\Table\AccountingEntriesTable|\Cake\ORM\Association\HasMany $AccountingEntries
 * @property \App\Model\Table\AccountingGroupsTable|\Cake\ORM\Association\HasMany $AccountingGroups
 * @property \App\Model\Table\CustomersTable|\Cake\ORM\Association\HasMany $Customers
 * @property \App\Model\Table\InvoicesTable|\Cake\ORM\Association\HasMany $Invoices
 * @property \App\Model\Table\ItemDiscountsTable|\Cake\ORM\Association\HasMany $ItemDiscounts
 * @property \App\Model\Table\ItemsTable|\Cake\ORM\Association\HasMany $Items
 * @property \App\Model\Table\LedgersTable|\Cake\ORM\Association\HasMany $Ledgers
 * @property \App\Model\Table\PurchaseInvoicesTable|\Cake\ORM\Association\HasMany $PurchaseInvoices
 * @property \App\Model\Table\PurchaseVouchersTable|\Cake\ORM\Association\HasMany $PurchaseVouchers
 * @property \App\Model\Table\SuppliersTable|\Cake\ORM\Association\HasMany $Suppliers
 * @property \App\Model\Table\UsersTable|\Cake\ORM\Association\HasMany $Users
 *
 * @method \App\Model\Entity\Company get($primaryKey, $options = [])
 * @method \App\Model\Entity\Company newEntity($data = null, array $options = [])
 * @method \App\Model\Entity\Company[] newEntities(array $data, array $options = [])
 * @method \App\Model\Entity\Company|bool save(\Cake\Datasource\EntityInterface $entity, $options = [])
 * @method \App\Model\Entity\Company patchEntity(\Cake\Datasource\EntityInterface $entity, array $data, array $options = [])
 * @method \App\Model\Entity\Company[] patchEntities($entities, array $data, array $options = [])
 * @method \App\Model\Entity\Company findOrCreate($search, callable $callback = null, $options = [])
 */
class CompaniesTable extends Table
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

        $this->setTable('companies');
        $this->setDisplayField('name');
        $this->setPrimaryKey('id');

        $this->hasMany('AccountingEntries', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('AccountingGroups', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Customers', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Invoices', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('ItemDiscounts', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Items', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Ledgers', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PurchaseInvoices', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('PurchaseVouchers', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Suppliers', [
            'foreignKey' => 'company_id'
        ]);
        $this->hasMany('Users', [
            'foreignKey' => 'company_id'
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
            ->requirePresence('name', 'create')
            ->notEmpty('name');

        

        return $validator;
    }
}
