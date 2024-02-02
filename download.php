<?php
// Verifica se o CNPJ foi enviado via POST
if(isset($_POST['cnpj'])) {
    // Obtém o CNPJ, o mês e ano do formulário 
    $procurarCnpj = $_POST['cnpj'];
    $procurarmes = $_POST['mesAno'];
    $nomeArquivo = date('m-Y', strtotime($procurarmes));
    $nomeArquivo = "XML-" . $nomeArquivo . ".zip";
    

    // Configurações do servidor FTP
    $ftpServer = "atomobackup.ddns.net";
    $ftpUsername = "contabil";
    $ftpPassword = "c07@b1l";

    // Caminho remoto do arquivo no servidor FTP
    $remoteFilePath = "/".$procurarCnpj."/".$nomeArquivo;

    // Caminho local onde o arquivo será salvo
    $localFilePath = "C:/".$nomeArquivo;

    // Conexão com o servidor FTP
    $ftpConnection = ftp_connect($ftpServer);
    if (!$ftpConnection) {
        die("Não foi possível conectar ao servidor FTP");
    }

    // Login no servidor FTP
    $loginResult = ftp_login($ftpConnection, $ftpUsername, $ftpPassword);
    if (!$loginResult) {
        die("Falha ao fazer login no servidor FTP");
    }

    // Baixar o arquivo do servidor FTP
    if (ftp_get($ftpConnection, $localFilePath, $remoteFilePath, FTP_BINARY)) {
        echo "Arquivo baixado com sucesso";
       echo "C:/Users/".getenv('USERNAME')."/Downloads/".$nomeArquivo;
    } else {
        echo "Erro ao baixar o arquivo";
        echo "C:/Users/".getenv('USERNAME')."/Downloads/".$nomeArquivo;
    }

    // Fechar a conexão com o servidor FTP
    ftp_close($ftpConnection);
} else {
    echo "CNPJ não foi enviado.";
}
?>
$
