<?php

class HomeController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
            $this->layout->main = View::make('home.index');
	}



}
