<?php


class EvaluacionTest extends TestCase {

	/**
	 * Retorna el listado de evaluaciones previo a calificar dicha evaluacion
	 *
	 * @return void
	 */
	public function testListadoEvaluaciones()
	{
        $crawler = $this->client->request('GET', '/exam/evaluaciones');
        $this->assertTrue($this->client->getResponse()->isOk());
        $this->assertCount(1, $crawler->filter('h3:contains("Listado De Evaluaciones")'));
	}


    /**
     * Califica evaluacion de acuerdo a un id dado
     *
     * @return void
     */
    public function testCalificarEvaluacion()
    {
        $response = $this->call('GET', '/exam/calificar?id_evaluacion=1');
        $this->assertResponseOk();

    }


}