<?php
/**
 * Modelo de Detalle de evaluacion
 * User: hERBER
 * Date: 6/09/14
 * Time: 20:50
 */

class DetalleEvaluacion  extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'DetalleEvaluacion';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');

    public function evaluacion(){
        return $this->belongsTo('Evaluacion','evaluacion');
    }

    public function pregunta(){
        return $this->belongsTo('Pregunta','pregunta');
    }

} 