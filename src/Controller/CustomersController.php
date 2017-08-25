<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Customers Controller
 *
 * @property \App\Model\Table\CustomersTable $Customers
 *
 * @method \App\Model\Entity\Customer[] paginate($object = null, array $settings = [])
 */
class CustomersController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $customers = $this->paginate($this->Customers->find()->where(['status' => 0,'company_id'=>$company_id]));

        $this->set(compact('customers'));
        $this->set('_serialize', ['customers']);
		$this->set('active_menu', 'Customers.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$company_id=$this->Auth->User('company_id');
        $customer = $this->Customers->get($id, [
            'contain' => ['Companies', 'Ledgers']
        ]);

        $this->set('customer', $customer);
        $this->set('_serialize', ['customer']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$company_id=$this->Auth->User('company_id');
		$this->viewBuilder()->layout('index_layout');
        $customer = $this->Customers->newEntity();
        if ($this->request->is('post')) {
			
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            $customer->company_id=$company_id;
			
            /*ledger table Entry Start*/
				$Ledger = $this->Customers->Ledgers->newEntity();
				$Ledger->name=$customer->name;
				$Ledger->freeze=$customer->freezed;
				$Ledger->accounting_group_id=22;
				$Ledger->company_id=$company_id;
				$customer->ledgers = [$Ledger];
			 /*ledger table Entry end*/	
			
			if ($this->Customers->save($customer)) {
				
				//$this->Customers->Ledgers->save($Ledger);
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'add']);
            } 
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $companies = $this->Customers->Companies->find('list')->where(['company_id'=>$company_id]);
        $this->set(compact('customer', 'companies'));
        $this->set('_serialize', ['customer']);
		$this->set('active_menu', 'Customers.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $company_id=$this->Auth->User('company_id');
		$customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
			$customer->company_id=$company_id;
				
				
			$query = $this->Customers->Ledgers->query();
			$query->update()
				->set([ /*ledger table Entry Start*/
						'name'=>$customer->name,
						'freeze'=>$customer->freezed,
						'accounting_group_id'=>22,
						'company_id'=>$company_id
						/*ledger table Entry end*/	
					 ])
				->where(['customer_id' => $id,'company_id'=>$company_id])
				->execute();	
				
			
			 
            if ($this->Customers->save($customer)) {
				
				
				
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $companies = $this->Customers->Companies->find('list');
        $this->set(compact('customer', 'companies'));
        $this->set('_serialize', ['customer']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Customer id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
	{
		$company_id=$this->Auth->User('company_id');
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$customer = $this->Customers->get($id);
			$query = $this->Customers->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id,'company_id'=>$company_id])
					->execute();
			if ($this->Customers->save($customer)) {
				
				$this->Flash->success(__('The customer has been deleted.'));
			} else {
				$this->Flash->error(__('The customer could not be deleted. Please, try again.'));
			}
		}
        return $this->redirect(['action' => 'index']);
    }
}
