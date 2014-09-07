<?php

class SessionController extends \BaseController {

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function create() {
        $this->layout->main = View::make('session.create');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function store() {

      //Get request data
        $postData = Input::all();
        //Equivale a login
        if ($postData['usuario'] == "ayd1") {
            Session::flash('message', 'Bienvenido ' . $postData['usuario']);
            return Redirect::to('home');
        } else {
            Session::flash('error', 'Usuario o password invalido');
            return Redirect::to('session/create');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return Response
     */
    public function destroy($id) {
        //
    }

}
