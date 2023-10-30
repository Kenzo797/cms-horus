<?php

require_once "model/Preferences.php";
class FormPreferences
{
    private $html;
    private $pasta;
    private $dadosAssociativos;
    private $text;
    private $id;

    public function __construct()
    {
        $this->html = file_get_contents("./Layout/html/preferencias.html");
        $this->pasta = './files/';
        $this->dadosAssociativos = ['favicon' => '',
                                    'headerLogo' => '',                                    
                                    'imgHomeSection' => '',                                    
                                    'imgStoreAppsSection' => '',                                    
                                    'imgAppStore' => '',                                    
                                    'imgPlayStore' => '',                                    
                                    'footerLogo' => '',                                    
    ];
        $this->id = ['id' => ''];
        $this->text = ['title' => '',
                       'linkFacebook'=> '',
                       'linkInstagram' => '',
                       'titleHomeSection' => '',
                       'subtitleHomeSection' => '',
                       'titleFeaturesHome' => '',
                       'titleTestimonySection' => '',
                       'titleStoreSection' => '',
                       'subTitleStoreSection' => '',
                       'telContact' => '',
                       'msgCopyright' => '',
                       'urlFooter' => '',
                       'messagePowered' => ''
                    ];
    }

    public function load()
    {
        try {
            $dados = Preferences::getAll();
            // print_r($dados);
            
            if(!empty($dados))
            {       
                $this->id = $dados[0]['id'];
                $this->text['title'] = $dados[0]['title'];
                $this->text['linkFacebook'] = $dados[0]['linkFacebook'];
                $this->text['linkInstagram'] = $dados[0]['linkInstagram'];
                $this->text['titleHomeSection'] = $dados[0]['titleHomeSection'];
                $this->text['subtitleHomeSection'] = $dados[0]['subtitleHomeSection'];
                $this->text['titleFeaturesHome'] = $dados[0]['titleFeaturesHome'];
                $this->text['titleTestimonySection'] = $dados[0]['titleTestimonySection'];
                $this->text['titleStoreSection'] = $dados[0]['titleStoreSection'];
                $this->text['subTitleStoreSection'] = $dados[0]['subTitleStoreSection'];
                $this->text['telContact'] = $dados[0]['telContact'];
                $this->text['msgCopyright'] = $dados[0]['msgCopyright'];
                $this->text['urlFooter'] = $dados[0]['urlFooter'];
                $this->text['messagePowered'] = $dados[0]['messagePowered'];


                $this->dadosAssociativos['favicon']             = $dados[0]['favicon'];
                $this->dadosAssociativos['headerLogo']          = $dados[0]['headerLogo'];
                $this->dadosAssociativos['imgHomeSection']      = $dados[0]['imgHomeSection'];
                $this->dadosAssociativos['imgStoreAppsSection'] = $dados[0]['imgStoreAppsSection'];
                $this->dadosAssociativos['imgAppStore']         = $dados[0]['imgAppStore'];
                $this->dadosAssociativos['imgPlayStore']        = $dados[0]['imgPlayStore'];
                $this->dadosAssociativos['footerLogo']          = $dados[0]['footerLogo'];
                // ver com as img
            }
           // TODO - accept=".jpg, .jpeg, .png" />
               
            $this->html = str_replace("{title}",                  $this->text['title'],                 $this->html);
            $this->html = str_replace("{linkFacebook}",           $this->text['linkFacebook'],          $this->html);
            $this->html = str_replace("{linkInstagram}",          $this->text['linkInstagram'],         $this->html);
            $this->html = str_replace("{titleHomeSection}",       $this->text['titleHomeSection'],      $this->html);
            $this->html = str_replace("{subtitleHomeSection}",    $this->text['subtitleHomeSection'],   $this->html);
            $this->html = str_replace("{titleFeaturesHome}",      $this->text['titleFeaturesHome'],     $this->html);
            $this->html = str_replace("{titleTestimonySection}",  $this->text['titleTestimonySection'], $this->html);
            $this->html = str_replace("{titleStoreSection}",      $this->text['titleStoreSection'],     $this->html);
            $this->html = str_replace("{subTitleStoreSection}",   $this->text['subTitleStoreSection'],  $this->html);
            $this->html = str_replace("{telContact}",             $this->text['telContact'],            $this->html);
            $this->html = str_replace("{msgCopyright}",           $this->text['msgCopyright'],          $this->html);
            $this->html = str_replace("{urlFooter}",              $this->text['urlFooter'],             $this->html);
            $this->html = str_replace("{messagePowered}",         $this->text['messagePowered'],        $this->html);
              
             
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

            $dados = Preferences::save($this->text, $this->dadosAssociativos, $this->id);
            return header("Location: index.php?class=FormPreferences");
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
