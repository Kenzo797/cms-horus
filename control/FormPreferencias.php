<?php

require_once "model/Preferences.php";
class FormPreferencias
{
    private $html;
    private $pasta;
    private $dadosAssociativos;
    private $text;

    public function __construct()
    {
        $this->html = file_get_contents("./Layout/html/preferencias.html");
        $this->pasta = './files/';
        $this->dadosAssociativos = [];
        $this->text = [];
    }

    public function load()
    {
        try {
            $dados = Preferences::getAll();
            $this->text['titulo'] = $dados[0]['titulo'];
            $this->text['linkFacebook'] = $dados[0]['linkFacebook'];
            $this->text['tituloSecaoHome'] = $dados[0]['tituloSecaoHome'];
            $this->text['tituloCaracteristicasHome'] = $dados[0]['tituloCaracteristicasHome'];
            $this->text['tituloSecaoTestemunho'] = $dados[0]['tituloSecaoTestemunho'];
            $this->text['tituloSecaoLojaApps'] = $dados[0]['tituloSecaoLojaApps'];
            $this->text['subtituloSecaoLojaApps'] = $dados[0]['subtituloSecaoLojaApps'];
            $this->text['telContato'] = $dados[0]['telContato'];
            $this->text['msgCopyright'] = $dados[0]['msgCopyright'];
            $this->text['urlRodape'] = $dados[0]['urlRodape'];
            $this->text['msgPowered'] = $dados[0]['msgPowered'];
            $this->dadosAssociativos['favicon'] = $dados[0]['favicon'];
            $this->dadosAssociativos['logoCabecalho'] = $dados[0]['logoCabecalho'];
            $this->dadosAssociativos['imgSecaoHome'] = $dados[0]['imgSecaoHome'];
            $this->dadosAssociativos['imgSecaoLojaApps'] = $dados[0]['imgSecaoLojaApps'];
            $this->dadosAssociativos['imgAppStore'] = $dados[0]['imgAppStore'];
            $this->dadosAssociativos['imgPlayStore'] = $dados[0]['imgPlayStore'];
            $this->dadosAssociativos['logoRodape'] = $dados[0]['logoRodape'];
            

            foreach($dados as $dado)
            {
                $this->html = str_replace("{titulo}",                    $dado["titulo"],       $this->html);
                $this->html = str_replace("{linkFacebook}",              $dado["linkFacebook"], $this->html);
                $this->html = str_replace("{linkInstagram}",             $dado["linkInstagram"], $this->html);
                $this->html = str_replace("{tituloSecaoHome}",           $dado["tituloSecaoHome"], $this->html);
                $this->html = str_replace("{subtituloSecaoHome}",        $dado["subtituloSecaoHome"], $this->html);
                $this->html = str_replace("{tituloCaracteristicasHome}", $dado["tituloCaracteristicasHome"], $this->html);
                $this->html = str_replace("{tituloSecaoTestemunho}",     $dado["tituloSecaoTestemunho"], $this->html);
                $this->html = str_replace("{tituloSecaoLojaApps}",       $dado["tituloSecaoLojaApps"], $this->html);
                $this->html = str_replace("{subtituloSecaoLojaApps}",    $dado["subtituloSecaoLojaApps"], $this->html);
                $this->html = str_replace("{telContato}",                $dado["telContato"], $this->html);
                $this->html = str_replace("{msgCopyright}",              $dado["msgCopyright"], $this->html);
                $this->html = str_replace("{urlRodape}",                 $dado["urlRodape"], $this->html);
                $this->html = str_replace("{msgPowered}",                $dado["msgPowered"], $this->html);

                $this->html = str_replace("{favicon}",                $dado["favicon"], $this->html);
                $this->html = str_replace("{logoCabecalho}",                $dado["logoCabecalho"], $this->html);
                $this->html = str_replace("{imgSecaoHome}",                $dado["imgSecaoHome"], $this->html);
                $this->html = str_replace("{imgSecaoLojaApps}",                $dado["imgSecaoLojaApps"], $this->html);
                $this->html = str_replace("{imgAppStore}",                $dado["imgAppStore"], $this->html);
                $this->html = str_replace("{imgPlayStore}",                $dado["imgPlayStore"], $this->html);
                $this->html = str_replace("{logoRodape}",                $dado["logoRodape"], $this->html);
            }

             
        } catch (Exception $e) {
            print $e->getMessage();
        }
    }
    
    public function save($request, $files)
    {
        try 
        {
            $this->load();
            $this->text = $request;
            
            foreach ($files as $campo => $file) 
            {
                $nomeDoArquivo = $file['name'];
                $novoNomeDoArquivo = uniqid();
                $extensao = strtolower(pathinfo($nomeDoArquivo, PATHINFO_EXTENSION));

                $path = $this->pasta . $novoNomeDoArquivo . '.' . $extensao;
                
                $deu_certo = move_uploaded_file($file['tmp_name'], $path);

                if ($deu_certo) 
                {
                    $this->dadosAssociativos[$campo] = $path;
                }
            }

            return $dados = Preferences::save($this->text, $this->dadosAssociativos);
            
        } catch (Exception $e) 
        {
            return print $e->getMessage();
        }  
    }



    public function show()  
    {
        $this->load();
        return print $this->html;
    }
}
