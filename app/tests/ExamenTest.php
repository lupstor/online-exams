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

    /**
     * Prueba de crear examen
     *
     * @return void
     */
    public function testCrearExamen() {
        $this->call('POST', '/exam?id_curso=1&titulo=Examen de prueba&n_intentos=2&duracion=60&hora_inicio=20:30&hora_fin=20:50&pregunta=clave');
        $this->assertResponseStatus(302);
    }


    /**
     * Prueba de crear examen
     *
     * @return void
     */
    public function testCrearPregunta() {
        $this->call('POST', '/exam/guardarPregunta?tipo_respuesta=fv&titulo=Examen de prueba&n_intentos=2&duracion=60&hora_inicio=20:30&hora_fin=20:50&pregunta=clave');
        $this->assertResponseStatus(302);
    }


}
