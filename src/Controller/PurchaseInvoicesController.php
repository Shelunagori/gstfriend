<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * PurchaseInvoices Controller
 *
 * @property \App\Model\Table\PurchaseInvoicesTable $PurchaseInvoices
 *
 * @method \App\Model\Entity\PurchaseInvoice[] paginate($object = null, array $settings = [])
 */
class PurchaseInvoicesController extends AppController
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
		$purchaseInvoices = $this->PurchaseInvoices->find()
		->contain(['PurchaseInvoiceRows'=>['CgstLedger','SgstLedger','IgstLedger'],'Companies','SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers']])
		->where(['PurchaseInvoices.status' => 0,'PurchaseInvoices.company_id'=>$company_id])->order(['PurchaseInvoices.id'=>'DESC']);
		
		$purchaseInvoices = $this->paginate($purchaseInvoices);
      
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
        $this->set(compact('purchaseInvoices','SupplierLedger'));
        $this->set('_serialize', ['purchaseInvoices']);
		$this->set('active_menu', 'PurchaseInvoices.Index');
    }
	
	//Report Generate Function Start
	function datewisereport($datefrom,$dateto)
	{
		$company_id=$this->Auth->User('company_id');
		$StartDate = date('Y-m-d',strtotime($datefrom));
		$EndDate = date('Y-m-d', strtotime($dateto));

		$reportdatas = $this->PurchaseInvoices->find()
		->where(['PurchaseInvoices.transaction_date BETWEEN :start AND :end','company_id'=>$company_id])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['PurchaseInvoices.id'=>'DESC']);
		
		$this->set(compact('reportdatas'));
	}
	
	
	
	
	function filterreportsupplier($startdatefrom,$startdateto,$supplierfilter)
	{   
		$company_id=$this->Auth->User('company_id');
		$StartfilterDate = date('Y-m-d',strtotime($startdatefrom));
		$EndfilterDate = date('Y-m-d', strtotime($startdateto));
		
			$filterdatas = $this->PurchaseInvoices->find()
			->where(['PurchaseInvoices.transaction_date BETWEEN :start AND :end','supplier_ledger_id'=>$supplierfilter,'PurchaseInvoices.company_id'=>$company_id,'PurchaseInvoices.status' => 0])
			->bind(':start', $StartfilterDate, 'date')
			->bind(':end',   $EndfilterDate, 'date')
			->contain(['SupplierLedger'=>['Suppliers']])
			->order(['PurchaseInvoices.id'=>'DESC']);
		
		
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find()->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
		
		$this->set(compact('filterdatas','SupplierLedger'));
		
	}
	
	//Report Generate Function End

    /**
     * View method
     *
     * @param string|null $id Purchase Invoice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $purchaseInvoice = $this->PurchaseInvoices->get($id, [
            'contain' => ['SupplierLedger'=>['Suppliers'],'PurchaseLedger'=>['Customers'],'Companies',  'PurchaseInvoiceRows']
        ]);
		$cgst_per=[];
		$sgst_per=[];
		$igst_per=[];
 		foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row){
			if($purchase_invoice_row->cgst_ledger_id > 0){
				$cgst_per[$purchase_invoice_row->id]=$this->PurchaseInvoices->Ledgers->get(@$purchase_invoice_row->cgst_ledger_id);
			}
			else{ 
					$cgst_per[$purchase_invoice_row->id] = 0;
				}
			if($purchase_invoice_row->sgst_ledger_id > 0){
				$sgst_per[$purchase_invoice_row->id]=$this->PurchaseInvoices->Ledgers->get(@$purchase_invoice_row->sgst_ledger_id);
			}
			else{ 
					$sgst_per[$purchase_invoice_row->id] = 0; 
				}
			if($purchase_invoice_row->igst_ledger_id > 0){
				$igst_per[$purchase_invoice_row->id]=$this->PurchaseInvoices->Ledgers->get(@$purchase_invoice_row->igst_ledger_id);
			}
			else{
					$igst_per[$purchase_invoice_row->id] = 0;
				}
			
		}
		// Tax value show in view page end
		
		$companies = $this->PurchaseInvoices->Companies->find()->where(['id' => $company_id]);
		
		$this->set(compact('cgst_per','sgst_per','igst_per','companies'));
        $this->set('purchaseInvoice', $purchaseInvoice);
        $this->set('_serialize', ['purchaseInvoice']);
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
		$purchaseInvoice = $this->PurchaseInvoices->newEntity();
        if ($this->request->is('post')) {
            $purchaseInvoice = $this->PurchaseInvoices->patchEntity($purchaseInvoice, $this->request->getData());
			$purchaseInvoice->transaction_date = date('Y-m-d',strtotime($purchaseInvoice->transaction_date));
			$purchaseInvoice->company_id = $company_id;
			//pr($purchaseInvoice);  exit;
			
			
				
				
		//pr($purchaseInvoice->purchase_invoice_others); exit;
            if ($this->PurchaseInvoices->save($purchaseInvoice)) {
			
				// Accounting Entry Start
				foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row)
				{
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_row['cgst_ledger_id'],
						'debit'=>$purchase_invoice_row['cgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	

					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_row['sgst_ledger_id'],
						'debit'=>$purchase_invoice_row['sgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
						
				
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_row['igst_ledger_id'],
						'debit'=>$purchase_invoice_row['igst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();
				}
				
				if($purchaseInvoice->total !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->supplier_ledger_id,
						'debit'=>0,
						'credit'=>$purchaseInvoice->total,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();							
					
					
				}
				
				if($purchaseInvoice->base_amount !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->purchase_ledger_id,
						'debit'=>$purchaseInvoice->base_amount,
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	
				}				
				
				
				
			
                $this->Flash->success(__('The purchase invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase invoice could not be saved. Please, try again.'));
        }
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
        $PurchaseLedger = $this->PurchaseInvoices->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0,'company_id'=>$company_id]);
		
		$CgstTax = $this->PurchaseInvoices->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST','company_id'=>$company_id]);
		
		$SgstTax = $this->PurchaseInvoices->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST','company_id'=>$company_id]);
		
		$IgstTax = $this->PurchaseInvoices->IgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'IGST','company_id'=>$company_id]);
		
		//$taxtypes = $this->PurchaseInvoices->TaxTypes->find('list');
		
        $this->set(compact('purchaseInvoice','SupplierLedger','PurchaseLedger','CgstTax','SgstTax','IgstTax'));
        $this->set('_serialize', ['purchaseInvoice']);
		$this->set('active_menu', 'PurchaseInvoices.Add');
    }


    /**
     * Edit method
     *
     * @param string|null $id Purchase Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
		$company_id=$this->Auth->User('company_id');
        $purchaseInvoice = $this->PurchaseInvoices->get($id, [
            'contain' => ['PurchaseInvoiceRows']
        ]);
		//pr($purchaseInvoice);exit;
		
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseInvoice = $this->PurchaseInvoices->patchEntity($purchaseInvoice, $this->request->getData());
			
			$purchaseInvoice->transaction_date = date('Y-m-d',strtotime($purchaseInvoice->transaction_date));
			$purchaseInvoice->company_id = $company_id;
			//pr($purchaseInvoice->purchase_invoice_rows);  exit;
			 if ($this->PurchaseInvoices->save($purchaseInvoice)) {
				 
				$query = $this->PurchaseInvoices->AccountingEntries->query();
				$query->delete()->where(['purchase_invoice_id'=> $id])->execute();
			
					foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row)
				{
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_row['cgst_ledger_id'],
						'debit'=>$purchase_invoice_row['cgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	

					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_row['sgst_ledger_id'],
						'debit'=>$purchase_invoice_row['sgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
						
				
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_row['igst_ledger_id'],
						'debit'=>$purchase_invoice_row['igst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();
				}
				
				if($purchaseInvoice->total !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->supplier_ledger_id,
						'debit'=>0,
						'credit'=>$purchaseInvoice->total,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();							
					
					
				}
				
				if($purchaseInvoice->base_amount !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_invoice_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->purchase_ledger_id,
						'debit'=>$purchaseInvoice->base_amount,
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_invoice_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	
				}				
				
				
			
				
                $this->Flash->success(__('The purchase invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase invoice could not be saved. Please, try again.'));
        }
	
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0,'company_id'=>$company_id]);
        $PurchaseLedger = $this->PurchaseInvoices->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0,'company_id'=>$company_id]);
		
		$CgstTax = $this->PurchaseInvoices->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST','company_id'=>$company_id]);
		
		$SgstTax = $this->PurchaseInvoices->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST','company_id'=>$company_id]);
		
		$IgstTax = $this->PurchaseInvoices->IgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'IGST','company_id'=>$company_id]);

		//$taxtypes = $this->PurchaseInvoices->TaxTypes->find('list');
		
        $this->set(compact('purchaseInvoice','SupplierLedger','PurchaseLedger','CgstTax','SgstTax','IgstTax'));
        $this->set('_serialize', ['purchaseInvoice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Purchase Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
		$company_id=$this->Auth->User('company_id');
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$purchaseInvoice = $this->PurchaseInvoices->get($id);
			$query = $this->PurchaseInvoices->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id,'company_id'=>$company_id])
					->execute();
			if ($this->PurchaseInvoices->save($purchaseInvoice)) {
				
				$this->Flash->success(__('The purchaseInvoice has been deleted.'));
			} else {
				$this->Flash->error(__('The purchaseInvoice could not be deleted. Please, try again.'));
			}
		}
        return $this->redirect(['action' => 'index']);
    }
}
