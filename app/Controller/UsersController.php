<?php
App::uses('CakeEmail', 'Network/Email');


class UsersController extends AppController {
		
		public $components = array('Auth','Session', 'Cookie');
		public $helpers = array('Form', 'Html', 'Js', 'Time', 'Session');
		public $uses = array('User');
	
	    public function beforeFilter()
        {
                parent::beforeFilter();
                $this->Auth->allow(array('__sendPasswordChangedEmail','__sendForgotPasswordEmail','__generatePasswordToken','reset_password_token','forgot_password','login','logout','signup','edit','index','delete'));
        }
		
		public function login() {
		
		//if already logged-in, redirect
		if($this->Session->check('Auth.User')){
			$this->redirect(array('controller' => 'stocks','action' => 'index'));		
		}
		
		// if we get the post information, try to authenticate
		if ($this->request->is('post')) {
			if ($this->Auth->login()) {
				 if ((!empty($this->data)) && (!empty($this->data['User']['remember_me']))) {
						$year = time() + 31536000;
						$cookie = array();
						$cookie['username'] = $this->data['User']['username'];	
						$cookie['password'] = $this->data['User']['password'];
						$this->Cookie->write('remember_me', $cookie, true, $year);
						$this->set('$cookie',$cookie);
				}
					$this->redirect($this->Auth->redirectUrl());
					$this->redirect(array('controller' => 'stocks','action' => 'index'));		
		
			}
			else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
				$user = $this->Cookie->read('remember_me');
				$this->set('user', $user); 
				$this->set('checked', 1);
				$this->redirect(array('controller' => 'stocks','action' => 'index'));		
		
		}			
				
	}
	
	 function forgot_password() {
        if (!empty($this->data)) {
            $user = $this->User->findByUsername($this->data['User']['username']);
            if (empty($user)) {
                $this->Session->setflash('Sorry, the username entered was not found.');
                $this->redirect('/users/forgot_password');
            } else {
                $user = $this->__generatePasswordToken($user);
                if ($this->User->save($user) && $this->__sendForgotPasswordEmail($user['User']['id'])) {
                    $this->Session->setflash('Password reset instructions have been sent to your email address.
						You have 24 hours to complete the request.');
                    $this->redirect('/users/login');
                }
            }
        }
    }

	  function reset_password_token($reset_password_token = null) {
				
			if (empty($this->data)) {
				
            $this->data = $this->User->findByResetPasswordToken($reset_password_token);
           
					if ((!empty($this->data['User']['reset_password_token'])) && (!empty($this->data['User']['token_created_at'])) && ($this->__validToken($this->data['User']['token_created_at']))) {
						//$this->data['User']['id'] = null;
						$_SESSION['token'] = $reset_password_token;
					  
					  } 
					 else
					 {
						$this->Session->setflash('The password reset request has either expired or is invalid.');
						$this->redirect('/users/login');
					}
        } else {
				$token = $this->User->findByResetPasswordToken($this->data['User']['reset_password_token']);
				if (($this->data['User']['reset_password_token']) !== ($token['User']['reset_password_token'])) {
                $this->Session->setflash('The password reset request has either expired or is in-valid.');
                $this->redirect('/users/login');
				}
					$user = $this->User->findByResetPasswordToken($this->data['User']['reset_password_token']);
					$this->User->id = $user['User']['id'];
					//print_r($this->data);die();
				     if ((!empty($this->data['User']['new_passwd'])) && (!empty($this->data['User']['confirm_passwd'])))
                        {

                            if($this->data['User']['new_passwd'] != $this->data['User']['confirm_passwd']) 
                            {
                            $this->Session->setFlash(__('Your passwords do not match.', true));
                            }
                            else
                            {
										if ($this->User->save($this->data, array('validate' => 'only'))) {
										//$this->data['User']['reset_password_token'] = $this->data['User']['token_created_at'] = null;
										if ($this->User->save($this->data) && $this->__sendPasswordChangedEmail($user['User']['id'])) {
											//unset($_SESSION['token']);
											$this->Session->setflash('Your password was changed successfully. Please login to continue.');
											$this->redirect('/users/login');
										}
									}
							}
						}
			       }
    }
	
	 function __generatePasswordToken($user) {
        if (empty($user)) {
            return null;
        }
        // Generate a random string 100 chars in length.
        $token = "";
        for ($i = 0; $i < 100; $i++) {
            $d = rand(1, 100000) % 2;
            $d ? $token .= chr(rand(33,79)) : $token .= chr(rand(80,126));
        }
        (rand(1, 100000) % 2) ? $token = strrev($token) : $token = $token;
        // Generate hash of random string
        $hash = Security::hash($token, 'sha256', true);;
        for ($i = 0; $i < 20; $i++) {
            $hash = Security::hash($hash, 'sha256', true);
        }
        $user['User']['reset_password_token'] = $hash;
        $user['User']['token_created_at']     = date('Y-m-d H:i:s');
        return $user;
    }
    
    function __validToken($token_created_at) {
        $expired = strtotime($token_created_at) + 86400;
        $time = strtotime("now");
		//print_r($time);
		//echo "</br>";
		//print_r($expired);die();
        if ($time < $expired) {
            return true;
        }
        return false;
    }

	
	function __sendForgotPasswordEmail($id = null) {
        if (!empty($id)) {
            $this->User->id = $id;
            $User = $this->User->read();
			$Email = new CakeEmail();
            $mail = $User['User']['email'];
			$Email->to($mail);
			$Email->from("app@homescapesonline.com");
			$Email->emailFormat('html');
			$Email->subject('Password Reset Request - DO NOT REPLY');
			$Email->template('reset_password_request');
			$Email->replyTo("app@homescapesonline.com"); 
			$token = $User['User']['reset_password_token'];
			$username = $User['User']['username'];
			$Email->viewVars(compact('token','username'));
            $Email->send();
            return true;
        }
        return false;
    }
	
	    function __sendPasswordChangedEmail($id = null) {
        if (!empty($id)) {
            $this->User->id = $id;
            $User = $this->User->read();
			$Email = new CakeEmail();
            $mail = $User['User']['email'];
			$Email->to($mail);
			$Email->from("app@homescapesonline.com");
			$Email->emailFormat('html');
			$Email->subject('Password change success - DO NOT REPLY');
			$Email->template('password_reset_success');
			$Email->replyTo("app@homescapesonline.com"); 
			$pass = $User['User']['password'];
			$username = $User['User']['username'];
			$Email->viewVars(compact('pass','username'));
            $Email->send();			
            return true;
        }
        return false;
    }
	
	function logout() {		
		$this->Session->destroy();
		$this->redirect($this->Auth->logout());
	}
	
	/*public function admin_login() {
		$this->layout = 'admin';		
		if ($this->request->is('post')) {
			if (($this->Auth->login()) && ((!empty($this->data))) && (($this->data['User']['username']=='admin'))) {
			$this->redirect(array('controller' => 'users','action' => 'index'));		
			}
			else {
				$this->Session->setFlash(__('Invalid username or password'));
			}
		}
					
		

	}
	public function admin_logout() {
	$this->Session->destroy();
	$this->redirect(array('controller' => 'users','action' => 'login'));		
	}
	*/
	
     function index() {
	
		$this->paginate = array(
			'limit' => 100,
			'order' => array('User.username' => 'asc' )
		);
		$users = $this->paginate('User');
		$this->set(compact('users'));
    }

	 function signup() {

                if (!empty($this->data))
                {
                        if ((!empty($this->data['User']['password'])) && (!empty($this->data['User']['password_confirm'])))
                        {

                            if($this->data['User']['password'] != $this->data['User']['password_confirm']) 
                            {
                            $this->Session->setFlash(__('Your passwords do not match.', true));
                            }
                            else
                            {
                               $this->User->create($this->data);
                                if ($this->User->save($this->data))
                                {
                                    $this->Session->setFlash(__('The user has been created successfully.', true));
                                    $this->redirect(array('controller' => 'users','action' => 'login'));
                                } 
                                else
                                {
                                 $this->Session->setFlash(__('The user could not be saved. Please try again.', true));
                                }
                            }												
                        }			
                        else
                        {
                        $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
                        }	
                }
                    
            }



    

    function edit($id = null) 
            {
			
				
                    if (!$id && empty($this->data))
                    {
                        $this->Session->setFlash(__('Invalid user', true));
                        $this->redirect(array('action' => 'index'));
                    }
                    if (!empty($this->data))
                    {
                        $user = $this->Session->read('User.username');
                        $someone = $this->User->findById($this->User->id);
                            if (!empty($this->data['User']['password_update']))
                            {
                                if($this->data['User']['password_update'] != $this->data['User']['password_confirm']) 
                                {
                                 $this->Session->setFlash(__('Your passwords do not match.', true));
                                }
                                else
                                {                           
                                    
                                    if ($this->User->save($this->data))
                                    {
                                        $this->Session->setFlash(__('The user has been updated successfully.', true));
                                         $this->redirect(array('action' => 'index'));
                                    } 
                                    else
                                    {
                                        $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
                                    }
                                }												
                            }			
                            else
                            {
                                if ($this->User->save($this->data))
                                {
                                    $this->Session->setFlash(__('The user has been updated successfully.', true));
                                    $this->redirect(array('action' => 'index'));
                                } 
                                else
                                {
                                    $this->Session->setFlash(__('ERROR!! Please check the fields and try again.', true));
                                }	
                            }
                    }
                        if (empty($this->data))
                        {
                            $this->data = $this->User->read(null, $id);
                        }
                    $users = $this->User->find('list');
                    $this->set(compact('users'));
            }


     function delete($id = null) {
	
		if (!$id) {
                    $this->Session->setFlash(__('Invalid id for user', true));
                    $this->redirect(array('controller' => 'users','action'=>'index'));
                }
                if ($this->User->delete($id)) {
                    $this->Session->setFlash(__('The user was deleted successfully!', true));
                    $this->redirect(array('controller' => 'users','action'=>'index'));
                }
                 $this->Session->setFlash(__('ERROR!! The user could not be deleted!', true));
                 $this->redirect(array('controller' => 'users','action' => 'index'));
            }
	
}

?>