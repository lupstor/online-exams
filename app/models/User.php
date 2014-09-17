<?php

class User extends Eloquent {

    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Usuario';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('password', 'remember_token');
    protected $fillable = array('usuario','password', 'nombre', 'email',"rol");

    public function evaluaciones(){
        return $this->hasMany('Evaluacion','alumno');
    }

}
