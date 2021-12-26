<!doctype html>
<html lang="en">

<head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <style>
        body{
            width: 100%;
            height: 100%;
            background-color: #e7e7e7 !important;
        }
        .container {
            padding: 20px;
        }
        .card{
            background: linear-gradient(to bottom, #e2e2e2, #fff);
            width: 50%;
            margin-left: auto;
            margin-right: auto;
        }
        .php-code{
            margin: 10px;
        }
        .btn-color{
            background-color: #e7e7e7 !important;
            color: black !important;
            border: 1px solid #000 !important;
        }
        .btn-color:hover{
            background-color: #858585 !important;
            color: white !important;
        }
        .form-width{
            vertical-align: middle;
            padding: .375rem .75rem;
        }
        .form-label{
            font-weight: auto;
        }
        </style>
        <title>Backend - PHP - Mooving</title>
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.0/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-KyZXEAg3QhqLMpG8r+8fhAXLRk2vvoC2f3B09zVXn8CA5QIVfZOJ3BCsw2P0p/We" crossorigin="anonymous">
</head>
<body>
    <div class="container">
        <div class="card">
            <form action="main.php" method="post">
                <div class="my-3 php-code" >
                    <p>
                    <h3>
                        Caixa Eletrônico - Mooving
                    </h3>
                   <b> Limite de saque:</b><br/>
                    Conta Corrente: B$ 600;<br/>
                    Poupança: B$ 1.000.
                    </p>
                   <b> Saldo em conta: B$</b>
                    <?php 
                    if (!isset($saldoConta)){
                        $saldoConta = 1200;
                    }
                    echo $saldoConta
                    ?>
                    <br/>
                    <div class="my-3">
                        <b>Taxas para saque:<br/></b>
                        <p>
                            Conta Corrente: B$ 2,50;<br/>
                            Conta Poupança: B$ 0,80;
                        </p>
                    </div>
                    <select class="form-select" aria-label="Default select example" id = 'operation' name = 'operation'>
                        <option selected>Selecione o tipo de transação:</option>
                        <option value="saqueCC">Saque Conta Corrente</option>
                        <option value="saquePoupanca">Saque Poupança</option>
                        <option value="deposito">Depósito</option>
                        <option value="transferencia">Transferência</option>
                    </select>
                    <label class="form-label ">Valor da operação:</label>

                    <input  class="form-control" required="true"  name = "value" method="POST"/>
                    <button typ
                    e="submit" class="btn btn-color">Enviar</button>

                </div>

                <div class="php-code">
                <?php
                require "./src/cashMachine.php";

                // $saldoConta = 1200;
                $operation = filter_input(INPUT_POST, 'operation', FILTER_SANITIZE_STRING);
                $accountXYZ = [];
                if($operation == 'transferencia'){
                    $accountXYZ=[
                        'valueTotal'=>2000,
                        'name'=> 'Weslley Hendz',            
                    ];
                }
                if (isset(($_POST['value'])) and isset($operation)) {
                    //Ex:
                    // Saque Poupança: Limite de B$1000 e taxa de B$0.80
                    // $accountABC = [
                    //     'type' => 'saquePoupanca',
                    //     'valueTotal' => 1200,
                    //     'value' => 900
                    // ];
                    $value = [];
                    $value =
                        [
                        'type' => $operation,
                        'valueTotal' => $saldoConta,
                        'value' => $_POST['value'],
                    ];
                    $request = new cashMachine();
                    $print = $request->electronicBank($value, $accountXYZ);
                    echo $print;
                }
                ?>
                </div>
            </form>
        </div>
    </div>
</body>
</html>
