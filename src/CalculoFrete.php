<?php

namespace Prhost\Jamef;

class CalculoFrete
{
    /**
     * @var string
     */
    protected $url_soap = 'http://www.jamef.com.br/webservice/JAMW0520.apw?WSDL';

    /**
     * @var string
     */
    protected $method = 'JAMW0520_05';

    /**
     * Verifique abaixo os códigos das filiais Jamef (FILCOT)
     *
     * @var array
     */
    protected $filiais = [
        [
            'filial' => 'AJU',
            'localizacao' => 'Aracaju/ SE',
            'codigo' => '31'
        ],
        [
            'filial' => 'BAR',
            'localizacao' => 'Barueri / SP',
            'codigo' => '19'
        ],
        [
            'filial' => 'BAU',
            'localizacao' => 'Bauru / SP',
            'codigo' => '16'
        ],
        [
            'filial' => 'BHZ',
            'localizacao' => 'Belo Horizonte / MG',
            'codigo' => '02'
        ],
        [
            'filial' => 'BNU',
            'localizacao' => 'Blumenau / SC',
            'codigo' => '09'
        ],
        [
            'filial' => 'BSB',
            'localizacao' => 'Brasília / DF',
            'codigo' => '28'
        ],
        [
            'filial' => 'CCM',
            'localizacao' => 'Criciúma / SC',
            'codigo' => '26'
        ],
        [
            'filial' => 'CPQ',
            'localizacao' => 'Campinas / SP',
            'codigo' => '03'
        ],
        [
            'filial' => 'CXJ',
            'localizacao' => 'Caxias do Sul / RS',
            'codigo' => '22'
        ],
        [
            'filial' => 'CWB',
            'localizacao' => 'Curitiba / PR',
            'codigo' => '04'
        ],
        [
            'filial' => 'DIV',
            'localizacao' => 'Divinópolis / MG',
            'codigo' => '38'
        ],
        [
            'filial' => 'FES',
            'localizacao' => 'Feira de Santana / BA',
            'codigo' => '34'
        ],
        [
            'filial' => 'FLN',
            'localizacao' => 'Florianópolis / SC',
            'codigo' => '11'
        ],
        [
            'filial' => 'FOR',
            'localizacao' => 'Fortaleza / CE',
            'codigo' => '32'
        ],
        [
            'filial' => 'GYN',
            'localizacao' => 'Goiânia / GO',
            'codigo' => '24'
        ],
        [
            'filial' => 'JPA',
            'localizacao' => 'João Pessoa / PB',
            'codigo' => '36'
        ],
        [
            'filial' => 'JDF',
            'localizacao' => 'Juiz de Fora / MG',
            'codigo' => '23'
        ],
        [
            'filial' => 'JOI',
            'localizacao' => 'Joinville / SC',
            'codigo' => '08'
        ],
        [
            'filial' => 'LDB',
            'localizacao' => 'Londrina / PR',
            'codigo' => '10'
        ],
        [
            'filial' => 'MAO',
            'localizacao' => 'Manaus / AM',
            'codigo' => '25'
        ],
        [
            'filial' => 'MCZ',
            'localizacao' => 'Maceió / AL',
            'codigo' => '33'
        ],
        [
            'filial' => 'MGF',
            'localizacao' => 'Maringá / PR',
            'codigo' => '12'
        ],
        [
            'filial' => 'POA',
            'localizacao' => 'Porto Alegre / RS',
            'codigo' => '05'
        ],
        [
            'filial' => 'PSA',
            'localizacao' => 'Pouso Alegre / MG',
            'codigo' => '27'
        ],
        [
            'filial' => 'RAO',
            'localizacao' => 'Ribeirão Preto / SP',
            'codigo' => '18'
        ],
        [
            'filial' => 'REC',
            'localizacao' => 'Recife / PE',
            'codigo' => '30'
        ],
        [
            'filial' => 'RIO',
            'localizacao' => 'Rio de Janeiro / RJ',
            'codigo' => '06'
        ],
        [
            'filial' => 'SAO',
            'localizacao' => 'São Paulo / SP',
            'codigo' => '07'
        ],
        [
            'filial' => 'SJK',
            'localizacao' => 'São José dos Campos / SP',
            'codigo' => '21'
        ],
    ];

    /**
     * Calcula o frete junto com a Jamef
     *
     * @param Objeto $objeto
     * @return \stdClass
     * @throws ExceptionJamef()
     */
    public function calc(Objeto $objeto): \stdClass
    {
        $client = new \SoapClient($this->url_soap, [
            "trace" => 1, "exception" => 0
        ]);

        $result = $client->__soapCall($this->method, [
            $this->method => $this->getParams($objeto)
        ], NULL);

        return $this->prepareResult($result);
    }

    /**
     * Prepara o resultado que veio da Jamef
     *
     * @param \stdClass $result
     * @return \stdClass
     * @throws ExceptionJamef()
     */
    protected function prepareResult(\stdClass $result): \stdClass
    {
        if (property_exists($result, 'JAMW0520_05RESULT')) {

            if (property_exists($result->JAMW0520_05RESULT, 'MSGERRO') &&
                strpos($result->JAMW0520_05RESULT->MSGERRO, 'Ok -') === false) {
                $errors = $result->JAMW0520_05RESULT->MSGERRO;
                $errors = explode(';', $errors);
                throw new ExceptionJamef($errors[0]);
            } else {

                $avalfree = $result->JAMW0520_05RESULT->VALFRE->AVALFRE;

                if (count($avalfree) > 1) {

                    foreach ($avalfree as $val) {
                        if ($val->COMPONENTE == 'TF-TOTAL DO FRETE') {
                            return $val;
                        }
                    }

                    throw new ExceptionJamef('Ocorreu algum erro ao calcular o frete com a Jamef');

                } else {
                    throw new ExceptionJamef('Ocorreu algum erro ao calcular o frete com a Jamef');
                }
            }

        } else {
            throw new ExceptionJamef('Ocorreu algum erro ao calcular o frete com a Jamef');
        }
    }

    /**
     * Busca filial pelo codigo
     *
     * @param int $codigo
     * @return array
     */
    public function getFilialByCodigo(int $codigo): array
    {
        foreach ($this->filiais as $filial) {
            if ($filial['codigo'] == $codigo) {
                return $filial;
            }
        }

        return [];
    }

    /**
     * Paramentros a serem passados para a Jamef
     *
     * @param Objeto $objeto
     * @return array
     */
    public function getParams(Objeto $objeto)
    {

        return [
            'TIPTRA' => $objeto->getTiptra(),
            'CNPJCPF' => $objeto->getCnpjcpf(),
            'MUNORI' => $objeto->getMunori(),
            'ESTORI' => $objeto->getEstori(),
            'CEPDES' => $objeto->getCepdes(),
            'CNPJDES' => $objeto->getCnpjdes(),
            'SEGPROD' => $objeto->getSegprod(),
            'QTDVOL' => $objeto->getQtdvol(),
            'PESO' => $objeto->getPeso(),
            'VALMER' => $objeto->getValmer(),
            'METRO3' => $objeto->getMetro3(),
        ];
    }
}