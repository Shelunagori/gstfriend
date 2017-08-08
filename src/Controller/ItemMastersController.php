<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * ItemMasters Controller
 *
 * @property \App\Model\Table\ItemMastersTable $ItemMasters
 *
 * @method \App\Model\Entity\ItemMaster[] paginate($object = null, array $settings = [])
 */
class ItemMastersController extends AppController
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
            'contain' => ['Items','CgstLedgers','SgstLedgers']
        ];
        $itemMasters = $this->paginate($this->ItemMasters);

        $this->set(compact('itemMasters'));
        $this->set('_serialize', ['itemMasters']);
		$this->set('active_menu', 'ItemMasters.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Item Master id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $itemMaster = $this->ItemMasters->get($id, [
            'contain' => ['Items','CgstLedgers','SgstLedgers']
        ]);

        $this->set('itemMaster', $itemMaster);
        $this->set('_serialize', ['itemMaster']);
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
        $itemMaster = $this->ItemMasters->newEntity();
        if ($this->request->is('post')) {
            $itemMaster = $this->ItemMasters->patchEntity($itemMaster, $this->request->getData());
			$itemMaster->company_id=$company_id;
            if ($this->ItemMasters->save($itemMaster)) {
                $this->Flash->success(__('The item master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item master could not be saved. Please, try again.'));
        }
        $items = $this->ItemMasters->Items->find('list');
        $cgstLedgers = $this->ItemMasters->CgstLedgers->find('list')->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
        $sgstLedgers = $this->ItemMasters->SgstLedgers->find('list')->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);
        $this->set(compact('itemMaster', 'items', 'cgstLedgers', 'sgstLedgers'));
        $this->set('_serialize', ['itemMaster']);
		$this->set('active_menu', 'ItemMasters.Add');
    }

    /**
     * Edit method
     *
     * @param string|null $id Item Master id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $itemMaster = $this->ItemMasters->get($id, [
            'contain' => []
        ]);
        if ($this->request->is(['patch', 'post', 'put'])) {
            $itemMaster = $this->ItemMasters->patchEntity($itemMaster, $this->request->getData());
            if ($this->ItemMasters->save($itemMaster)) {
                $this->Flash->success(__('The item master has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The item master could not be saved. Please, try again.'));
        }
        $items = $this->ItemMasters->Items->find('list');
        $cgstLedgers = $this->ItemMasters->CgstLedgers->find('list')->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
        $sgstLedgers = $this->ItemMasters->SgstLedgers->find('list')->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);
        $this->set(compact('itemMaster', 'items','cgstLedgers','sgstLedgers'));
        $this->set('_serialize', ['itemMaster']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Item Master id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $itemMaster = $this->ItemMasters->get($id);
        if ($this->ItemMasters->delete($itemMaster)) {
            $this->Flash->success(__('The item master has been deleted.'));
        } else {
            $this->Flash->error(__('The item master could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
