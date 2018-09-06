<?php

namespace Prhost\Jamef;

class Objeto
{
    /**
     * Tipo de transporte ou tipo de frete escolhido pelo
     *
     * @var int
     */
    protected $tiptra;

    /**
     * CNPJ do cliente que será responsável pelo
     * pagamento
     *
     * @var string
     */
    protected $cnpjcpf;

    /**
     * Nome do Município de origem da Mercadoria. Mesmo
     * Munícipio do Cliente Responsável.
     *
     * @var string
     */
    protected $munori;

    /**
     * Sigla do Estado de origem.
     *
     * @var string
     */
    protected $estori;

    /**
     * CEP de destino
     *
     * @var int
     */
    protected $cepdes;

    /**
     * Tipo de Produto a ser transportado.
     * Para frete rodoviário:
     * 000004-CONFORME NOTA FISCAL
     * 000005-LIVROS
     * Para frete aéreo:
     * 000010-ALIMENTOS INDUSTRIALIZADOS
     * 000008-CONFECCOES
     * 000004-CONFORME NOTA FISCAL
     * 000011-COSMETICOS / MATERIAL CIRURGICO
     * 000006-JORNAIS / REVISTAS
     * 000005-LIVROS
     * 000013-MATERIAL ESCOLAR
     *
     * @var int
     */
    protected $segprod;

    /**
     * Quantidade de Mercadorias Transportadas.
     * Padrão 1.
     *
     * @var int
     */
    protected $qtdvol = 1;

    /**
     * Peso total da mercadoria, este campo deverá ser um
     * somatório de todas os pesos das mercadorias
     * compradas. Formato em KG e separação decimal por
     * ponto “.”. Ex: 10.0 Quilos
     *
     * @var float
     */
    protected $peso;

    /**
     * Valor total da mercadoria.
     *
     * @var float
     */
    protected $valmer;

    /**
     * Peso cubado em metros. Este parâmetro é composto
     * por dados que compõem as dimensões da
     * mercadoria, ou seja, METRO3 = QUANTIDADE *
     * ALTURA * COMPRIMENTO * LARGURA.
     *
     * @var float
     */
    protected $metro3;

    /**
     * Filial da Jamef que irá efetuar a coleta da mercadoria
     * e emitir o CTRC do cliente. Na maioria dos casos
     * será a mesma região. Este parâmetro foi incluído
     * para o sistema ficar genérico, uma vez que o cliente
     * poderá ter mais de uma área de armazém e logística
     * da sua mercadoria.
     *
     * @var int
     */
    protected $filcot;

    /**
     * CNPJ ou CPF do cliente destino.
     *
     * @var string
     */
    protected $cnpjdes;

    /**
     * @return int
     */
    public function getTiptra(): int
    {
        return $this->tiptra;
    }

    /**
     * @param int $tiptra
     */
    public function setTiptra(int $tiptra)
    {
        $this->tiptra = $tiptra;
    }

    /**
     * @return int
     */
    public function getCnpjcpf()
    {
        return $this->cnpjcpf;
    }

    /**
     * @param string $cnpjcpf
     */
    public function setCnpjcpf(string $cnpjcpf)
    {
        $this->cnpjcpf = $cnpjcpf;
    }

    /**
     * @return string
     */
    public function getMunori(): string
    {
        return $this->munori;
    }

    /**
     * @param string $munori
     */
    public function setMunori(string $munori)
    {
        $this->munori = $munori;
    }

    /**
     * @return string
     */
    public function getEstori(): string
    {
        return $this->estori;
    }

    /**
     * @param string $estori
     */
    public function setEstori(string $estori)
    {
        $this->estori = $estori;
    }

    /**
     * @return int
     */
    public function getSegprod(): int
    {
        return $this->segprod;
    }

    /**
     * @param int $segprod
     */
    public function setSegprod(int $segprod)
    {
        $this->segprod = $segprod;
    }

    /**
     * @return int
     */
    public function getQtdvol(): int
    {
        return $this->qtdvol;
    }

    /**
     * @param int $qtdvol
     */
    public function setQtdvol(int $qtdvol)
    {
        $this->qtdvol = $qtdvol;
    }

    /**
     * @return float
     */
    public function getPeso(): float
    {
        return $this->peso;
    }

    /**
     * @param float $peso
     */
    public function setPeso(float $peso)
    {
        $this->peso = $peso;
    }

    /**
     * @return float
     */
    public function getValmer(): float
    {
        return $this->valmer;
    }

    /**
     * @param float $valmer
     */
    public function setValmer(float $valmer)
    {
        $this->valmer = $valmer;
    }

    /**
     * @return float
     */
    public function getMetro3(): float
    {
        return $this->metro3;
    }

    /**
     * @param float $metro3
     */
    public function setMetro3(float $metro3)
    {
        $this->metro3 = $metro3;
    }

    /**
     * @return int
     */
    public function getFilcot(): int
    {
        return $this->filcot;
    }

    /**
     * @param int $filcot
     */
    public function setFilcot(int $filcot)
    {
        $this->filcot = $filcot;
    }

    /**
     * @return string
     */
    public function getCnpjdes(): string
    {
        return $this->cnpjdes;
    }

    /**
     * @param string $cnpjdes
     */
    public function setCnpjdes(string $cnpjdes)
    {
        $this->cnpjdes = $cnpjdes;
    }

    /**
     * @return int
     */
    public function getCepdes(): int
    {
        return $this->cepdes;
    }

    /**
     * @param int $cepdes
     */
    public function setCepdes(int $cepdes)
    {
        $this->cepdes = $cepdes;
    }
}
