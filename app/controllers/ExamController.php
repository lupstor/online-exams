<?php

class ExamController extends \BaseController
{

    /**
     * Display a listing of the resource.
     *
     * @return Response
     */
    public function index()
    {
        $examenes = Examen::all();
        $examenes->toarray();
        $this->layout->main = View::make('exam.index',compact('examenes'));

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
     * @param  int $id
     * @return Response
     */
    public function show($id)
    {
        //
    }


    /**
     * Show the form for editing the specified resource.
     *
     * @param  int $id
     * @return Response
     */
    public function edit($id)
    {
        //
    }


    /**
     * Update the specified resource in storage.
     *
     * @param  int $id
     * @return Response
     */
    public function update($id)
    {
        //
    }


    /**
     * Remove the specified resource from storage.
     *
     * @param  int $id
     * @return Response
     */
    public function destroy($id)
    {
        //
    }

    /**
     * Carga examen desde archivo csv
     */
    public function upload()
    {
        try {
            if (Input::file('file') != null &&Input::file('file')->guessClientExtension() == strtolower("csv")) {
                //Guarda examen en carpeta uploads
                Input::file('file')->move(base_path() . '/uploads/', Input::file('file')->getClientOriginalName());
                $archivo = File::get(base_path() . '/uploads/' . Input::file('file')->getClientOriginalName());
                $contenido = explode(PHP_EOL, $archivo);
                $datosExamen = explode(",", $contenido[1]);

                //Crea Examen
                $examen = new Examen();
                $examen->curso = $datosExamen[0];
                $examen->titulo = $datosExamen[1];
                $examen->n_intentos = $datosExamen[2];
                $examen->duracion = $datosExamen[3];
                $examen->hora_inicio = $datosExamen[4];
                $examen->hora_fin = $datosExamen[5];
                $examen->pregunta = $datosExamen[6];
                $examen->save();

                //Crea preguntas de examen
                $contador = 0;
                foreach ($contenido as $pregunta) {
                    if ($contador >= 3) {
                        if (!empty($pregunta)) {
                            $detallePregunta = explode(",", $pregunta);
                            $pregunta = new Pregunta();
                            $pregunta->tipo_respuesta = $detallePregunta[0];
                            $pregunta->pregunta = $detallePregunta[1];
                            $pregunta->punteo = $detallePregunta[2];
                            $pregunta->porcentaje = $detallePregunta[3];
                            $pregunta->penalizacion = $detallePregunta[4];
                            $pregunta->respuesta_correcta = $detallePregunta[5];
                            $examen->preguntas()->save($pregunta);

                            //Graba opciones de seleccion multiple
                            if ($pregunta->tipo_respuesta == 'sel_mul') {
                                $respuestasSelMult = explode(";", $detallePregunta[6]);
                                foreach ($respuestasSelMult as $opcion) {
                                    $respuesta = new Respuesta();
                                    $respuesta->respuesta = $opcion;
                                    $pregunta->respuestas()->save($respuesta);
                                }
                            }
                        }
                    }
                    $contador++;
                }
                Session::flash('message', 'Examen cargado correctamente');
            } else {
                Session::flash('error', 'Extension invalida, archivo requerido ".CSV"');
            }
        } catch (\Exception $exception) {
            Session::flash('error', 'Carga de examen no se realizo correctamente');
            Log::error(__METHOD__ . "-[" .$exception->getMessage() . "] " .$exception->getTraceAsString());
        }
        return Redirect::to('exam/upload');
    }

    /**
     * Retorna vista califcar examen
     */
    public function calificar()
    {
        return View::make('exam.calificar'); //Retorna vista calificar
    }

    /**
     * Califica un examen de acuerdo a un id de examen dado
     */
    public function calificarPerform()
    {

    }


}
