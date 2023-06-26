<?php
// CONEXÃO COM O ARQUIVO LEITOR
require_once get_stylesheet_directory() . '/modulos/gerencial/leitor.php';
$leitor = new Leitor();
?>

<!-- APRESENTA RESUMO DE QUANTIDADES POR CLASSIFICACAO -->
<div class="row">
    <div class="col negrito-texto">
        <div class="card">
            <div class="card-body">
                <div class="titulo">Publicados
                    <div class="numero"><?php echo $leitor->getQuantidadePublicados(); ?></div>
                </div>
                <?php 
                $contador = 1;
				foreach ($leitor->getTituloPublicados() as $secao) { ?>
                    <div class="bloco-dados">
                        <div class="titulo">
                            <span><?php echo $secao ?></span>
                        </div>
                        <div class="numero">
                            <span>
                                <?php 
                                if($contador > 1){
                                    echo $leitor->getQuantidadeResumo($contador);
                                    $contador++;
                                }else{
                                    echo $leitor->getQuantidadeResumo($contador);
                                    $contador++;
                                }
                                ?>
                            </span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div> 
    </div>

    <!-- APRESENTA RESUMO DE QUANTIDADES POR SECAO -->
    <div class="col">
        <div class="card">
            <div class="card-body">
                <div>
                    <div class="negrito-texto">
                        <?php 
                        $contador = 1;
						foreach ($leitor->getTituloSecao() as $secao) { ?>
                            <div class="bloco-dados2">
                                <div class="titulo">
                                    <span><?php echo $secao ?></span>
                                </div>
                                <div class="numero">
                                    <span>
                                        <?php 
                                        if($contador > 1){
                                            echo $leitor->getQuantidadeSecao($contador);
                                            $contador++;
                                        }else{
                                            echo $leitor->getQuantidadeSecao($contador);
                                            $contador++;
                                        }
                                        ?>
                                    </span>
                                </div>
                            </div>
                        <?php } ?>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
<br>

<!-- APRESENTA RESUMO DE QUANTIDADES (COMPLETOS - EM ANDAMENTO - A FAZER) -->
<div class="row">
    <div class="col negrito-texto">
        <div class="card">
            <div class="card-body">
                <?php 
                $contador = 1;
                foreach ($leitor->getTituloCompletude() as $porcentagem => $secao) { ?>
                    <div class="bloco-dados">
                        <div class="titulo">
                            <span><?php echo $secao ?></span>
                        </div>
                        <div class="numero">
                            <span>
                                <?php 
                                if($contador > 1){
                                    echo $leitor->getQuantidadeStatus($contador);
                                    $contador++;
                                }else{
                                    echo $leitor->getQuantidadeStatus($contador);
                                    $contador++;
                                }
                                ?>
                            </span>
                        </div>
                        <div class="porcentagemt">
                            <span><?php echo $porcentagem ?></span>
                        </div>
                    </div>
                <?php } ?>
            </div>
        </div>
    </div>
</div>
<br>

<!-- TABELA -->
<div class="row">
    <div style="margin-right:100px; margin-left: -150px;">
        <?php
		    $leitor->comporTabela();
		?>
    </div>
</div>