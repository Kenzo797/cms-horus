<?php 
require_once './database/TTransaction.php';

class Preferences  {
    public static function getAll()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query('SELECT * FROM preferencias');
        $data = $result->fetchAll();
        TTransaction::closeConnection();
        return  $data;
    }

    public static function save($params)
    {
        $conn = TTransaction::getConnection();

        $sql = "UPDATE preferencias SET
                titulo                    = :titulo,
                favicon                   = :favico,
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
                imgAppStore               = :imgAppStore;
                imgPlayStore              = :imgPlayStore,
                telContato                = :telContato,
                logoRodape                = :logoRodape,
                msgCopyright              = :msgCopyright,
                urlRodape                 = :urlRodape,
                msgPowered                = :msgPowered 
                WHERE id                  = :id";
        $result = $conn->prepare($sql);
        $result->execute([':id' => $params['id'],
                          ':titulo' => $params['titulo'],
                          ':favicon' => $params['favicon'],
                          ':logoCabecalho' => $params['logoCabecalho'],
                          ':linkFacebook' => $params['linkFacebook'],
                          ':linkInstagram' => $params['linkInstagram'],
                          ':tituloSecaoHome' => $params['tituloSecaoHome'],
                          ':subtituloSecaoHome' => $params['subtituloSecaoHome'],
                          ':imgSecaoHome' => $params['imgSecaoHome'],
                          ':tituloCaracteristicasHome' => $params['tituloCaracteristicasHome'],
                          ':tituloSecaoTestemunho' => $params['tituloSecaoTestemunho'],
                          ':tituloSecaoLojaApps' => $params['tituloSecaoLojaApps'],
                          ':subtituloSecaoLojaApps' => $params['subtituloSecaoLojaApps'],
                          ':imgSecaoLojaApps' => $params['imgSecaoLojaApps'],
                          ':imgAppStore' => $params['imgAppStore'],
                          ':imgPlayStore' => $params['imgPlayStore'],
                          ':telContato' => $params['telContato'],
                          ':logoRodape' => $params['logoRodape'],
                          ':msgCopyright' => $params['msgCopyright'],
                          ':urlRodape' => $params['urlRodape'],
                          ':msgPowered' => $params['msgPowered']
                        ]);
        return $params;
        TTtransaction::closeConnection();  
    }
}