<?php
namespace App\Controller;

use App\Controller\AppController;

/**
 * Invoices Controller
 *
 * @property \App\Model\Table\InvoicesTable $Invoices
 *
 * @method \App\Model\Entity\Invoice[] paginate($object = null, array $settings = [])
 */
class InvoicesController extends AppController
{

    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
		$this->viewBuilder()->layout('index_layout');
		$invoic = $this->Invoices->find('all',['contain'=>['CustomerLedgers'=>['Customers'], 'SalesLedgers']])->order(['Invoices.id'=>'DESC']);
	
        $invoices = $this->paginate($invoic);
        $this->set(compact('invoices'));
        $this->set('_serialize', ['invoices']);
		$this->set('active_menu','Invoices.Index');
    }

    /**
     * View method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $invoice = $this->Invoices->get($id, [
            'contain' => ['CustomerLedgers'=>['Customers'], 'SalesLedgers', 'InvoiceRows'=>['Items','TaxCGST','TaxSGST']]
        ]);
		//pr($invoice->toArray());exit;
        $this->set('invoice', $invoice);
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('index_layout');
        $invoice = $this->Invoices->newEntity();
		$company_id=$this->Auth->User('company_id');
        if ($this->request->is('post')) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
			//Invoice Number Increment
			$last_invoice=$this->Invoices->find()->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
			if($last_invoice){
				$invoice->invoice_no=$last_invoice->invoice_no+1;
			}else{
				$invoice->invoice_no=1;
			}
			//pr($invoice->invoicetype); exit;
            if ($this->Invoices->save($invoice)) {
				
				if($invoice->invoicetype == 'Cash')
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = 29;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				else
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = $invoice->customer_ledger_id;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				
				if($invoice->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice->sales_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice->total_amount_before_tax;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);				
				}				
				
				
				foreach($invoice->invoice_rows as $invoice_row)
				{
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->cgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->cgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->sgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->sgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
				}
				
				
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'Add']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }
        $customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0]);
        $salesLedgers = $this->Invoices->SalesLedgers->find('list')->where(['accounting_group_id'=>14,'freeze'=>0]);
        $items_datas = $this->Invoices->InvoiceRows->Items->find()->where(['freezed'=>0]);
        $customer_discounts = $this->Invoices->InvoiceRows->Items->find();
	
		$tax_CGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'CGST']);
		
		
		
		
		
		foreach($tax_CGSTS as $tax_CGST)
		{
			$taxs_CGST[]=['value'=>$tax_CGST->id,'text'=>$tax_CGST->name,'tax_rate'=>$tax_CGST->tax_percentage];
		}		
		
		$tax_SGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'SGST']);
		
		foreach($tax_SGSTS as $tax_SGST)
		{
			$taxs_SGST[]=['value'=>$tax_SGST->id,'text'=>$tax_SGST->name,'tax_rate'=>$tax_SGST->tax_percentage];
		}		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->price,'cgst_ledger_id'=>$items_data->cgst_ledger_id,'sgst_ledger_id'=>$items_data->sgst_ledger_id];
		}
//pr($items->toArray()) ;
        $this->set(compact('invoice', 'customerLedgers', 'salesLedgers', 'items','taxs_CGST','taxs_SGST'));
        $this->set('_serialize', ['invoice']);
		$this->set('active_menu', 'Invoices.Add');
    }
	
	
	function CustomerDiscount($customer_id,$item_id){
		
		$CustomerDiscounts = $this->Invoices->InvoiceRows->Items->ItemDiscounts->find()->where(['ItemDiscounts.customer_ledger_id'=>$customer_id,'ItemDiscounts.item_id'=>$item_id]);
		$CustomerDiscount = 0;
		if(!empty($CustomerDiscounts))
		{	
			foreach($CustomerDiscounts as $CustomerDis)
			{
				$CustomerDiscount = $CustomerDis->discount;
			}
		}
		else
		{
			$CustomerDiscount = 0;
		}
		 echo $CustomerDiscount; exit;
		
	}
	

    /**
     * Edit method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $invoice = $this->Invoices->get($id, [
            'contain' => ['InvoiceRows']
        ]);
		$company_id=$this->Auth->User('company_id');
		
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $invoice = $this->Invoices->patchEntity($invoice, $this->request->getData());
            
			if ($this->Invoices->save($invoice)) {
				$query = $this->Invoices->AccountingEntries->query();
				$query->delete()->where(['invoice_id'=> $id])->execute();
				
				if($invoice->invoicetype == 'Cash')
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = 29;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}
				else
				{
					if($invoice->total_amount_after_tax !=0)
					{		
						$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
						$Accounting_entries->ledger_id = $invoice->customer_ledger_id;
						$Accounting_entries->debit = $invoice->total_amount_after_tax;
						$Accounting_entries->credit = 0;
						$Accounting_entries->transaction_date = $invoice->transaction_date;
						$Accounting_entries->company_id=$company_id;
						$Accounting_entries->invoice_id = $invoice->id;
						$this->Invoices->AccountingEntries->save($Accounting_entries);				
					}					
				}

				if($invoice->total_amount_before_tax !=0)
				{		
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice->sales_ledger_id;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice->total_amount_before_tax;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);				
				}				
				
				
				foreach($invoice->invoice_rows as $invoice_row)
				{
					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->cgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->cgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);

					$Accounting_entries = $this->Invoices->AccountingEntries->newEntity();
					$Accounting_entries->ledger_id = $invoice_row->sgst_rate;
					$Accounting_entries->debit = 0;
					$Accounting_entries->credit = $invoice_row->sgst_amount;
					$Accounting_entries->transaction_date = $invoice->transaction_date;
					$Accounting_entries->company_id=$company_id;
					$Accounting_entries->invoice_id = $invoice->id;
					$this->Invoices->AccountingEntries->save($Accounting_entries);
					
				}

					
                $this->Flash->success(__('The invoice has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The invoice could not be saved. Please, try again.'));
        }

        $customerLedgers = $this->Invoices->CustomerLedgers->find('list')->where(['accounting_group_id'=>22,'freeze'=>0]);
        $salesLedgers = $this->Invoices->SalesLedgers->find('list')->where(['accounting_group_id'=>14,'freeze'=>0]);
        $items_datas = $this->Invoices->InvoiceRows->Items->find()->where(['freezed'=>0]);
		$tax_CGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'CGST']);

		foreach($tax_CGSTS as $tax_CGST)
		{
			$taxs_CGST[]=['value'=>$tax_CGST->id,'text'=>$tax_CGST->name,'tax_rate'=>$tax_CGST->tax_percentage];
		}		
		
		$tax_SGSTS = $this->Invoices->SalesLedgers->find()->where(['accounting_group_id'=>30,'gst_type'=>'SGST']);
		
		foreach($tax_SGSTS as $tax_SGST)
		{
			$taxs_SGST[]=['value'=>$tax_SGST->id,'text'=>$tax_SGST->name,'tax_rate'=>$tax_SGST->tax_percentage];
		}		
		
		foreach($items_datas as $items_data)
		{
			$items[]=['value'=>$items_data->id,'text'=>$items_data->name,'rate'=>$items_data->price,'cgst_ledger_id'=>$items_data->cgst_ledger_id,'sgst_ledger_id'=>$items_data->sgst_ledger_id];
		}		
		//pr($invoice->toArray()); exit;
        $this->set(compact('invoice','customerLedgers','salesLedgers','items','taxs_CGST','taxs_SGST'));
        $this->set('_serialize', ['invoice']);
    }

    /**
     * Delete method
     *
     * @param string|null $id Invoice id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $invoice = $this->Invoices->get($id);
        if ($this->Invoices->delete($invoice)) {
            $this->Flash->success(__('The invoice has been deleted.'));
        } else {
            $this->Flash->error(__('The invoice could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
}
