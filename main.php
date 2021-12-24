<?php

require_once __DIR__ . '/vendor/autoload.php';

use Moovin\Job\Backend;

$exemplo = new Backend\cashMachine;

// Saque Poupança: Limite de B$1000 e taxa de B$0.80
// $accountABC = [
//     'type' => 'saquePoupanca',
//     'valueTotal' => 1200,
//     'value' => 900
// ];

// Saque Conta Corrente: Limite de B$600 e taxa de B$2.50
// $accountABC = [
//     'type' => 'saqueCC',
//     'valueTotal' => 1200,
//     'value' => 900
// ];

// Operação de depósito
// $accountABC = [
//     'type' => 'deposito',
//     'valueTotal' => 1200,
//     'value' => 900
// ];

// Operação de transferência
$accountABC = [
    'type' => 'transferência',
    'valueTotal' => 1200,
    'value' => 900
];

$accountXYZ = [
    'name' =>'Weslley Hendz',
    'valueTotal' => 1200,
    'value' => 900
];
// $contType = 'deposito';
// $valueTotal = 1200;
// $valueDraft = 900;
if (isset($accountXYZ)){
    echo $exemplo->bankDraft($accountABC, $accountXYZ);
}else{
    echo $exemplo->bankDraft($accountABC);

}
