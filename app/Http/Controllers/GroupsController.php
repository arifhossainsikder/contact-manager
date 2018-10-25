<?php

namespace App\Http\Controllers;

use App\Group;
use Illuminate\Http\Request;

class GroupsController extends Controller
{
    public function store(Request $request){
    	$this->validate($request,[
    		'name' => 'required|unique:groups'
	    ]);
    	return Group::create($request->all());
    }
}
