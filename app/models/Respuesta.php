<?php
/**
 * Functionality
 * Date: 8/27/14, Time: 4:36 PM
 * @author hvasquez
 * @copyright Usac
 */

class Respuesta extends Eloquent {
    /**
     * The database table used by the model.
     *
     * @var string
     */
    protected $table = 'Respuesta';

    /**
     * The attributes excluded from the model's JSON form.
     *
     * @var array
     */
    protected $hidden = array( 'remember_token');

    public function pregunta(){
        return $this->belongsTo('Pregunta','pregunta');
    }


}