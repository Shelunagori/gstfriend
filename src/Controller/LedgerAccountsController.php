<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * LedgerAccounts Controller
 *
 * @property \App\Model\Table\LedgerAccountsTable $LedgerAccounts
 *
 * @method \App\Model\Entity\LedgerAccount[] paginate($object = null, array $settings = [])
 */
class LedgerAccountsController extends AppController
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
            'contain' => ['Companies', 'Suppliers', 'Customers']
        ];
        $ledgerAccounts = $this->paginate($this->LedgerAccounts);

        $this->set(compact('ledgerAccounts'));
        $this->set('_serialize', ['ledgerAccounts']);
		$this->set('active_menu', 'LedgerAccounts.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Ledger Account id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $ledgerAccount = $this->LedgerAccounts->get($id, [
            'contain' => ['Companies', 'Suppliers', 'Customers']
        ]);

        $this->set('ledgerAccount', $ledgerAccount);
        $this->set('_serialize', ['ledgerAccount']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $ledgerAccount = $this->LedgerAccounts->newEntity();
        if ($this->request->is('post')) {
            $ledgerAccount = $this->LedgerAccounts->patchEntity($ledgerAccount, $this->request->getData());
            if ($this->LedgerAccounts->save($ledgerAccount)) {
                $this->Flash->success(__('The ledger account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ledger account could not be saved. Please, try again.'));
        }
        $companies = $this->LedgerAccounts->Companies->find('list', ['limit' => 200]);
        $suppliers = $this->LedgerAccounts->Suppliers->find('list', ['limit' => 200]);
        $customers = $this->LedgerAccounts->Customers->find('list', ['limit' => 200]);
        $this->set(compact('ledgerAccount', 'companies', 'suppliers', 'customers'));
        $this->set('_serialize', ['ledgerAccount']);
		$this->set('active_menu', 'LedgerAccounts.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Ledger Account id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $ledgerAccount = $this->LedgerAccounts->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $ledgerAccount = $this->LedgerAccounts->patchEntity($ledgerAccount, $this->request->getData());
            if ($this->LedgerAccounts->save($ledgerAccount)) {
                $this->Flash->success(__('The ledger account has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The ledger account could not be saved. Please, try again.'));
        }
        $companies = $this->LedgerAccounts->Companies->find('list', ['limit' => 200]);
        $suppliers = $this->LedgerAccounts->Suppliers->find('list', ['limit' => 200]);
        $customers = $this->LedgerAccounts->Customers->find('list', ['limit' => 200]);
        $this->set(compact('ledgerAccount', 'companies', 'suppliers', 'customers'));
        $this->set('_serialize', ['ledgerAccount']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Ledger Account id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $ledgerAccount = $this->LedgerAccounts->get($id);
        if ($this->LedgerAccounts->delete($ledgerAccount)) {
            $this->Flash->success(__('The ledger account has been deleted.'));
        } else {
            $this->Flash->error(__('The ledger account could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
