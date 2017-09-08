<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Companies Controller
 *
 * @property \App\Model\Table\CompaniesTable $Companies
 *
 * @method \App\Model\Entity\Company[] paginate($object = null, array $settings = [])
 */
class CompaniesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $companies = $this->paginate($this->Companies);

        $this->set(compact('companies'));
        $this->set('_serialize', ['companies']);
    }

    /**
     * View method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $company = $this->Companies->get($id, [
            'contain' => ['AccountingEntries', 'AccountingGroups', 'Customers', 'Invoices', 'ItemDiscounts', 'Items', 'Ledgers', 'PurchaseInvoices', 'PurchaseVouchers', 'Suppliers', 'Users']
        ]);

        $this->set('company', $company);
        $this->set('_serialize', ['company']);
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
        $company = $this->Companies->newEntity();
		
		
		
		
        if ($this->request->is('post')) {
            $company = $this->Companies->patchEntity($company, $this->request->getData());
			
			$file = $this->request->data['logo'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
			$arr_ext = array('png'); //set allowed extensions
			$setNewFileName = uniqid();
			
			$company->logo=$setNewFileName. '.' . $ext;
			if (in_array($ext, $arr_ext)) {
				move_uploaded_file($file['tmp_name'], WWW_ROOT . '/company_logo/' . $setNewFileName . '.' . $ext);
			}
			
			
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Edit method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $company = $this->Companies->get($id, [
            'contain' => []
        ]);
		$oldlogo=$company->logo;
		$company_id=$company->id;
        if ($this->request->is(['patch', 'post', 'put'])) {
			$file = $this->request->data['logo'];
			$file_name=$file['name'];
			$ext = substr(strtolower(strrchr($file['name'], '.')), 1); //get the extension
			$arr_ext = array('jpg'); //set allowed extensions
			$setNewFileName = $this->request->data['gstno'].$company_id;
			
			$new_file_name=$setNewFileName. '.' . $ext;
			if (in_array($ext, $arr_ext)) {
				move_uploaded_file($file['tmp_name'], WWW_ROOT . '/company_logo/' . $setNewFileName . '.' . $ext);
			}
			if(!empty($file_name))
			{
				$this->request->data['logo']=$new_file_name;
			}if(empty($file_name))
			{
				$this->request->data['logo']=$oldlogo;
			}
            $company = $this->Companies->patchEntity($company, $this->request->getData());
			
			
			
            if ($this->Companies->save($company)) {
                $this->Flash->success(__('The company has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The company could not be saved. Please, try again.'));
        }
		
        $this->set(compact('company'));
        $this->set('_serialize', ['company']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Company id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $this->request->allowMethod(['post', 'delete']);
        $company = $this->Companies->get($id);
        if ($this->Companies->delete($company)) {
            $this->Flash->success(__('The company has been deleted.'));
        } else {
            $this->Flash->error(__('The company could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
