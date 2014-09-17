<?php
/**
 * Modelo de evaluaciones
 * User: hERBER
 * Date: 6/09/14
 * Time: 20:50
 */

class Evaluacion  extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Evaluacion';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');


    public function alumno(){
        return $this->belongsTo('User','alumno');
    }

    public function examen(){
        return $this->belongsTo('Examen','examen');
    }

    public function detalle(){
        return $this->hasMany('DetalleEvaluacion','evaluacion');
    }
} 