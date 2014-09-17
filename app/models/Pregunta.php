<?php

class Pregunta extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Pregunta';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array( 'remember_token');

    public function examen(){
        return $this->belongsTo('Examen','examen');
    }

    public function respuestas(){
        return $this->hasMany('Respuesta','pregunta');
    }
}
