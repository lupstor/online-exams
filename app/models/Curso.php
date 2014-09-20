<?php
/**
 * Modelo de Cursos
 * User: hERBER
 * Date: 6/09/14
 * Time: 20:50
 */

class Curso  extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Curso';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');

    public function preguntas(){
        return $this->hasMany('Pregunta','examen');
    }

    public function examenes(){
        return $this->hasMany('Examen','curso');
    }
} 