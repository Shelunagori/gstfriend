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
        $purchaseInvoices = $this->paginate($this->PurchaseInvoices->find()->where(['status' => 0]));

        $this->set(compact('purchaseInvoices'));
        $this->set('_serialize', ['purchaseInvoices']);
		$this->set('active_menu', 'PurchaseInvoices.Index');
    }
	
	//Report Generate Function Start
	function datewisereport($datefrom,$dateto)
	{
		$StartDate = date('Y-m-d',strtotime($datefrom));
		$EndDate = date('Y-m-d', strtotime($dateto));

		$reportdatas = $this->PurchaseInvoices->find()
		->where(['PurchaseInvoices.transaction_date BETWEEN :start AND :end' ])
		->bind(':start', $StartDate, 'date')
		->bind(':end',   $EndDate, 'date')
		->order(['PurchaseInvoices.id'=>'DESC']);
		
		$this->set(compact('reportdatas'));
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
        $purchaseInvoice = $this->PurchaseInvoices->get($id, [
            'contain' => []
        ]);

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
			//pr($purchaseInvoice->purchase_invoice_others);  exit;
			
			foreach($purchaseInvoice->purchase_invoice_others as $purchase_invoice_row)
			{
				
				$taxtypes[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_id'=>$purchase_invoice_row['tax_type_id']])->toArray();

				
				foreach($taxtypes as $taxtype)
				{   
					foreach($taxtype as $key => &$taxtyp)
					{	if($purchase_invoice_row['tax_type_id'] == $taxtyp->tax_type_id)
						{
							$taxtyp['tax_amount'] = $purchase_invoice_row['tax_amount'];
						}
						
					}
				}	
			}
			
			//pr($taxtypes);exit;
			
			foreach($taxtypes as $taxtype)
			{
				foreach($taxtype as $taxtyp)
				{
				
				 $input_gst_ids[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['name'=>$taxtyp->tax_type_name,'accounting_group_id'=>29])->toArray(); 

					foreach($input_gst_ids as $input_gst_id_data)
					{
						foreach($input_gst_id_data as $key => &$input_gst_id)
						{
							 if($taxtyp->tax_type_name == $input_gst_id->name)
							{
								$input_gst_id['tax_amount'] = $taxtyp->tax_amount;
							} 
						}						
					}							

				}
			}
			
			//pr($input_gst_ids); exit;
			unset($purchaseInvoice->purchase_invoice_others);
			$purchaseInvoice->purchase_invoice_others = array();
			if(!empty($input_gst_ids))
			{
				foreach($input_gst_ids as $input_gst_id_data)
				{
					foreach($input_gst_id_data as $input_gst_id)
					{
						if($input_gst_id->gst_type == 'CGST')
						{
							$cgst_amount = $input_gst_id->tax_amount/2;
							$purchaseInvoice['purchase_invoice_others']['CGST'] = ['cgst_ledger_id' =>$input_gst_id->id,'cgst_amount'=>$cgst_amount];
						}

						if($input_gst_id->gst_type == 'SGST')
						{
							$sgst_amount = $input_gst_id->tax_amount/2;
							$purchaseInvoice['purchase_invoice_others']['SGST'] = ['sgst_ledger_id' =>$input_gst_id->id,'sgst_amount'=>$sgst_amount];
						}
						
						if($input_gst_id->gst_type == 'IGST')
						{
							$igst_amount = $input_gst_id->tax_amount;
							$purchaseInvoice['purchase_invoice_others']['IGST'] = ['igst_ledger_id' =>$input_gst_id->id,'igst_amount'=>$igst_amount];
						}						
					}
				}
			}
				
		//pr($purchaseInvoice->purchase_invoice_others); exit;
            if ($this->PurchaseInvoices->save($purchaseInvoice)) {
			
			foreach($purchaseInvoice->purchase_invoice_others as $key => $purchase_invoice_other)
			{ 
				if($key == 'CGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['cgst_ledger_id','cgst_amount','purchase_invoice_id'])
					->values([
						'cgst_ledger_id' => $purchase_invoice_other['cgst_ledger_id'],
						'cgst_amount' => $purchase_invoice_other['cgst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['cgst_ledger_id'],
						'debit'=>$purchase_invoice_other['cgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();					
				}

				if($key == 'SGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['sgst_ledger_id','sgst_amount','purchase_invoice_id'])
					->values([
						'sgst_ledger_id' => $purchase_invoice_other['sgst_ledger_id'],
						'sgst_amount' => $purchase_invoice_other['sgst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['sgst_ledger_id'],
						'debit'=>$purchase_invoice_other['sgst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
					
				}
				if($key == 'IGST')
				{
					$query_insert = $this->PurchaseInvoices->PurchaseInvoiceRows->query();
					$query_insert->insert(['igst_ledger_id','igst_amount','purchase_invoice_id'])
					->values([
						'igst_ledger_id' => $purchase_invoice_other['igst_ledger_id'],
						'igst_amount' => $purchase_invoice_other['igst_amount'],
						'purchase_invoice_id' => $purchaseInvoice->id
					]);
					$query_insert->execute();
					
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchase_invoice_other['igst_ledger_id'],
						'debit'=>$purchase_invoice_other['igst_amount'],
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();		
				}			
				
			} 
			
				if($purchaseInvoice->total !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->supplier_ledger_id,
						'debit'=>0,
						'credit'=>$purchaseInvoice->total,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();							
					
					
				}
				
				if($purchaseInvoice->base_amount !=0)
				{		
					$query_insert = $this->PurchaseInvoices->AccountingEntries->query();
					$query_insert->insert(['ledger_id','debit','credit','transaction_date','purchase_voucher_id','company_id'])
					->values([
						'ledger_id'=>$purchaseInvoice->purchase_ledger_id,
						'debit'=>$purchaseInvoice->base_amount,
						'credit'=>0,
						'transaction_date'=>$purchaseInvoice->transaction_date,
						'purchase_voucher_id'=>$purchaseInvoice->id,
						'company_id'=>$company_id
					]);
					$query_insert->execute();	
				}				
				
                $this->Flash->success(__('The purchase invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase invoice could not be saved. Please, try again.'));
        }
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0]);
        $PurchaseLedger = $this->PurchaseInvoices->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0]);
		
		$CgstTax = $this->PurchaseInvoices->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
		
		$SgstTax = $this->PurchaseInvoices->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);
		
		$taxtypes = $this->PurchaseInvoices->TaxTypes->find('list');
		
        $this->set(compact('purchaseInvoice','SupplierLedger','PurchaseLedger','CgstTax','SgstTax','taxtypes'));
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
        if ($this->request->is(['patch', 'post', 'put'])) {
            $purchaseInvoice = $this->PurchaseInvoices->patchEntity($purchaseInvoice, $this->request->getData());
			$purchaseInvoice->transaction_date = date('Y-m-d',strtotime($purchaseInvoice->transaction_date));
			$purchaseInvoice->company_id = $company_id;
            
				
			foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row)
			{
				$taxtypes[] = $this->PurchaseInvoices->TaxTypes->TaxTypeRows->find()
				->where(['tax_type_id'=>$purchase_invoice_row->tax_type_id])->toArray();
			}
			
			
			foreach($taxtypes as $taxtype)
			{
				foreach($taxtype as $taxtyp)
				{
				 $input_gst_ids[] = $this->PurchaseInvoices->Ledgers->find()
				->where(['name'=>$taxtyp->tax_type_name,'accounting_group_id'=>29])->toArray(); 
				}
			}
			
			if(!empty($input_gst_ids))
			{
				foreach($input_gst_ids as $input_gst_id_data)
				{
					foreach($input_gst_id_data as $input_gst_id)
					{
						if($input_gst_id->gst_type == 'CGST')
						{
							$purchaseInvoice->cgst_ledger_id = $input_gst_id->id;
						}

						if($input_gst_id->gst_type == 'SGST')
						{
							$purchaseInvoice->sgst_ledger_id = $input_gst_id->id;
						}
						
						if($input_gst_id->gst_type == 'IGST')
						{
							$purchaseInvoice->igst_ledger_id = $input_gst_id->id;
						}						
						
					}
				}
			}
			
			if ($this->PurchaseInvoices->save($purchaseInvoice)) {	
				
				
				//Acconting Entry Start
				if($purchaseInvoice->total !=0)
				{		
					$Accounting_entries = $this->PurchaseInvoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchaseInvoice->supplier_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $purchaseInvoice->total;
					$Accounting_entries->transaction_date = $purchaseInvoice->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseInvoice->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseInvoices->AccountingEntries->save($Accounting_entries);				
				}
				
				if($purchaseInvoice->base_amount !=0)
				{		
					$Accounting_entries = $this->PurchaseInvoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchaseInvoice->purchase_ledger_id;
					$Accounting_entries->debit = $purchaseInvoice->base_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseInvoice->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseInvoice->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseInvoices->AccountingEntries->save($Accounting_entries);				
				}				
			
				
				foreach($purchaseInvoice->purchase_invoice_rows as $purchase_invoice_row)
				{
					$Accounting_entries = $this->PurchaseInvoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_invoice_row->cgst_ledger_id;
					$Accounting_entries->debit = $purchase_invoice_row->cgst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseInvoice->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseInvoice->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseInvoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->PurchaseInvoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_invoice_row->sgst_ledger_id;
					$Accounting_entries->debit = $purchase_invoice_row->sgst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseInvoice->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseInvoice->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseInvoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->PurchaseInvoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $purchase_invoice_row->igst_ledger_id;
					$Accounting_entries->debit = $purchase_invoice_row->igst_amount;
					$Accounting_entries->credit = 0;
					$Accounting_entries->transaction_date = $purchaseInvoice->transaction_date;
					$Accounting_entries->purchase_voucher_id = $purchaseInvoice->id;
					$Accounting_entries->company_id=$company_id;
					$this->PurchaseInvoices->AccountingEntries->save($Accounting_entries);					
					
				}
				
				
				//Accounting Entry End	
                $this->Flash->success(__('The purchase invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The purchase invoice could not be saved. Please, try again.'));
        }
	
		$SupplierLedger = $this->PurchaseInvoices->SupplierLedger->find('list')->where(['accounting_group_id'=>25,'freeze'=>0]);
        $PurchaseLedger = $this->PurchaseInvoices->PurchaseLedger->find('list')->where(['accounting_group_id'=>13,'freeze'=>0]);
		
		$CgstTax = $this->PurchaseInvoices->CgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'CGST']);
		
		$SgstTax = $this->PurchaseInvoices->SgstLedger->find()->where(['accounting_group_id'=>29,'gst_type'=>'SGST']);

		$taxtypes = $this->PurchaseInvoices->TaxTypes->find('list');
		
        $this->set(compact('purchaseInvoice','SupplierLedger','PurchaseLedger','CgstTax','SgstTax','taxtypes'));
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
		if ($this->request->is(['patch', 'post', 'put']))
		{
			$purchaseInvoice = $this->PurchaseInvoices->get($id);
			$query = $this->PurchaseInvoices->query();
				$query->update()
					->set(['status' => 1])
					->where(['id' => $id])
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
