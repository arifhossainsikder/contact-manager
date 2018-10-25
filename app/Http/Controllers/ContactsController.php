<?php

namespace App\Http\Controllers;

use App\Contact;
use Illuminate\Http\Request;

class ContactsController extends Controller {
	/**
	 * Display a listing of the resource.
	 *
	 * @return \Illuminate\Http\Response
	 */

	private $limit = 5;

	private $rules = [
		'name'    => [ 'required', 'min:1' ],
		'company' => [ 'required' ],
		'email'   => [ 'required', 'email' ],
	];

	public function index( Request $request ) {
//    	if ($group_id = ($request->get('group_id'))){
//		    $contacts = Contact::orderby('id','desc')->where('group_id',$group_id)->paginate($this->limit);
//	    } else{
//		    $contacts = Contact::orderby('id','desc')->paginate($this->limit);
//	    }

		$contacts = Contact::where( function ( $query ) use ( $request ) {
			if ( $group_id = ( $request->get( 'group_id' ) ) ) {
				$query->where( 'group_id', $group_id );
			}
			if ( $term = $request->get( 'term' ) ) {
				$keywords = '%' . $term . '%';
				$query->orWhere( 'name', 'LIKE', $keywords );
				$query->orWhere( 'email', 'LIKE', $keywords );
				$query->orWhere( 'company', 'LIKE', $keywords );
			}
		} )
		                   ->orderby( 'id', 'desc' )
		                   ->paginate( $this->limit );

		return view( 'contacts.index', compact( 'contacts' ) );
	}


	public function autocomplete( Request $request ) {

		return Contact::select(['id','name as value'])->where( function ( $query ) use ( $request ) {
			if ( $term = $request->get( 'term' ) ) {
				$keywords = '%' . $term . '%';
				$query->orWhere( 'name', 'LIKE', $keywords );
				$query->orWhere( 'email', 'LIKE', $keywords );
				$query->orWhere( 'company', 'LIKE', $keywords );
			}
		} )
		                   ->orderby( 'name', 'asc' )
			               ->take(5)
		                   ->get();
	}

	/**
	 * Show the form for creating a new resource.
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function create() {
		return view( 'contacts.create' );
	}

	/**
	 * Store a newly created resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function store( Request $request ) {

		$this->validate( $request, $this->rules );

		Contact::create( $request->all() );

		return redirect( 'contacts' )->with( 'message', 'Contact saved!' );
	}

	/**
	 * Display the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function show( $id ) {
		//
	}

	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function edit( $id ) {
		$contact = Contact::findOrFail( $id );

		return view( 'contacts.edit', compact( 'contact' ) );
	}

	/**
	 * Update the specified resource in storage.
	 *
	 * @param  \Illuminate\Http\Request $request
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function update( Request $request, $id ) {
		$this->validate( $request, $this->rules );

		$contact = Contact::findOrFail( $id );

		$contact->update( $request->all() );

		return redirect( 'contacts' )->with( 'message', 'Contact updated!' );
	}

	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int $id
	 *
	 * @return \Illuminate\Http\Response
	 */
	public function destroy( $id ) {
		//
	}
}
