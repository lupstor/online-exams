<?php

class Examen extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Examen';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');

    public function preguntas(){
        return $this->hasMany('Pregunta','examen');
    }
}
