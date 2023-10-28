<?php 
require_once './database/TTransaction.php';

class Preferences  {
    public static function getAll()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query('SELECT * FROM preferencias');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        TTransaction::closeConnection();
        return  $data;
    }

    public static function save($text, $img)
    {
        $conn = TTransaction::getConnection();

         $sql = "UPDATE preferencias SET
            titulo                    = :titulo,
            favicon                   = :favicon,
            logoCabecalho             = :logoCabecalho,
            linkFacebook              = :linkFacebook,
            linkInstagram             = :linkInstagram,
            tituloSecaoHome           = :tituloSecaoHome,
            subtituloSecaoHome        = :subtituloSecaoHome,
            imgSecaoHome              = :imgSecaoHome,
            tituloCaracteristicasHome = :tituloCaracteristicasHome,
            tituloSecaoTestemunho     = :tituloSecaoTestemunho,
            tituloSecaoLojaApps       = :tituloSecaoLojaApps,
            subtituloSecaoLojaApps    = :subtituloSecaoLojaApps,
            imgSecaoLojaApps          = :imgSecaoLojaApps,
            imgAppStore               = :imgAppStore,
            imgPlayStore              = :imgPlayStore,
            telContato                = :telContato,
            logoRodape                = :logoRodape,
            msgCopyright              = :msgCopyright,
            urlRodape                 = :urlRodape,
            msgPowered                = :msgPowered
            WHERE id = 0";

        $result = $conn->prepare($sql);
        $result->execute([
                          ':titulo' => $text['titulo'],
                          ':favicon' => $img['favicon'],
                          ':logoCabecalho' => $img['logoCabecalho'],
                          ':linkFacebook' => $text['linkFacebook'],
                          ':linkInstagram' => $text['linkInstagram'],
                          ':tituloSecaoHome' => $text['tituloSecaoHome'],
                          ':subtituloSecaoHome' => $text['subtituloSecaoHome'],
                          ':imgSecaoHome' => $img['imgSecaoHome'],
                          ':tituloCaracteristicasHome' => $text['tituloCaracteristicasHome'],
                          ':tituloSecaoTestemunho' => $text['tituloSecaoTestemunho'],
                          ':tituloSecaoLojaApps' => $text['tituloSecaoLojaApps'],
                          ':subtituloSecaoLojaApps' => $text['subtituloSecaoLojaApps'],
                          ':imgSecaoLojaApps' => $img['imgSecaoLojaApps'],
                          ':imgAppStore' => $img['imgAppStore'],
                          ':imgPlayStore' => $img['imgPlayStore'],
                          ':telContato' => $text['telContato'],
                          ':logoRodape' => $img['logoRodape'],
                          ':msgCopyright' => $text['msgCopyright'],
                          ':urlRodape' => $text['urlRodape'],
                          ':msgPowered' => $text['msgPowered']
                        ]);
        TTransaction::closeConnection();  
    }
}

 
        // return $params;