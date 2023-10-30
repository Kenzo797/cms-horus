<?php

require_once 'model/Preferences.php';
require_once 'model/Depositions.php';
require_once 'control/DepositionsComponent.php';
require_once 'control/HomeFeaturesComponent.php';

class LandPage
{
    private $html;
    private $data;

    public function __construct()
    {
        $this->html  = file_get_contents("Layout/html/index.html");
    }

    public function load()
    {
        try 
        {
            $depositions = new DepositionsComponent();
            $features = new HomeFeaturesComponent();
            // $app = new HomeAppCompontent();
            $preferences = Preferences::getAll();
           

            foreach($preferences as $preference)
            {
                $this->html = str_replace('{headerLogo}',                    $preference['headerLogo'],           $this->html);
                $this->html = str_replace('{favicon}',                       $preference['favicon'],              $this->html);
                $this->html = str_replace('{imgHomeSection}',                $preference['imgHomeSection'],       $this->html);

                $this->html = str_replace('{facebook}',                      $preference['linkFacebook'],          $this->html);
                $this->html = str_replace('{instagram}',                     $preference['linkInstagram'],         $this->html);
                $this->html = str_replace('{title}',                         $preference['title'],                 $this->html);
                $this->html = str_replace('{titleHomeSection}',              $preference['titleHomeSection'],      $this->html);
                $this->html = str_replace('{titleFeaturesHome}',             $preference['titleFeaturesHome'],     $this->html);
                $this->html = str_replace('{titleTestimonySection}',         $preference['titleTestimonySection'], $this->html);

                $this->html = str_replace('{titleStoreSection}',             $preference['titleStoreSection'],     $this->html);
                $this->html = str_replace('{subTitleStoreSection}',          $preference['subTitleStoreSection'],  $this->html);
                $this->html = str_replace('{imgStoreAppsSection}',           $preference['imgStoreAppsSection'],   $this->html);
                $this->html = str_replace('{imgAppStore}',                   $preference['imgAppStore'],           $this->html);
                $this->html = str_replace('{imgPlayStore}',                  $preference['imgPlayStore'],          $this->html);
                $this->html = str_replace('{telContact}',                    $preference['telContact'],            $this->html);
                $this->html = str_replace('{footerLogo}',                    $preference['footerLogo'],            $this->html);
                $this->html = str_replace('{msgCopyright}',                  $preference['msgCopyright'],          $this->html);
                $this->html = str_replace('{urlFooter}',                     $preference['urlFooter'],             $this->html);
                $this->html = str_replace('{messagePowered}',                $preference['messagePowered'],        $this->html);
            }

            $this->html = str_replace("{depositions}", $depositions->get(), $this->html);
            $this->html = str_replace("{homee}", $features->get(), $this->html);

            // TODO - add no datagrid o campo name em depositions
            // TODO - Colocar o nome nas paginas 
            // TODO - colocar um campo no banco para o icone
        }
        catch(Exception $e)
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