<?php 
require_once './database/TTransaction.php';

class Preferences  {
    public static function getAll()
    {
        $conn = TTransaction::getConnection();
        $result = $conn->query('SELECT * FROM preferences');
        $data = $result->fetchAll(PDO::FETCH_ASSOC);
        TTransaction::closeConnection();
        return  $data;
    }

    public static function save($text, $img, $id)
    {
        $conn = TTransaction::getConnection();
    
        if (isset($id)) {
            $sql = "UPDATE preferences SET
            title                    = :title,
            favicon                   = :favicon,
            headerLogo             = :headerLogo,
            linkFacebook              = :linkFacebook,
            linkInstagram             = :linkInstagram,
            titleHomeSection           = :titleHomeSection,
            subtitleHomeSection        = :subtitleHomeSection,
            imgHomeSection              = :imgHomeSection,
            titleFeaturesHome = :titleFeaturesHome,
            titleTestimonySection     = :titleTestimonySection,
            titleStoreSection       = :titleStoreSection,
            subTitleStoreSection    = :subTitleStoreSection,
            imgStoreAppsSection          = :imgStoreAppsSection,
            imgAppStore               = :imgAppStore,
            imgPlayStore              = :imgPlayStore,
            telContact                = :telContact,
            footerLogo                = :footerLogo,
            msgCopyright              = :msgCopyright,
            urlFooter                 = :urlFooter,
            messagePowered                = :messagePowered
            WHERE id = :id";
        } else {
            $sql = "INSERT INTO preferences (id, title, favicon, headerLogo, linkFacebook, linkInstagram, titleHomeSection, subtitleHomeSection,
            imgHomeSection, titleFeaturesHome, titleTestimonySection, titleStoreSection, subTitleStoreSection,
            imgStoreAppsSection, imgAppStore, imgPlayStore, telContact, footerLogo, msgCopyright, urlFooter, messagePowered)
            VALUES (1, :title, :favicon, :headerLogo, :linkFacebook, :linkInstagram, :titleHomeSection, :subtitleHomeSection,
            :imgHomeSection, :titleFeaturesHome, :titleTestimonySection, :titleStoreSection, :subTitleStoreSection,
            :imgStoreAppsSection, :imgAppStore, :imgPlayStore, :telContact, :footerLogo, :msgCopyright, :urlFooter, :messagePowered)";
        }

        $result = $conn->prepare($sql);
        $result->execute([
            ':id' => $id, // Certifique-se de passar o ID
            ':title' => $text['title'],
            ':favicon' => $img['favicon'],
            ':headerLogo' => $img['headerLogo'],
            ':linkFacebook' => $text['linkFacebook'],
            ':linkInstagram' => $text['linkInstagram'],
            ':titleHomeSection' => $text['titleHomeSection'],
            ':subtitleHomeSection' => $text['subtitleHomeSection'],
            ':imgHomeSection' => $img['imgHomeSection'],
            ':titleFeaturesHome' => $text['titleFeaturesHome'],
            ':titleTestimonySection' => $text['titleTestimonySection'],
            ':titleStoreSection' => $text['titleStoreSection'],
            ':subTitleStoreSection' => $text['subTitleStoreSection'],
            ':imgStoreAppsSection' => $img['imgStoreAppsSection'],
            ':imgAppStore' => $img['imgAppStore'],
            ':imgPlayStore' => $img['imgPlayStore'],
            ':telContact' => $text['telContact'],
            ':footerLogo' => $img['footerLogo'],
            ':msgCopyright' => $text['msgCopyright'],
            ':urlFooter' => $text['urlFooter'],
            ':messagePowered' => $text['messagePowered']
        ]);

        TTransaction::closeConnection();  
        return;
    }

}

 
        // return $params;