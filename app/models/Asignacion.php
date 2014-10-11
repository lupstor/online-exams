<?php
/**
 * Modelo de Asignaciones
 * User: hERBER
 * Date: 6/09/14
 * Time: 20:50
 */

class Asignacion  extends Eloquent{
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Asignacion';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array('remember_token');


} 