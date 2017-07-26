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
		$this->viewBuilder()->layout('index_layout');
        $this->paginate = [
            'contain' => ['Companies']
        ];
        $customers = $this->paginate($this->Customers);

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
		$this->viewBuilder()->layout('index_layout');
        $customer = $this->Customers->get($id, [
            'contain' => ['Companies']
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
				$LedgerAccount = $this->Customers->LedgerAccounts->newEntity();
				$LedgerAccount->name=$customer->name;
				$LedgerAccount->freezed=$customer->freezed;
				$LedgerAccount->company_id=$company_id;
				$customer->ledger_accounts = [$LedgerAccount];
			 /*ledger table Entry end*/	
			if ($this->Customers->save($customer)) {
				$this->Customers->LedgerAccounts->save($LedgerAccount);
				$this->Flash->success(__('The customer has been saved.'));
				return $this->redirect(['action' => 'index']);
            }
				$this->Flash->error(__('The customer could not be saved. Please, try again.'));
		}
        $companies = $this->Customers->Companies->find('list', ['limit' => 200]);
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
        $customer = $this->Customers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $customer = $this->Customers->patchEntity($customer, $this->request->getData());
            if ($this->Customers->save($customer)) {
                $this->Flash->success(__('The customer has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The customer could not be saved. Please, try again.'));
        }
        $companies = $this->Customers->Companies->find('list', ['limit' => 200]);
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
		$this->viewBuilder()->layout('index_layout');
        $this->request->allowMethod(['post', 'delete']);
        $customer = $this->Customers->get($id);
        if ($this->Customers->delete($customer)) {
            $this->Flash->success(__('The customer has been deleted.'));
        } else {
            $this->Flash->error(__('The customer could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
