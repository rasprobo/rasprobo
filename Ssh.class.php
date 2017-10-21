<?php
	class Ssh{
		private $usuario;
		private $host;
		private $porta;
		private $senha;
		private $conexao;
		private $retorno;
		function __construct($usuario, $host,$porta, $senha){
			$this->usuario = $usuario;
			$this->host = $host;
			$this->porta = $porta;
			$this->senha = $senha;
			
		}
		function conectar(){
			if($this->conexao = ssh2_connect($this->host, $this->porta)){
				if(ssh2_auth_password($this->conexao, $this->usuario, $this->senha)) { 
                		echo "AQUI";
				return true; 
				}else{
					return false;				
				}
			}else{
				return false;
			}
		}
		
		function desconetar(){
			executarComando("exit");
		}

		function enviarArquivo($arquivo, $local){
			 if(ssh2_scp_send($this->conexao, $arquivo,$local, 0660)) { 
            	return true; 
       		 }else{
				return false;
			 }
		}

		function pegarArquivo($arquivo, $local){
			 if(ssh2_scp_recv($this->conexao, $arquivo, $local)) { 
            	return true; 
       		 }else{
				return false;
			 }
		}

		function executarComando($comando){
			$this->retorno = ssh2_exec($this->conexao, $comando);
			stream_set_blocking($this->retorno, true); 
		}

		function pegarSaida(){
			 return stream_get_contents($this->retorno);
		}
		
	}
	/*  //RODAR COMANDO
		$teste = new Ssh("root", "192.168.1.250", "22", "rasp@oseqhk71");
		$teste->conectar();
		$teste->executarComando("ls -la");
		echo $teste->pegarSaida();
		$teste->desconectar();

		//ENVIAR ARQUIVO
		$teste = new Ssh("root", "192.168.1.250", "22", "rasp@oseqhk71");
		$teste->conectar();
		if($teste->enviarArquivo("/var/www/html/monitor/teste.txt","/root/testo.txt")){
			echo "enviado \n";
		}else{
			echo "não enviado \n";
		}
	
		//PEGAR ARQUIVO
		$teste = new Ssh("root", "192.168.1.250", "22", "rasp@oseqhk71");
		$teste->conectar();
		if($teste->pegarArquivo("/root/testo.txt","/var/www/html/teste.php")){
			echo " recebido \n";
		}else{
			echo "não recebido \n";
		}
	*/
?>
