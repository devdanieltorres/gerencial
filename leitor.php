<?php
// CONEXÃO COM O ARQUIVO CONEXAO
include_once 'conexao.php';

class Leitor
{
	public function comporTabela()
	{
		global $mysqli;

		// CONSULTA PARA LER A TABELA DO BANCO DE DADOS
		$consulta = "SELECT * FROM tb_gerencial ORDER BY class_status_select ASC";
		$con = $mysqli->query($consulta) or die($mysqli->error);

		// CONSULTA PARA SABER O TAMANHO QUE SERA O CAMPO CLASSIFICAÇÃO
		$consulta2 = "SELECT class_status_select as 'status', COUNT(id_page) AS 'quantidade' FROM `tb_gerencial` WHERE 1 GROUP BY class_status_select";
		$con2 = $mysqli->query($consulta2) or die($mysqli->error);

		$qtd_status = array();

		while ($status = $con2->fetch_assoc()) {
			$qtd_status[$status['status']] = $status['quantidade'];
		}

		// STYLE DA TABELA
		echo '
		<html>
			<head>
				<meta charset="utf8">
			</head>
			<body>
				<table class="table table-striped">
				<thead class="thead" style="
				background-color: #07558D;
				color: #fff;
				font-size: 15px;
				font-weight: 650;
				line-height: 15px;
				font-family: "Titillium Web","sans-serif";
				border-style: none;" >';

		// CABEÇALHO DA TABELA
		echo '
			<tr>
				<td>Classificação</td>
				<td>Produtos</td>
				<td>Sobre</td>
				<td>Relacionamento</td>
				<td>Concorrentes</td>
				<td>Capacidade</td>
				<td>Modelo de Negócio</td>
				<td>Manual do Usuário</td>
				<td>Conceitos de Mercado</td>
				<td>Gestão de Serviço</td>
				<td>Simulador</td>
				<td>Material Publicitário</td>
				<td>Clientes</td>
				<td>COMPLETUDE</td></thead>
			</tr>';

		// ESTRUTURA DA TABELA
		$num_status = 1;

		while ($dado = $con->fetch_array()) {
			echo '<tr>';
			if ($num_status == 1) {
				$num_status = $qtd_status[$dado["class_status_select"]];
				echo '<td rowspan="' . $qtd_status[$dado["class_status_select"]] . '">' . $dado["class_status_select"] . '</td>';
			} else {
				$num_status--;
			}
			echo '<td>' . $dado["product_name"] . '</td>';
			for ($i = 1; $i <= 11; $i++) {
				echo $this->tratarTexto($dado, $i);
			}
			echo $this->tratarTextoCompletude($dado);
			echo '</tr>';
		}
		echo '</table>
			</body>
		</html>';
	}

	private function tratarTexto($dado, $index)
	{
		if ($dado["field_".$index] != "") {
			return '<td>SIM</td>';
		} else {
			return '<td>NÃO</td>';
		}
	}

	private function tratarTextoCompletude($dado)
	{
		$totalCampos = 11;
		$camposPreenchidos = 0;

		for ($i = 1; $i <= $totalCampos; $i++) {
			if ($dado["field_".$i] != "") {
				$camposPreenchidos++;
			}
		}

		$completude = round(($camposPreenchidos / $totalCampos) * 100, 2);

		return '<td>'.$completude.'%</td>';
	}
}

// INSTANCIANDO A CLASSE
$leitor = new Leitor();
$leitor->comporTabela();
?>