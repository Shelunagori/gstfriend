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
        $purchaseInvoices = $this->paginate($this->PurchaseInvoices);

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
			//pr($purchaseInvoice);  exit;
			
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

						if($gst_id->gst_type == 'SGST')
						{
							$purchaseInvoice->sgst_ledger_id = $input_gst_id->id;
						}
						
						if($gst_id->gst_type == 'IGST')
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
            if ($this->PurchaseInvoices->save($purchaseInvoice)) {
				
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

						if($gst_id->gst_type == 'SGST')
						{
							$purchaseInvoice->sgst_ledger_id = $input_gst_id->id;
						}
						
						if($gst_id->gst_type == 'IGST')
						{
							$purchaseInvoice->igst_ledger_id = $input_gst_id->id;
						}						
						
					}
				}
			}
				
				
				
				
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
        $this->request->allowMethod(['post', 'delete']);
        $purchaseInvoice = $this->PurchaseInvoices->get($id);
        if ($this->PurchaseInvoices->delete($purchaseInvoice)) {
            $this->Flash->success(__('The purchase invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The purchase invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
