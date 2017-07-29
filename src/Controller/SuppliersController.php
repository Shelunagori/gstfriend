<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Suppliers Controller
 *
 * @property \App\Model\Table\SuppliersTable $Suppliers
 *
 * @method \App\Model\Entity\Supplier[] paginate($object = null, array $settings = [])
 */
class SuppliersController extends AppController
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
        $suppliers = $this->paginate($this->Suppliers);

        $this->set(compact('suppliers'));
        $this->set('_serialize', ['suppliers']);
		$this->set('active_menu', 'Suppliers.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $supplier = $this->Suppliers->get($id, [
            'contain' => ['Companies', 'Ledgers']
        ]);

        $this->set('supplier', $supplier);
        $this->set('_serialize', ['supplier']);
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
        $supplier = $this->Suppliers->newEntity();
        if ($this->request->is('post')) {
            $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());
           $supplier->company_id=$company_id;
		/*ledger table Entry Start */	
			$Ledger = $this->Suppliers->Ledgers->newEntity();
			$Ledger->name = $supplier->name;
			$Ledger->freezed = $supplier->freezed;
			$Ledger->company_id = $company_id;
			$supplier->ledgers = [$Ledger];
        /*ledger table Entry End */    
			if ($this->Suppliers->save($supplier)) {
				
				//$this->Suppliers->Ledgers->save($Ledger);
                $this->Flash->success(__('The supplier has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The supplier could not be saved. Please, try again.'));
        }
        $companies = $this->Suppliers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('supplier', 'companies'));
        $this->set('_serialize', ['supplier']);
		$this->set('active_menu', 'Suppliers.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $supplier = $this->Suppliers->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $supplier = $this->Suppliers->patchEntity($supplier, $this->request->getData());
            if ($this->Suppliers->save($supplier)) {
                $this->Flash->success(__('The supplier has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The supplier could not be saved. Please, try again.'));
        }
        $companies = $this->Suppliers->Companies->find('list', ['limit' => 200]);
        $this->set(compact('supplier', 'companies'));
        $this->set('_serialize', ['supplier']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Supplier id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $supplier = $this->Suppliers->get($id);
        if ($this->Suppliers->delete($supplier)) {
            $this->Flash->success(__('The supplier has been deleted.'));
        } else {
            $this->Flash->error(__('The supplier could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
