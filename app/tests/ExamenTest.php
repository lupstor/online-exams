<?php

class ExamenTest extends TestCase {


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
        $this->call('POST', 'exam/preguntas/guardar-pregunta/12?tipo_respuesta=fv&pregunta=Pregunta de preuba?&punteo=5&porcentaje=0&penalizacion=00&respuesta=F');
        $this->assertResponseStatus(302);
    }


}
