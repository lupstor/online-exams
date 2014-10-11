<?php


class AsignacionTest extends TestCase {


    /**
     * Verifica enlace de pagina de asignacion
     *
     * @return void
     */
    public function testVerificarPaginaAsignacion()
    {
        $crawler = $this->client->request('GET', '/course/asignacion');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h3:contains("Asignar Curso")'));

    }

	/**
	 * Asigna alumno a un curso específico
	 *
	 * @return void
	 */
	public function testAsignarAlumno()
	{
        $this->call('POST', 'course/asignar/?id_alumno=1&id_curso=1');
        $this->assertResponseStatus(302);
    }

}