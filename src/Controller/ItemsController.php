<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Items Controller
 *
 * @property \App\Model\Table\ItemsTable $Items
 *
 * @method \App\Model\Entity\Item[] paginate($object = null, array $settings = [])
 */
class ItemsController extends AppController
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
            'contain' => ['Companies','CgstLedgers','SgstLedgers']
        ];
        $items = $this->paginate($this->Items);
        $this->set(compact('items'));
        $this->set('_serialize', ['items']);
		$this->set('active_menu', 'Items.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $item = $this->Items->get($id, [
            'contain' => ['Companies','CgstLedgers','SgstLedgers']
        ]);

        $this->set('item', $item);
        $this->set('_serialize', ['item']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
		$item = $this->Items->newEntity();
        if ($this->request->is('post')) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
			$item->company_id=$company_id;
			
			$gst_type = $item->gst_type;
			
			$taxtypes = $this->Items->TaxTypes->TaxTypeRows->find()
						->where(['tax_type_id'=>$gst_type]);
			
			if(!empty($taxtypes->toArray()))
			{
				foreach($taxtypes as $taxtype)
				{
					$this->Items->TaxTypes->Ledgers->find()
					->where(['name'=>$taxtype->tax_type_name,'accounting_group_id'=>30]);					
				}
			}
			
			
			
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
		 
		$taxtypes = $this->Items->TaxTypes->find('list');
    
        $this->set(compact('item','companies','taxtypes'));
        $this->set('_serialize', ['item']);
		$this->set('active_menu', 'Items.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $item = $this->Items->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $item = $this->Items->patchEntity($item, $this->request->getData());
            if ($this->Items->save($item)) {
                $this->Flash->success(__('The item has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item could not be saved. Please, try again.'));
        }
		$cgstLedgers = $this->Items->CgstLedgers->find('list')->where(['accounting_group_id'=>30,'gst_type'=>'CGST']);
        $sgstLedgers = $this->Items->SgstLedgers->find('list')->where(['accounting_group_id'=>30,'gst_type'=>'SGST']);
        $this->set(compact('item', 'companies','cgstLedgers','sgstLedgers'));
        $this->set('_serialize', ['item']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $item = $this->Items->get($id);
        if ($this->Items->delete($item)) {
            $this->Flash->success(__('The item has been deleted.'));
        } else {
            $this->Flash->error(__('The item could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
