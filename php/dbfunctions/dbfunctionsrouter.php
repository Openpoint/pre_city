<?php
if(isset($data->command)){
		if(!isset($data->level)){
			$data->level = 0;
		}
		if(!isset($data->status)){
			$data->status = null;
		}
		$myfile = fopen("/tmp/testfile.txt", "w");
		fwrite($myfile, print_r($data, TRUE));
		fclose($myfile);	
	//Getters
	if($data->command == 'getprops'){	
		//print_r(json_encode($data));

		$action=$lkbase->getprops($data->level);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getstreets'){	
		$action=$lkbase->getstreets();
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getlevelskey'){	
		$action=$lkbase->getlevelskey();
		print_r(json_encode($action));
		return;
	};
		
	if($data->command == 'getzones'){	
		$action=$lkbase->getzones();
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getffall'){	
		$action=$lkbase->getffall();
		print_r(json_encode($action));
		return;
	};	
	if($data->command == 'getagents'){	
		$action=$lkbase->getagents();
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'gettenants'){	
		$action=$lkbase->gettenants();
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'gettenant'){	
		$action=$lkbase->gettenant($data->tid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'gettenantadd'){	
		$action=$lkbase->gettenantadd($data->tid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getlevels'){	
		$action=$lkbase->getlevels($data->pid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getallvunits'){	
		$action=$lkbase->getallvunits($data->level, $data->status);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getallunits'){	
		$action=$lkbase->getallunits($data->level,$data->zid,$data->usage,$data->subusage,$data->refine,$data->status,$data->sid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getalleunits'){	
		$action=$lkbase->getalleunits($data->level,$data->zid,$data->status,$data->sid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getunits'){	
		$action=$lkbase->getunits($data->lid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getpunits'){	
		$action=$lkbase->getpunits($data->pid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getunit'){	
		$action=$lkbase->getunit($data->uid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'getlevel'){	
		$action=$lkbase->getlevel($data->lid);
		print_r(json_encode($action[0]));
		return;
	};
	if($data->command == 'getproperty'){	
		$action=$lkbase->getproperty($data->pid);
		$action[0]['agents']= json_decode($action[0]['agents']);
		//$action[0]['agents']= (array) $action[0]['agents'];
		print_r(json_encode($action[0]));
		return;

	};
	if($data->command == 'getagent'){	
		$action=$lkbase->getagent($data->aid);
		print_r(json_encode($action[0]));
		return;

	};	
	if($data->command == 'getpropbyagent'){
		$action=$lkbase->getpropbyagent($data->aid);
		print_r(json_encode($action));
		return;		
	}
	
	//Setters
	if($data->command == 'addstreet'){	
		$action=$lkbase->addstreet($data->streetname);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'addzone'){	
		$action=$lkbase->addzone($data->zoning,$data->color);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'addprop'){	
		$action=$lkbase->addprop($data->street, $data->address, $data->geom);
		$action2=$lkbase->addlevel($action, $data->zid);
		print_r(json_encode($action));
		return;
	};	
	if($data->command == 'addlevel'){	
		$action=$lkbase->addlevel($data->pid, $data->zid);
		print_r(json_encode($action));
		return;
	};

	if($data->command == 'addagent'){	
		$action=$lkbase->addagent($data->agency,$data->address1,$data->address2,$data->address3,$data->email,$data->telephone,$data->about);
		print_r(json_encode($action));
		return;
	};	
	if($data->command == 'addtenant'){	
		$action=$lkbase->addtenant($data->tenant,$data->url,$data->about,$data->zid,$data->usage,$data->subusage,$data->refine);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'addunit'){	
		$action=$lkbase->addunit($data->code,$data->tid,$data->agents,$data->geom,$data->lid,$data->status);
		print_r(json_encode($action));
		return;
	};	
	//Changers
	if($data->command == 'upditem'){	
		$action=$lkbase->upditem($data->table, $data->key, $data->keyval, $data->column, $data->colval);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'delrow'){	
		$action=$lkbase->delrow($data->table, $data->key, $data->keyval);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'delunit'){	
		$action=$lkbase->delunit($data->uid);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'deltenant'){
		$action=$lkbase->deltenant($data->tid);	
		if($action=='ok'){
			$action=$lkbase->upditem('units', 'tid', $data->tid, 'tid', null);
			print_r(json_encode($action));
			return;
		}else{
			print_r(json_encode($action));
			return;
		}
	};
	if($data->command == 'delproperty'){	
		$action=$lkbase->delunits($data->lid);
		$lkbase->delproperty($data->pid,'levels');
		$lkbase->delproperty($data->pid,'properties');
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'editunit'){	
		$action=$lkbase->editunit($data->code,$data->tid,$data->agents,$data->geom,$data->uid,$data->status);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'editlevel'){	
		$action=$lkbase->editlevel($data->lid,$data->zid,$data->area,$data->status,$data->occupancy);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'editprop'){	
		$action=$lkbase->editprop($data->pid,$data->address,$data->sid,$data->footfall,$data->agents);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'editagent'){	
		$action=$lkbase->editagent($data->aid,$data->agency,$data->address1,$data->address2,$data->address3,$data->email,$data->telephone,$data->about);
		print_r(json_encode($action));
		return;
	};
	if($data->command == 'edittenant'){	
		$action=$lkbase->edittenant($data->tid,$data->url,$data->about,$data->usage,$data->subusage,$data->zid,$data->refine,$data->tenant);
		print_r(json_encode($action));
		return;
	};
};
?>
