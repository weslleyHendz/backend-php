<?php

namespace Moovin\Job\Backend;

/**
 * Classe que trata as contas correntes
 *
 * @author Weslley Hendz <hendzweslley@gmail.com>
 */

class cashMachine 
{

    public function bankDraft($accountABC, $accountXYZ=[])
    {
        if($accountABC['type'] == 'saquePoupanca'){
            $limit = 1000;
            $tax = 0.80;
        }
        if($accountABC['type'] == 'saqueCC'){
            $limit = 600;
            $tax = 2.50;
        }
        if($accountABC['value'] > $accountABC['valueTotal']){
            return "Saldo insuficiente. Saldo atual: B$" . $accountABC['valueTotal'];
        }
        if(isset($limit) AND $accountABC['value'] > $limit){
            return "O limite para saques neste tipo de conta é B$ ". $limit . ". \nVocê tentou sacar: B$ " . $accountABC['value'];
        }
        if(isset($limit) AND $accountABC['value'] <= $accountABC['valueTotal'] AND $accountABC['value'] <= $limit){
            $balance = bcsub(bcsub($accountABC['valueTotal'], $accountABC['value'], 2), $tax, 2);

            return "Saque efetuado no valor de B$: " . $accountABC['value'] . ". Saldo atual em conta: " . $balance;
        }
        if($accountABC['type'] == 'deposito'){
            $balance = bcadd($accountABC['valueTotal'], $accountABC['value'], 2);
            return "Depósito efetuado com sucesso no valor de B$ " . $accountABC['value'] . ". \nSaldo anterior ao depósito: B$ " . $accountABC['valueTotal'] . "\nSaldo atual em conta: " . $balance;
        }
        if($accountABC['type']  == 'transferência' AND $accountABC['value'] >= $accountABC['valueTotal']){
            return "Saldo insuficiente. Saldo atual: B$" . $accountABC['valueTotal'];
        }
        if($accountABC['type']  == 'transferência' AND $accountABC['value'] <= $accountABC['valueTotal']){
            $balanceAccountABC = bcsub($accountABC['valueTotal'], $accountABC['value'], 2);
            $balanceAccountXYZ = bcadd($accountXYZ['valueTotal'], $accountABC['value'], 2);

            return "Transferência efetuada com sucesso no valor de B$ " . $accountABC['value'] . ". 
            \nSaldo atual de B$ " . $balanceAccountABC . "
            \nNome do recebedor: " . $accountXYZ['name'] . "
            \nSaldo anterior:  " . $accountXYZ['valueTotal'] . "
            \nSaldo atual do recebedor:" . $balanceAccountXYZ;
        }
    }

}