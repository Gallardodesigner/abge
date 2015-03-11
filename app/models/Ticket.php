<?php

class Ticket{
    
    protected $boleto = array();
    protected $id_associado = 0;
    protected $categoria = '';
    protected $linea1 = '';
    protected $linea2 = '';
    protected $linea3 = '';
    protected $linea4 = '';
    protected $conta = array();
    protected $add = array();
    protected $dataped = '';
    protected $num_ped = '';
    protected $ano = '';
    protected $valor_boleto = 0;
    protected $nossoNumeroInicial = 0;
    protected $nosso_numero = 0;
    protected $nosso_numero_final = 0;
    protected $dataVencimiento = 0;
    protected $multa = 0;
    protected $valor_boleto1 = 0;
    protected $sacado_nome = '';
    protected $sacado_end1 = '';
    protected $sacado_end2 = '';
    protected $fator_vencimento = '';
    protected $boleto1 = 0;
    protected $dv = 0;
    protected $campo_livre = '';
    protected $campo1 = '';
    protected $dac_campo1 = '';
    protected $campo2 = '';
    protected $dac_campo2 = '';
    protected $campo3 = '';
    protected $dac_campo3 = '';
    protected $campo4 = '';
    protected $campo5 = '';
    protected $linha_digitavel = '';
    protected $numeroFinal = '';
    protected $interval = null;
    public $pdf = array();
    public $html = '';
    public $htmlBoleto = '';
    
    

    public function __construct($associado = null)
    {
        //$this->id_associado = $associado;
        $this->dataped = date("Y-m-d");
        $this->ano = date("Y");
        
        //$this->inicialize();
    }
    
    public function setAsociado($associado)
    {
        $this->id_associado = $associado;
        return $this;
    }

    public function inicialize()
    {
        // Obtiene datos del asociado
        $this->conta = ORGAssociates::find($this->id_associado);
        // Numer de pedido
        $this->num_ped = $this->conta->id_asociado.'-'.date('Ym');
        // Nosso numero
        $this->nossoNumeroInicial = $this->conta->id_asociado.date('Ym');
        // Valores boleto (direccion, sacados, lineas de categorias)
        $this->valoresBoleto(); 
        // Valor del boleto
        $this->setValorBoleto();
        $this->valor_boleto1 = $this->getValorBoletoFormateado();
        // Define valores del boleto
        $this->boletoSettings();
        // Obtengo el identificador
        $id = $this->getIdentificadorNossoNumero($this->nossoNumeroInicial);
        // Calculo fecha de vencimiento    
        $this->setFechaVencimiento();
        
        $this->fator_vencimento = $this->fator_venc($this->dataVencimiento);
        // Monta cógigo de barras sem o dígito verificador
        $this->boleto['codbarra_sem_dv'] = $this->boleto['num_banco'] . $this->boleto['moeda'] .$this->fator_vencimento . $this->boleto['valor_zeroesq'] . $this->boleto['fixo'] .  $this->boleto['num_agencia_sem_digito_verificador'] . $this->nosso_numero . $this->boleto["iof"] . $this->boleto['carteira']  ;
        // Calcula DV
        $this->dv = $this->calculaDv();
        // Monta o código de barras com o dígito verificador (dv)
        $this->boleto['codbarra_dv'] = substr($this->boleto['codbarra_sem_dv'],0,4) . $this->dv . substr($this->boleto['codbarra_sem_dv'],4,39);
        
        // *************** LINHA DIGITÁVEL
        $this->campo_livre = $this->boleto["fixo"].$this->boleto['num_agencia_sem_digito_verificador'] . $this->boleto["carteira"] . $this->nosso_numero . $this->boleto["num_conta"] ;
        
        // 1º campo
        // Composto pelo código de Banco, código da moeda, as cinco primeiras posições do campo livre e o dígito de auto conferência(DAC) deste campo
        $this->campo1 = $this->boleto['num_banco'] . $this->boleto['moeda'] . substr($this->campo_livre,0,5);
        $this->dac_campo1 = $this->calculo_dac1($this->campo1);
        // 2º campo
        // Composto pelas posições 6ª a 15ª do campo livre e o dígito verificador deste campo
        $this->campo2 = substr($this->campo_livre,5,3).substr($this->nosso_numero,0,7);
        $this->dac_campo2 = $this->calculo_dac2($this->campo2);
        // 3º campo
        // Composto pelas posições 16ª a 25ª do campo livre e o dígito verificador deste campo deste campo
        $this->campo3 = substr($this->campo_livre,15,10);
        $this->dac_campo3 = $this->calculo_dac2(substr($this->campo_livre,18,6).'0'.$this->boleto["carteira"]);
        // 4º campo
        // Composto pelo dígito verificador do código de barras, ou seja, a 5ª posição do código de barras
        $this->campo4 = $this->dv;
        // 5º campo
        // Composto pelo fator de vencimento com 4(quatro) caracteres e o valor do documento com 10(dez) caracteres, sem separadores e sem edição
        $vBoleto = str_replace(',', '', $this->valor_boleto1) ;
        $vBoleto = str_replace('.', '', $vBoleto) ;
        
        $this->campo5 = $this->fator_venc($this->dataVencimiento) . $this->zero_esquerda($vBoleto,10);
        // LINHA DIGITÁVEL
        $this->linha_digitavel = substr($this->campo1,0,5) . "." . substr($this->campo1,5,5) . $this->dac_campo1 . " ";
        $this->linha_digitavel = $this->linha_digitavel . substr($this->campo2,0,3) . substr($this->nosso_numero,0,2) ."." . substr($this->nosso_numero,2,5) . $this->dac_campo2 . " ";
        $this->linha_digitavel = $this->linha_digitavel . substr($this->campo3,3,5) . "." . $this->numeroFinal .'0'. $this->boleto["carteira"] .  $this->dac_campo3 . " ";
        $this->linha_digitavel = $this->linha_digitavel . $this->campo4 . " " . $this->campo5;   
        
        // crea pdf
        //$this->printTcPdf();
    }
    
    protected function setFechaVencimiento()
    {
        $mesActual = date("m", strtotime(date("Y-m-d")));
        if($this->interval != null)
        {
            $this->dataVencimiento = date("Y-m-d",strtotime($this->interval->data_final));
        }else{
            $this->dataVencimiento = date("Y-m-d", strtotime(date("Y-m-d"). " +8 day"));
        }
    }

    protected function setValorBoleto()
    {

    	$anuidade = ORGAnnuities::getLastAnnuity();
    	$anuidade_categoria = $anuidade->getAnnuityCategoryByAssociateCategory($this->conta->category);
    	if($this->interval = $anuidade_categoria->getActualInterval()):
	    	$this->valor_boleto = $this->interval->preco;
	    	$this->valor_boleto = number_format($this->valor_boleto,2,'.','');
	    else:
	    	die('<html><head><meta charset="UTF-8"></head><body>Não é possível carregar o boleto de <b>'.$this->conta->nombre_completo.'</b> porque não há datas definidas para la categoria <b>'.$this->conta->category->nombre_categoria.'</b> em anuidade <b>'.$anuidade->ano.'</b>. Clique <a href="/dashboard/annuities/'.$anuidade->id.'/categories/'.$this->conta->categoria.'/dates/create">aqui</a> para adicionar.<br></body></html>');
	    endif;
        /*$anuidade_asociado = AnuidadeAsosiadoPeer::validatePagoAnoExist($this->id_associado, $this->ano);
        $this->valor_boleto = $anuidade_asociado->getValor();
        $this->valor_boleto = number_format($this->valor_boleto,2,'.','');;*/
    }
    
    public function getValorBoleto()
    {
        return $this->valor_boleto;
    }
    
    public function getValorBoletoFormateado()
    {
        return number_format($this->valor_boleto,2,',','');
    }
    
    protected function boletoSettings()
    {
        $this->boleto["cedente_nome"] = "ASSOC.BRAS.GEOL.ENG.AMB. - ABGE";
        $this->boleto["cedente_cnpj"] = "43.361.997/0001-18 ";
        // 2. Dados da conta bancária da empresa (devem ser confirmados com o banco do cedente)
        $this->boleto['num_banco'] = "033"; // Identificação do Banco (Banco teste = 935)
        $this->boleto['dv_banco'] = "7";    // Identificação do Banco (Banco teste = 935)
        $this->boleto['moeda'] = "9";		// Código da Moeda (Real = 9)
        $this->boleto["num_agencia"] = "0121-0 /1327429";	// Num da agência - com digito verificador
        $this->boleto["num_agencia_sem_digito_verificador"] = "1327429";	// Num da agência - sem digito verificador
        $this->boleto["dv_agencia"] = "0";	// Dígito verificador da agência
        $this->boleto["num_conta"] = "132742";	// Num da conta corrente sem o dígito verificador
        $this->boleto["dv_conta"] = "9";	// Digito verificador da conta corrente
        // 3. Dados restritos do banco (devem ser confirmados com o banco do cedente)
        $this->boleto["carteira"] = "102";  // Código da Carteira: Consultar seu banco
        $this->boleto["aceite"] = "N";      // Aceite: Consultar seu banco
        $this->boleto["especie"] = "REAL";	// Espécie: Consultar seu banco
        $this->boleto["especie_doc"] = "RE";	// Espécie documento: Consultar seu banco
        $this->boleto["fixo"] = "9";		// posicao 44 do código de barras
        $this->boleto["iof"] = "0";		// iof
        // 4. Informações gerais do boleto
        $this->boleto['dv_codbar'] = "";	// Dígito verificador do Código de Barras
        $this->boleto['fator'] = $this->fator_venc($this->dataped);
        $this->boleto['valor_zeroesq'] = $this->zero_esquerda($this->valor_boleto,10);
    }

    // Função formatar CNPJ
    function formatar_cnpj($n) {
        $cnpj_formatado = substr($n,0,2).".".substr($n,2,3).".".substr($n,5,3)."/".substr($n,8,4)."-".substr($n,12,2);
        return $cnpj_formatado;
    }

    // Cálculo do Dígito de auto conferência (DAC) da linha digitável para o campo 1
    function calculo_dac1($campo) {
        $soma_dac = '';
    for($i=0; $i < 9; $i++) {
            // Varifica a posição do número. Se impar $fator_dac = 2. Se par $fator_dac = 1
            if ($i % 2 == 0) {
                    $fator_dac = 2;
            } else {
                    $fator_dac = 1;
            }
            // Multiplica a posição do número pelo $fator_dac
            $dac1 = (substr($campo,$i,1) * $fator_dac);
            // Se o valor de $dac1 for maior do que 9, somam-se os dois dígitos, ex:
            // Se $dac1 = 12 teremos como resultado final 1 + 2, ou seja 3.
            if ($dac1 > 9) {
                    $dac2 = substr($dac1,0,1) + substr($dac1,1,1);
            } else {
                    $dac2 = $dac1;
            }
            $soma_dac = $soma_dac + $dac2;
            // Divide-se o resultado por 10, se resto = 0 o DAC será 0
            // Se resto diferente de 0 o DAC será: 10 - resto
            if ($soma_dac % 10 == 0) {
                    $dac = 0;
            } else {
                    $dac = 10 - ($soma_dac % 10);
            }
    }
    return $dac;
    }	

    // Cálculo do Dígito de auto conferência (DAC) da linha digitável para o campo 2 e 3
    function calculo_dac2($campo) {
        $soma_dac = '';
        for($i=0; $i < 10; $i++) {
                // Varifica a posição do número. Se impar $fator_dac = 2. Se par $fator_dac = 1
                if ($i % 2 == 0) {
                        $fator_dac = 1;
                } else {
                        $fator_dac = 2;
                }
                // Multiplica a posição do número pelo $fator_dac
                $dac1 = (substr($campo,$i,1) * $fator_dac);
                // Se o valor de $dac1 for maior do que 9, somam-se os dois dígitos, ex:
                // Se $dac1 = 12 teremos como resultado final 1 + 2, ou seja 3.
                if ($dac1 > 9) {
                        $dac2 = substr($dac1,0,1) + substr($dac1,1,1);
                } else {
                        $dac2 = $dac1;
                }
                $soma_dac = $soma_dac + $dac2;
                // Divide-se o resultado por 10, se resto = 0 o DAC será 0
                // Se resto diferente de 0 o DAC será: 10 - resto
                if ($soma_dac % 10 == 0) {
                        $dac = 0;
                } else {
                        $dac = 10 - ($soma_dac % 10);
                }
        }
        return $dac;
    }
    
    function zero_esquerda($numero,$zeros) {	
	// Retira o ponto decimal do número	        
	$numero = str_replace(".","",$numero);
        
	// Define o número de zeros a serem inseridos à esquerda do número
	$loop = $zeros - strlen($numero);				
	for($i=0; $i < $loop; $i++) {
		$numero = "0" . $numero;
	}
        return $numero;
    }
    
    // CALCULO DO FATOR DE VENCIMENTO DO BOLETO
    // Parâmetro: $data = Data de vencimento do boleto no formato aaaa-mm-dd
    function fator_venc($data) {
            // Separa a data em dia, mês e ano
            $dia = substr($data,8,2);
            $mes = substr($data,5,2);
            $ano = substr($data,0,4);
            
            // calcula o timestamp da data 07/10/1997 (base de cálculo do fator de vencimento)
            $timestamp_data1 = mktime(0,0,0,10,07,1997);
            // calcula o timestamp da data de vencimento do boleto
            $timestamp_data2 = mktime(0,0,0,$mes,$dia,$ano);
            // Calcula a diferença de dias entre as duas datas. Como esta diferença é calculada em segundos, 
            // é necessário se dividir esse resultado por 86.400 (número de segundos de 1 dia)
            $dif_dias = round(($timestamp_data2 - $timestamp_data1) / 86400);
            return $dif_dias;
    }
    
    public static function diasTranscurridos($fecha_i,$fecha_f)
    {
            $dias	= (strtotime($fecha_i)-strtotime($fecha_f))/86400;
            $dias 	= abs($dias); $dias = floor($dias);		
            return $dias;
    }
    /**
     *  Supondo-se que: Nosso Número = 566612457800
        Inverter da direita para a esquerda na vertical.
        0 X 2 = 0 
        0 X 3 = 0 
        8 X 4 = 32 
        7 X 5 = 35 
        5 X 6 = 30 
        4 X 7 = 28 
        2 X 8 = 16 
        1 X 9 = 9 
        6 X 2 = 12 
        6 X 3 = 18 
        6 X 4 = 24
        5 X 5 = 25  
        Total 229 / 11 = 20 resto = 9 
        11-9 = 2 

        Nosso numero final: 56612457800-2 
        Utilizar o módulo 11 – peso de 2 a 9 - para o cálculo deste DV. 
        Multiplicar da direita para a esquerda, de 2 até 9, até o final do número, reiniciando em 2 se necessário. 
        Somar os resultados obtidos, multiplicar o total da soma por 10 (dez) e dividi-lo por 11 (onze). 
        O resto desta divisão será o digito do controle. 
        Se o resto for igual a 0 (zero), 1 (um) ou 10 (dez) o digito será = 1 (um).
     */
    protected function getIdentificadorNossoNumero($nNumero)
    {
        $this->nosso_numero = $this->zero_esquerda($nNumero,12);
        $total = strlen($this->nosso_numero);
        $nvaCadena = '';
        for($i=1;$i < 13;$i++){ 
            $nvaCadena.= substr($this->nosso_numero, -$i , 1);
        }
        // recorro la cadena nueva y multiplico
        $m = 2;
        $sum = 0;
        for($i=0;$i<strlen($nvaCadena);$i++){ 
            $op = $nvaCadena{$i} * $m;
            $sum = $sum + $op;
            if($m == 9)
            {
                $m = 2; 
            }else{
                $m++;
            }
        }
        $resto = $sum % 11;
        // Si resto es igual a 0 o a 1 resto = 0
        // Si resto es igual a 10, resto = 1
        // Sino el numero identificador es 11 - resto
        if($resto == 0 || $resto == 1 || $resto == 10)
        {
            if($resto == 0 || $resto == 1)
            {
                $resto = 0;
            }
            if($resto == 10)
            {
                $resto = 1;
            }
            $this->numeroFinal = $resto;
        }else{
            $this->numeroFinal = 11 - $resto;
        }
        $this->nosso_numero_final = $this->nosso_numero.'-'.$this->numeroFinal;
        $this->nosso_numero = $this->nosso_numero.$this->numeroFinal;
        
    }
    
    protected function valoresBoleto()
    {
        $this->add['nombre'] = $this->conta->nombre_completo;
        // Direccion de acuerdo al tipo de correspondencia
        if($this->conta->tipo_correspondencia == 'c')
        {
            $this->add['estado'] = $this->conta->uf_com;
            $this->add['ciudad'] = $this->conta->municipio_com;
            $this->add['direccion'] = $this->conta->dir_com;
            $this->add['numero'] = $this->conta->numero_com;
            $this->add['complemento'] = $this->conta->complemento_com;
            $this->add['cep'] = $this->conta->cep_com;
            $this->add['barrio'] = $this->conta->bairro_com;
        }elseif ($this->conta->tipo_correspondencia == 'r') {
            $this->add['estado'] = $this->conta->uf_res;
            $this->add['ciudad'] = $this->conta->municipio_res;
            $this->add['direccion'] = $this->conta->dir_res;
            $this->add['numero'] = $this->conta->numero_res;
            $this->add['complemento'] = $this->conta->complemento_res;
            $this->add['cep'] = $this->conta->cep_res;
            $this->add['barrio'] = $this->conta->bairro_res;
        }

        // Instrucciones de boleto de acuerdo a la categoria
        if($this->conta->categoria)
        {
            $rsCat = $this->conta->category;
            $this->categoria = $rsCat->nombre_categoria;
            $instruccionesCategoria = $rsCat->instruction;
            if($instruccionesCategoria)
            {
                $this->linea2 = $instruccionesCategoria->linea_2;
                $this->linea3 = $instruccionesCategoria->linea_3;
                $this->linea4 = $instruccionesCategoria->linea_4;
            }
        }
        // Dados do Sacado asociado
        $cidade = ORGTowns::find($this->add['ciudad']);
        $cidade = $cidade ? $cidade->name_municipio : '';
        $estado = ORGuf::find($this->add['estado']);
        $estado = $estado ?  $estado->name_uf : '';
        $this->boleto['sacado_nome'] = ucfirst($this->add['nombre']);
        $this->boleto['sacado_end1'] = $this->add['direccion'].' ' .ltrim($this->add['numero']) . " " . ltrim($this->add['complemento']); 
        $this->boleto['sacado_end2'] = $this->add['cep']. "&nbsp;&nbsp;&nbsp;&nbsp;" . ltrim($this->add['barrio']) . "&nbsp;&nbsp;&nbsp;&nbsp;" . ltrim($cidade) . "&nbsp;&nbsp;&nbsp;&nbsp;" . ltrim($estado);
    }

    protected function calculaDv()
    {
        $boleto = strrev($this->boleto['codbarra_sem_dv']);
        $soma = 0;
        $multplicador = 2;
        $suma = 0;
        for($i=0; $i <= 42; $i++) 
        {
            $a[$i] = substr($boleto,$i,1);
            // Soma os números de cada posição do código de barras invertido pelo respectivo fator
            $suma = $suma + ($a[$i] * $multplicador);
            $multplicador++;
            if($multplicador == 10)
            {
                $multplicador = 2;
            }
        }
        // Calcula o resto da divisão entre a soma e 11
        $tDv = $suma * 10;
        $dv = $tDv%11;
        // Se o resultado da subtração (11 - resto de $soma) for igual a 0 (Zero), 1 (um)
        // ou maior que 9 (nove) deverão assumir o dígito igual a 1 (um).
        if ($dv == 0 or $dv == 1 or $dv > 9) {
            $dv = 1;
        }
        return $dv;
    }

    public function buildHtml()
    {
        $this->html .= '
        <html>
        	<head>
        		<meta charset="UTF-8">
        	</head><body>
			<style>
                .logo_banco {
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    border-right-width: 1px;
                    border-right-style: solid;
                    border-right-color: #000000;
                    font-weight: bold;
                    padding-top: 0px;
                    padding-right: 2px;
                    padding-bottom: 2px;
                    padding-left: 0px;
                }
                .num_banco {
                    padding: 2px;
                    font-size: 12px;
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    border-right-width: 1px;
                    border-right-style: solid;
                    border-right-color: #000000;
                    text-align: center;
                }
                .avalista {
                    font-size: 8px;
                    line-height: 10px;
                    padding-top: 0px;
                    padding-right: 2px;
                    padding-bottom: 0px;
                    padding-left: 2px;
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    text-align:left;
                }
                .linha_digitavel {
                    padding: 2px;
                    font-size: 12px;
                    font-weight: normal;
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    text-align: left;
                }
                .linha_digitavelA {
                    padding: 2px;
                    font-size: 12px;
                    font-weight: normal;
                }
                .instrucoes {
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    padding-top: 0px;
                    padding-right: 2px;
                    padding-bottom: 2px;
                    padding-left: 10px;
                }
                .titulo_dir{
                    border-right-width: 1px;
                    border-right-style: solid;
                    border-right-color: #000000;
                    font-size: 8px;
                    line-height: 10px;
                    padding-top: 2px !important;
                    padding-right: 2px;
                    padding-bottom: 0px;
                    padding-left: 2px;
                    text-align:left;
                }
                .titulo_inf {
                    font-size: 8px;
                    line-height: 10px;
                    padding-top: 2px;
                    padding-right: 2px;
                    padding-bottom: 0px;
                    padding-left: 2px;
                    text-align:left !important;
                }
                .linha_dir {
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    border-right-width: 1px;
                    border-right-style: solid;
                    border-right-color: #000000;
                    font-weight: bold;
                    padding-top: 0px;
                    padding-right: 2px;
                    padding-bottom: 2px;
                    padding-left: 10px;
                    text-align:left !important;
                }
                .linha_inf {
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    font-weight: bold;
                    padding-top: 0px;
                    padding-right: 2px;
                    padding-bottom: 2px;
                    padding-left: 10px;
                    text-align:left !important;
                }
                .valor {
                    border-bottom-width: 1px;
                    border-bottom-style: solid;
                    border-bottom-color: #000000;
                    font-weight: bold;
                    padding-top: 0px;
                    padding-right: 15px;
                    padding-bottom: 2px;
                    padding-left: 10px;
                    text-align: left;
                }
                .sacado {
                    font-weight: bold;
                    padding-top: 3px;
                    padding-right: 15px;
                    padding-bottom: 3px;
                    padding-left: 30px;
                    font-size: 10px;
                    text-align:left;
                }
            </style>
        '.$this->htmlBoleto;
        return $this;
    }
    
    public function buildHtmlBoleto()
    {
        
        $this->htmlBoleto = '
            <table style=" border-width: 0px; border-style: solid; border-bottom-color: #000000; border-collapse: collapse; border-top: none;" width="910pt">
                <tr>
                  <td width="150pt"><br /><br /><img src="'. public_path().'/images/logo_abge45.png" width="90pt" height="32pt" border="0" /></td>
                  <td width="400pt"><br /><br />Boleto para pagamento do pedido nº<strong>&nbsp;'.$this->num_ped.'</strong></td>
                </tr>
            </table>
            <br />
            <table width="485pt" border="0" align="center" cellpadding="0" cellspacing="0" style="">
                <tr>
                  <td colspan="5" class="titulo_dir" style="text-align:left;">Local de Pagamento</td>
                  <td width="146pt" class="titulo_inf">Vencimento</td>
                </tr>
                <tr>
                    <td colspan="5" class="linha_dir" style="text-align:left;">Pagar preferencialmente no Grupo Santander - GC</td>
                    <td class="linha_inf">'.substr($this->dataVencimiento,8,2).'/'.substr($this->dataVencimiento,5,2).'/'.substr($this->dataVencimiento,0,4).'</td>
                </tr>
                <tr>
                    <td colspan="5" class="titulo_dir">Cedente</td>
                    <td class="titulo_inf">Agência</td>
                </tr>
                <tr>
                    <td colspan="5" class="linha_dir">'.$this->boleto['cedente_nome'].' - CNPJ/CPF '.$this->boleto['cedente_cnpj'].'</td>
                    <td class="linha_inf">
                      '.$this->boleto['num_agencia'].'
                    </td>
                </tr>
                <tr>
                    <td width="90pt" class="titulo_dir">Data do Documento </td>
                    <td width="109pt" class="titulo_dir">N&ordm; do Documento </td>
                    <td width="100pt" class="titulo_dir">Esp&eacute;cie Documento </td>
                    <td width="44pt" class="titulo_dir">Aceite</td>
                    <td width="90pt" class="titulo_dir">Data do Processamento</td>
                    <td width="118pt" class="titulo_inf">Nosso Número</td>
                </tr>
                <tr>
                    <td class="linha_dir">'.substr($this->dataped,8,2).'/'.substr($this->dataped,5,2).'/'.substr($this->dataped,0,4).'</td>
                    <td class="linha_dir">'.$this->num_ped.'</td>
                    <td class="linha_dir">'.$this->boleto['especie_doc'].'</td>
                    <td class="linha_dir">'.$this->boleto['aceite'].'</td>
                    <td class="linha_dir">'.date("d-m-Y").'</td>
                    <td class="linha_inf">'.$this->nosso_numero_final.'</td>
                </tr>
                <tr>
                    <td class="titulo_dir">Uso do Banco </td>
                    <td class="titulo_dir">Carteira</td>
                    <td class="titulo_dir">Esp&eacute;cie</td>
                    <td class="titulo_dir">Quantidade</td>
                    <td class="titulo_dir">Valor</td>
                    <td class="titulo_inf">(=) Valor do Documento </td>
                </tr>
                <tr>
                    <td class="linha_dir">&nbsp;</td>
                    <td class="linha_dir">'. $this->boleto['carteira'].'</td>
                    <td class="linha_dir">'.$this->boleto['especie'].'</td>
                    <td class="linha_dir">&nbsp;</td>
                    <td class="linha_dir">&nbsp;</td>
                    <td class="valor">R$ '.$this->valor_boleto1.'</td>
                </tr>
                <tr>
                    <td colspan="5" class="titulo_inf"><span class="titulo_dir">INSTRU&Ccedil;&Otilde;ES (Texto de responsabilidade do Cedente) </span></td>
                    <td class="titulo_inf">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6" valign="top" class="instrucoes">
                        <p align="left">ABGE - Associado Tipo: '.$this->categoria.'
                        '.$this->linea1.'<br />
                        '.$this->linea2.'<br />
                        '.$this->linea3.'
                        </p>
                        <p align="center" class="linha_digitavelA">'.$this->linha_digitavel.'</p>

                    </td>
                </tr>

                <tr>
                    <td colspan="6" class="titulo_inf">Sacado</td>
                </tr>
                <tr>
                    <td colspan="6" class="sacado">'.$this->boleto['sacado_nome'].' <br />
                        '.$this->boleto['sacado_end1'].'<br />
                        '.$this->boleto['sacado_end2'].'
                    </td>
                </tr>
                <tr>
                    <td colspan="6" class="avalista">Sacador/Avalista</td>
                </tr>
                <tr>
                    <td colspan="6"><div align="left"><strong>Recibo do Sacado  -</strong> <span class="autenticacao">Autentica&ccedil;&atilde;o Mec&acirc;nica</span> </div></td>
                </tr>
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>
                <tr>
                    <td colspan="6"><img src="'. public_path().'/images/boleto/corte.gif" width="700" height="12" /></td>
                </tr>	
                <tr>
                    <td colspan="6">&nbsp;</td>
                </tr>						
            </table>    
            <!-- Ficha de Compensação -->
            <table width="500pt" border="0" align="center" cellpadding="0" cellspacing="0">
                <tr>
                  <td width="155" class="logo_banco"><img src="'. public_path().'/images/boleto/logo_Banco.gif" width="178" height="37" /></td>
                  <td width="45" class="num_banco">'.$this->boleto['num_banco'].'-'.$this->boleto['dv_banco'].'</td>
                  <td width="350" class="linha_digitavel">  '.$this->linha_digitavel.' </td>
                </tr>
            </table>
            <table width="483pt" border="0" align="center" cellpadding="0" cellspacing="0" >
                <tr>
                    <td colspan="5" class="titulo_dir">Local de Pagamento</td>
                    <td width="146" class="titulo_inf">Vencimento</td>
                </tr>
                <tr>
                    <td colspan="5" class="linha_dir">Pagar preferencialmente no Grupo Santander - GC</td>
                    <td class="linha_inf">'.substr($this->dataVencimiento,8,2).'/'.substr($this->dataVencimiento,5,2).'/'.substr($this->dataVencimiento,0,4).'</td>
                </tr>
                <tr>
                    <td colspan="5" class="titulo_dir">Cedente</td>
                    <td class="titulo_inf">Agência</td>
                </tr>
                <tr>
                    <td colspan="5" class="linha_dir">'.$this->boleto['cedente_nome'].' - CNPJ/CPF '.$this->boleto['cedente_cnpj'].'</td>
                    <td class="linha_inf">
                        '.$this->boleto['num_agencia'].'
                    </td>
                </tr>
                <tr>
                    <td width="90pt" class="titulo_dir">Data do Documento </td>
                    <td width="109pt" class="titulo_dir">N&ordm; do Documento </td>
                    <td width="100pt" class="titulo_dir">Esp&eacute;cie Documento </td>
                    <td width="44pt" class="titulo_dir">Aceite</td>
                    <td width="90pt" class="titulo_dir">Data do Processamento</td>
                    <td width="118pt" class="titulo_inf">Nosso Número</td>
                </tr>
                <tr>
                    <td class="linha_dir">'.substr($this->dataped,8,2).'/'.substr($this->dataped,5,2).'/'.substr($this->dataped,0,4).'</td>
                    <td class="linha_dir">'.$this->num_ped.'</td>
                    <td class="linha_dir">'.$this->boleto['especie_doc'].'</td>
                    <td class="linha_dir">'.$this->boleto['aceite'].'</td>
                    <td class="linha_dir">'.date("d-m-Y").'</td>
                    <td class="linha_inf">'.$this->nosso_numero_final.'</td>
                </tr>
                <tr>
                    <td class="titulo_dir">Uso do Banco </td>
                    <td class="titulo_dir">Carteira</td>
                    <td class="titulo_dir">Esp&eacute;cie</td>
                    <td class="titulo_dir">Quantidade</td>
                    <td class="titulo_dir">Valor</td>
                    <td class="titulo_inf">(=) Valor do Documento </td>
                </tr>
                <tr>
                    <td class="linha_dir">&nbsp;</td>
                    <td class="linha_dir">'.$this->boleto['carteira'].'</td>
                    <td class="linha_dir">'.$this->boleto['especie'].'</td>
                    <td class="linha_dir">&nbsp;</td>
                    <td class="linha_dir">&nbsp;</td>
                    <td class="valor">R$ '.$this->valor_boleto1.' </td>
                </tr>
                <tr>
                    <td colspan="5" class="titulo_dir">INSTRU&Ccedil;&Otilde;ES (Texto de responsabilidade do Cedente) </td>
                    <td class="titulo_inf">(-) Desconto/Abatimento </td>
                </tr>
                <tr>
                    <td colspan="5" rowspan="9" valign="top" class="linha_dir">
                        <p>ABGE - Associado Tipo: '.$this->categoria.'</p>
                        '.$this->linea1.'<br />
                        '.$this->linea2.'<br />
                        '.$this->linea3.'
                    </td>
                    <td class="linha_inf">&nbsp;</td>
                </tr>
                <tr>
                    <td class="titulo_inf">(-) Outras Dedu&ccedil;&otilde;es </td>
                  </tr>
                  <tr>
                    <td class="linha_inf">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="titulo_inf">(+) Mora/Multa </td>
                  </tr>
                  <tr>
                    <td class="linha_inf">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="titulo_inf">(+) Outros Acr&eacute;scimos </td>
                  </tr>
                  <tr>
                    <td class="linha_inf">&nbsp;</td>
                  </tr>
                  <tr>
                    <td class="titulo_inf">(=) Valor Cobrado </td>
                  </tr>
                  <tr>
                    <td class="linha_inf">&nbsp;</td>
                  </tr>
                  <tr>
                    <td colspan="6" class="titulo_inf">Sacado</td>
                  </tr>
                  <tr>
                    <td colspan="6" class="sacado">'.$this->boleto['sacado_nome'].'<br />
                             '. $this->boleto['sacado_end1'].'<br />
                                '.$this->boleto['sacado_end2'].'
                    </td>
                  </tr>
                  <tr>
                    <td colspan="5" class="avalista">Sacador/Avalista</td>
                    <td class="avalista"><div align="left"><!--C&oacute;digo de Baixa --></div></td>
                  </tr>
                  <tr>
                    <td colspan="6"></td>
                  </tr>
            </table>
         ';
        
        return $this->htmlBoleto;
        

    }

    public function getHtml()
    {
        return $this->html.$this->htmlBoleto;
    }
    
    public function inicializaHtml()
    {
        $this->html = '';
        return $this;
    }
    
    public function addPagePdf()
    {
        PDF::AddPage();
    }
    
    public function endPagePdf()
    {
        PDF::endPage();
    }
    
    public function creaPaginaBoleto()
    {
        
        // return Pdf::load($this->html.$this->htmlBoleto)->download('my_pdf');
        // Print text using writeHTMLCell()
        PDF::writeHTMLCell($w=-0, $h=10, $x='', $y='', $this->html, $border=0, $ln=1, $fill=0, $reseth=true, $align='', $autopadding=true);
        
        // define barcode style
        $style = array(
            'position' => '',
            'align' => 'C',
            'stretch' => false,
            'fitwidth' => true,
            'cellfitalign' => '',
            'border' => false,
            'hpadding' => 'auto',
            'vpadding' => 'auto',
            'fgcolor' => array(0,0,0),
            'bgcolor' => false, //array(255,255,255),
            'text' => false,
            'font' => 'helvetica',
            'fontsize' => 8,
            'stretchtext' => 4
        );
        
        $numerosBarcode = $this->boleto['codbarra_dv'];

        // die($numerosBarcode);        
        // PRINT BARCODE
        PDF::Cell(0, 0, 'Ficha de Compensação - Autenticação Mecânica', 0, 1);
        
        PDF::write1DBarcode($numerosBarcode, 'I25', '', '', 201, 18, 0.325, $style, 'N');
    }

    public function printTcPdf()
    {
        // creo el pdf
        // $config = sfTCPDFPluginConfigHandler::loadConfig();
        // pdf object
        // $this->pdf = new PDF();
        // set document information
        PDF::SetCreator(PDF_CREATOR);
        PDF::SetAuthor('Henry Vallenilla');
        PDF::SetTitle('Boleto Associado '.date('Y'));
        PDF::SetSubject('ABGE');
        PDF::SetKeywords('ABGE, PDF, Boleto');
        // set default header data
        PDF::SetHeaderData(PDF_HEADER_LOGO, PDF_HEADER_LOGO_WIDTH, PDF_HEADER_TITLE.'', PDF_HEADER_STRING);

        // set header and footer fonts
        PDF::setHeaderFont(Array(PDF_FONT_NAME_MAIN, '', PDF_FONT_SIZE_MAIN));
        PDF::setFooterFont(Array(PDF_FONT_NAME_DATA, '', PDF_FONT_SIZE_DATA));

        // set default monospaced font
        PDF::SetDefaultMonospacedFont(PDF_FONT_MONOSPACED);

        //set margins
        PDF::SetMargins(PDF_MARGIN_LEFT, PDF_MARGIN_TOP, PDF_MARGIN_RIGHT);
        PDF::SetHeaderMargin(PDF_MARGIN_HEADER);
        PDF::SetFooterMargin(PDF_MARGIN_FOOTER);

        //set auto page breaks
        PDF::SetAutoPageBreak(TRUE, PDF_MARGIN_BOTTOM);

        //set image scale factor
        PDF::setImageScale(PDF_IMAGE_SCALE_RATIO);
        // set default font subsetting mode
        PDF::setFontSubsetting(true);

        // Set font
        // dejavusans is a UTF-8 Unicode font, if you only need to
        // print standard ASCII chars, you can use core fonts like
        // helvetica or times to reduce file size.
        PDF::SetFont('helvetica', '', 9, '', true);

        // Add a page
        // This method has several options, check the source code documentation for more information.
        //PDF::AddPage();
        
        //$this->html.= globalFunctions::stylesBoleto();
                
        
        // codigo asociado + nombre_asociado + ano
        $nomeAsociado = self::crearPermalink(strtolower($this->conta->nombre_completo));
        $nomeFile = $nomeAsociado. '-' .$this->id_associado .date('Ym');
        

    }

	  //Funcion que genera un permalink
	  static function crearPermalink($text){
	    $text = ucwords(strtolower(trim($text)));
	    // strip all non word chars

	    //cambios en acentos, dieresis y enies
	    $text = str_replace('á','a',$text);
	    $text = str_replace('é','e',$text);
	    $text = str_replace('í','i',$text);
	    $text = str_replace('ó','o',$text);
	    $text = str_replace('ú','u',$text);
	    $text = str_replace('ü','u',$text);
	    $text = str_replace('ç','c',$text);
	    $text = str_replace('ñ','n',$text);

	    $text = preg_replace('/[^a-zA-Z0-9\s]/', '-', $text);
	    // replace all white space sections with a dash
	    $text = preg_replace('/\ +/', '-', $text);
	    // trim dashes
	    $text = preg_replace('/\-$/', '-', $text);
	    $text = preg_replace('/^\-/', '-', $text);

	    return $text;
	  }
    
    
    public function downloadPdf($file)
    {
        // Close and output PDF document
        PDF::Output($file.'.pdf', 'D');
        
        // Stop symfony process
        throw new sfStopException();
    }
            
    
}


?>
