<?php

use Alumno;

class LoginTest extends TestCase {

	/**
	 * Prueba de conectividad de login
	 *
	 * @return void
	 */
	public function testLoginConnection()
	{
        //Solicita pagina de login
        $this->client->request('GET', '/session/create');
        //Retorna el codigo de respuesta de la llamada
        $this->assertTrue($this->client->getResponse()->isOk());
	}


    /**
     * Prueba de autenticacion
     *
     * @return void
     */
    public function testAutenthication()
    {
        //$postData = array('usuario' => 'ayd1','password' => 'ayd1');
        //$postRequest = $this->action('POST', '/session/create', array(), array(), array(), array(), json_encode($postData));
        //$this->assertTrue($this->client->getResponse()->isOk());
    }

}
