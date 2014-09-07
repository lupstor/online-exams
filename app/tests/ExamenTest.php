<?php

use Alumno;

class ExamenTest extends TestCase {

	/**
	 * Califica examen de respuestas falso/verdadero y seleccion multiple
	 *
	 * @return void
	 */
	public function testCalificarExamen()
	{
        //Solicita pagina de login
        $this->client->request('GET', '/exam/calificar');
        //Retorna el codigo de respuesta de la llamada
        $this->assertTrue($this->client->getResponse()->isOk());
	}


}
