<?php

class ExamenTest extends TestCase {

    /**
     * Prueba de calificar examen
     *
     * @return void
     */
    public function testCalificar() {
        //Solicita pagina de login
        $this->client->request('GET', '/session/create');
        //Retorna el codigo de respuesta de la llamada
        $this->assertTrue($this->client->getResponse()->isOk());
    }


}
