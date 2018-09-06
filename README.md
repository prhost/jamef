# Calculo frete Webservice Jamef

Esse pacote faclita o calculo do frete através do webservice SOAP que a Jamef fornece.

Exemplo de uso:

```php
<?php

try {

    require_once 'vendor/autoload.php';

    $objeto = new \Prhost\Jamef\Objeto();

    //Origem
    $objeto->setTiptra(1); //Tipo de transporte 1. rodoviario
    $objeto->setCnpjcpf(07564417000126); //CNPJ origem
    $objeto->setMunori('Curitiba'); //Cidade origem. Campo obrigatório pra revenda.
    $objeto->setEstori('PR'); // UF origem

    //Destino
    if ($tipo_pessoa == 'PF') { //Pessoa Fisica
        $objeto->setCnpjdes('55620644057'); //CPF destinatario
    } else {
        $objeto->setCnpjdes('60195124000100'); //CNPJ destinatario
    }

    $objeto->setCepdes('59618744'); //CEP destino
    $objeto->setSegprod(000004); //000004-CONFORME NOTA FISCAL
    $objeto->setQtdvol(1);
    $objeto->setPeso(15.50); //por quilo e decimal ex 10.0
    $objeto->setValmer(160.70); // valor da venda
    $objeto->setMetro3(1.5);//metros cubicos

    $calculoFrete = new \Prhost\Jamef\CalculoFrete();
    $valor_frete = $calculoFrete->calc($objeto);

    var_dump($valor_frete);

    /**
     * Dump:
        object(stdClass)#17 (4) {
            ["COMPONENTE"]=>
            string(17) "TF-TOTAL DO FRETE"
            ["IMPOSTO"]=>
            float(251.2)
            ["TOTAL"]=>
            float(3629.37)
            ["VALOR"]=>
            float(3378.17)
        }
     */

} catch (\Prhost\Jamef\ExceptionJamef $e) {
    var_dump($e->getMessage());
}
```