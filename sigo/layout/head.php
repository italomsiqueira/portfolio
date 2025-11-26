<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">

    <!-- Favicon -->
    <link rel="shortcut icon" href="assets/img/favicon.png">

    <!-- CSS Bootstrap -->
    <link rel="stylesheet" href="assets/css/bootstrap.min.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/css/bootstrap-select.min.css">

    <!-- CSS personalizados -->
    <link rel="stylesheet" href="assets/css/cadastro.css">
    <link rel="stylesheet" href="assets/css/style.css">
    <!-- <link rel="stylesheet" href="assets/css/login.css"> -->

    <!-- Scripts jQuery e Bootstrap -->
    <script src='http://code.jquery.com/jquery-2.1.3.min.js'></script>
    <script src="assets/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap-select@1.13.14/dist/js/bootstrap-select.min.js"></script>

    <!-- Scripts personalizados -->
    <script src="assets/js/validacoes.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.mask/1.14.11/jquery.mask.min.js"></script>
    <script src="assets/js/jquery.btechco.excelexport.js"></script>
    <script src="assets/js/jquery.base64.js"></script>

    <!-- Título dinâmico da página -->
    <title><?php echo isset($titulo) ? $titulo . ' - SIGO' : 'SIGO'; ?></title>

    <!-- Scripts específicos -->
    <script type="text/javascript">
        // Máscaras de telefone e CPF
        $(document).ready(function() {
            if ($("#tel, #celular").length) {
                $("#tel, #celular").mask("(00) 00000-0000");
            }
            if ($('#cpf').length) {
                $('#cpf').mask("000.000.000-00");
            }

            // Exportação de tabela Excel
            if ($("#btnExport").length && $("#tblExport").length) {
                $("#btnExport").click(function() {
                    $("#tblExport").btechco_excelexport({
                        containerid: "tblExport",
                        datatype: $datatype.Table,
                        filename: '<?php echo $exportFilename ?? "Export"; ?>'
                    });
                });
            }
        });
    </script>

    <!-- TableExport -->
    <script src="https://cdn.jsdelivr.net/npm/tableexport@5.2.0/dist/js/tableexport.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/xlsx@0.18.5/dist/xlsx.full.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/file-saver@2.0.5/dist/FileSaver.min.js"></script>
</head>