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


        $this->layout->main = View::make('exam.index', compact('examenes'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return Response
     */
    public function create()
    {

        $cursos = Curso::lists('nombre', 'id');
        $this->layout->main = View::make('exam.create', array('cursos' => $cursos));

    }

    /**
     * Store a newly created resource in storage.
     *
     * @return Response
     */
    public function store()
    {

        //Get request data
        $data = Input::all();

        Log::info(__METHOD__ . "- GUARDAR EXAMEN [" . print_r($data, true) . "] ");

        try {
            //Crea Examen
            $examen = new Examen();
            $examen->curso = $data['id_curso'];
            $examen->titulo = $data['titulo'];
            $examen->n_intentos = $data['n_intentos'];
            $examen->duracion = $data['duracion'];
            $examen->hora_inicio = $data['hora_inicio'];
            $examen->hora_fin = $data['hora_fin'];
            $examen->pregunta = $data['pregunta'];
            $examen->save();

            Session::flash('message', 'Examen creado correctamente, por favor agregar preguntas');
            return Redirect::to('exam/preguntas/' . $examen->id);

        } catch (\Exception $exception) {
            Log::error(__METHOD__ . "-[" . $exception->getMessage() . "] " . $exception->getTraceAsString());
            Session::flash('error', 'Error al guardar examen');
            return Redirect::to('exam/create');
        }

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
     * Retorna listado de preguntas de un examen dado
     *
     */
    public function preguntas($idExamen)
    {
        if (!empty($idExamen)) {
            $preguntas = Pregunta::where('examen', '=', $idExamen)->get();
            $this->layout->main = View::make('exam.preguntas', compact('preguntas', 'idExamen'));
        } else {
            Session::flash('error', 'Debe proporcionar un id de examen para visualizar las preguntas');
            return Redirect::to('exam/');
        }
    }


    /**
     * Crea una pregunta de un examen determinado
     *
     */
    public function crearPregunta($idExamen)
    {
        return View::make('exam.crear-pregunta', compact('preguntas', 'idExamen')); //Retorna vista calificar

    }


    /**
     * Guarda una pregunta de un examen determinado
     *
     */
    public function guardarPregunta($idExamen)
    {
        $data = Input::all();

        try {

            $preguntas = Pregunta::where('examen', '=', $idExamen)->get();

            $sumaPunteo = 0;
            $sumaPorcentaje = 0;
            foreach($preguntas as $pregunta){
                $sumaPunteo += $pregunta->punteo;
                $sumaPorcentaje += $pregunta->porcentaje;
            }



            $pregunta = new Pregunta();
            $pregunta->examen = $idExamen;
            $pregunta->tipo_respuesta = $data['tipo_respuesta'];
            $pregunta->pregunta = $data['pregunta'];
            $pregunta->punteo = $data['punteo'];
            $pregunta->porcentaje = $data['porcentaje'];
            $pregunta->penalizacion = $data['penalizacion'];

            if($data['tipo_respuesta'] == "directa"){
                $pregunta->respuesta_correcta = null;
            }else if($data['tipo_respuesta'] == "fv"){
                $pregunta->respuesta_correcta = $data['respuesta'];
            }else{
                $pregunta->respuesta_correcta = $data['respuesta_correcta'];
            }


            if(($sumaPunteo + $pregunta->punteo) <= 100 && ($sumaPorcentaje + $pregunta->punporcentajeteo) <=100) {
                $pregunta->save();
                if ($data['tipo_respuesta'] == "sel_mul") {
                    $respuestasSelMult = explode(",", $data['respuestas']);
                    foreach ($respuestasSelMult as $opcion) {
                        $respuesta = new Respuesta();
                        $respuesta->respuesta = trim($opcion);
                        $pregunta->respuestas()->save($respuesta);
                    }
                }

                Session::flash('message', 'Pregunta creada correctamente');
                return Redirect::to('exam/preguntas/' . $idExamen);
            }else{
                Session::flash('error', 'No se pudo crear pregunta, suma de punteo o porcentaje mayor 100');
                return Redirect::to('exam/preguntas/' . $idExamen);
            }
        } catch (\Exception $exception) {
            Log::error(__METHOD__ . "-[" . $exception->getMessage() . "] " . $exception->getTraceAsString());
            Session::flash('error', 'Error al crear pregunta');
            return Redirect::to('exam/preguntas/' . $idExamen);
        }
    }


    /**
     * Carga examen desde archivo csv
     */
    public function upload()
    {
        try {
            if (Input::file('file') != null && Input::file('file')->guessClientExtension() == strtolower("csv")) {
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
            Log::error(__METHOD__ . "-[" . $exception->getMessage() . "] " . $exception->getTraceAsString());
        }
        return Redirect::to('exam/upload');
    }

    /**
     * Retorna vista de calificacion de una evaluacion
     */
    public function calificacion()
    {


        $params = Input::all();
        Log::info(__METHOD__ . "-PARAMETROS[" . print_r($params, true) . "] ");

        $idEvaluacion = $params['id_evaluacion'];
        //$evaluacion = Evaluacion::find($idEvaluacion);
        $detalle = DetalleEvaluacion::where('evaluacion', '=', $idEvaluacion)->get();


        Log::info(__METHOD__ . "-ID EVALUACION[" . $idEvaluacion . "] ");

        $evalu = Evaluacion::all();
        $evalu->toarray();

        return $this->layout->main = View::make('exam.calificacion', compact('idEvaluacion','evalu','params','detalle')); //Retorna vista calificar
    }

    /**
     * Califica una evaluacion de acuerdo a un id de evaluacion dado
     */
    public function calificar()
    {
        $postData = Input::all();
        Log::info(__METHOD__ . "-TESTING   10 EVALUACION[" . print_r($postData, true) . "] ");

        if ($postData['id_evaluacion'] == "1") {
            return Redirect::to('exam/evaluaciones');
        } else {
            return Redirect::to('exam/calificar');
        }
    }

    /**
     * Retorna vista de listado de evaluaciones
     */
    public function evaluaciones()
    {
        $evaluaciones = Evaluacion::all();
        $evaluaciones->toarray();
        $this->layout->main = View::make('exam.evaluaciones', compact('evaluaciones'));
    }

    /*
     * Retorna la vista del examen con id = al parrametro que se envia
     *
     */

    public function crearExamen($idexamen)
    {
        $exampreguntas = Examen::find($idexamen);
        $varexamen = $exampreguntas->preguntas;

        //$varexamen->toarray();
        //Log::info(printr(Examen::find( $idexamen )->preguntas(), true));
        //$this->layout->main = View::make('exam.takexame', compact('$exampreguntas'),array('$varexamen'=>$varexamen));
        $this->layout->main = View::make('exam.takexame', compact('varexamen', 'exampreguntas'));
    }

}
