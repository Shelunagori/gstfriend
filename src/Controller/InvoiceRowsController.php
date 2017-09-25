<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * InvoiceRows Controller
 *
 * @property \App\Model\Table\InvoiceRowsTable $InvoiceRows
 *
 * @method \App\Model\Entity\InvoiceRow[] paginate($object = null, array $settings = [])
 */
class InvoiceRowsController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $this->paginate = [
            'contain' => ['Invoices', 'Items']
        ];
        $invoiceRows = $this->paginate($this->InvoiceRows);

        $this->set(compact('invoiceRows'));
        $this->set('_serialize', ['invoiceRows']);
    }

	
	
	
	
	
	
    /**
     * View method
     *
     * @param string|null $id Invoice Row id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $invoiceRow = $this->InvoiceRows->get($id, [
            'contain' => ['Invoices', 'Items']
        ]);

        $this->set('invoiceRow', $invoiceRow);
        $this->set('_serialize', ['invoiceRow']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
        $invoiceRow = $this->InvoiceRows->newEntity();
        if ($this->request->is('post')) {
            $invoiceRow = $this->InvoiceRows->patchEntity($invoiceRow, $this->request->getData());
            if ($this->InvoiceRows->save($invoiceRow)) {
                $this->Flash->success(__('The invoice row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice row could not be saved. Please, try again.'));
        }
        $invoices = $this->InvoiceRows->Invoices->find('list');
        $items = $this->InvoiceRows->Items->find('list')->where(['freezed'=>0]);
        $this->set(compact('invoiceRow', 'invoices', 'items'));
        $this->set('_serialize', ['invoiceRow']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Invoice Row id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
        $invoiceRow = $this->InvoiceRows->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoiceRow = $this->InvoiceRows->patchEntity($invoiceRow, $this->request->getData());
            if ($this->InvoiceRows->save($invoiceRow)) {
                $this->Flash->success(__('The invoice row has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice row could not be saved. Please, try again.'));
        }
        $invoices = $this->InvoiceRows->Invoices->find('list');
        $items = $this->InvoiceRows->Items->find('list')->where(['freezed'=>0]);
        $this->set(compact('invoiceRow', 'invoices', 'items'));
        $this->set('_serialize', ['invoiceRow']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice Row id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoiceRow = $this->InvoiceRows->get($id);
        if ($this->InvoiceRows->delete($invoiceRow)) {
            $this->Flash->success(__('The invoice row has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice row could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
