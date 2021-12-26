

<?php

// namespace Moovin\Job\Backend;

/**
 * Classe que trata as contas correntes
 *
 * @author Weslley Hendz <hendzweslley@gmail.com>
 */

class cashMachine
{
    public function electronicBank($accountABC, $accountXYZ = [])
    {
        if ($accountABC['type'] == 'saquePoupanca') {
            $limit = 1000;
            $tax = 0.80;
        }
        if ($accountABC['type'] == 'saqueCC') {
            $limit = 600;
            $tax = 2.50;
        }
        if ($accountABC['value'] > $accountABC['valueTotal']) {
            return "Saldo insuficiente. Saldo atual: B$" . $accountABC['valueTotal'];
        }
        if (isset($limit) and $accountABC['value'] > $limit) {
            return "O limite para saques neste tipo de conta é B$ " . $limit . ". <br>Você tentou sacar: B$ " . $accountABC['value'];
        }
        if (isset($limit) and $accountABC['value'] <= $accountABC['valueTotal'] and $accountABC['value'] <= $limit) {
            $balance = bcsub(bcsub($accountABC['valueTotal'], $accountABC['value'], 2), $tax, 2);
            return "Saque efetuado no valor de B$: " . $accountABC['value'] . ". Saldo atual em conta: B$" . $balance;
        }
        if ($accountABC['type'] == 'deposito') {
            $balance = bcadd($accountABC['valueTotal'], $accountABC['value'], 2);
            return "Depósito efetuado com sucesso no valor de B$ " . $accountABC['value'] . ". <br>Saldo anterior ao depósito: B$ " . $accountABC['valueTotal'] . "<br>Saldo atual em conta: B$ " . $balance;
        }
        if ($accountABC['type'] == 'transferencia' and $accountABC['value'] > $accountABC['valueTotal']) {
            return "Saldo insuficiente. Saldo atual: B$" . $accountABC['valueTotal'];
        }
        if ($accountABC['type'] == 'transferencia' and $accountABC['value'] <= $accountABC['valueTotal']) {
            $balanceAccountABC = bcsub($accountABC['valueTotal'], $accountABC['value'], 2);
            $balanceAccountXYZ = bcadd($accountXYZ['valueTotal'], $accountABC['value'], 2);
            return 
            "Transferência efetuada com sucesso no valor de B$ " . $accountABC['value'] . ".
            <br>Saldo atual: B$ " . $balanceAccountABC . "
            <br>Nome do recebedor: " . $accountXYZ['name'] . "
            <br>Saldo anterior: B$  " . $accountXYZ['valueTotal'] . "
            <br>Saldo atual do recebedor:" . $balanceAccountXYZ;
        }
    }
}