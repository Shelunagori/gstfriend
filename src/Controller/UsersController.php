<?php
namespace App\Controller;
use Cake\Event\Event;
use App\Controller\AppController;

/**
 * Users Controller
 *
 * @property \App\Model\Table\UsersTable $Users
 *
 * @method \App\Model\Entity\User[] paginate($object = null, array $settings = [])
 */
class UsersController extends AppController
{
	
	public function beforeFilter(Event $event)
    {
        parent::beforeFilter($event);
        $this->Auth->allow([ 'logout', 'add', 'sendotpmobile']);
    }

	public function logout()
	{
		return $this->redirect($this->Auth->logout());
	}
	
    public function login()
    {
		$this->viewBuilder()->layout('login');
        if ($this->request->is('post')) 
		{
            $user = $this->Auth->identify();
			
            if ($user) 
			{
                $this->Auth->setUser($user);
				return $this->redirect(['controller'=>'Users','action' => 'Dashboard']);
            }
			//pr($user); exit;
            $this->Flash->error(__('Invalid Username or Password'));
        }
		$user = $this->Users->newEntity();
        $this->set(compact('user'));
    }
	
	
	
	
	
    /**
     * Index method
     *
     * @return \Cake\Http\Response|void
     */
    public function index()
    {
        $users = $this->paginate($this->Users);
		
        $this->set(compact('users'));
        $this->set('_serialize', ['users']);
    }

	
	
	function sendotpmobile($smssend)
    {
		$datas = $this->Users->find()
		->where(['mobile_no'=>$smssend]);
		
		if($datas)
		{  
			$chars = "0123456789";//ABCDEFGHIJKLMNOPQRSTUVWXYZ
			$string = '';
			for ($i = 0; $i < 6; $i++) {
			 $string .= $chars[rand(0, strlen($chars) - 1)];
			}
			$query = $this->Users->query();
				$query->update()
					->set(['otp'=>$string])
					->where(['mobile_no' => $smssend])
					->execute();
			
		}	
	}
	
	
	
    /**
	
	//$sms=str_replace('', '+', 'Your One Time Password Set successfully.');
			
			//$working_key='A7a76ea72525fc05bbe9963267b48dd96';
			//$sms_sender='JAINTE';
			//$sms=str_replace(' ' , '+', $sms);
			//file_get_contents('http://alerts.sinfini.com/api/web2sms.php?workingkey='.$working_key.'&sender='.$sms_sender.'&to='.$smssend.'&message='.$sms.''.$string);
	
	
	
	
	
	
	
     * View method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|void
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function view($id = null)
    {
        $user = $this->Users->get($id, [
            'contain' => []
        ]);

        $this->set('user', $user);
        $this->set('_serialize', ['user']);
    }

    /**
     * Add method
     *
     * @return \Cake\Http\Response|null Redirects on successful add, renders view otherwise.
     */
    public function add()
    {
		$this->viewBuilder()->layout('login');
        $user = $this->Users->newEntity();
		
        if ($this->request->is('post')) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'add']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Edit method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects on successful edit, renders view otherwise.
     * @throws \Cake\Network\Exception\NotFoundException When record not found.
     */
    public function edit($id = null)
    {
		$this->viewBuilder()->layout('index_layout');
        $user = $this->Users->get($id, [
            'contain' => []
        ]);
		
        if ($this->request->is(['patch', 'post', 'put'])) {
            $user = $this->Users->patchEntity($user, $this->request->getData());
            if ($this->Users->save($user)) {
                $this->Flash->success(__('The user has been saved.'));

                return $this->redirect(['action' => 'index']);
            }
            $this->Flash->error(__('The user could not be saved. Please, try again.'));
        }
        $this->set(compact('user'));
        $this->set('_serialize', ['user']);
    }

    /**
     * Delete method
     *
     * @param string|null $id User id.
     * @return \Cake\Http\Response|null Redirects to index.
     * @throws \Cake\Datasource\Exception\RecordNotFoundException When record not found.
     */
    public function delete($id = null)
    {
        $this->request->allowMethod(['post', 'delete']);
        $user = $this->Users->get($id);
        if ($this->Users->delete($user)) {
            $this->Flash->success(__('The user has been deleted.'));
        } else {
            $this->Flash->error(__('The user could not be deleted. Please, try again.'));
        }

        return $this->redirect(['action' => 'index']);
    }
	
	public function dashboard()
    {
        $this->viewBuilder()->layout('index_layout');
		
		$company_id=$this->Auth->User('company_id');
		
		
		$last_invoice=$this->Users->Invoices->find()->select(['invoice_no'])->order(['invoice_no' => 'DESC'])->first();
		$last_voucher=$this->Users->PurchaseInvoices->find()->select(['id'])->order(['id' => 'DESC'])->first();
		 
		$this->set(compact('user','last_invoice','last_voucher'));
		$this->set('active_menu', 'Users.Dashboard');
    }
	
	
}
