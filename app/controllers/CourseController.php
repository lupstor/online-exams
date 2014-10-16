<?php

class CourseController extends \BaseController {

	/**
	 * Display a listing of the resource.
	 *
	 * @return Response
	 */
	public function index()
	{
		//
	}


	/**
	 * Show the form for creating a new resource.
	 *
	 * @return Response
	 */
	public function create()
	{
		//
	}


	/**
	 * Store a newly created resource in storage.
	 *
	 * @return Response
	 */
	public function store()
	{
		//
	}


	/**
	 * Display the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function show($id)
	{
		//
	}


	/**
	 * Show the form for editing the specified resource.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function edit($id)
	{
		//
	}


	/**
	 * Update the specified resource in storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function update($id)
	{
		//
	}


	/**
	 * Remove the specified resource from storage.
	 *
	 * @param  int  $id
	 * @return Response
	 */
	public function destroy($id)
	{
		//
	}


    /**
     * Asigna un alumno a un curso
     */
    public function asignar()
    {

        //Get request data
        $data = Input::all();
        Log::info(__METHOD__ . "- Crear Asignacion [" . print_r($data, true) . "] ");        

        try {
            //Crea Asingacion
            $asignacion = new Asignacion();
            $asignacion->curso = $data['id_curso'];
            $asignacion->alumno = $data['id_alumno'];
            $asignacion->save();
            Session::flash('message', 'Asignacion realizada correctamente');           
            return Redirect::to('course/asignacion');
        } catch (\Exception $exception) {
            Log::error(__METHOD__ . "-[" . $exception->getMessage() . "] " . $exception->getTraceAsString());
            Session::flash('error', 'Error al crear asignacion');
            return Redirect::to('course/asignacion');
        }
    }


}
