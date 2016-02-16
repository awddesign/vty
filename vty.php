<?php
     
/*
     
VTY - Database Manager For Mysql

     
LICENSE
............................................................................
: GNU General Public License (GPL)     :
:              :
:              :
:              :
:...........................................................................
     
     
INSTALL
............................................................................
: Only enter the correct connection informations below.        :
:              :
:              :
:...........................................................................
     
*/
     
$ayar['LoginType'] = 'config_or_login';

          // "config" - Connect to server with connection information in this page.
          // "config_or_login" - Connect to server connection information in this page or with login screen.
          // "login" -  Connect to server with only login screen.

$ayar['dbuser'] = 'root'; // YOUR MYSQL USER NAME
$ayar['dbpass'] = ''; // YOUR MYSQL PASSWORD
$ayar['dbhost'] = 'localhost';    // host name to connect to database server
$ayar['dbname'] = ''; // Want to you only one database. Write its name or keep empry.

$ayar['DefaultLang'] = 'en';      // default language like en,de,tr
$ayar['db_type'] = 'mysql';       // "mysql";
$ayar['PerPage'] = 25;// number of rows to show per page.
$ayar['DbSecimi'] = 1;// is there "Choose Database"? 1 for true, 0 for false; -> default : 1
$ayar['NfGoster'] = 1;// ( 1 to Show, 0 to hide ) numrows and numfields for tables; -> default : 1
$ayar['NtGoster'] = 1;// ( 1 to Show, 0 to hide ) table number for databases; -> default : 1

?>
<?php
     
     
     
        $vty = new vty($ayar);
     
$vty->baglan();
     
if($vty->baglanti==0):
        $vty->ust();
        $vty->girisForm();
else:
        $vty->linkler();
        if($vty->ne=='' or $vty->ne == 'duzelt'){
    $vty->ust();
    $vty->db_secimi();
            if(!empty($vty->dbname) and !empty($vty->tablename)){
            $tablo = new tablo($vty);
            $tablo->asil_tablo();
    }else{
            $vty->db_seciniz_linkler();
    }
        }elseif($vty->ne=='sectim'){
    $vty->ust();
    $sct = new sectim($vty);
    if($sct->sdsduzelt<>''){
            $sct->_duzelt();
    } elseif($vty->nebu == "duzeltiyorum" ){
            $sct->_duzeltiyorum();
    }elseif($sct->sdssil<>''){
        $sct->_hepsiniSil();
    } elseif($vty->nebu == "bunlariduzelt" ){
            $sct->_bunlariDuzelt();
    }
        }else{
    $isl = new islemler($vty);
    switch($vty->ne):
   
    case 'sesscikis':
            $isl->sesscikis();
            break;
           
    case 'sqlgoster':
            $vty->ust();
            $isl->SqlGoster();
            $vty->tabloSonu();
            break;
           
    case 'sqldosyadan':
            $isl->SqlDosyadan();
            break;
           
    case 'dumpet':
            if($vty->nebu=='sim'){
        $isl->DumpEtSimdi();
            }else{
        $isl->DumpEt();
            }
            break;
       
        case 'satirgir':
            $isl->satirgir();
            break;
     
        case 'satirgir_yap':
            $isl->satirgir_yap();
            break;
     
    case 'yeniTbEkle':
            $vty->ust();
            $isl->YeniTableEkle();
            break;
           
    case 'yenitbekliyorum':
            if($vty->gp('fieldsayisi')){
        $vty->ust();
        $isl->YeniTableEkliyorum();
            }else{
        $vty->HataGoster("Empty Form!");
            }
    break;
    case 'yeniDbEkle':
            $isl->YeniDatabaseEkle();
    break;
    case 'yeniDbEkliyorum':
            $isl->YeniDatabaseEkliyorum();
    break;
    case 'dbSil':
            $isl->DatabaseSil();
    break;
    case 'tablo_bosalt':
            $isl->tablo_bosalt();
        break;
    case 'tablo_kaldir':
            $isl->tablo_kaldir();
    break;
    case 'lang':
            $isl->Language($vty->gp('fDilSubmit'));
    break;
    case 'docs':
        $vty->ust();
        $vty->tabloBasi3();
    $docs = new Docs($vty);
        $vty->tabloSonu();
    break;
    endswitch;
        }
        endif;
     
$vty->BitimIslemleri();
     
    ?>
    <?php
     
    /**
    * class dug
    *
    * This class includes the language informations and the display informations
    */
    class dug
    {
var $dil;
var $uy;
var $gor;
var $dl;
var $diller;
     
function dug($dl='en'){
        $this->dl = $dl;
        $this->dil();
        $this->gor();
}
     
/**
* gor()
*
* The color and size informations used in table and fonts ex.
*
*/
function gor(){
        $gor['table_width'] = '100%';         // $table_width width for <table>; -> default : '600'
        $gor['table_height'] = null;          // $table_width width for <table>; -> default : '600'
        $gor['koyu_bgcolor'] = '#e9e9e9';     // bgcolor for menu ; -> default : '#eeeeee'
        $gor['enust_bgcolor'] = '#f0f0f0';    // bgcolor for menu ; -> default : '#f0f0f0'
        $gor['enalt_bgcolor'] = '#f8f8f8';    // bgcolor for menu ; -> sub tables : '#f7f7f7'
        $gor['ust_bgcolor'] = '#eeeeff';      // bgcolor for top; -> default : '#eeeeff'
        $gor['alt_bgcolor'] = '#f2f2f2';      // bgcolor for bottom; -> default : '#f9f9f9'
        $gor['bgcolor2'] = '#f6f6f6';         // bgcolor; -> default : '#f6f6f6'
        $gor['bgcolor3'] = '#f9f9f9';         // bgcolor; -> default : '#f9f9f9'
        $gor['ikirenklicolor1'] = '#f5f5f5';  // bgcolor for rows 1; -> default : '#f0f0f0'
        $gor['ikirenklicolor2'] = '#f9f9f9';  // bgcolor for rows 2; -> default : '#f7f7f7'
        $gor['cellspacing'] = '1';            // cellspacing for all tables; -> default : '1'
        $gor['cellpadding'] = '1';            // cellpading for all tables; -> default : '1'
        $gor['border'] = '0';     // border for all tabels; -> dafault : '0'
        $gor['input_size'] = '10';            // size for text input tags; -> dafault : '10'
        $gor['asilTbSagYan'] = '110';
        $gor['asilTbSolYan'] = '90';
        $gor['StrlenMax'] = '50'; // max chars for shorter view; -> dafault : '50'
        $this->gor = $gor;
}
     
/**
* diller()
*
* List of languages that vty support
*
*/
function diller(){
        return array(
    'en' => 'English',
    'tr' => 'Türkçe',
    'it' => 'Italiano',
    'es' => 'Espa?ol'
        );
}
     
/**
* dil()
*
* Words that used in Vty interface, in languages listed diller() function.
*
*/
function dil(){
        if($this->dl=='tr'){
     
    /**
    * Türkçe
    */
    $dil['Charset']          = 'iso-8859-9';    //iso-8859-1
    $dil['dil']  = 'Dil';           //Language
    $dil['Duzelt']           = 'Düzelt';        //"Edit"
    $dil['Sil']  = 'Sil';           //"Delete"
    $dil['Kaydet']           = 'Kaydet';        //"Save"
    $dil['Gonder']           = 'G?nder';        //"Send"
    $dil['Reset']= 'Temizle';       //"Reset"
    $dil['Tamam']= 'Tamam';         //"OK"
    $dil['Uygula']           = 'Uygula';        //"Apply"
    $dil['Iptal']= '?ptal';         //"Cancel"
    $dil['Yukari']           = 'Yukar?';        //"Up Level"
    $dil['Satir']= 'Sat?r';         //"Line"
    $dil['Hata'] = 'Hata';          //"Error"
    $dil['HataAcklm']        = 'Hata aç?klamas?';           //"Error desciription"
    $dil['MysqlHata']        = 'Mysql Hatas?';           //"Error desciription"
    $dil['Cevap']= 'Cevap';         //"Answer"
    $dil['Evet'] = 'Evet';          //"Yes"
    $dil['Hayir']= 'Hay?r';         //"No"
    $dil['Ekle'] = 'Ekle';          //"Add"
    $dil['Olustur']          = 'Olu?tur';       //"Create"
    $dil['Devam']= 'Devam';         //"Next"
    $dil['Geri'] = 'Geri';          //"Back"
    $dil['Seciniz']          = 'Seçiniz';       //"Choose"
    $dil['YeniTbAdi']        = 'Yeni tablo ad?';//"New table name"
    $dil['DbEkle']           = 'CREATE DATABASE';           //"CREATE DATABASE"
    $dil['TbEkle']           = 'CREATE TABLE';  //"CREATE TABLE"
    $dil['DbSil']= 'DROP this DATABASE';        //"DROP this DATABASE"
    $dil['Gelistir']         = 'Geli?tir';      //"Develop"
    $dil['Ayarlar']          = 'Ayarlar';       //"Options"
    $dil['Yardim']           = 'Yard?m';        //"Help"
    $dil['VtYonet']          = 'MySQL için '.
       'veritaban? y?neticisi';     //"Database manager for MySQL"
    $dil['Vt']   = 'Veritaban?';    //"Database"
    $dil['Dosyadan']         = 'Dosyadan';      //"From File"
    $dil['Tablo']= 'Tablo';         //"Table"
    $dil['VtSeciniz']        = 'Ba?lamak için bir '.
       'veritaban? seçiniz';        //"Choose a Database to Start"
    $dil['TbSeciniz']        = 'Tablo seçiniz'; //"Choose a Table"
    $dil['SayfaYnl']         = 'Sayfay? Yenile';//"Refresh"
    $dil['Sorgu']= 'Sorgu';         //"Query"
    $dil['Sql']  = 'Sql Sorgusu';   //"Sql Query"
    $dil['SqlSonucu']        = 'Sql Sonucu';    //"Sql Results"
    $dil['Buyut']= 'Büyüt';         //"&lt; Longer &gt;"
    $dil['Uzat'] = '&lt; Uzat &gt;';//"&lt; Longer &gt;"
    $dil['Kisalt']           = '&gt; K?salt &lt;';          //"&gt; Shorter &lt;"
    $dil['Hep']  = 'Hep';           //"All"
    $dil['Hic']  = 'Hiç';           //"None"
    $dil['EnAlt']= 'En Alt';        //"Bottom"
    $dil['EnUst']= 'En ?st';        //"Top"
    $dil['VtAdi']= 'Veritaban?Ad?'; //"DatabaseName"
    $dil['TbAdi']= 'TabloAd?';      //"TableName"
    $dil['SutunSys']         = 'Sütun Say?s?';  //"Field Number"
    $dil['TbBosalt']         = 'Bu tabloyu bo?alt';         //"EMPTY this TABLE"
    $dil['TbKaldir']         = 'Bu tabloyu kald?r';         //"DROP this TABLE"
    $dil['DumpTables']       = 'D?küm Olu?tur'; //"DUMP"
    $dil['SatirEkle']        = 'Yeni Sat?r Ekle';           //"Add New Row"
    $dil['SatirDzlt']        = 'Sat?rlar? Düzelt';          //"Edit Rows"
    $dil['DbHost']           = 'Host';          //"Host Name"
    $dil['DbKullAdi']        = 'Kullan?c? Ad?'; //"User Name"
    $dil['DbSifre']          = '?ifre';         //"Password"
    $dil['SessCikis']        = '??k??';         //"Session Log Out"
    $dil['db_type']          = 'Veritaban?';    //"Server Type"
    $dil['GrsHts']           = 'Ba?lant? Hatas?';           //"Connection Error"
    $dil['sayfalar']         = 'Sayfalar';      //"Pages"
    $dil['sayfa']= 'Sayfa';         //"Page"
    $dil['SayfaBasi']        = 'Sayfa Ba??';    //"Rows per page"
    $dil['Yeni'] = 'Yeni';          //"New"
    $dil['AnaMenu']          = 'Ana Sayfa';     //"Main Menu"
    $dil['WellComeToVty']    = "VTY'ye Ho? Geldiniz";       //"Wellcome to Vty"
    $dil['About']= "Hakk?nda";        //"about"
    $dil['Bugs'] = "Hatalar";   //"Bugs"
    $dil['DumpTable']         = 'Dump Table';       //"Dump Table"
    $dil['DumpBoth']         = '"Insert Into" ve "Create Table" bilgilerini dump et';       //Both of "Insert Into" and "Create Table"
    $dil['DumpCreateOnly']   = 'sadece "Create Table" bilgisi';     //"Create Table" info only
    $dil['DumpInsertOnly']   = '"Insert Into" bilgisi';     //"Insert Into" info only
    $dil['SaveAsFile']       = "Dosya olarak kaydet";       //"Save as file"
    $dil['DumpSubmit']       = "?imdi Dump Et";    //"Dump Now"
     
    $uy['EminmisinCikis']    = "Oturumunuzu kapat?p ç?kmak istedi?inizden emin misiniz?\\n";
    $uy['EminmisinSil']      = "Seçti?iniz sat?r? silmek istedi?inizden emin misiniz?\\n";
    $uy['EminmisinBosalt']   = "Seçti?iniz sat?r? bo?altmak istedi?inizden emin misiniz?";
    $uy['EminmisinKaldir']   = "Seçti?iniz sat?r? kald?rmak istedi?inizden emin misiniz?";
    $uy['EminmisinDbSil']    = 'Emin misiniz?\\nSeçti?iniz veritaban?n? kald?rmak istiyor musunuz?';
    $uy['KomutCalistirildi'] = 'Sorgu çal??t?r?ld?';
    $uy['KacSatirEtkilendi'] = 'sat?r etkilendi';
    $uy['loginBilgi']        = 'Database serverina ba?lanmak için kullan?c? ad?n?z? ve ?ifresinizi giriniz. (Cookie abanl?.)';
    $uy['destekYok']         = 'Php ayarlar?n?z @DbType@ ile ilgili fonksiyonlar? desteklememektedir.';
    $uy['YeniDbOldu']        = '`@NewDbName@` veritaban? olu?turuldu.';
    $uy['YeniDbHata']        = 'Yeni `@NewDbName@` veritaban? olu?turulurken hata oldu.';
    $uy['YeniTbOldu']        = '`@NewTbName@` tablosu olu?turuldu.';
    $uy['YeniTbHata']        = 'Yeni `@NewTbName@` tablosu olu?turulurken hata oldu.';
    $uy['DbSilEminmi']       = 'Emin misiniz? `@DbName@` veritaban?n? kald?rmak istiyor musunuz?';
    $uy['DbSilHata']         = '`@DbName@` veritaban?n? kald?r?l?rken hata olu?tu.';
    $uy['DbSilOldu']         = '`@DbName@` veritaban? kald?r?ld?.';
    $uy['YeniSatirOldu']     = 'Yeni sat?r eklendi.';
    $uy['YeniSatirHata']     = 'Yeni sat?r eklerken hata olu?tu.';
    $uy['SatirlarDuzeldi']   = 'Seçti?iniz sat?rlar düzeltildi.';
    $uy['SatirlarDuzeltHata']= 'Seçti?iniz sat?rlar düzeltilirken hata olu?tu.';
    $uy['SatirDuzeldi']      = 'Seçti?iniz sat?r düzeltildi.';
    $uy['SatirDuzelHata']    = 'Seçti?iniz sat?r düzeltilirken hata olu?tu.';
    $uy['SatirSilindi']      = 'Seçti?iniz sat?r silindi.';
    $uy['SatirSilHata']      = 'Seçti?iniz sat?r silinirken hata olu?tu.';
    $uy['SatirNSilindi']     = 'Seçti?iniz @number@ sat?r silindi.';
    $uy['SatirSilNHata']     = 'Seçti?iniz sat?rlardan @number@ tanesi silinirken hata olustu.';
    $uy['OturumKapa']        = 'Oturum kapat?ld?.';
    $uy['OturumKaHata']      = 'Oturum kapat?l?rken hata olu?tu.';
    $uy['ToplamSatir']       = 'Sat?r Say?s?: @number@';
    $uy['SatirYok']          = 'Tabloda hiç sat?r yok.';
    $uy['BosaltEmin']        = '@DbTable@ tablosunu bo?altmak istedi?inizden istiyor musunuz?';
    $uy['BosaltOldu']        = '@DbTable@ tablosu bo?alt?ld?.';
    $uy['BosaltHata']        = '@DbTable@ tablosu bo?alt?l?rken hata olu?tu.';
    $uy['KaldirEmin']        = '@DbTable@ tablosunu kald?rmak istedi?inizden emin misiniz?';
    $uy['KaldirOldu']        = '@DbTable@ tablosu kald?r?ld?.';
    $uy['KaldirHata']        = '@DbTable@ tablosu kald?r?l?rken hata olu?tu.';
    $uy['YeniDilSec']        = 'Select your new language';
    $uy['CookieError']       = 'Taray?c?n?z çerezleri (cookie) kabul etmemektedir. Lütfen taray?c?n?z ayarlar?n? de?i?tiriniz.';
    $uy['CookieErrorBas']    = 'Cookie Hatas?';
     
        }elseif($this->dl=='es'){
    /**
    * Espa?ol
    */ 
     
    /// <TRANSLATE_HERE>
    $dil['Charset']          = 'iso-8859-1';     //iso-8859-1
    $dil['dil']  = 'Idioma';         //Language
    $dil['Duzelt']           = 'Editar';         //"Edit"
    $dil['Sil']  = 'Suprimir';       //"Delete"
    $dil['Kaydet']           = 'Guardar';        //"Save"
    $dil['Gonder']           = 'Enviar';         //"Send"
    $dil['Reset']= 'Borrar';         //"Reset"
    $dil['Tamam']= 'Aceptar';        //"OK"
    $dil['Uygula']           = 'Aplicar';        //"Apply"
    $dil['Iptal']= 'Cancelar';       //"Cancel"
    $dil['Yukari']           = 'Nivel anterior'; //"Up Level"
    $dil['Satir']= 'Linea';          //"Line"
    $dil['Hata'] = 'Error';          //"Error"
    $dil['HataAcklm']        = 'Error en Descripci?n';       //"Error desciription"
    $dil['MysqlHata']        = 'Mysql Error';    //"Mysql Error"
    $dil['Cevap']= 'Respuesta';      //"Answer"
    $dil['Evet'] = 'Si'; //"Yes"
    $dil['Hayir']= 'No'; //"No"
    $dil['Ekle'] = 'A?adir';         //"Add"
    $dil['Olustur']          = 'Crear';          //"Create"
    $dil['Devam']= 'Siguiente';      //"Next"
    $dil['Geri'] = 'Atras';          //"Back"
    $dil['Seciniz']          = 'Seleccionar';    //"Choose"
    $dil['YeniTbAdi']        = 'Nombre Nueva Tabla';         //"New table name"
    $dil['DbEkle']           = 'Crear Base de Datos';        //"CREATE DATABASE"
    $dil['TbEkle']           = 'Crear Tabla';    //"CREATE TABLE"
    $dil['DbSil']= 'Suprimir Base de Datos';     //"DROP this DATABASE"
    $dil['Gelistir']         = 'Desarrollar';    //"Develop"
    $dil['Ayarlar']          = 'Opciones';       //"Options"
    $dil['Yardim']           = 'Ayuda';          //"Help"
    $dil['VtYonet']          = 'Administrador de Bases de Datos MySQL'; //"Database manager for MySQL"
    $dil['Vt']   = 'Base de Datos';  //"Database"
    $dil['Dosyadan']         = 'Del Archivo';    //"From File"
    $dil['Tablo']= 'Tabla';          //"Table"
    $dil['VtSeciniz']        = 'Seleccionar Base de Datos '; //"Choose a Database to Start"
    $dil['TbSeciniz']        = 'Seleccionar Tabla';          //"Choose a Table"
    $dil['SayfaYnl']         = 'Actualizar';     //"Refresh"
    $dil['Sorgu']= 'Interrogaci?n';  //"Query"
    $dil['Sql']  = 'Interrogaci?n SQL';          //"Sql Query"
    $dil['SqlSonucu']        = 'Resultados SQL'; //"Sql Results"
    $dil['Buyut']= 'Ampliar';        //"Larger"
    $dil['Uzat'] = '&lt; Mas Largo &gt;';        //"&lt; Longer &gt;"
    $dil['Kisalt']           = '&gt; Mas Corto &lt;';        //"&gt; Shorter &lt;"
    $dil['Hep']  = 'Todos';          //"All"
    $dil['Hic']  = 'Ninguno';        //"None"
    $dil['EnAlt']= 'Abajo';          //"Bottom"
    $dil['EnUst']= 'Arriba';         //"Top"
    $dil['VtAdi']= 'Nombre de la Base de Datos'; //"DatabaseName"
    $dil['TbAdi']= 'Nombre de la Tabla';         //"TableName"
    $dil['SutunSys']         = 'Numero de Campos';           //"Field Number"
    $dil['TbBosalt']         = 'Vaciar Tabla';   //"EMPTY this TABLE"
    $dil['TbKaldir']         = 'Suprimir Tabla'; //"DROP this TABLE"
    $dil['DumpTables']       = 'Visualizar Tabla';           //"DUMP"
    $dil['SatirEkle']        = 'A?adir Nueva Fila';          //"Add New Row"
    $dil['SatirDzlt']        = 'Editar Fila';    //"Edit Rows"
    $dil['DbHost']           = 'Nombre del Host';//"Host Name"
    $dil['DbKullAdi']        = 'Nombre del Usuario';         //"User Name"
    $dil['DbSifre']          = 'Contrase?a';     //"Password"
    $dil['SessCikis']        = 'Desconectar';    //"Session Log Out"
    $dil['db_type']          = 'Tipo de Servidor';           //"Server Type"
    $dil['GrsHts']           = 'Error de Conexi?n';          //"Connection Error"
    $dil['sayfalar']         = 'P?ginas';        //"Pages"
    $dil['sayfa']= 'P?gina';         //"Pages"
    $dil['SayfaBasi']        = 'Filas por p?gina';           //"Rows per page"
    $dil['Yeni'] = 'Nuevo';          //"New"
    $dil['AnaMenu']          = 'Menu Principal'; //"Main Menu"
    $dil['WellComeToVty']    = 'Bienvenido a Vty';           //"Wellcome to Vty"
    $dil['About']= "Acerca de ";     //"about"
    $dil['Bugs'] = "Errores";        //"Bugs"
    $dil['DumpTable']        = 'Visualizar Tabla';           //"Dump Table"
    $dil['DumpBoth']         = 'Ambos "Insertar en" y "Crear Tabla"'; //Both of "Insert Into" and "Create Table"
    $dil['DumpCreateOnly']   = '"Crear Tabla" solo info';    //"Create Table" info only
    $dil['DumpInsertOnly']   = '"Insertar en" solo info';    //"Insert Into" info only
    $dil['SaveAsFile']       = "Guardar como";   //"Save as file"
    $dil['DumpSubmit']       = "Visualizar ahora";           //"Dump Now"
     
    $uy['EminmisinCikis']    = '?Esta seguro?\\n?Desea finalizar y salir?\\n';
    $uy['EminmisinSil']      = '?Esta seguro?\\n?Desea Suprimir el Registro Seleccionado?\\n';
    $uy['EminmisinBosalt']   = '?Esta seguro?\\n?Desea Vaciar la Tabla Seleccionada?\\n';
    $uy['EminmisinKaldir']   = '?Esta seguro?\\n?Desea Suprimir la Tabla Seleccionada?';
    $uy['EminmisinDbSil']    = '?Esta seguro?\\n?Desea Suprimir la Base de Datos Seleccionada?\\n';
    $uy['KomutCalistirildi'] = 'Interrogaci?n OK';
    $uy['KacSatirEtkilendi'] = 'filas seleccionadas';
    $uy['loginBilgi']        = 'Por favor Teclee su Nombre y Contrase?a para conectar. (Basado en Cookies)';
    $uy['destekYok']         = 'La configuraci?n PHP no soporta funciones @DbType@.';
    $uy['YeniDbOldu']        = 'La Base de Datos `@NewDbName@` ha sido Creada.';
    $uy['YeniDbHata']        = 'Ha occurrido un error al Crear la Base de Datos `@NewDbName@`.';
    $uy['YeniTbOldu']        = 'La Tabla `@NewTbName@` ha sido Creada.';
    $uy['YeniTbHata']        = 'Ha ocurrido un error al Crear la Tabla `@NewTbName@`.';
    $uy['DbSilEminmi']       = '?Esta seguro? ?Desea Suprimir la Base de Datos `@DbName@`?';
    $uy['DbSilOldu']         = 'La Base de Datos `@DbName@` ha sido Suprimida.';
    $uy['DbSilHata']         = 'Ha ocurrido un error la Suprimir la Base de Datos `@DbName@`';
    $uy['YeniSatirOldu']     = 'Nuevo Registro A?adido.';
    $uy['YeniSatirHata']     = 'Ha ocurrido un error al A?adir un Registro.';
    $uy['SatirDuzeldi']      = 'El Registro seleccionado ha sido Actualizado.';
    $uy['SatirDuzelHata']    = 'Ha ocuurido un error al Actualizar el Registro.';
    $uy['SatirlarDuzeldi']   = 'Los Registros seleccionados han sido Actualizados.';
    $uy['SatirSilindi']      = 'El Registro seleccionado a sido Suprimido.';
    $uy['SatirSilHata']      = 'Ha ocurrido un error al Suprimir el Registro.';
    $uy['SatirNSilindi']     = '@number@ Registros seleccionados han sido Suprimidos.';
    $uy['SatirSilNHata']     = 'Ha ocurrido un error al Suprimir @number@ Registros seleccionados.';
    $uy['OturumKapa']        = 'Sesi?n cerrada';
    $uy['OturumKaHata']      = 'Ha ocurrido un error al cerrar la sesi?n.';
    $uy['ToplamSatir']       = 'NumReg: @number@';
    $uy['SatirYok']          = 'No hay Registros en la Tabla.';
    $uy['BosaltEmin']        = '?Desea Vaciar la Tabla @DbTable@?';
    $uy['BosaltOldu']        = 'Tabla @DbTable@ Vaciada.';
    $uy['BosaltHata']        = 'Ha ocurrido un error la Vaciar la Tabla @DbTable@.';
    $uy['KaldirEmin']        = '?Desea Suprimir la Tabla @DbTable@?';
    $uy['KaldirOldu']        = 'Tabla @DbTable@ Suprimida.';
    $uy['KaldirHata']        = 'Ha ocurrido un error al Suprimir la Tabla @DbTable@.';
    $uy['YeniDilSec']        = 'Selecione un nuevo idioma.';
    $uy['CookieError']       = 'El explorador no acepta cookies. Por favor activelas para continuar.';
    $uy['CookieErrorBas']    = 'Error en Cookies';
    /// <TRANSLATE_HERE END>
        }elseif($this->dl=='it'){
     
    /**
    * italian
    */
    /// <TRANSLATE_HERE>
    $dil['Charset']          = 'iso-8859-1';    //iso-8859-1
    $dil['dil']  = 'Lingua';      //Language
    $dil['Duzelt']           = 'Modifica';          //"Edit"
    $dil['Sil']  = 'Cancella';        //"Delete"
    $dil['Kaydet']           = 'Salva';          //"Save"
    $dil['Gonder']           = 'Invia';          //"Send"
    $dil['Reset']= 'Reset';         //"Reset"
    $dil['Tamam']= 'Ok';          //"OK"
    $dil['Uygula']           = 'Applica';         //"Apply"
    $dil['Iptal']= 'Cancella';        //"Cancel"
    $dil['Yukari']           = 'Livello superiore';      //"Up Level"
    $dil['Satir']= 'Linea';          //"Line"
    $dil['Hata'] = 'Errore';         //"Error"
    $dil['HataAcklm']        = "Descrizione dell'errore";         //"Error desciription"
    $dil['MysqlHata']        = 'Mysql Error';   //"Mysql Error"
    $dil['Cevap']= 'Risposta';        //"Answer"
    $dil['Evet'] = 'Si';           //"Yes"
    $dil['Hayir']= 'No';            //"No"
    $dil['Ekle'] = 'Aggiungi';           //"Add"
    $dil['Olustur']          = 'Crea';        //"Create"
    $dil['Devam']= 'Successivo';          //"Next"
    $dil['Geri'] = 'Indietro';          //"Back"
    $dil['Seciniz']          = 'Scegli';        //"Choose"
    $dil['YeniTbAdi']        = 'Nome della nuova tabella';//"New table name"
    $dil['DbEkle']           = 'CREA DATABASE';           //"CREATE DATABASE"
    $dil['TbEkle']           = 'CREA TABELLA';  //"CREATE TABLE"
    $dil['DbSil']= 'ELIMINA DATABASE';        //"DROP this DATABASE"
    $dil['Gelistir']         = 'Sviluppo';       //"Develop"
    $dil['Ayarlar']          = 'Opzioni';       //"Options"
    $dil['Yardim']           = 'Aiuto';          //"Help"
    $dil['VtYonet']          = 'Database Manager per MySQL';//"Database manager for MySQL"
    $dil['Vt']   = 'Database';      //"Database"
    $dil['Dosyadan']         = 'Dal File';     //"From File"
    $dil['Tablo']= 'Tabella';         //"Table"
    $dil['VtSeciniz']        = 'Scegli un Database '.
       'per iniziare';      //"Choose a Database to Start"
    $dil['TbSeciniz']        = 'Scegli una Tabella';//"Choose a Table"
    $dil['SayfaYnl']         = 'Ricarica';       //"Refresh"
    $dil['Sorgu']= 'Query';         //"Query"
    $dil['Sql']  = 'Query Sql';     //"Sql Query"
    $dil['SqlSonucu']        = 'Risultati Sql';   //"Sql Results"
    $dil['Buyut']= 'Esteso';        //"Larger"
    $dil['Uzat'] = '&lt; Esteso &gt;';          //"&lt; Longer &gt;"
    $dil['Kisalt']           = '&gt; Ridotto &lt;';         //"&gt; Shorter &lt;"
    $dil['Hep']  = 'Tutto';           //"All"
    $dil['Hic']      = 'Nulla';          //"None"
    $dil['EnAlt']= 'Giù';        //"Bottom"
    $dil['EnUst']= 'Su';           //"Top"
    $dil['VtAdi']= 'Nome del Database';  //"DatabaseName"
    $dil['TbAdi']= 'Nome della Tabella';     //"TableName"
    $dil['SutunSys']         = 'Numero dei campi';  //"Field Number"
    $dil['TbBosalt']         = 'SVUOTA questa Tabella';          //"EMPTY this TABLE"
    $dil['TbKaldir']         = 'ELIMINA questa Tabella';           //"DROP this TABLE"
    $dil['DumpTables']       = 'Esporta Tabella';    //"DUMP"
    $dil['SatirEkle']        = 'Aggiungi una nuova Riga';   //"Add New Row"
    $dil['SatirDzlt']        = 'Modifica la Riga';     //"Edit Rows"
    $dil['DbHost']           = 'Nome Host';     //"Host Name"
    $dil['DbKullAdi']        = 'User Name';     //"User Name"
    $dil['DbSifre']          = 'Password';      //"Password"
    $dil['SessCikis']        = 'Log Out';       //"Session Log Out"
    $dil['db_type']          = 'Server Type';   //"Server Type"
    $dil['GrsHts']           = 'Errore di Connessione';          //"Connection Error"
    $dil['sayfalar']         = 'Pagine';         //"Pages"
    $dil['sayfa']= 'Pagina';          //"Pages"
    $dil['SayfaBasi']        = 'Righe per pagina'; //"Rows per page"
    $dil['Yeni'] = 'Nuovo';           //"New"
    $dil['AnaMenu']          = 'Menu';     //"Main Menu"
    $dil['WellComeToVty']    = 'Benvenuto in Vty';           //"Wellcome to Vty"
    $dil['About']= "A proposito";       //"about"
    $dil['Bugs'] = "Bugs";      //"Bugs"
    $dil['DumpTable']         = 'Esporta Tabella';          //"Dump Table"
    $dil['DumpBoth']         = 'Esporta con "Insert Into" e "Create Table"';        //Both of "Insert Into" and "Create Table"
    $dil['DumpCreateOnly']   = 'Esporta solo con "Create Table"';           //"Create Table" info only
    $dil['DumpInsertOnly']   = 'Esposta solo con "Insert Into"';    //"Insert Into" info only
    $dil['SaveAsFile']       = "Esporta in un file esterno.";       //"Save as file"
    $dil['DumpSubmit']       = "Esporta";           //"Dump Now"
     
    $uy['EminmisinCikis']    = 'Sei sicuro?\\nVuoi terninare la sessione?\\n';
    $uy['EminmisinSil']      = 'Sei sicuro?\\nVuoi CANCELLARE la RIGA selezionata?\\n';
    $uy['EminmisinBosalt']   = 'Sei sicuro?\\nVuoi CANCELLARE la TABELLA selezionata ?\\n';
    $uy['EminmisinKaldir']   = 'Sei sicuro?\\nVuoi ELIMINARE la TABELLA selezionata?';
    $uy['EminmisinDbSil']    = 'Sei sicuro?\\nVuoi ELIMINARE il DATABASE selezionato?\\n';
    $uy['KomutCalistirildi'] = 'Query OK';
    $uy['KacSatirEtkilendi'] = 'rows affected';
    $uy['loginBilgi']        = 'Inserisci username e password per connetterti al database. (basato sui Cookie)';
    $uy['destekYok']         = 'La tua configurazione PHP non supporta le @DbType@ functions.';
    $uy['YeniDbOldu']        = 'Hai creato un nuovo database: `@NewDbName@`.';
    $uy['YeniDbHata']        = 'Errore nella creazione del database `@NewDbName@`.';
    $uy['YeniTbOldu']        = 'Hai creato una nuova tabella: `@NewTbName@`.';
    $uy['YeniTbHata']        = 'Errore nella creazione della tabella `@NewTbName@`.';
    $uy['DbSilEminmi']       = 'Sei sicuro? Vuoi ELIMINAREil database `@DbName@`?';
    $uy['DbSilOldu']         = 'Il database `@DbName@` è stato eliminato.';
    $uy['DbSilHata']         = "Errore nell'eliminazione del database`@DbName@`";
    $uy['YeniSatirOldu']     = 'Aggiunta una nuova riga.';
    $uy['YeniSatirHata']     = 'Errore nella creazionedi una nuova riga.';
    $uy['SatirDuzeldi']      = 'La riga selezionata è stato aggiornata.';
    $uy['SatirDuzelHata']    = "Errore nell'aggiornamento della riga.";
    $uy['SatirlarDuzeldi']   = 'Le righe selezionate sono state aggiornate.';
    $uy['SatirSilindi']      = 'Le righe selezionate sono state eliminate.';
    $uy['SatirSilHata']      = "Errore nell'eliminazione delle righe.";
    $uy['SatirNSilindi']     = '@number@ righe selezionate sono state eliminate.';
    $uy['SatirSilNHata']     = "Errore nell'eliminazione delle @number@ righe selezionate.";
    $uy['OturumKapa']        = 'Sessione conclusa';
    $uy['OturumKaHata']      = 'Errore nel concludere la sessione.';
    $uy['ToplamSatir']       = 'Numero di righe: @number@';
    $uy['SatirYok']          = 'Non ci sono righe in questa tabella.';
    $uy['BosaltEmin']        = 'Vuoi svuotare la tabella @DbTable@?';
    $uy['BosaltOldu']        = 'Tabella @DbTable@ svuotata.';
    $uy['BosaltHata']        = 'Errore nello svuotamento della tabella @DbTable@.';
    $uy['KaldirEmin']        = 'Vuoi elimiare la tabella @DbTable@?';
    $uy['KaldirOldu']        = 'Tabella @DbTable@ eliminata.';
    $uy['KaldirHata']        = "Errore nell'eliminazione della tabella @DbTable@.";
    $uy['YeniDilSec']        = 'Seleziona la lingua.';
    $uy['CookieError']       = 'Il tuo browser non accetta i cookie. Risolvi il problema e ritenta';
    $uy['CookieErrorBas']    = 'Cookie Error';
    /// <TRANSLATE_HERE END>
     
        }else{
     
    ///
    /// if you want to translate Vty to your language.
    /// Please email us from vtydev@gmail.com
    ///
     
    /**
    * English
    */
   
    /// <TRANSLATE_HERE>
    $dil['Charset']          = 'iso-8859-1';    //iso-8859-1
    $dil['dil']  = 'Language';      //Language
    $dil['Duzelt']           = 'Edit';          //"Edit"
    $dil['Sil']  = 'Delete';        //"Delete"
    $dil['Kaydet']           = 'Save';          //"Save"
    $dil['Gonder']           = 'Send';          //"Send"
    $dil['Reset']= 'Reset';         //"Reset"
    $dil['Tamam']= 'Okey';          //"OK"
    $dil['Uygula']           = 'Apply';         //"Apply"
    $dil['Iptal']= 'Cancel';        //"Cancel"
    $dil['Yukari']           = 'Up Level';      //"Up Level"
    $dil['Satir']= 'Line';          //"Line"
    $dil['Hata'] = 'Error';         //"Error"
    $dil['HataAcklm']        = 'Error Description';         //"Error desciription"
    $dil['MysqlHata']        = 'Mysql Error';   //"Mysql Error"
    $dil['Cevap']= 'Answer';        //"Answer"
    $dil['Evet'] = 'Yes';           //"Yes"
    $dil['Hayir']= 'No';            //"No"
    $dil['Ekle'] = 'Add';           //"Add"
    $dil['Olustur']          = 'Create';        //"Create"
    $dil['Devam']= 'Next';          //"Next"
    $dil['Geri'] = 'Back';          //"Back"
    $dil['Seciniz']          = 'Choose';        //"Choose"
    $dil['YeniTbAdi']        = 'New table name';//"New table name"
    $dil['DbEkle']           = 'CREATE DATABASE';           //"CREATE DATABASE"
    $dil['TbEkle']           = 'CREATE TABLE';  //"CREATE TABLE"
    $dil['DbSil']= 'DROP this DATABASE';        //"DROP this DATABASE"
    $dil['Gelistir']         = 'Develop';       //"Develop"
    $dil['Ayarlar']          = 'Options';       //"Options"
    $dil['Yardim']           = 'Help';          //"Help"
    $dil['VtYonet']          = 'Database Manager for MySQL';//"Database manager for MySQL"
    $dil['Vt']   = 'Database';      //"Database"
    $dil['Dosyadan']         = 'From File';     //"From File"
    $dil['Tablo']= 'Table';         //"Table"
    $dil['VtSeciniz']        = 'Choose a Database '.
       'to Start';      //"Choose a Database to Start"
    $dil['TbSeciniz']        = 'Choose a Table';//"Choose a Table"
    $dil['SayfaYnl']         = 'Refresh';       //"Refresh"
    $dil['Sorgu']= 'Query';         //"Query"
    $dil['Sql']  = 'Sql Query';     //"Sql Query"
    $dil['SqlSonucu']        = 'Sql Results';   //"Sql Results"
    $dil['Buyut']= 'Larger';        //"Larger"
    $dil['Uzat'] = '&lt; Longer &gt;';          //"&lt; Longer &gt;"
    $dil['Kisalt']           = '&gt; Shorter &lt;';         //"&gt; Shorter &lt;"
    $dil['Hep']  = 'All';           //"All"
    $dil['Hic']      = 'None';          //"None"
    $dil['EnAlt']= 'Bottom';        //"Bottom"
    $dil['EnUst']= 'Top';           //"Top"
    $dil['VtAdi']= 'DatabaseName';  //"DatabaseName"
    $dil['TbAdi']= 'TableName';     //"TableName"
    $dil['SutunSys']         = 'Field Number';  //"Field Number"
    $dil['TbBosalt']         = 'EMPTY this TABLE';          //"EMPTY this TABLE"
    $dil['TbKaldir']         = 'DROP this TABLE';           //"DROP this TABLE"
    $dil['DumpTables']       = 'DUMP Table';    //"DUMP"
    $dil['SatirEkle']        = 'Add New Row';   //"Add New Row"
    $dil['SatirDzlt']        = 'Edit Rows';     //"Edit Rows"
    $dil['DbHost']           = 'Host Name';     //"Host Name"
    $dil['DbKullAdi']        = 'User Name';     //"User Name"
    $dil['DbSifre']          = 'Password';      //"Password"
    $dil['SessCikis']        = 'Log Out';       //"Session Log Out"
    $dil['db_type']           = 'Server Type';   //"Server Type"
    $dil['GrsHts']           = 'Connection Error';          //"Connection Error"
    $dil['sayfalar']         = 'Pages';         //"Pages"
    $dil['sayfa']= 'Page';          //"Pages"
    $dil['SayfaBasi']        = 'Rows per page'; //"Rows per page"
    $dil['Yeni'] = 'New';           //"New"
    $dil['AnaMenu']          = 'Main Menu';     //"Main Menu"
    $dil['WellComeToVty']    = 'Welcome to Vty';           //"Wellcome to Vty"
    $dil['About']= "About";     //"about"
    $dil['Bugs'] = "Bugs";      //"Bugs"
    $dil['DumpTable']         = 'Dump Table';       //"Dump Table"
    $dil['DumpBoth']         = 'Both of "Insert Into" and "Create Table"';          //Both of "Insert Into" and "Create Table"
    $dil['DumpCreateOnly']   = '"Create Table" info only';          //"Create Table" info only
    $dil['DumpInsertOnly']   = '"Insert Into" info only';           //"Insert Into" info only
    $dil['SaveAsFile']       = "Save as file";      //"Save as file"
    $dil['DumpSubmit']       = "Dump Now";          //"Dump Now"
     
    $uy['EminmisinCikis']    = 'Are you sure?\\nDo you want to end your session and quit?\\n';
    $uy['EminmisinSil']      = 'Are you sure?\\nDo you want to DELETE selected ROW?\\n';
    $uy['EminmisinBosalt']   = 'Are you sure?\\nDo you want to EMPTY selected TABLE?\\n';
    $uy['EminmisinKaldir']   = 'Are you sure?\\nDo you want to DROP selected ROW?';
    $uy['EminmisinDbSil']    = 'Are you sure?\\nDo you want to DROP selected DATABASE?\\n';
    $uy['KomutCalistirildi'] = 'Query OK';
    $uy['KacSatirEtkilendi'] = 'rows affected';
    $uy['loginBilgi']        = 'Please enter your username and  password to connect database server. (Cookie based)';
    $uy['destekYok']         = 'Your PHP configuration do not support @DbType@ functions.';
    $uy['YeniDbOldu']        = 'New database `@NewDbName@` has been created.';
    $uy['YeniDbHata']        = 'An error occured when creating new database `@NewDbName@`.';
    $uy['YeniTbOldu']        = 'New table `@NewTbName@` has been created.';
    $uy['YeniTbHata']        = 'An error occured when creating new table `@NewTbName@`.';
    $uy['DbSilEminmi']       = 'Are you sure? Do you want to DROP `@DbName@` database?';
    $uy['DbSilOldu']         = '`@DbName@` database has been dropped.';
    $uy['DbSilHata']         = 'An error occured when dropping `@DbName@` database';
    $uy['YeniSatirOldu']     = 'New row added.';
    $uy['YeniSatirHata']     = 'An error occured when adding new row.';
    $uy['SatirDuzeldi']      = 'The rows you have selected has been updated.';
    $uy['SatirDuzelHata']    = 'An error occured when updating row.';
    $uy['SatirlarDuzeldi']   = 'The rows you have selected has been updated.';
    $uy['SatirSilindi']      = 'The row you have selected has been deleted.';
    $uy['SatirSilHata']      = 'An error occured when deleting row.';
    $uy['SatirNSilindi']     = '@number@ rows you have selected has been deleted.';
    $uy['SatirSilNHata']     = 'An error occured when deleting @number@ rows you have selected.';
    $uy['OturumKapa']        = 'Session closed';
    $uy['OturumKaHata']      = 'Error when closing session.';
    $uy['ToplamSatir']       = 'Numrows: @number@';
    $uy['SatirYok']          = 'There is no row in the table.';
    $uy['BosaltEmin']        = 'Do you want to empty @DbTable@ table?';
    $uy['BosaltOldu']        = '@DbTable@ table emptied.';
    $uy['BosaltHata']        = 'An error occured when emptying @DbTable@  table.';
    $uy['KaldirEmin']        = 'Do you want to drop @DbTable@ table?';
    $uy['KaldirOldu']        = '@DbTable@ table dropped.';
    $uy['KaldirHata']        = 'An error occured when dropping @DbTable@ table.';
    $uy['YeniDilSec']        = 'Select your new language.';
    $uy['CookieError']       = 'Your browser does not accept cookies. Please turn it on to continue.';
    $uy['CookieErrorBas']    = 'Cookie Error';
    /// <TRANSLATE_HERE END>
        }
        $this->dil = $dil;
        $this->uy = $uy;
}
     
     
    }
     
    ?>
    <?php
     
    /**
    * class Docs
    *
    * This class includes the language informations and the display informations
    */
    class Docs
    {
     
        /**
* Docs
*
*
*/
function Docs($vty){
$this->vty = $vty;
       
        $this->menu();
        if($this->vty->nebu=='help'){
    $this->help();
        }elseif($this->vty->nebu=='bugs'){
    $this->bugs();
        }elseif($this->vty->nebu=='about'){
    $this->about();
        }
}
     
        /**
        * menu
        *
        *
        */
        function menu(){
    ?>
    <table width="100%" border="0" cellpadding="5" cellspacing="1" bgcolor="#ECB100">
      <tr>
        <td height="30" bgcolor="#FFF4D2"> <a href="<? echo $this->vty->urlyap($this->vty->linkler.'&ne=docs&nebu=help'); ?>"><? echo $this->vty->dug->dil['Yardim']; ?></a>
          | <a href="<? echo $this->vty->urlyap($this->vty->linkler.'&ne=docs&nebu=about'); ?>"><? echo $this->vty->dug->dil['About']; ?></a>
          | <a href="<? echo $this->vty->urlyap($this->vty->linkler); ?>"><? echo $this->vty->dug->dil['Iptal']; ?></a>
        </td>
      </tr>
    </table>
    <br>
    <?
}//end of func: menu
     
        /**
        * help
        *
        *
        */
        function help(){
echo '<style type="text/css">
        h3{ color:#CC0000;}
        ul{ list-style:square;}
</style>';
    ?>
    <fieldset>
    <div align="left" style="margin:10;">
    <h3>Vty Help</h3>
    <ul>
<li><a href="<? echo $this->vty->vtyUrl; ?>help.php">Go to Vty Help Page</a></li>
<li><a href="<? echo $this->vty->vtyUrl; ?>forum.php">Go to Vty Forum</a></li>
<li><a href="<? echo $this->vty->vtyUrl; ?>bug.php">Report a bug</a></li>
<li><a href="<? echo $this->vty->vtyUrl; ?>translate.php">Become a translator</a></li>
<li><a href="<? echo $this->vty->vtyUrl; ?>feedback.php">Send Feedback</a></li>
    </ul>
    <ul>
<li><b>How to install Vty?</b></li><br />
No need to install Vty. Only enter your correct Mysql informations to login
page. No need any installation. Only upload and use.<br><br>
     
<li><b>I don't want to see login page. What can i do?</b></li><br />
If you don't want to see "Login Page".<br />
1. Open vty.php with a file editor.<br>
2. Go to Line 29.<br />
3. Change <font color="#993333">$ayar['LoginType'] = 'config_or_login';</font>&nbsp;&nbsp;&nbsp;        as  &nbsp;&nbsp;
<font color="#993333">$ayar['LoginType'] = 'config';</font><br>
4. Write your correct MySQL informations. Your mysql username to <font color="#993333">$ayar['dbuser']</font>, password to <font color="#993333">$ayar['dbpass']</font> and mysql host to <font color="#993333">$ayar['dbhost']</font><br />
5. Save file.<br />
    And you will no longer see login page. Vty will directly connect to mysql server and will show you the databases.
<br><br>
           
<li><b>Why has Vty got only one php file?</b></li><br />
Vty is one file for easy upload and download.<br><br>
           
    </ul>
    </div>
    </fieldset>
    <?
}//end of func: help
           
     
        /**
        * about
        *
        *
        */
        function about(){
    ?>
    <fieldset>
    <alegend align="left" style="font-size:24px;color:#333333;"></alegend>
    <amarquee behavior="" direction="up" loop="-1" scrolldelay="110" scrollamount="3">
    <div align="left" style="margin:10;">
    <font size="4"><? echo 'Vty - '.$this->vty->dug->dil['VtYonet']; ?></font>
    <br />
    <br />
      <strong>Version: </strong><? echo 'Vty '.$this->vty->vtyversion; ?>
      <br />
      <strong>Email: </strong>
      vtydev@gmail.com<br />
      <strong>URL: </strong><a href="<? echo $this->vty->vtyUrl; ?>" target="_blank"><? echo $this->vty->vtyUrl; ?></a> <br />
    <br />
      <strong>Translaters</strong><br>
      <em>English: Mustafa Kirgul, karloffstardust@hotmail.com </em><br>
      <em>Italian: Luca Realdi, baol77@yahoo.it </em><br>
      <em>Spanish: Manuel Ruiz, manuel@ruiz.cc</em><br>
      <br>
      <strong>Developers</strong><br>
      <em>ismail Alpen, ismailalpen@gmail.com<br>
      Enis ?oban, eniscoban@gmail.com<br>
      Hizir Seven, hseven@gmail.com<br>
      Baurcan Jakasev: baur79@hotmail.com </em><br>
    </div>
    </amarquee>
    </fieldset>
    <?
}//end of func: about
           
        /**
        * bugs
        *
        *
        */
        function bugs(){
        echo 'BUGS';
        }//end of func: help
    }//end of class: docs
    ?>
    <?php
     
    class vty
    {
     
/**
* ?nemli degiskenler
*/
var $ayar;
var $dug;
var $dl;
var $baglanti;
var $dosya;
var $vtyversion;
var $vtyUrl;
        var $BitimIslemleri;
     
/**
* Icde uretilen degiskenler
*/
var $dbname;
var $tablename;
     
/**
* sql query deki limit bilgisini iceris. LIMIT $i,$s gibi
*/
var $numrows;
var $query_limit;
     
/**
* Gelen Degiskenler
*/
var $ne;
var $nebu;
var $pp;
var $order;
var $desc;
var $kac;
var $ilk;
var $query_order;
     
/**
* Giris formdan gelenler
*/
var $txtDbTipi;
var $txtDbHost;
var $txtDbKullanici;
var $txtDbSifre;
     
     
/**
* vty()
*
* Vty için baslangiç fonksiyonlari
*
* @param object $ayar ayarlar classini icerir
*/
function vty($ayar)
{
     
        ob_start();
        set_magic_quotes_runtime(false);
        $this->NoCache();
           
        $this->ayar = $ayar;
        $this->dug = new dug($this->DilCookie());
        $this->ne = $this->gkp('ne');
        $this->nebu = $this->gkp('nebu');
        $this->sbtGirisYap = $this->gkp('sbtGirisYap','p');
        $this->txtDbTipi = $this->gkp('txtDbTipi','p');
        $this->txtDbHost = $this->gkp('txtDbHost','p');
        $this->txtDbKullanici = $this->gkp('txtDbKullanici','p');
        $this->txtDbSifre = $this->gkp('txtDbSifre','p');
        $this->RandomSayi();
        $this->ayar['error_reporting'] = error_reporting('E_ALL'); // alternatives: E_ALL & ~E_NOTICE
        $this->dosya = basename($this->gp('PHP_SELF','s'));
        $this->vtyversion = '1.6';
        $this->vtyUrl = 'http://www.kutukutu.com/vty/';
}
     
        /**
        * DilCookie()
        *
        *
        *
        */
        function DilCookie(){
if($this->gkp('dl') == ''){
    if($this->gkp('vtykuki_dil','c')==''){
        $dil = $this->gkp('HTTP_ACCEPT_LANGUAGE','s');
        $dil = substr($dil,0,2);
        $dil = ($dil==''?$this->ayar['DefaultLang']:$dil);
    }else{
        $dil = $this->gkp('vtykuki_dil','c');
    }
}else{
    $dil = $this->gkp('dl');
    if($dil <> $this->gkp('vtykuki_dil','c'))
        setcookie("vtykuki_dil",$dil,time()+100000000);
}
return $dil;
        }
     
/**
* bitimIslemler()
*
* Vty için bitim fonksiyonlari
*/
function BitimIslemleri()
{
     
if($this->BitimIslemleri == false){
   $this->ImzaKoy();
   $this->_htmlSonu();
}
           if($this->baglanti!=0){
   $this->db->vty_close();
           }
           ob_end_flush();
}
     
/**
* BitimYok()
*
* Vty için bitim fonksiyonlari
*/
function BitimYok()
{
           $this->BitimIslemleri = true;
}
     
           
/**
* linkler()
*
* Gelen databaseadi, tabloadi ve sayfada gezme bilgilerini alir,
* bunlardan sayfanin heryerinde kullanmak amaciyla string $linkler degiskenini olusturur.
*/
function linkler()
{
        $this->dbname = (!empty($this->ayar['dbname']) ? $this->ayar['dbname'] : urldecode($this->gkp('sdb')) );
        $this->tablename = urldecode($this->gkp('stb'));
        $this->pp = ($this->gp('sayfaBasi','p')?$this->gp('sayfaBasi','p'):$this->gp('pp','g'));
        $this->order = $this->gp('order');
        $this->desc = $this->gp('desc');
        $this->kac = $this->gp('kac');
        $this->ilk = $this->gp('ilk');
        $this->linkler = (!empty($this->dug->dl)?"dl=".$this->dug->dl."&":'').
     (!empty($this->dbname)?"sdb=".urlencode($this->dbname)."&":'').
     (!empty($this->tablename)?"stb=".urlencode($this->tablename)."&":'').
     (!empty($this->order)?"order=".$this->order."&":'').
     (!empty($this->kac)?"kac=".$this->kac."&":'').
     (!empty($this->pp)?"pp=".$this->pp."&":'').
     (!empty($this->desc)?"desc=".$this->desc."&":'');
        $this->DescOlayi();
}
     
function DescOlayi()
{
        if(!empty($this->order)){
    $this->query_order = "order by ".$this->order;
    if($this->desc == "ASC"){
            $this->query_order = "order by ".$this->order." ASC"; $this->desc = "DESC"; $this->desc_resim = '<font face="Webdings">6</font>'; //"res/desc_desc.gif";
    }else{
            $this->query_order = "order by ".$this->order." DESC"; $this->desc = "ASC"; $this->desc_resim = '<font face="Webdings">5</font>'; //"res/desc_asc.gif";
    }
        }
}
           
     
/**
* baglan()
*
* Baglantiyi Yapan fonksiyon, baglanti yapilip yapilmadigina g?re sonuc d?ner,
* baglanti olursa kuki birakir
*/
function baglan()
{
        $girisYontem = 'ayar';
        if($this->ayar['LoginType']=='config_or_login' or $this->ayar['LoginType']=='login'){
    if(!empty($this->sbtGirisYap) ){
            $this->ayar['db_type'] = $this->txtDbTipi;
            $this->ayar['dbhost'] = $this->txtDbHost;
            $this->ayar['dbuser'] = $this->txtDbKullanici;
            $this->ayar['dbpass'] = $this->txtDbSifre;
    }elseif( $this->gp('vtykuki_host','c')<>'' and $this->gp('vtykuki_dbtipi','c')<>''){
            $this->ayar['db_type'] = $this->gp('vtykuki_dbtipi','c');
            $this->ayar['dbhost'] = $this->gp('vtykuki_host','c');
            $this->ayar['dbuser'] = $this->gp('vtykuki_kullanici','c');
            $this->ayar['dbpass'] = $this->gp('vtykuki_sifre','c');
    }
    $girisYontem = 'kuki';
        }
        if( $this->ayar['LoginType']=='config' or $this->ayar['LoginType']=='config_or_login' or ($this->ayar['LoginType']=='login' and ($this->gkp('vtykuki_host','c') or !empty($this->sbtGirisYap))) ){
    if($this->dbKurulumu($this->ayar['db_type'])==false){
            $this->baglantiHatasi = '<font color="#FF0000" >'. ereg_replace('@DbType@','<b>'.$this->dbTipiAdi($this->ayar['db_type']).'</b>',$this->dug->uy['destekYok']).'</font>'."\n";
    }else{
            $this->db = new vtydb;
            $this->db->vt_adi($this->ayar['db_type']);     
            $this->baglan = ($this->db->vty_connect($this->ayar['dbhost'], $this->ayar['dbuser'], $this->ayar['dbpass']));
            if($this->baglan==0){
        $this->baglanti = 0;
            $this->baglantiHatasiCol = '#FF0000';
            $this->baglantiHatasiBas = $this->dug->dil['GrsHts'];
        //DB_AYRIMI
        if($this->ayar['db_type']=='mysql'){
    $this->baglantiHatasi = $this->db->vty_error();
        }elseif($this->ayar['db_type']=='mssql'){
    $this->baglantiHatasi = 'MS SQL: Unable to connect to server'.(!empty($this->txtDbHost)?' : '.$this->txtDbHost:'.');
        }
            }else{
    if($girisYontem=='kuki'){
    setcookie("vtykuki_host",$this->ayar['dbhost']);
    setcookie("vtykuki_kullanici",$this->ayar['dbuser']);
    setcookie("vtykuki_sifre",$this->ayar['dbpass']);
    setcookie("vtykuki_dbtipi",$this->ayar['db_type']);
        }
        $this->baglanti = 1;
            }
    }
        }else{
    $this->baglanti = 0;
        }
}
     
/*
* girisForm()
*
* Database bilgilerin kullanididan istemek icin cikan ekrani oluturan fonksiyon
*
*/
function girisForm()
{
        echo '<table width="'.$this->dug->gor['table_width'].'"  border = "'.$this->dug->gor['border'].'" cellspacing="'.$this->dug->gor['cellspacing'].'" cellpadding="'.$this->dug->gor['cellpadding'].'" >'."\n".
     '<tr bgcolor="'.$this->dug->gor['alt_bgcolor'].'">'."\n".
     "<td valign=\"top\">"."<br />"."\n".
     '<table>'."\n".
     "<form name=\"frmKukiliGiris\" method=\"post\" action=\"".$this->dosya."\" onSubmit=\"return fncKukiliGirisOnSub();\">"."\n".
     '<tr colspan="2" >'."\n".'<td  width="5" rowspan="3">'.'</td>'.
     (($this->ayar['LoginType']=='config' or $this->gp('txtDbHost')<>'' )?
     '<tr><td colspan="2">'.'<font face="Times New Roman" size="3" color="'.$this->baglantiHatasiCol.'"> <b> '.$this->baglantiHatasiBas.'</b>'."<br />".
    $this->baglantiHatasi.'</font>'."<br /><br /></td>\n":'<td><font color="#000080" size="2" > &nbsp;<b>'.$this->dug->dil['WellComeToVty'].'</b></font><br/><br/></td>').
     '</tr>'."\n";
        if( $this->ayar['LoginType']=='config_or_login' or $this->ayar['LoginType']=='login'){
    echo '<tr  colspan="2" >'."\n".
    '<td>'.
            '<table cellspacing="5" cellpadding="0" >'.
            '<tr><td>'.$this->dug->dil['dil'].':</td><td> &nbsp; '.$this->dilListesi().'</td></tr>'.
            '<tr><td>'.'<b>'.$this->dug->dil['db_type'].' :</b>'.'</td>'.
    '<td> &nbsp; <select name="txtDbTipi" style="width:130;" >'."\n".
            '<option value="mysql" '.($this->ayar['db_type']=='mysql'?'selected':'').' >MySQL</option> '.
            '<option value="mssql" '.($this->ayar['db_type']=='mssql'?'selected':'').' >MS SQL (test)</option>'."\n".
            '</select>'.
            '</td></tr>'.
            '<tr>'.
    '<td>'.'<b>'.$this->dug->dil['DbHost'].' :</b>'.'</td>'.
    '<td> &nbsp; <input type="input" name="txtDbHost" value="'.(!empty($this->txtDbHost)?$this->txtDbHost:'localhost').'" >'.'</td>'.
            '</tr>'.
            '<tr>'.
            '<td>'.'<b>'.$this->dug->dil['DbKullAdi'].' :</b>'.'</td>'.
            '<td> &nbsp; '.'<input type="input" name="txtDbKullanici" value="'.(!empty($this->txtDbKullanici)?$this->txtDbKullanici:'').'">'."</td>".
            '</tr>'.
            '<tr>'.
    '<td>'.'<b>'.$this->dug->dil['DbSifre'].' :</b>'.'</td>'.
            '<td> &nbsp; '.'<input type="password" name="txtDbSifre">'."</td>".
            '</tr>'.
            '<tr>'.
    '<td colspan="2" >'.
        '<input type="submit" name="sbtGirisYap" value="     '.$this->dug->dil['Gonder'].'       ">'.
        '<input name="dl" type="hidden" id="dl" value="'.$this->dug->dl.'">'.
        '<br /><br />'.
            '</td></tr></table>'.
   
    '</td>'."\n".
    '</tr>'."\n";
        }
        echo '</form>'."\n".'</table>'."\n";
        echo "</td> \n </tr> \n ".'<tr bgcolor="#dddddd" border = "0" cellspacing="1" cellpadding="1">'." \n ";
        echo '<td height="25" align="right">&nbsp;</td>';        
        echo "</td>"."\n"."</tr>"."\n"."</table>"."\n";
}
     
/*
* Dil listesi
*/
function dilListesi()
{
        $diller = $this->dug->diller();
        $dl = $this->dug->dl;
        $don = '<select name="sDil" onChange="atla(\'parent\',\''.$this->dosya."?ne=lang&r=".$this->random.$this->linkler().'\',this,0)" >'."\n";
        $don .= '<option >-'.$this->dug->dil['Seciniz'].'-</option>'."\n";
        foreach($diller as $key=>$dil) $keys[] = $key;
        foreach($diller as $di => $dil){
    $don .= '<option value="&dl='.$di.'" '.((empty($dl) or !in_array($dl,$keys)) ? ($di==$this->ayar['DefaultLang']?'selected':'') : ($dl==$di?'selected':'') ).' >'.$dil.'</option>'."\n";
        }
        $don .= '</select>'."\n";
        return $don;
}  
     
/*
* Ust Menu
*/
function ust()
{
        $devam = $this->gp('devam');
        if($this->baglanti==0)
    $this->baslik = 'Vty '.$this->vtyversion.' - '.$this->dug->dil['VtYonet'];
        else
    $this->baslik = "vty : ".($this->dbname?$this->dbname:'?')." . ".(($this->tablename and $this->dbname)?$this->tablename:'?')." ".
    (($this->tablename and $this->dbname and $this->ayar['dbhost'])?"@ ".$this->ayar['dbhost']." - v".$this->vtyversion:'');
   
        echo '<!DOCTYPE HTML PUBLIC "-//W3C//DTD HTML 4.01 Transitional//EN">'."\n".
    '<html>'."\n".
    '<head>'."\n".'<title>'.$this->baslik.'</title>'."\n".
    '<meta http-equiv="Content-Type" content="text/html; charset='.$this->dug->dil['Charset'].'">'."\n".
    '<meta http-equiv="expires" content="now" >'."\n".
    '<style type="text/css"> <!-- '."\n".
    'td{font-family: Arial; font-size: 12px}body{font-family: Arial; font-size: 12px}'."\n".
    'input{font-family: Arial; font-size: 12px}select{font-family: Arial; font-size: 12px}'."\n".
    'A:link{font-family: arial; font-size: 12px; text-decoration: none; color: #0000ff}'."\n".
    'A:visited{font-family: arial; font-size: 12px; text-decoration: none; color: #0000ff}'."\n".
    'A:hover{font-family: arial; font-size: 12px; text-decoration: underline; color: #006600}'."\n".
    '-->  </style>'."\n";
   
        echo '<script language="JavaScript" type="text/JavaScript" > <!--'."\n".
    "function atla(targ,adres,selObj,restore){eval(targ+\".location=\'\"+adres+selObj.options[selObj.selectedIndex].value+\"\'\");if(restore)selObj.selectedIndex=0;}"."\n".
    "function Sileyimmi(soyle){var c=confirm(soyle);if(c==\"1\")return true;else if(c==\"0\")return false;}"."\n".
    "function silDe(){ return Sileyimmi('".$this->dug->uy['EminmisinSil']."');} \n".
    "function HepsiniSec(form,checkbox){var f=document.forms[form];var d=(typeof(f.elements[checkbox])!='undefined'?f.elements[checkbox]:0);var l=(typeof(d.length)!='undefined'?d.length:'0');if(l!=\"0\")for(var i=1;i<l;i++)d[i].checked=d[0].checked; }".""."\n".
    "function sMi(){var by=0,form='dsform',checkbox='sdscheck[]',f=document.forms[form];var d=(typeof(f.elements[checkbox])!='undefined'?f.elements[checkbox]:0);var l=(typeof(d.length)!='undefined'?d.length:'0');for(var i=1;i<l;i++) if(d[i].checked==false) by = 3;if(by == 3)        d[0].checked = false; else d[0].checked = true;}"."\n".
    "function sdBiKontrolEt(form,checkbox,durum,neresi,soyle){ var f = document.forms[form].elements[checkbox];var d=(typeof(f)!='undefined'?f:0); var k=0,l = (typeof(d.length) != 'undefined' ? d.length : '0' );if(l!=\"0\"){for(var i=0;i<l;i++)if(d[i].checked == durum) k++;}else{if(d.checked == durum)k++;}if(k==\"0\"){return false;}else{if(neresi=='duzelt')return true;else if(neresi=='sil')return Sileyimmi(soyle);}}".
    "function yeniDbOnSubmit(){ if(document.yeniDbForm.yeniDbAdi.value == '') return false; else return true; }"."\n".
    "function yeniTbOnSubmit(){var f = document.yeniTbForm; if(f.yeniTbAdi.value==''||f.yeniTbAlanSayisi.value=='')return false; else return true;}"."\n".
    "function BunaFocus(form,ele){document.forms[form].elements[ele].focus();}"."\n".
    "function fncKukiliGirisOnSub(){f = document.frmKukiliGiris; if(f.txtDbHost.value=='')return false; else return true;}"."\n". // || f.txtDbKullanici.value ==''
    "//--> </script>"."\n"."</head>"."\n";
        echo $this->ImzaKoy();
     
        echo "<body".$this->onLoad($devam).' bgcolor="#cccccc" >'."\n".
    "<a name=\"EnUst\"></a>"."\n";
   
        $this->tabloBas('','1','0','','','');
        $this->ust_logo();
        $this->tabloSonu();
}
           
/**
* ust_logo
*
*/
function ust_logo(){
        $this->tabloBas('','0','5','30','0','#CBD6DE');
        echo '&nbsp; <a href="'.$this->vtyUrl.'" target="_blank" ><font color="#333333" ><strong>V t y  '.$this->vtyversion.'</strong></font></a><font color="#333333" > - '.$this->dug->dil['VtYonet'].'</font>&nbsp;&nbsp;</td>'."\n".
    "\t\t\t".'<td width="5" >&nbsp;</td>'."\n".
    "\t\t\t".'<td align="right">'.
            ((  
           !$this->ayar['LoginType']=='' and
           (isset($_COOKIE['vtykuki_host']) or
           !empty($this->sbtGirisYap)) and
           $this->baglanti>0
        )?
    '<a href="'.$this->urlyap("ne=sesscikis&".$this->linkler).'" onClick="return confirm(\''.$this->dug->uy['EminmisinCikis'].'\');"><font color="red">'.$this->dug->dil['SessCikis'].'</font> </a> '.$this->ara().' '
        :
    ''
        ).
            ($this->baglanti>0?'<a href="'.$this->urlyap("ne=lang&".$this->linkler).'"><font color="#222222">'.'Language'.' ('.ucfirst($this->dug->dl).')</font></a> '.$this->ara().' ':' ')."\n".
            ($this->baglanti>0?'<a href="'.$this->urlyap($this->linkler."&ne=docs&nebu=help").'"><font color="#222222">'.$this->dug->dil['Yardim'].'</font></a> '."\n":' ')."&nbsp;\n".
    '</td>'."\n"."\t\t".'</tr>'."\n".
    "\t\t".'<tr bgcolor="#394D5B"><td height="1" colspan="3" >'."\n";
        $this->tabloSonu();
}
     
/**
* ust_sonu
*
* ust fonksiyonunda açilan tablonun kapatildigi fonksiyon
*/
function ustSonu(){
        $this->tabloSonu();
}
           
/*
*
* Database ve tablo listeleri
*/
function db_secimi()
{
        if( $this->ayar['DbSecimi'] == 1 ){
    $this->tabloBas('','1','10','50','');
    echo '<font size="4">'.$this->dug->dil['Vt'].': </font>'."\n".$this->db_liste()."\n";
    echo (!empty($this->dbname)?'&nbsp;<font size="4">  - '.$this->dug->dil['Tablo'].':</font> '."\n".$this->tb_liste()."\n":'');
    $this->tabloSonu();
        }
}
     
     
/**
* db_liste()
*
* Drop down menu de database listesi,
*
* @access public
*/
function db_liste($id=1)
{
if($id==1){
   $return = "\t\t\t\t".'<select name="sSdb" onChange="atla(\'parent\',\''.$this->urlyap("dl=".$this->dug->dl).'\',this,0)">'."\n";
}elseif($id==2){
    $return = "\t\t\t\t".'<select name="dumpet_dblist"  style="width:200;"  onChange="atla(\'parent\',\''.$this->urlyap("ne=dumpet&dl=".$this->dug->dl).'\',this,0)">';
}
        $return .= "\t\t\t\t\t".'<option value="" selected>---'.$this->dug->dil['Seciniz'].'---</option>'."\n";
        $db_list = $this->db->vty_list_dbs($this->baglan);
        while ($row = $this->db->vty_fetch_object($db_list)) {
            unset($temp_tb_numrows);
            $DatabaseNameInObject = $this->db->vty_list_dbs_databasename();
            $tempdb = $row->$DatabaseNameInObject;
            if($tempdb == $this->dbname){$selected = 'selected'; $dbGercekMi = 1; }else{ $selected = ''; }
     
            //DB_AYRIMI
            if($this->ayar['db_type']=='mysql'){
        $temp_tb_list = $this->db->vty_list_tables($tempdb);
        $temp_tb_numrows = $this->db->vty_num_rows($temp_tb_list);
            }elseif($this->ayar['db_type']=='mssql'){
        $temp_tb_list = $this->db->vty_query("sp_tables");
        $temp_tb_numrows = $this->db->vty_num_rows($temp_tb_list);
            }
           
            if($this->ayar['NtGoster'] == 1)
        $tb_numrows =(($temp_tb_numrows == "0" or !empty($temp_tb_numrows) )? " (".$temp_tb_numrows.")" : ' : (x)' )."";
     
            if(isset($temp_tb_numrows))  
        $return .= "\t\t\t\t\t".'<option value="&sdb='.urlencode($tempdb).'"'.$selected.'>'.$tempdb.$tb_numrows.'</option>'."\n";
     
     
        }//w
        if(empty($dbGercekMi) and $this->dbname)
    unset($this->dbname);
        $return .= "\t\t\t\t"."</select>"."\n";
        return $return;
}
     
/**
* tb_liste()
*
* Drop down menu de tablo listesi,
*
* @access public
*/
function tb_liste($id=1)
{
if($id==1){
        $return = "\t\t\t\t".'<select name="sStb" onChange="atla(\'parent\',\''.$this->urlyap("sdb=".$this->dbname."&dl=".$this->dug->dl).'\',this,0)">'."\n";
        $return .= "\t\t\t\t\t".'<option value="'.$this->urlyap("sdb=".$this->dbname).'" selected>---'.$this->dug->dil['Seciniz'].'---</option>'."\n";
}elseif($id==2){
        $return = "\t\t\t\t".'<select name="dumpet_tablelist" size="15" style="width:200;" multiple onChange="return DumpEtJsHepHicSayi();" >'."\n"; //onChange="atla(\'parent\',\''.$this->urlyap("sdb=".$this->dbname."&dl=".$this->dug->dl).'\',this,0)"
}
     
        $select = $this->db->vty_select_db($this->dbname);
           
        if($this->ayar['db_type']=='mysql'){
    $tb_list = $this->db->vty_list_tables($this->dbname);
    $tb_numrows = $this->db->vty_num_rows($tb_list);
        }elseif($this->ayar['db_type']=='mssql'){
    $tb_list = $this->db->vty_query("sp_tables");
    $tb_numrows = $this->db->vty_num_rows($tb_list);
        }
           
        $tableGercekMi = 0;
        for($l=0;$l<$tb_numrows;$l++){
           
            if($this->ayar['db_type']=='mysql')
        $temptb = $this->db->vty_tablename($tb_list,$l);
            elseif($this->ayar['db_type']=='mssql')
        $temptb = mssql_result($tb_list,$l,'TABLE_NAME');
       
            if($this->ayar['NfGoster'] == 1){
           
        if($this->ayar['db_type']=='mysql')
    $query = $this->db->vty_query("select count(*) as c from `$temptb` ");
        elseif($this->ayar['db_type']=='mssql')
    $query = $this->db->vty_query("select count(*) as c from [$temptb] ");
           
        if($this->ayar['db_type']=='mysql')
    $temptb = $this->db->vty_tablename($tb_list,$l);
        elseif($this->ayar['db_type']=='mssql')
    $temptb = mssql_result($tb_list,$l,'TABLE_NAME');
   
        $numrows = $this->db->vty_result($query,"0","c"); unset($query);
       
        if($this->ayar['db_type']=='mysql'){
    $list = $this->db->vty_list_fields($this->dbname,$temptb);
    $numfields = $this->db->vty_num_fields($list);  unset($list);
        }elseif($this->ayar['db_type']=='mssql'){
    $list = $this->db->vty_query("sp_tables [$temptb]");
    $numfields = $this->db->vty_num_fields($list);  unset($list);
        }
           
        $soyle = $temptb.' ('.$numrows.'x'.$numfields.')';
            }else{
        $soyle = $temptb;
            }
            if($temptb == $this->tablename ){$selected = "selected"; $tableGercekMi=1;} else { $selected = '';}
        if($id==1){
            $return .= "\t\t\t\t\t".'<option value="&stb='.$temptb.'" '.$selected.'>'.$soyle.'</option>'."\n";
        }elseif($id==2){
            $return .= "\t\t\t\t\t".'<option value="'.$temptb.'" '.$selected.'>'.$soyle.'</option>'."\n";
        }
        } //f
        $return .= "\t\t\t\t"."</select>"."\n";
        return $return;
}
     
/**
* db_seciniz_linkler()
*
* Database seciniz, tablo seciniz ifadeleri
*
* @access private
* @return bos echo ile halleder
*
*/
function db_seciniz_linkler()
{
    if(empty($this->dbname)){
    $this->tabloBas('','1','10','','',$this->dug->gor['bgcolor3']);
    $this->Soyle($this->dug->dil['VtSeciniz']."","green",'',""); echo "\n";
    $this->tabloSonu();
    $this->tabloBas('','1','10','60','',$this->dug->gor['bgcolor2']);
    echo    '<li><a href="'.$this->urlyap("ne=sqlgoster&".$this->linkler).'">'.$this->dug->dil['Sql']."</a></li> \n ".
        '<li><a href="'.$this->urlyap("ne=yeniDbEkle&".$this->linkler).'">'.$this->dug->dil['DbEkle']."</a></li> \n ";
    $this->tabloSonu();
           
        }elseif(empty($this->tablename)){
    $this->tabloBas('','1','10','','',$this->dug->gor['bgcolor3']);
    $this->Soyle($this->dug->dil['TbSeciniz']."","green",'',""); echo "\n";
    $this->tabloSonu();
    $this->tabloBas('','1','0','60','0',$this->dug->gor['alt_bgcolor']);
    $this->tabloBas('','0','10','','',$this->dug->gor['bgcolor2']);
    echo    '<li><a href="'.$this->urlyap("ne=sqlgoster&amp;".$this->linkler)."\">".$this->dug->dil['Sql']."</a></li>"."\n".
        '<li><a href="'.$this->urlyap("ne=yeniTbEkle&amp;".$this->linkler)."\" >".$this->dug->dil['TbEkle']."</a></li>"."\n".
        '<li><a href="'.$this->urlyap("ne=yeniDbEkle&amp;".$this->linkler)."\" >".$this->dug->dil['DbEkle']."</a></li>"."\n".
        '<li><a href="'.$this->urlyap("ne=dbSil&amp;sor=e&amp;".$this->linkler)."\" onClick=\"return Sileyimmi('". $this->dug->uy['EminmisinDbSil']."');\">".
    "<font color=\"red\">".$this->dug->dil['DbSil']."</font></a>".
        '</li>'."\n".
        "</td>"."\n".
        "<td align=\"right\" valign=\"top\">"."\n".
    '<a href="'.$this->urlyap($this->linkler).'">'.$this->dug->dil['SayfaYnl'].'</a> '.$this->ara().' '.
    '<a href="'.$this->urlyap("sdb=&dl=".$this->dug->dl).'" >'.$this->dug->dil['Yukari'].'</a>'."\n";
    $this->tabloSonu();
    $this->tabloSonu();
}
}
     
/**
* _htmlSonu()
*
* Sayfanin bitimindeki html body taglarini koyar.
*
* @access private
*/
function _htmlSonu()
{
        echo '</body>'."\n".'</html>';
}
     
     
        /**
        *
        *
        *
        *  ALL
        *  FUNCTIONS
        *
        *
        *
        */
     
function gecici_tb_adi()
{
        return ($this->ayar['db_type']=='mssql'?'['.$this->tablename.']':'`'.$this->tablename.'`');
}
     
function select_db()
{
        return $this->db->vty_select_db($this->dbname) or die ($this->db->vty_error());
}
     
function numrows()
{
        $gcc_table_name = $this->gecici_tb_adi();
        $this->numrows = $this->db->vty_result($this->db->vty_query("SELECT COUNT(*) as c FROM $gcc_table_name"),0,'c');
}
     
/**
* SayfaYap()
*
* ?ekilen verileri (mesela) 50'ser 50'ser sayfalara ayiran fonksiyon
*
* @param $numrows Sql sorgusundan gelen satir sayisi
* @param $linkler vty'de dolasan $linkler degisgeni href="$linkler seklinde
* @return bos. echo ile kendini ifade eder.
* @access public
*/
function SayfaYap()
{
        if($this->ayar['db_type']=='mysql'){
    $bs = (!empty($this->pp)?$this->pp:$this->ayar['PerPage']);
    $ts = ceil($this->numrows / $bs);
    $kac = ((!$this->kac or $this->kac<1)?1:($this->kac>$ts?$ts:$this->kac));
    $i = ($kac -1)*$bs;
    $s = ($kac==$ts?($bs - (($ts*$bs) - $this->numrows)):$bs);
    $basson = ($ts<40?40:10);
    if($this->numrows>0){
            $this->query_limit = 'LIMIT '.$i.', '.$s;
     
            echo '<table width="100%" height="0" border = "0" cellspacing="0" cellpadding="0" >
        <form name="fSayfaBasi" method="post" action="'.$this->urlyap($this->linkler).'" >
        <tr bgcolor="#E9EDE9" ><td>&nbsp;';
     
            echo ($kac-1>0?'<a href="'.$this->urlyap($this->linkler."kac=".($kac-1)).'" style="color:#009933;" ><b>&lt;</b></a>':'&lt;').' ';
            echo $this->dug->dil['sayfalar']."&nbsp; ";
            echo ($kac+1<=$ts?'<a href="'.$this->urlyap($this->linkler."kac=".($kac+1)).'" style="color:#009933;" ><b>&gt;</b></a>':'&gt;').' :&nbsp;  ';
     
            if((($kac>$basson)?$kac-$basson:1)!=1)
        echo ($kac!=1?'&nbsp;<a href="'.$this->urlyap($this->linkler."kac=".(1).'"').' style="color:#009933;" >'.'1'.'</a>':'1').' ... ';
            for($k=(($kac>$basson)?$kac-$basson:1);$k<=(($kac+$basson<=$ts)?$kac+$basson:$ts);$k++){
        echo '<a href="'.$this->urlyap($this->linkler."kac=".$k).'" style="color:#009933;" >'.($k==$kac?'<b><u>'.$k.'</u></b>':''.$k.'').'</a> ';
            }
            if((($kac+$basson<=$ts)?$kac+$basson:$ts)!=$ts){
        echo ' ... '.($kac!=$ts?'&nbsp;<a href="'.$this->urlyap($this->linkler."kac=".$ts.'"').' style="color:#009933;" >'.$ts.'</a>':'').' ';
            }
            echo "</td> \n"
        ."<td align=\"right\" valign=\"top\"  nowrap > \n"
        .'<b>'.$this->dug->dil['sayfa'].': <input name="kac" type="text" value="'.$kac.'" size="5" style="width=\'37\'" > &nbsp;'
        .$this->dug->dil['SayfaBasi'].': <input name="sayfaBasi" type="text" value="'.(($this->numrows<$bs and empty($this->pp))?$this->numrows:$bs).'" size="5" style="width=\'37\'" >'
        .'<input name="git" type="submit" size="1" value=" &gt; "></b>'
        ."&nbsp;</td></tr></form></table>";
            $this->tabloSonu();
    }
        }else{
    ; // may be mssql
        }
}
     
/**
* query_limit
*
*/
function query_limit()
{
        $numrows = $this->numrows;
        $bs = (!empty($this->pp)?$this->pp:$this->ayar['PerPage']);
        $ts = ceil($numrows / $bs);
        $kac = ((!$this->kac or $this->kac>$ts)?1:$this->kac);
        $i = ($kac -1)*$bs;
        $s = ($kac==$ts?($bs - (($ts*$bs) - $numrows)):$bs);
        if($numrows>0){
    $this->query_limit = 'LIMIT '.$i.', '.$s;
    return $this->query_limit;
        }
}
     
/**
* dbKurulumu()
*
* DB Fonksiyonlari kurulumu yoksa kurulu degilmi onu kontrol eder.
*
* @param $dbTipi Veritabaninin tipi 'mysql' veya 'mssql'
* @return true yada false
*/
function dbKurulumu($dbTipi)
{
        if($dbTipi=='mysql')
    return function_exists('mysql_connect');
        elseif($dbTipi=='mssql')
    return function_exists('mssql_connect');
}
     
/**
* dbTipiAdi()
*
* MS SQL ve Mysql icin dogru yazilim dondurur
*
* @param $dbTipi Veritabaninin tipi 'mysql' veya 'mssql'
* @return string Mysql yada MS SQL seklinde database adi dogru yazilimi
*/
function dbTipiAdi($dbTipi)
{
        if($dbTipi=='mysql')
    return 'Mysql';
        elseif($dbTipi=='mssql')
    return 'MS SQL';
        else
    return 'Unknown Database Server';
}
     
/*function t($t=1)
{
        $return = '';
        for($i=0;$i<$t;$i++) $return .= "\t";
        return $return;
}*/
           
function onLoad($devam)
{
        if($this->ne=='yeniDbEkle'){
    $return = "'yeniDbForm','yeniDbAdi'";
        } elseif($this->ne=='yeniTbEkle' and $devam <> 'et'){
    $return = "'yeniTbForm','yeniTbAdi'";
        } elseif($this->ne=='sqlgoster'){
    $return = "'fquery','inquery'";
        }elseif($this->baglan == 0 /*or $this->gp('txtDbHost')*/  and ($this->ayar['LoginType']=='config_or_login' or $this->ayar['LoginType']=='login' )){ //or $this->ayar['LoginType']==2
    $return = "'frmKukiliGiris','txtDbKullanici'";
        }
        return $return = (!empty($return) ? ' onLoad="BunaFocus('.$return.');" ' : '') ;
}
           
/**
* urlyap()
*
* ?ok sik kullanilan bir fonksiyon, linkler olusturur.
*
* @param $url dl=tr&sdb=test&stb=table sekinde bilgiler icerir
* @param $root k?k varmi? yok mu?
* @return (string) url adress
*/
function urlyap($url,$root='var')
{
        $dosya = ($root=='var'? $this->dosya : '' );
        $url = (( substr($url,-1) == "&" or empty($url) ) ? $url."r=".$this->random : $url.'&'."r=".$this->random );
        return $url = $dosya."?".$url;
}
           
function Soyle($soyle,$color="green",$size="",$h)
{
        if($h) echo "<".$h.">";
        echo "<font color=\"$color\" size=\"$size\">$soyle</font>";
        if($h) echo "</".$h.">";
}
           
function ImzaKoy()
{
        print("\n<!-- This page created by Vty - ".date("Y.m.d H:i:s")." -->\n".
      "<!-- Vty download page : http://www.kutukutu.com/vty/ (download)-->\n\n");
}
           
function RandomSayi()
{
        mt_srand ((double) microtime() * 1000000);
        $this->random = mt_rand();
}
     
function ikirenkli($i,$renk1='#eeeeee',$renk2='#eeeeec')
{
        if($i%2){ $bgcolor = $renk1;} else { $bgcolor = $renk2;}
        return $bgcolor;
}
     
function baslik($yazi)
{
        return '<b><font color="#000000" size="3">'.$yazi.'</font></b>';
}
     
function ilk50($girilen,$uzunluk)
{
        $strlen = strlen($girilen);
        if($strlen > ($uzunluk)){
    if($strlen == ($uzunluk+3))
            $girilen = substr($girilen,0,($uzunluk+3));
    else
            $girilen = substr($girilen,0,$uzunluk)."..";
        }
        return $girilen;
}
     
function AlanTipi($result,$alantipi='int')
{
        if($alantipi == 'int'){
    $textyeri = '<input type="text" name="duzeltyazi[]" value="'.$result.'" >';
        }elseif($alantipi == 'string' ){
    $textyeri = '<textarea name="duzeltyazi[]" cols="20" rows="3">'.$result.'</textarea>';
        }elseif($alantipi == 'blob' ){
    $textyeri = '<textarea name="duzeltyazi[]" cols="25" rows="6">'.$result.'</textarea>';
        }else{
    $textyeri = '<input type="text" name="duzeltyazi[]" value="'.$result.'" >';
    //echo "FARKLI DURUM!!! >> ".$alantipi;
        }
        return $textyeri;
}
           
/*
* Coklu duzeltme sayfasindaki durum.
*/
function AlanTipi2($deger,$alantipi,$k)
{
        if($alantipi == 'int'){
    $textyeri = '<input type="text" name="sdsduzeltyazi['.$k.'][]" value="'.$deger.'" >';
        }elseif($alantipi == 'string' ){
    $textyeri = '<textarea name="sdsduzeltyazi['.$k.'][]" cols="20" rows="3" >'.$deger.'</textarea>';
        }elseif($alantipi == 'blob' ){
    $textyeri = '<textarea name="sdsduzeltyazi['.$k.'][]" cols="25" rows="6" >'.$deger.'</textarea>';
        }else{
    $textyeri = '<textarea name="sdsduzeltyazi['.$k.'][]" cols="25" rows="6">'.$deger.'</textarea>';
        }
        return $textyeri;
}      
     
/**
* gp()
*
* get the post and get variables without any error report
*
* @param $deg degisken adi
* @param $met 'get', 'post', ''
*
* @return $ret degisken degeri  //"_FILES","HTTP_POST_FILES"); //EXTR_OVERWRITE
*/
function gp($deg,$tur='gp')
{
        $ret = false;
        if($tur=='g')     $gelenler = array("_GET","HTTP_GET_VARS");
        elseif($tur=='p') $gelenler = array("_POST","HTTP_POST_VARS");
        elseif($tur=='c') $gelenler = array("_COOKIE","HTTP_COOKIE_VARS");
        elseif($tur=='s') $gelenler = array("_SERVER","HTTP_SERVER_VARS");
        elseif($tur=='f') $gelenler = array("_FILES","HTTP_POST_FILES");
        else  $gelenler = array("_GET","HTTP_GET_VARS","_POST","HTTP_POST_VARS");
        if(isset($deg))
        foreach($gelenler as $gelen){
    global $$gelen;
    if(isset($$gelen)){
            $gelend = $$gelen;
            if(isset($gelend[$deg])){
        $$deg = $gelend[$deg];
        $ret = $$deg;
            }
    }
        }
        return $ret;   
}
     
/**
* gkp()
*
* gelen degiskene stripslashes falan ekler
*
* @param $deg degisken adi : bunlari gp fonksiyonuna gonderir.
* @param $met 'get', 'post', ''  : bunlari gp fonksiyonuna gonderir.
*
* @return $ret degisken degeri
*/
function gkp($deg,$tur='gp')
{
        $deg = $this->gp($deg,$tur);
        if(get_magic_quotes_gpc()==true)
    $deg = stripslashes($deg);
        return $deg;
}
     
     
/**
* NoCache()
* Geçmise kaydolmayi engeller
*/
function NoCache(){
        //header("Expires: Mon, 5 jul 1980 05:00:00 GMT");
        //header("Cache-Control: no-cache, must-revalidate");
        //header("Pragma: no-cache");
}
     
/**
* PrimaryVarMi()
*
* Bir tabloda Primary varmi yokmu onu s?yler
*/
function PrimaryVarMi(){
        $field_name = '';
        $list = $this->db->vty_list_fields($this->dbname, $this->tablename);
        $numfield = $this->db->vty_num_fields($list);
        for($i=0;$i<$numfield;$i++){
    $fetch_field = $this->db->vty_fetch_field($list,$i);
    if($fetch_field->primary_key == "1")
            $field_name =$fetch_field->name;
        }
        if($field_name) return 1; else return 0;
}
     
/**
* Mysql Tablo Türleri select menüsü yap
*
*
*/
function AlanTurleri($selectadi="alanturleri"){
    $array = array('INT','VARCHAR','TEXT','TINYINT','SMALLINT','MEDIUMINT','BIGINT','FLOAT','DOUBLE','DATA','DATATIME','TIMESTAMP','TIME','YEAR','CHAR',
             'TINYBLOB','TINYTEXT','BLOB','MEDIUMTEXT','MEDIUMBLOB','LONGBLOB','LONGTEXT','ENUM','SET');
    $return = "<select name=\"$selectadi\">\n";
    foreach($array as $anahtar => $deger){ $return .= "<option>$deger</option>\n";}
    return $return .= "</select>\n";
}
           
function HataGoster($hatasi){
    $this->ust();
    $this->tabloBasi();
    $hata = ''; if($this->db->vty_error()) $hata = '<br>HATA: '.$this->db->vty_error();
    echo "<font sytle=\" color=\"red\"\">$hatasi</font>$hata <br><a href=\"javascript:history.back(-1)\" >« ".$this->dug->dil['Geri']."</a>".
        " | <a href=\"".$this->urlyap($this->linkler)."\" >".$this->dug->dil['Iptal']."</a>";
    $this->tabloSonu();
}
     
function HataGoster2($hatasi){
    $hata = ''; if($this->db->vty_error()) $hata = '<br>HATA: '.$this->db->vty_error();
    echo "<font sytle=\" color=\"red\"\">$hatasi</font>$hata <br><a href=\"javascript:history.back(-1)\" >« ".$this->dug->dil['Geri']."</a>".
        " | <a href=\"".$this->urlyap($this->linkler)."\" >".$this->dug->dil['Iptal']."</a>";
}
     
        /**
        * SonucGoster()
        *
        * Sonuç varsa g?sterir
        *
        */
function SonucGoster($sql,$oldu,$hata){
    $arr = array('@DbName@'=>$this->dbname,'@DbTable@'=>$this->tbname);
    $oldu = strtr($oldu,$arr);
    $hata = strtr($hata,$arr);
    if($this->db->vty_query($sql) == true){
            echo '<font color="green" >'.$oldu."</font>\n<br/>\n".
            "<div style='margin:5;'></div>".
            '<a href="'.$this->urlyap($this->linkler).'" >'.$this->dug->dil['Tamam'].'</a>'."\n".
        '<meta http-equiv="refresh" content="1;URL='.$this->urlyap($this->linkler).'"><br/> ';
    } else {
            echo '<font color="red" size="3" >'.$hata."</font>\n<br/><br/>\n".
        '<font color="red">'.$this->dug->dil['MysqlHata'].':</font> '.mysql_error().'<br/>'.
        '<font color="red">'.$this->dug->dil['Sql'].':</font> '.$sql.'<br/><br/>'.
        '<a href="javascript:history.back(-1)" > « '.$this->dug->dil['Geri'].'</a> '.$this->ara().' '.
        '<a href="'.$this->urlyap($this->linkler).'" >'.$this->dug->dil['Tamam'].'</a><br/> '."\n";
    }
}
     
        /**
        * DiziyiAc()
        *
        * Bir Dizideki de?i?ken de?erlerini aralar?na $ara koyarak s?ralar.
        *
        */
function DiziyiAc($dizi,$ara){
    $sonuc = '';
    array($dizi); $count = count($dizi);
    for($i=0;$i<$count;$i++){
        $sonuc = $dizi[$i].$ara.$sonuc;
    }
    $strlen = strlen($ara);
    $sonuc = substr($sonuc,0,-$strlen);
    return $sonuc;
}
     
function islemSonucu($soyle){
        $this->ust();
        $this->tabloBasi3();
        echo "\t\t\t\t"."<br />"."\n";
        echo "\t\t\t\t".$soyle."\n";
        echo "\t\t\t\t"."<br /> <br />"."\n";
        $this->tabloSonu();
}
     
/**
* tabloBas()
*
* Genel olarak tablonun bas kismini olusturur
* tabloBasi12345 fonksiyonlari bundan alirlar.
*
*/
function tabloBas($wi='',$spa='',$pad='',$he='',$bo='',$bg=''){
        $wi  = ' width="'   .($wi!='' ?     $wi  :  $this->dug->gor['table_width'])         .'" ';
        $spa = 'cellspacing="'  .($spa!=''?     $spa :  $this->dug->gor['cellspacing'])         .'" ';
        $pad = 'cellpadding="'  .($pad!=''?     $pad :  $this->dug->gor['cellpadding'])         .'" ';
        $he  = 'height="'   .($he!='' ?     $he  :  $this->dug->gor['table_height'])        .'" ';
        $bo  = 'border="'   .($bo!='' ?     $bo  :  $this->dug->gor['border'])          .'" ';
        $bg  = ' bgcolor="' .($bg!='' ?     $bg  :  $this->dug->gor['enust_bgcolor'])       .'" ';
        echo "\t".'<table'.$wi.$he.$bo.$spa.$pad.'>'."\n".
     "\t\t".'<tr'.$bg.'>'."\n".
     "\t\t\t"."<td>"."\n";
}
     
function tabloBasi(){
        $this->tabloBas('','','3','','',$this->dug->gor['enalt_bgcolor']);
}
     
function tabloBasi2(){
        $this->tabloBas('','','6','','',$this->dug->gor['alt_bgcolor']);
}
     
function tabloBasi3(){
        $this->tabloBas('','','12','','',$this->dug->gor['enalt_bgcolor']);
}
     
function tabloBasi4(){
        $this->tabloBas();
}
           
function tablo2($icerik)
{
$this->tabloBasi3();
echo $icerik;
$this->tabloSonu();
}
     
/**
* tabloSonu()
*
* Genel olarak tablonun sonu
*/
function tabloSonu(){
        echo "\t\t\t".'</td>'."\n"."\t\t".'</tr>'."\n"."\t".'</table>'."\n";
}
     
function htmlSonu(){
        echo "</body>"."\n"."</html>";
}
     
function ara(){
        return '<font color="#999999">|</font>';
}
     
    }//class:vty
     
    ?>
    <?php
    class islemler
    {
     
        /**
* islemler
*
*
*/
function islemler($vty)
{
$this->vty = $vty;
}
           
/**
* sesscikis
*
* ?ikis tusuna basinca sessini kapatan fonksiyon
*
*/
function sesscikis()
{
        if( setcookie("vtykuki_host",1,time()-1) or setcookie("vtykuki_kullanici",1,time()-1) or setcookie("vtykuki_sifre",1,time()-1) /*or setcookie("vtySeGirDbTipi",1,time()-1)*/ ){
    $soyle = '&nbsp;&nbsp;'.'<font color="green" >'.$this->vty->dug->uy['OturumKapa'].'</font>'."\n<br>\n".
         '&nbsp;&nbsp;'.'<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Tamam'].'</a>'."\n".
         '<meta http-equiv="refresh" content="1;URL='.$this->vty->urlyap($this->vty->linkler).'">';
        }else{
    $soyle = '&nbsp;<font  color="red">'.$this->vty->dug->uy['OturumKaHata'].'</font><br><br>&nbsp;'.
         '<a href="javascript:history.back(-1)" >« '.$this->vty->dug->dil['Geri'].'</a>'.
         ' | <a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Iptal'].'</a>';
        }
        $this->vty->islemSonucu($soyle);
}
     
     
/**
* SqlGoster
*
* SQL ?alistirma ve sonuç g?sterme ana formu, ana sayfasi
*
*/
function SqlGoster()
{
     
        $inquery = stripslashes(trim($this->vty->gp('inquery')));
     
        $this->SqlGosterBasit($inquery);
     
        $dbtbyaz = (!empty($this->vty->tablename)?$this->vty->dbname." . ".$this->vty->tablename : $this->vty->dbname);
     
        if(strlen(trim($inquery))>0){
    $this->vty->select_db();
    $inqueryex = explode("\n",$inquery);
    $count = count($inqueryex);
    if($count>1){
            $goster = '';
            for($i=0;$i<$count;$i++){
        $query = trim($inqueryex[$i]);
        if(trim($query)!='' && trim($query)!=' ' && substr(trim($query),0,2)!='--' && substr(trim($query),0,1)!='#'){
    $this->vty->db->vty_query($query);
    if($this->vty->db->vty_error()==false){
            $goster .= $this->vty->dug->dil['Satir'].' '.($i+1).' - '.'<font color="green" >'.$this->vty->dug->uy['KomutCalistirildi'].'</font>'.'<br />'."\n";
    }else{
            $goster .= $this->vty->dug->dil['Satir'].' '.($i+1).' - '.'<font color="red" >'.'<b>'.$this->vty->dug->dil['Hata'].': '.'</b>'.'</font>'.stripslashes($this->vty->db->vty_error()).'<br />'."\n";
    }
        }
        unset($query);
            }
    }else{
            $this->SqlGosterSonuc($inqueryex[0]);
            if($this->vty->db->vty_error()){
        $goster = "\t\t\t\t".'&nbsp;'.'<b>'.$this->vty->dug->dil['Sorgu'].":</b> ".stripslashes($inqueryex[0]).'<br />'."\n";
        $goster .= "\t\t\t\t".'&nbsp;'.'<font color="red" ><b>'.$this->vty->dug->dil['Hata'].":</b> </font>".stripslashes($this->vty->db->vty_error())."\n";
            }else{
        $goster = "\t\t\t\t".'&nbsp;'.'<font color="green" ><b>'.$this->vty->dug->dil['Cevap'].":</b> </font>".$this->vty->dug->uy['KomutCalistirildi'].". - <b>".$this->vty->db->vty_affected_rows()."</b> ".$this->vty->dug->uy['KacSatirEtkilendi']."\n";
            }
    }
        }
     
        $this->vty->tabloBasi2();
        echo (strlen(trim($inquery))>0?$goster:'<br />');
        $this->vty->tabloSonu();
}
     
function SqlGosterBasit($inquery)
{
        //DB_AYRIM
        if($this->vty->ayar['db_type']=='mysql'){
    $inquery = (!empty($inquery)?stripslashes($inquery): "SELECT * FROM `".$this->vty->tablename."` " );
        }elseif($this->vty->ayar['db_type']=='mssql'){
    $inquery = (!empty($inquery)?stripslashes($inquery): "SELECT * FROM [".$this->vty->tablename."] " );
        }
       
        $dbtbyaz = (!empty($this->vty->tablename)?$this->vty->dbname." . ".$this->vty->tablename : $this->vty->dbname.' . ?');
        $this->vty->tabloBasi();
        echo "\t\t\t\t"."<br>&nbsp;&nbsp; ".$this->vty->baslik($this->vty->dug->dil['Sql'].':')."<br>&nbsp;&nbsp; ".$dbtbyaz."<br>"."\n";
echo "\t".'<table>'."\n".
    "\t".'<form name="fquery" action="'.$this->vty->urlyap("ne=sqlgoster&".$this->vty->linkler).'" method="post" >'."\n".
    "\t\t".'<tr>'."\n".
    "\t\t\t".'<td align="right" > <input name="uzat" type="checkbox" id="uzat" value="3" onClick="return fuzat();" '.($this->vty->gp('uzat')==3?'checked ':'').'> <label for="uzat" >'.$this->vty->dug->dil['Buyut'].'</label> </td>'."\n".
    "\t\t".'</tr>'.
    "\t\t".'<tr>'."\n".
    "\t\t\t".'<td>'."\n".
    "\t\t\t\t".'&nbsp;&nbsp; <textarea name="inquery" cols="90" rows="'.($this->vty->gp('uzat')==3?'25':'5').'">'.$inquery.'</textarea><br>'."\n".
    "\t\t\t\t".'&nbsp;&nbsp; <input name="duzelt" type="submit" id="duzelt" value="      '.$this->vty->dug->dil['Gonder'].'      "> | '."\n".
    "\t\t\t\t".'<input name="temizle" type="reset" id="duzelt" value="'.$this->vty->dug->dil['Reset'].'"> | '."\n".
    "\t\t\t\t".'<a href="'.$this->vty->urlyap("ne=sqlgoster&".$this->vty->linkler).'" >'.$this->vty->dug->dil['Yeni'].'</a> | '."\n".
    // DOSYADAN "\t\t\t\t".'<a href="'.$this->vty->urlyap("ne=sqldosyadan&".$this->vty->linkler).'" >'.$this->vty->dug->dil['Dosyadan'].'</a> | '."\n".
    "\t\t\t\t".'<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Iptal'].'</a>'."\n".
    "\t\t\t".'</td>'."\n".
    "\t\t".'</tr>'."\n".
    "\t".'</form>'."\n".
    "\t".'</table >'."\n".
    '<br>'."\n";
        $this->vty->tabloSonu();
        $this->SqlGosterJS();
     
}
           
        function SqlGosterJS(){
        echo '<script language="JavaScript" type="text/JavaScript" > <!--
    function fuzat(){
            var d = document.fquery;
            if(d.uzat.checked==true) d.inquery.rows = 25; else  d.inquery.rows = 5;
    }'."\n".
    '--> </script>'."\n";
}
           
function SqlGosterSonuc($sql){
        $query = $this->vty->db->vty_query($sql);
        if(!$this->vty->db->vty_error()){
    $numrows = $this->vty->db->vty_num_rows($query);
    $numfields = $this->vty->db->vty_num_fields($query);
    $fetch = $this->vty->db->vty_fetch_row($query);
    echo "\t".'<table width="'.$this->vty->dug->gor['table_width'].'"  border="0" cellspacing="1" cellpadding="2">'."\n";
    echo "\t\t".'<tr bgcolor="'.$this->vty->dug->gor['ust_bgcolor'].'" height="30" cellpadding="3" >'."\n";
    for($i=0;$i<$numfields;$i++){
            echo "\t\t\t"."<td>";
            echo "&nbsp;<strong>".$this->vty->db->vty_field_name($query,$i)."</strong>";
            echo "</td>"."\n";
    }
    echo "\t\t"."</tr>\n";
    for($k=0;$k<$numrows;$k++){
        echo "\t\t".'<tr bgcolor="'.$this->vty->ikirenkli($k,$this->vty->dug->gor['ikirenklicolor1'],$this->vty->dug->gor['ikirenklicolor2']).'" >';
        for($i=0;$i<$numfields;$i++){
    $fieldname = $this->vty->db->vty_field_name($query,$i);
    echo "\t\t\t".'<td valign="top" >&nbsp;';
    echo htmlspecialchars($this->vty->db->vty_result($query,$k,"$fieldname"));
    echo "</td>\n";
        }
        echo "\t\t"."</tr>\n";
    }
    echo "\t"."</table>"."\n";
        }
}
     
/**
* SqlDosyadan
        *
* When executing SQL commands from file
        *
*/
function SqlDosyadan(){
        $inquery = $this->vty->gp('inquery');
        $dosyadansql = $this->vty->gp('dosyadansql','f');
     
        if(!empty($this->vty->dbname)){
    $dbtbyaz = (!empty($this->vty->tablename)?$this->vty->dbname." . ".$this->vty->tablename : $this->vty->dbname); }
        else{
    $dbtbyaz = '';
        }
        $inquery = (isset($inquery)?stripslashes($inquery): "SELECT * FROM `".$this->vty->tablename."` " );
$soyle = '<form name="fquery" action="'.$this->vty->urlyap("ne=sqlgoster&".$this->vty->linkler).'" method="post" enctype="multipart/form-data" >'."\n".
             "&nbsp;&nbsp; ".$this->vty->baslik($this->vty->dug->dil['Sql'].':')."<br>&nbsp;&nbsp; ".$dbtbyaz."<br><br>".
             '&nbsp;&nbsp; <textarea name="inquery" cols="60" rows="6">'.$inquery.'</textarea><br>'."\n".
             '&nbsp;&nbsp; <input name="dosyadansql" type="file" id="dosyadansql" size="70" accept="text/plain" ><br><br>'."\n".
             '&nbsp;&nbsp; <input name="duzelt" type="submit" id="duzelt" value="          '.$this->vty->dug->dil['Gonder'].'  "> | '.
             '<input name="temizle" type="reset" id="duzelt" value="'.$this->vty->dug->dil['Reset'].'"> | '.
             '<a href="'.$this->vty->urlyap($this->vty->linkler).'">'.$this->vty->dug->dil['Iptal'].'</a>'."</form>";
        $this->vty->islemSonucu($soyle);
}
     
/**
* DumpEt
*
* When dumping tables
*
*/
function DumpEt()
{
        $this->vty->ust();
        $this->vty->tabloBasi3();
echo $this->vty->baslik($this->vty->dug->dil['DumpTable']);
echo '<br><br><table border="1" cellpadding="5" cellspacing="0" bordercolor="#999999"><tr>   <td>';
echo '<form name="dumpet_form" action="'.$this->vty->urlyap("ne=dumpet&nebu=sim&".$this->vty->linkler).'" onSubmit="return DumpEtJsKontrol();" method="post" >';
echo '<table><tr><td>';
echo $this->vty->dug->dil['Vt'].':<br>';
echo $this->vty->db_liste(2);
//if($this->vty->dbname!=''){
    echo '<br><br><table cellpadding="0" cellspacing="0" ><tr><td>'.$this->vty->dug->dil['Tablo'].':</td>';
    echo '<td align="right" ><span id="dumpet_span"></span><input type="checkbox" name="dumpet_hephic" value="3" onClick="return DumpEtJsHepHic();" ></td></tr>';
    echo '<tr><td colspan="2" >'.$this->vty->tb_liste(2).'</td></tr></table>';
//}
echo '</td><td valign="bottom" align="left" ><br><br>  &nbsp; ';
echo '<input type="radio" name="dumpet_creins" id="d01" value="both" checked ><label for="d01" >'.$this->vty->dug->dil['DumpBoth'].'</label><br> &nbsp; '."\n";
echo '<input type="radio" name="dumpet_creins" id="d02" value="create"><label for="d02" >'.$this->vty->dug->dil['DumpCreateOnly'].'</label><br> &nbsp; '."\n";
echo '<input type="radio" name="dumpet_creins" id="d03" value="insert" ><label for="d03" >'.$this->vty->dug->dil['DumpInsertOnly'].'</label><br><br>  &nbsp; '."\n";
echo '<input type="checkbox" name="dumpet_dosyayakaydet" id="d04" value="evet" ><label for="d04" >'.$this->vty->dug->dil['SaveAsFile'].'</label><br> &nbsp; '."\n";
echo '</td></tr></table>'."\n";
echo '</td></tr></table>'."\n";
echo '<br>';
echo '<input type="submit" value="'.$this->vty->dug->dil['DumpSubmit'].'" >'."\n";
echo ' '.$this->vty->ara().' ';
echo '<a href="'.$this->vty->urlyap($this->vty->linkler).'">'.$this->vty->dug->dil['Iptal'].'</a><br><br>';
echo '<input name="dumpet_tablolar" type="hidden" value="" ><span id="dumpet_tablolars"></span>';
echo "</form>";
$this->DumpEtJs();
        $this->vty->tabloSonu();
        }
     
/**
* DumpEtSimdi
*
* When dumping tables
*
*/
function DumpEtSimdi()
{
$dumpet_creins = $this->vty->gp('dumpet_creins');
$dumpet_dosyayakaydet = $this->vty->gp('dumpet_dosyayakaydet');
           
if($dumpet_dosyayakaydet == 'evet' ){
    header("Content-type: text/plain"); //text/Vty-Dump "_".date("d_m_Y_H_i")
    header("Content-Disposition: attachment; filename=vty_".$this->vty->dbname.".txt");
    header("Pragma: no-cache");
    header("Expires: 0");
}else{
    header("Content-type: text/plain");
    $this->htmlen = true;
}
     
           $this->vty->BitimYok();
$database = $this->vty->dbname;
$tablolar = explode('/',$this->vty->gkp('dumpet_tablolar'));
$count = count($tablolar)-1;
for($j=0;$j<$count;$j++) $tablolars = $tablolars.$tablolar[$j].', ';
     
/// 1
echo    "#\n# Vty - Table Dump\n#\n".
        "# Version: ".$this->vty->vtyversion."\n".
        "# URL: ".$this->vty->vtyUrl."\n#\n".
        "# Date: ".date("d.m.Y - H:i:s")."\n".
        "# Host: ".$this->vty->ayar['dbhost']."\n".
        "# Database: ".$database."\n".
        "# Table: ".$tablolars."\n".
        "#\n\n\n";
     
for($i=0;$i<$count;$i++){
    $tablename = $tablolar[$i];
    if($tablename!=''){
     
    echo "\n#\n# `".$tablename."` ----------------------------------------------------------\n#\n\n";
     
    /// 2
    if($dumpet_creins != 'insert' ){
        echo "# Create Table Info\n";
        $query = $this->vty->db->vty_query("SHOW CREATE TABLE `".$database."`.`".$tablename."`");
        echo $this->vty->db->vty_result($query,0,"Create Table")."\n\n";
    }
     
    /// 3
    if($dumpet_creins != 'create' ){
        echo "# Insert Into Info\n";
        $this->DumpEtSimdiInsertInto($tablename);
        echo "\n\n\n";
    }
}}
           
/// 4
echo    "# End Of Vty Table Dump -------------------------------------------------------------\n\n";
}
     
/**
* DumpEt
*
*/
function DumpEtSimdiInsertInto($tablename){
$query = $this->vty->db->vty_query("SELECT * FROM `".$this->vty->dbname."`.`".$tablename."`");
if($this->vty->db->vty_num_rows($query)>0){
    while($satir = $this->vty->db->vty_fetch_row($query)){
        $ret = "INSERT INTO `".$tablename."` VALUES (";
        while (list ($key, $val) = each ($satir)) {
            $val = ($this->htmlen==true?addslashes($val):$val);
            //$val = preg_split ("/[\n,]+/", $val); //preg_replace(chr(11),'',$val);
            //$val = preg_replace("/[\n\s\f\t]+/",'',$val);
            $val = preg_replace("/[\n\r\f\t]+/",' ',$val);
            $ret .= '"'.$val.'", ';
        }
        echo substr($ret,0,-2) . ");\n";
    }
   
   
}else{
   echo "# There is no row in the table.\n";
}
        }
     
     
        /**
        * DumpEtJS
        *
        * Dump et sayfas?ndaki javascriptler
        */
        function DumpEtJs(){
echo "\n\n<script language='javascript'>
       // Tablolarin hepsini yada hicbirini secmek icin kullanilir
       func"."tion DumpEtJsHepHic(){
           var d = document.dumpet_form;
           var che = d.dumpet_tablelist;
    var len = (typeof(che.length)!='undefined'?che.length:'0');
           for(var i=0;i<len;i++){
   che[i].selected = d.dumpet_hephic.checked;
           }
           DumpEtJsHepHicSayi();
       }
     
       DumpEtJsHepHicSayi();
     
       // Kac tane tablo secildigini gosterir: 3/30 seklinde
       func"."tion DumpEtJsHepHicSayi(){
    var brow = (navigator.appName.substring(0,8)=='Netscape'?1:0);
           var d = document.dumpet_form;
           var che = d.dumpet_tablelist;
    var len = (typeof(che.length)!='undefined'?che.length:'0');
    var isimleri = '';
           for(var i=0,j=0;i<len;i++){
   if(che[i].selected == true ){
       j++;
       isimleri = isimleri + che[i].value + '/';
   }
           }
    if(brow==1){
   document.getElementById('dumpet_span').value = j+'/'+len;
   d.dumpet_tablolar.value = isimleri;
    }else{
   dumpet_span.innerText = j+'/'+len;
   d.dumpet_tablolar.value = isimleri;
           }
    return false;
       }
       
       func"."tion DumpEtJsKontrol(){
           var d = document.dumpet_form;
           var che = d.dumpet_tablelist;
    var len = (typeof(che.length)!='undefined'?che.length:'0');
           var k = false;
           for(var i=0;i<len;i++){
   if(che[i].selected == true){
       i = len;
       k = true;
   }
           }
           return k;
       }
   </script>
           ";
        }
     
/**
* Select Language page
*/
function Language($secildimi){
        $this->vty->ust();
        $this->vty->tabloBasi3();
        echo $this->LanguageList($secildimi);
        $this->vty->tabloSonu();
}
     
/*
* Language List for LANG page
*/
function LanguageList($secildimi){
        $diller = $this->vty->dug->diller();
        $dl = $this->vty->dug->dl;
        //$don .= '<form name="fDil" action="'.$this->vty->urlyap("ne=lang&".$this->vty->linkler).'" method="post" >'."\n";
        $don .= '<form name="fDil" action="'.$this->vty->urlyap($this->vty->linkler).'" method="post" >'."\n";
        $don .= '<h3>'.$this->vty->dug->uy['YeniDilSec'].':</h3>'."\n";
        $don .= '<select name="dl" >'."\n";
        foreach($diller as $key=>$dil)
    $keys[] = $key;
        foreach($diller as $di => $dil)
    $don .= '<option value="'.$di.'" '.((empty($dl) or !in_array($dl,$keys)) ? ($di==$this->ayar['DefaultLang']?'selected':'') : ($dl==$di?'selected':'') ).' >'.$dil.'</option>'."\n";
        $don .= '</select>'."\n";
        $don .= '<br/><br/>';
        $don .= '<input type="submit" name="fDilSubmit" value="   OK     " > | ';
        //$don .= '<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.(isset($secildimi)?$this->vty->dug->dil['Iptal']:$this->vty->dug->dil['Iptal']).'</a>';
        $don .= '<a href="'.$this->vty->urlyap($this->vty->linkler).'" >cancel</a>';
        $don .= '</form>';
        return $don;
}
     
/**
* YeniTableEkle
*
*
*/
function YeniTableEkle(){
if($this->vty->gkp('devam')==''){
        /// birinci
            echo "\t".'<table width="'.$this->vty->dug->gor['table_width'].'"  border = "'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'" cellpadding="'.($this->vty->dug->gor['cellpadding']+5).'" >'."\n".
        "<form name=\"yeniTbForm\" method=\"post\" action=\"".$this->vty->urlyap($this->vty->linkler."ne=yeniTbEkle&devam=et")."\" onSubmit=\"return yeniTbOnSubmit();\">\n".
        "\t\t".'<tr bgcolor="'.$this->vty->dug->gor['alt_bgcolor'].'" >'."\n".
        "<td>\n<br>&nbsp;&nbsp;".$this->vty->baslik($this->vty->dug->dil['TbEkle'])."\n<br><br>\n&nbsp;&nbsp;".$this->vty->dug->dil['VtAdi']." . ".$this->vty->dug->dil['TbAdi']." :<br>\n";
        // tablo listele
        echo '&nbsp;&nbsp;<select name="sdb">'."\n";
        $db_list = $this->vty->db->vty_list_dbs($this->vty->baglan);
        while ($row = $this->vty->db->vty_fetch_object($db_list)) {
    $DatabaseNameInObject = $this->vty->db->vty_list_dbs_databasename();
    $tempdb = $row->$DatabaseNameInObject;
    $selected = ( $tempdb == $this->vty->dbname ? 'selected' : '' );
    echo "<option value=\"$tempdb\" $selected>$tempdb</option>\n";
        } //w
        echo "</select>\n";
        echo        '&nbsp;&nbsp;<strong>.</strong>&nbsp;&nbsp;<input name="yeniTbAdi" type="text" id="yeniTbAdi">'.
            '<br><br>&nbsp;&nbsp;'.$this->vty->dug->dil['SutunSys'].' :<br>&nbsp;&nbsp;'.
            '<input name="yeniTbAlanSayisi" type="text" id="sb" size="2"><br>'."\n".
            '<br>&nbsp;&nbsp;<input name="yeniTbDevam" type="submit" id="yeniTbDevam" value="  '.$this->vty->dug->dil['Devam'].'  "> | '.
            "<a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Iptal']."</a><br><br><br>\n".
            "</td>\n</tr>\n</form>\n</table>\n";
     
} elseif($this->vty->gkp('devam')=="et"){
        /// ikinci
        if($this->vty->gkp('yeniTbAlanSayisi') == 0){
    echo "yok";
        }else{
    $yeniTbUzunluk = strlen($this->vty->gkp(yeniTbAdi));
    echo '<table bgcolor="'.$this->vty->dug->gor['alt_bgcolor'].'" border = "'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'" cellpadding="'.($this->vty->dug->gor['cellpadding']+5).'" >'."\n".
            "<form name=\"yenitb2form\" action=\"".$this->vty->urlyap("ne=yenitbekliyorum&".$this->vty->linkler)."\" method=\"post\">\n<tr>\n".
            "<td colspan=\"9\"><br>".$this->vty->baslik($this->vty->dug->dil['TbEkle'])."<br>".$this->vty->gkp('sdb')." . <input name=\"yeniTbAdi\" type=\"text\" value=\"".$this->vty->gkp(yeniTbAdi)."\" size=\"".$this->vty->gkp($yeniTbUzunluk)."\" >".
            " <br><br></td></tr>\n".
            '<tr><td><table><tr bgcolor="'.$this->vty->dug->gor['ust_bgcolor'].'" border="'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'"'.'cellpadding="'.$this->vty->dug->gor['cellpadding'].'" align="center" height="30" >'.
            "<td>&nbsp;<b>#</b>&nbsp;</td>\n<td>&nbsp;<b>Sütun Ad? :</b></td>\n<td>&nbsp;<b>Türü :</b> </td>\n<td> &nbsp;<b>Boyutu :</b></td>\n".
            "<td> &nbsp;<b>?zellik :</b></td>\n <td>&nbsp;<b>Bos mu? :</b> </td>\n<td>&nbsp;<b>Anahtar :</b></td>\n".
            "<td>&nbsp;<b>?lk De?eri :</b> </td>\n<td>&nbsp;<b>Di?er :</b></td>\n</tr>\n";
    for($i=0;$i<$this->vty->gkp('yeniTbAlanSayisi');$i++){
            echo //"<tr bgcolor=\"".ikirenkli($i,"$ikirenklicolor1","$ikirenklicolor2")."\" border = \"$border\" cellspacing=\"$cellspacing\" cellpadding=\"$cellpadding\">\n".
                "<tr bgcolor=\"".$this->vty->ikirenkli($i,$this->vty->dug->gor['ikirenklicolor1'],$this->vty->dug->gor['ikirenklicolor2'])."\"  cellpadding=\"".$this->vty->dug->gor['cellpadding']."\">\n".
                "<td>".($i+1)."</td>\n".
                "<td><input type=\"text\" name=\"sutunadi[]\"></td>\n".
                "<td>\n".$this->vty->AlanTurleri("turu[]")."</td>\n".
                "<td><input type=\"text\" name=\"boyutu[]\" size=\"4\" ></td>\n".
                "<td>\n<select name = \"ozellik[]\"  size=\"1\">\n<option>-</option>\n<option>unsigned</option>\n".
                "<option>unsigned zerofill</option>\n<option>binary</option>\n</select></td>\n".
                "<td><input name=\"bosmu[]\" type=\"checkbox\" value=\"NULL\"> NULL</td>\n".
                "<td>\n<select name = \"anahtar[]\"  size=\"1\">\n<option>-</option>\n<option>primary</option>\n".
                "<option>unique</option>\n<option>index</option>\n</select></td>\n".
                "<td><input type=\"text\" name=\"ilkdegeri[]\"></td>\n".
                "<td>\n<select name = \"diger[]\"  size=\"1\">\n<option>-</option>\n<option>auto_increment</option>\n</select></td>\n".
                "</tr>\n";
    } //f
    echo         "</table></td></tr><tr>\n<td colspan=\"9\" ><br>&nbsp;<input type=\"submit\" name=\"ekle\" value=\"  ".$this->vty->dug->dil['Olustur']."  \"> | ".
        //"<input type=\"reset\" name=\"reset\" value=\"Temizle\"> | ".
        "<input name=\"fieldsayisi\" type=\"hidden\" value=\"".$i."\">".
        "<a href=\"javascript:history.back(-1)\">".$this->vty->dug->dil['Geri']."</a> | ".
        "<a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Iptal']."</a> <br><br></td>\n</tr>\n".
        "</form>\n</table>\n";
        }//i
} //i : devam
     
}
     
/**
* YeniTableEkliyorum
*
*
*/
function YeniTableEkliyorum(){
     
        $fieldsayisi = $this->vty->gp('fieldsayisi');
        if(!empty($fieldsayisi)){
        $primaryk = '';
            $indexk = '';
            $uniquek = '';
            $createDef = '';
            $key = '';
        for($k=0,$p=0,$u=0,$n=0,$i=0; $i < $fieldsayisi;$i++){
    $sutunadi = $this->vty->gp('sutunadi');
    $turu = $this->vty->gp('turu');
    $boyutu = $this->vty->gp('boyutu');
    $ozellik = $this->vty->gp('ozellik');
    $bosmu = $this->vty->gp('bosmu');
    $diger = $this->vty->gp('diger');
    $ilkdegeri = $this->vty->gp('ilkdegeri');
    if(!empty($sutunadi[$i])){
            //$girenler = array("boyutu","turu","ozellik","bosmu","anahtar","ilkdegeri","diger");
            //foreach($girenler as $giren){@array($$giren);}
            unset($girenler);
            if($anahtar[$i]){
        if($anahtar[$i] == 'primary'){
    if($p==0){ $primaryk = "PRIMARY KEY ("; $p++;}
    $primaryk = $primaryk.$sutunadi[$i].', ';
        }
        if($anahtar[$i] == 'index'){
    if($n==0){ $indexk = "INDEX ".$sutunadi[$i]."("; $n++;}
    $indexk = $indexk.$sutunadi[$i].', ';
        }
        if($anahtar[$i] == 'unique'){
    if($u==0){ $uniquek = "UNIQUE ".$sutunadi[$i]."("; $u++;}
    $uniquek = $uniquek.$sutunadi[$i].', ';
        }
            }
     
            $turu[$i] = stripslashes(((!empty($turu[$i]) and $turu[$i] != '-') ? $turu[$i] : '' ));
            $boyutu[$i] = stripslashes((!empty($boyutu[$i]) ? '('.$boyutu[$i].')' : '' ));
            $ozellik[$i] = stripslashes(((!empty($ozellik[$i]) and $ozellik[$i] != '-') ? $ozellik[$i] : '' ));
            $bosmu[$i] = stripslashes(((!empty($bosmu[$i]) and $bosmu[$i] == 'NULL') ? 'NULL' : 'NOT NULL'));
            $diger[$i] = stripslashes(((!empty($diger[$i]) and $diger[$i] != '-') ? $diger[$i] : '' ));
            $ilkdegeri[$i] = stripslashes((!empty($ilkdegeri[$i]) ? 'DEFAULT "'.$ilkdegeri[$i].'"' : '' ));
     
            $createDef = $createDef.' '.$sutunadi[$i].' '.$turu[$i].$boyutu[$i].' '.$ozellik[$i].' '.$bosmu[$i].' '.$ilkdegeri[$i].' '.$diger[$i].", \n";
     
     $k++;
    }//i
        }//f
        $primaryk = substr($primaryk,0,-2).")";
        $indexk = substr($indexk,0,-2).")";
        $uniquek = substr($uniquek,0,-2).")";
        $key = substr(($p>0?$primaryk.", ":'').($n>0?$indexk.", ":'').($u>0?$uniquek.", ":''),0,-2);
        $createDef = ( !empty($key)?substr($createDef,0,-2):substr($createDef,0,-3));
        if(!empty($createDef)){
    $sql= "CREATE TABLE `".$this->vty->dbname."`.`".$this->vty->gp('yeniTbAdi')."` ( $createDef $key )";
    $this->vty->tabloBas('','','20','');
    $this->vty->SonucGoster($sql,ereg_replace('@NewTbName@',$this->vty->gp('yeniTbAdi'),$this->vty->dug->uy['YeniTbOldu']),ereg_replace('@NewTbName@',$this->vty->gp('yeniTbAdi'),$this->vty->dug->uy['YeniTbHata']) );
    $this->vty->tabloSonu();
        }
        if($k==0) $this->vty->HataGoster2("<br>G?nderdiniz form bos.");
}//i
}
     
/**
* YeniDatabaseEkle
*
* Yeni Database Ekleme Formu
*
*/
function YeniDatabaseEkle(){
        $this->vty->ust();
        $this->vty->tabloBas('','','20','');
echo "<form name=\"yeniDbForm\" method=\"post\" action=\"".$this->vty->urlyap("ne=yeniDbEkliyorum")."\" onSubmit=\"return yeniDbOnSubmit();\">\n".
    $this->vty->baslik($this->vty->dug->dil['DbEkle'])."<br><br>\n".$this->vty->dug->dil['VtAdi']." :\n<br>".
    '<input name="yeniDbAdi" type="text" id="yeniDbAdi" size="15"><br><br>'."\n".
    '<input name="yeniDbEkle" this.focus(); type="submit" id="yeniDbEkle" value="  '.$this->vty->dug->dil['Olustur'].'  "> | '.
    "\n<a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Iptal']."</a>\n";
        $this->vty->tabloSonu();
}
     
/**
* YeniDatabaseEkliyorum
*
* Yeni Database ekleme isleminin yapilip bitirildigi yer.
*
*/
function YeniDatabaseEkliyorum(){
        $this->vty->ust();
        $this->vty->tabloBas('','','20','');
$yeniDbAdi = $this->vty->gkp('yeniDbAdi');
$sql = "CREATE DATABASE `$yeniDbAdi` ";
        $this->linkler = "sdb=".$yeniDbAdi;
$this->vty->SonucGoster($sql,ereg_replace('@NewDbName@',$yeniDbAdi,$this->vty->dug->uy['YeniDbOldu']),ereg_replace('@NewDbName@',$yeniDbAdi,$this->vty->dug->uy['YeniDbHata']));
        $this->vty->tabloSonu();
}
           
/**
* Seçilen database'in silinmesinin yapilip bitirildigi yer.
*
*
*/
function DatabaseSil(){
        $sor = ($this->vty->gp('sor')!=''?$this->vty->gp('sor'):'k');
        $this->vty->ust();
        $this->vty->tabloBasi3();
if($sor == "e"){
    echo ereg_replace('@DbName@',$this->vty->dbname,$this->vty->dug->uy['DbSilEminmi']).'<br/>'."\n".
            '<a href="'.$this->vty->urlyap($this->vty->linkler."ne=dbSil&sor=dum").'">'.$this->vty->dug->dil['Evet'].'</a> '.$this->vty->ara().' '.
            '<a href="'.$this->vty->urlyap($this->vty->linkler).'">'.$this->vty->dug->dil['Hayir'].'</a>'."\n";
} elseif ($sor == "dum"){
    $sql = "DROP DATABASE `".$this->vty->dbname."` ";
    $this->vty->SonucGoster($sql,$this->vty->dug->uy['DbSilOldu'],$this->vty->dug->uy['DbSilHata']);
}
        $this->vty->tabloSonu();
}
           
           
/**
        * satirgir()
        *
* Yeni Satirin Girilmesi için form sayfasi
        *
*/
function satirgir(){
        $this->vty->ust();
$sec = $this->vty->db->vty_select_db($this->vty->dbname);
$query = $this->vty->db->vty_query("select * from `".$this->vty->tablename."` ");
        $this->vty->tabloBasi3();
        echo $this->vty->baslik($this->vty->dug->dil['SatirEkle']);
        echo "<br>".$this->vty->dbname.' . '.$this->vty->tablename;
        $this->vty->tabloSonu();
       
        $list = $this->vty->db->vty_list_fields($this->vty->dbname, $this->vty->tablename);
        $numfields = $this->vty->db->vty_num_fields($list);
     
echo '<table cellpadding="0" cellspacing="0" >';
echo '<form action="'.$this->vty->urlyap("ne=satirgir_yap&".$this->vty->linkler).'" method="post" name="satirgirform">';
echo "\t\t".'<tr>'."\n";
echo "\t\t".'<td>'."\n";
echo '<table cellpadding="5" cellspacing="1" >';
echo "\t\t".'<tr bgcolor="'.$this->vty->dug->gor['ust_bgcolor'].'" border="'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'"'.'cellpadding="'.$this->vty->dug->gor['cellpadding'].'"  height="30" >'."\n";
for($r=0;$r<$numfields;$r++){
        $field_name = $this->vty->db->vty_field_name($list,$r);
        $field_name = ucwords(trim($field_name));
        echo '<td align="left" ><b> &nbsp;'.$field_name."</b>&nbsp;</td>\n";
}
echo '</tr>'."\n";
        echo "\t\t".'<tr bgcolor="'.$this->vty->dug->gor['alt_bgcolor'].'" height="30" cellpadding="3" >'."\n";
for($r=0;$r<$numfields;$r++){
    $meta = $this->vty->db->vty_fetch_field($query,$r);
        $type = $meta->type;
        if($type == "blob")
    $textyeri = '<textarea name="duzeltyazi[]" cols="40" rows="10"></textarea>';
        elseif($type=="string")
    $textyeri = '<textarea name="duzeltyazi[]" cols="20" rows="5"></textarea>';
        elseif($type == "int")
    $textyeri = '<input type="text" name="duzeltyazi[]" value="" size="'.$input_size.'">';
        echo '<td  valign="top">'.$textyeri.'</td>'."\n";
}
        echo    "  </tr> </table> \n".
     
    '<table cellpadding="5" cellspacing="1" height="50" width="'.$this->vty->dug->gor['table_width'].'" >'.'<tr>'.
            '<td bgcolor="'.$this->vty->dug->gor['koyu_bgcolor'].'" colspan="'.$f.'" valign="middle"  align ="left" >'."\n".
            '&nbsp;<input name="duzeltonay" type="submit" value="  '.$this->vty->dug->dil['Kaydet'].'  " > | '."\n".
            "<input name=\"reset\" type=\"reset\" value=\"".$this->vty->dug->dil['Reset']."\" > | <a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Iptal']."</a>\n".
            '<input type="hidden" name="sdquery_order" value="'.$this->sdquery_order.'">'.
        '<input name="sdb" type="hidden" value="'.$this->vty->dbname.'">'.
        '<input name="stb" type="hidden" value="'.$this->vty->tablename.'">'.
        "</td>\n</tr>\n \n </table>\n".
     
        " </td> </tr> </form> </table> \n";
     
}//end of func: satir_gir
     
/**
* satirgir_yap
*
*
*
*/
function satirgir_yap(){
        $this->vty->ust();
$this->vty->tabloBasi3();
$field_name = '';
$where = '';
$duzeltyazi = $this->vty->gp('duzeltyazi','p');
array($duzeltyazi);
$list = $this->vty->db->vty_list_fields($this->vty->dbname, $this->vty->tablename);
$numfields = $this->vty->db->vty_num_fields($list);
for($r=0;$r<$numfields;$r++){
        $field_name_ic = $this->vty->db->vty_field_name($list,$r);
        $field_name = '`'.$field_name_ic."` = '".$duzeltyazi[$r]."', ".$field_name."";
}
$field_name = substr($field_name,0,-2);
$sql = 'INSERT INTO`'.$this->vty->tablename.'` SET '.$field_name;
$this->vty->SonucGoster($sql,$this->vty->dug->uy['YeniSatirOldu'],$this->vty->dug->uy['YeniSatirHata']);
$this->vty->tabloSonu();
        }
       
     
/**
* tablo_bosalt
*
*
*
*/
function tablo_bosalt(){
        $this->vty->ust();
$this->vty->tabloBasi3();
$sor = $this->vty->gkp('sor');
$tablename = strtoupper($this->vty->tablename);
$dbname = strtoupper($this->vty->dbname);
if($sor=="yap"){
        $sql = "DELETE FROM `".$this->vty->dbname."`.`".$this->vty->tablename."`";
            $this->vty->SonucGoster($sql,ereg_replace('@DbTable@','<b>'.$dbname." . ".$tablename.'</b>',$this->vty->dug->uy['BosaltOldu']),$this->vty->dug->uy['BosaltHata']);
}else{
        echo ereg_replace('@DbTable@','<b>'.$dbname." . ".$tablename.'</b>',$this->vty->dug->uy['BosaltEmin']);
        echo "<div style='margin:5;'></div>";
        echo "<a href=\"".$this->vty->urlyap("ne=tablo_bosalt&sor=yap&".$this->vty->linkler)."\">".$this->vty->dug->dil['Evet']."</a> | ".
            "<a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Hayir']."</a>";
}
$this->vty->tabloSonu();
        }
     
     
/**
* tablo_kaldir
*
*
*
*/
function tablo_kaldir(){
        $this->vty->ust();
$this->vty->tabloBasi3();
$sor = $this->vty->gkp('sor');
$tablename = strtoupper($this->vty->tablename);
$dbname = strtoupper($this->vty->dbname);
if($sor=="yap"){
        $sql = "DROP TABLE `".$this->vty->dbname."`.`".$this->vty->tablename."`";
        $this->vty->tablename = '';
            $this->vty->SonucGoster($sql,ereg_replace('@DbTable@','<b>`'.$dbname." . ".$tablename.'`</b>',$this->vty->dug->uy['KaldirOldu']),$this->vty->dug->uy['KaldirHata']);
}else{
        echo ereg_replace('@DbTable@','<b>`'.$dbname." . ".$tablename.'`</b>',$this->vty->dug->uy['KaldirEmin']);
        echo "<div style='margin:5;'></div>";
        echo "<a href=\"".$this->vty->urlyap("ne=tablo_kaldir&sor=yap&".$this->vty->linkler)."\">".$this->vty->dug->dil['Evet']."</a> | ".
            "<a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Hayir']."</a>";
}
$this->vty->tabloSonu();
        }
     
     
     
    }
    ?>
    <?php
    class sectim
    {
     
var $vty;
     
/**
* Formdan gelenler
*/
     
// sdquery_order: formda tasinan mevcut tablonun ORDER BY bilgisi
var $sdquery_order;
     
// sdscheck: formdaki herbir sat?r? ifade eden id niteli?indeki bilgidir, dizidir. formdaki ad? sdscheck[]'dir
var $sdscheck;
     
// sdsduzelt: formdaki g?nder butonu. formdaki adi: sdsduzelt
var $sdsduzelt;
     
// sdssil: formdaki sil butonu. formdaki adi: sdssil
var $sdssil;
     
// DUZELT BOLUMU - sdsduzeltyazi: formdaki degistirilecek yazilari icerir iki boyutlu dizidir. formdaki ad?: sdsduzeltyazi[][] seklinde
var $sdsduzeltyazi;
     
// DUZELT BOLUMU - GidecekPrimary: formdaki parimary yoksa olacak durum için databasedeki bilgileri tasir. GidecekPrimary[] url encode seklindedir.
var $GidecekPrimary;
           
// TEK DUZELT BOLUMU - sdsduzeltyazi: formdaki degistirilecek yazilari icerir iki boyutlu dizidir. formdaki ad?: sdsduzeltyazi[][] seklinde
var $duzeltyazi;
     
     
     
/**
* sectim()
*
* Constructor
*/
function sectim($vty)
{
        $this->vty = $vty;
     
        $this->query_order = $vty->gp('query_order');
        $this->sdquery_order = ($vty->gp('sdquery_order')!=''?$vty->gp('sdquery_order') : $this->query_order );
        $this->sdscheck = $vty->gp('sdscheck');
        $this->sdsduzelt = $vty->gp('sdsduzelt');
        $this->sdssil = $vty->gp('sdssil');
     
        $this->sdsduzeltyazi = $vty->gp('sdsduzeltyazi');
        $this->primary = $vty->gp('primary');
        $this->GidecekPrimary = $vty->gp('GidecekPrimary');
        $this->duzeltyazi = $vty->gp('duzeltyazi');
     
        $this->vty->select_db();
        $this->vty->numrows();
        $this->vty->query_limit();
     
        if(isset($this->sdscheck) and $this->sdscheck[0]=='budonguburadabitmez')
    $this->sdscheck = array_slice($this->sdscheck,1);
}
     
/**
* _duzelt()
*
* Duzelt durumu
* seçtim sen düzelt
*
*/
function _duzelt()
{
        $this->vty->tablo2($this->vty->baslik($this->vty->dug->dil['SatirDzlt'])."<br>".$this->vty->dbname." . ".$this->vty->tablename.'<br />');
        //$this->__duzelt_baglantilar(&$list,&$numfields,&$GidecekPrimaryVar,&$GidecekPrimary);
        $GidecekPrimary = '';
        $GidecekPrimaryVar = '';
        $list = $this->vty->db->vty_list_fields($this->vty->dbname,$this->vty->tablename);
        $numfields = $this->vty->db->vty_num_fields($list);
     
        //$this->__duzelt_tablo_basi($list,$numfields,&$GidecekPrimaryVar);
        echo    "\t"."<table cellpadding='0' cellspacing='0' >".
            "\t\t"."<form name=\"duzeltiyorumform\" method=\"post\" action=\"".$this->vty->urlyap("ne=sectim&nebu=duzeltiyorum&".$this->vty->linkler)."\">".
            "\t\t\t"."<tr>"."\n".
            "\t\t\t\t"."<td>"."\n";
     
        //$this->__duzelt_tabloadlari($list,$numfields,&$GidecekPrimaryVar);
        //function __duzelt_tabloadlari($list,$numfields,&$GidecekPrimaryVar){
        $GidecekPrimary = '';
        $GidecekPrimaryVar = '';
        $buff = "\t".'<table  cellpadding="5" cellspacing="1"  width="'.$this->vty->dug->gor['table_width'].'" nowrap >'.
            "\t\t".'<tr bgcolor="'.$this->vty->dug->gor['ust_bgcolor'].'" border="'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'"'.'cellpadding="'.$this->vty->dug->gor['cellpadding'].'" align="center" height="30" >'."\n";
        for($f=0;$f<$numfields;$f++){
            $fetch_field = $this->vty->db->vty_fetch_field($list,$f);
            $fieldname = $fetch_field->name;
            if($fetch_field->primary_key == "1") $GidecekPrimaryVar = $GidecekPrimaryVar."&primary[$fieldname]=var";
            $fieldflag = $this->vty->db->vty_field_flags($list,$f);
            $fieldtype = $this->vty->db->vty_field_type($list,$f);
            $fieldlen = $this->vty->db->vty_field_len($list,$f);
            $buff .= "\t\t\t\t"."<td align='left' >&nbsp; <strong>".$fieldname." :</strong></td>\n";
            //$buff .= "\t\t\t\t"."<td> <strong>".$fieldname." :</strong><br><small> ".$fieldflag."  - ".$fieldtype."(".$fieldlen.")</small></td>\n";
        }
        $buff .= "\t\t\t\t"."</tr>"."\n";
        echo $buff;
    //}endoffunc:__duzelt_tabloadlari
     
        $this->__duzelt_textyerleri($list,$numfields,$GidecekPrimaryVar);
     
        echo    "\n </table> \n ";
        echo    '<table cellpadding="5" cellspacing="1" height="50" width="'.$this->vty->dug->gor['table_width'].'" >'.'<tr>'.
            '<td bgcolor="'.$this->vty->dug->gor['koyu_bgcolor'].'" colspan="'.$f.'" valign="middle"  align ="left" >'."\n".
            '&nbsp;<input name="duzeltonay" type="submit" value="  '.$this->vty->dug->dil['Kaydet'].'  " > | '."\n".
            "<input name=\"reset\" type=\"reset\" value=\"".$this->vty->dug->dil['Reset']."\" > | <a href=\"".$this->vty->urlyap($this->vty->linkler)."\">".$this->vty->dug->dil['Iptal']."</a>\n".
            '<input type="hidden" name="sdquery_order" value="'.$this->vty->sdquery_order.'">'."</td>\n</tr>\n \n </table>\n";
        echo    " </td> </tr> </form> </table> \n";
     
}
     
function __duzelt_textyerleri($list,$numfields,$GidecekPrimary)
{
        $query = $this->vty->db->vty_query("SELECT * FROM `".$this->vty->tablename."` ".$this->vty->sdquery_order." ".$this->vty->query_limit);
        $count = count($this->sdscheck);
        // alta
        for($k=0;$k<$count;$k++){
    $i = $this->sdscheck[$k];
    echo "\t\t".'<tr bgcolor="'.$this->vty->ikirenkli($i,$this->vty->dug->gor['ikirenklicolor1'],$this->vty->dug->gor['ikirenklicolor2']).'"  valign ="top" >'."\n";
    // yana
    for($f=0;$f<$numfields;$f++){
     
            echo "\t\t"."<td> "."\n";
     
            $alanozellik = $this->vty->db->vty_fetch_field($query,$f);
            $alanadi = $alanozellik->name;
            $deger = $this->vty->db->vty_result($query,$i,$alanadi);
     
            if(!empty($GidecekPrimaryVar)){
        if($alanozellik->primary_key == "1")
    $GidecekPrimary = $GidecekPrimary.'&primary['.$alanadi.']='.base64_encode($deger);
            } else{
        $GidecekPrimary = $GidecekPrimary.'&primary['.$alanadi.']='.base64_encode($deger);
            }
        $alantipi = $alanozellik->type;
            $alanuzunluk = $this->vty->db->vty_field_len($list,$f);
            $deger = htmlspecialchars($deger);
            $textyeri = $this->vty->AlanTipi2($deger,$alantipi,$k);
     
            echo    "\t\t\t".$textyeri."\n".
    "\t\t"."</td>"."\n";
    }
    echo '<input name="GidecekPrimary[]" type="hidden" value="'.$GidecekPrimary.'">'."\n";
    echo "</tr>\n";
    $GidecekPrimary = '';
        }
}
           
/**
        * _hepsiniSil()
        *
* Hepsini Sil Durumu
*
*/
function _hepsiniSil(){
$this->vty->tabloBasi3();
        $q = 0;
        $list = $this->vty->db->vty_list_fields($this->vty->dbname, $this->vty->tablename);
        $query = $this->vty->db->vty_query("SELECT * FROM `".$this->vty->tablename."` ".$this->vty->query_order." ".$this->vty->query_limit);
        $numfield = $this->vty->db->vty_num_fields($list);
        $count = count($this->sdscheck);
        $PrimaryVar = $this->vty->PrimaryVarMi();
        // alta
        for($k=0;$k<$count;$k++){
    $where = '';
    $i = $this->sdscheck[$k];
    // yana
    for($f=0;$f<$numfield;$f++){
            $alanozellik = $this->vty->db->vty_fetch_field($list,$f);
            $alanadi = $alanozellik->name;
            $result = $this->vty->db->vty_result($query,$i,"$alanadi");
            if($PrimaryVar == 1){
        if($alanozellik->primary_key == 1)
    $where = $where." `".$alanadi."` = '".$result."' and ";
            }else{
        echo $where = $where." `".$alanadi."` = '".$result."' and ";
            }
    }
    $where = substr($where,0,-4);
     
    $querydel = $this->vty->db->vty_query('DELETE FROM  `'.$this->vty->tablename.'` WHERE '.$where.' LIMIT 1');
    if($this->vty->db->vty_error())
            $hata[] = $this->vty->db->vty_errno()." : ".$this->vty->db->vty_error()." -> ".$this->vty->TrMysqlError($this->vty->db->vty_errno()) ;
    if($querydel)
            $q++;
    unset($querydel);
        }//f
     
        /// Sonuç
        if($q==$k){
    $cevap = ($k==1 ? $this->vty->dug->uy['SatirSilindi'] : ereg_replace('@number@',"$k",$this->vty->dug->uy['SatirNSilindi']));
    echo '<font color="green" >'.$cevap."</font>\n<br/>\n".
        "<div style='margin:5;'></div>".
        '<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Tamam'].'</a>'."\n".
            '<meta http-equiv="refresh" content="1;URL='.$this->vty->urlyap($this->vty->linkler).'"><br/> ';
     
        } elseif($q>0 and $q < $k){
    $hata = DiziyiAc($hata,"<br>");
    $cevap = ereg_replace('@number@',"$k",$this->vty->dug->uy['SatirSilNHata']);
     
    echo '<font color="red" size="3" >'.$this->vty->dug->uy['SatirSilNHata']."</font>\n<br/>".
            '<font color="red">'.$this->vty->dug->dil['MysqlHata'].':</font> '.$hata.'<br/>'.
            '<font color="red">'.$this->vty->dug->dil['Sql'].':</font> '.$sql.'<br/><br/>'.
        "<div style='margin:5;'></div>".
            '<a href="javascript:history.back(-1)" > « '.$this->vty->dug->dil['Geri'].'</a> '.$this->vty->ara().' '.
            '<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Tamam'].'</a><br/> '."\n";
} else{
    $hata = DiziyiAc($hata,"<br>");
    echo '<font color="red" size="3" >'.$this->vty->dug->uy['SatirSilHata']."</font>\n<br/>".
            '<font color="red">'.$this->vty->dug->dil['MysqlHata'].':</font> '.$hata.'<br/>'.
            '<font color="red">'.$this->vty->dug->dil['Sql'].':</font> '.$sql.'<br/><br/>'.
         "<div style='margin:5;'></div>".
            '<a href="javascript:history.back(-1)" > « '.$this->vty->dug->dil['Geri'].'</a> '.$this->vty->ara().' '.
            '<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Tamam'].'</a><br/> '."\n";
        }
     
$this->vty->tabloSonu();
}
           
/**
* _duzeltiyorum()
        *
* Düzeltiyorum Durumu
* hepsini düzeltiyorum
*
*/
function _duzeltiyorum(){
        $list = $this->vty->db->vty_list_fields($this->vty->dbname, $this->vty->tablename);
        $numfields = $this->vty->db->vty_num_fields($list);
        //$sdsduzeltyazi = (isset($sdsduzeltyazi) ? $sdsduzeltyazi : '' );
        $duzeltyazi = (isset($duzeltyazi) ? $duzeltyazi : '' );
        //$GidecekPrimary = (isset($GidecekPrimary) ? $GidecekPrimary : '' );
        array($duzeltyazi);
        $this->GidecekPrimary;
        $count = count($this->GidecekPrimary);
        for($k=0,$i=0;$i<$count;$i++){
     $field_name = '';
     $where = '';
    array($this->sdsduzeltyazi[$i]);
    @parse_str($this->GidecekPrimary[$i]);
    foreach($primary as $anahtar => $deger){
            $where = $where." `".$anahtar."` = '".addslashes(base64_decode($deger))."' and";
    }
    $where = substr($where,0,-4);
    for($r=0;$r<$numfields;$r++){
            $field_name = '`'.$this->vty->db->vty_field_name($list,$r)."` = '".$this->sdsduzeltyazi[$i][$r]."' , ".$field_name;
    }
    $field_name = substr($field_name,0,-2);
    $sql = "UPDATE `".$this->vty->tablename."` set  ".$field_name." WHERE ".$where;
    $query = $this->vty->db->vty_query("$sql");
    if($this->vty->db->vty_error())
            $hata[] = $this->vty->db->vty_errno()." : ".$this->vty->db->vty_error()." -> ".$this->vty->db->vty_error($this->vty->db->vty_errno()) ;
    if($query)
            $k++;
    unset($primary);
        }
$this->vty->tabloBasi3();
        // sonuç
        if($k==$i){
    echo "<font color=\"green\">".$this->vty->dug->uy['SatirlarDuzeldi']."</font><br/>".
        "<div style='margin:5;'></div>".
        "<a href=\"".$this->vty->urlyap($this->vty->linkler)."\" >".$this->vty->dug->dil['Tamam']."</a>\n";
    echo '<meta http-equiv="refresh" content="1;URL='.$this->vty->urlyap($this->vty->linkler).'" ><br/>'."\n";
        } elseif($k>0 and $k < $i){
    $hata = $this->vty->DiziyiAc($hata,"<br>");
    $cevap = "Error: $k rows updated but error on ".($i-$k)." rows .<br>"."Mysql Hata ?iktisi:<br>\"$hata\"<br>";
    echo "<font color=\"red\">$cevap</font>\n<br>\n".
        "<div style='margin:5;'></div>".
        "<a href=\"javascript:history.back(-1)\">&lt;&lt; ".$this->vty->dug->dil['Geri']."</a> | <a href=\"".$this->vty->urlyap($this->vty->linkler)."\" >".$this->vty->dug->dil['Tamam']."</a>\n";
        } else{
    $hata = $this->vty->DiziyiAc($hata,"<br>");
    $cevap = $this->vty->dug->uy['SatirlarDuzeltHata']."<br>"."Mysql Hata ?iktisi:<br>\"$hata\"<br>";
    echo "<font color=\"red\">$cevap</font>\n<br>\n".
        "<div style='margin:5;'></div>".
           "<a href=\"javascript:history.back(-1)\">&lt;&lt; ".$this->vty->dug->dil['Geri']."</a> | <a href=\"".$this->vty->urlyap($this->vty->linkler)."\" >".$this->vty->dug->dil['Tamam']."</a>\n";
        }
$this->vty->tabloSonu();
     
       
       
       
}
           
/**
* bunlariDuzelt()
*/
function _bunlariDuzelt(){
$this->vty->tabloBasi3();
        $where = '';
        $field_name = '';
        @parse_str($this->GidecekPrimary);
        foreach($primary as $anahtar => $deger){
    $where .=  " `".$anahtar."`='".$deger."' and";
        }
        $where = substr($where,0,-4);
     
        $list = $this->vty->db->vty_list_fields($this->vty->dbname, $this->vty->tablename);
        $numfields = $this->vty->db->vty_num_fields($list);
        for($r=0;$r<$numfields;$r++){
    $field_name = $this->vty->db->vty_field_name($list,$r)."= '".$this->duzeltyazi[$r]."' , ".$field_name."";
        }
        $field_name = substr($field_name,0,-2);
        $sql = "UPDATE `".$this->vty->tablename."` SET  ".$field_name." WHERE ".$where."  LIMIT 1";
        if($this->vty->db->vty_query($sql)){
    echo '<font color="green" >'.$this->vty->dug->uy['SatirDuzeldi'].'</font>'."\n".'<br>'.
        "<div style='margin:5;'></div>".
        '<a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Tamam'].'</a>'."\n";
    echo '<meta http-equiv="refresh" content="1;URL='.$this->vty->urlyap($this->vty->linkler).'" >'."\n";
        }else{
    echo '<font color="red" >'.$this->vty->dug->uy['SatirDuzelHata'].'<br><br>'.$this->vty->db->vty_error().'<br>'.'</font>'."\n".'<br>'."\n".'<a href="javascript:history.back(-1);">&lt;&lt; '.$this->vty->dug->dil['Geri'].'</a> | <a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['Tamam'].'</a>'."\n";
        }
$this->vty->tabloSonu();
}
    }
    ?>
    <?php
     
    /**
    * Class tablo
    *
    * Veritabanindan cekilen bilgilerin listelendigi asil tabloyu yapan fonksiyonlar.
    *
    */
    class tablo
    {
var $vty;
var $GidecekPrimary;
           
/**
* tablo()
*
* Constructor
*/
function tablo($vty)
{
        $this->vty = $vty;
}
           
/**
* asil_tablo()
*
* Olayin dondugu asil tablodur
* Tablolarin icindeki bilgilerin gosterildigi asil tablodur
*
* @param $duzeltid eger duzelt durumu varsa hangi satir duzeltilecekse onun idsi
* @access public
*/
function asil_tablo()
{
        $duzeltid = $this->vty->gp('duzeltid');
        $this->vty->select_db();
        $this->vty->numrows();
     
$this->tablo_ust_linkler();
        $this->vty->SayfaYap();
     
        $query = $this->vty->db->vty_query("SELECT * FROM ".$this->vty->gecici_tb_adi()." ".$this->vty->query_order." ".$this->vty->query_limit);
        $numrows = $this->vty->db->vty_num_rows($query);
        $numfields = $this->vty->db->vty_num_fields($query);
           
        $this->asil_tablo_ust();
        $GidecekPrimaryVar = $this->asil_tablo_adlari($query,$numfields);
        $this->asil_tablo_hep_hic($numrows);
        for($i=0;$i<$numrows;$i++){
        $_bgcolor = strtoupper($this->vty->ikirenkli($i,$this->vty->dug->gor['ikirenklicolor1'],$this->vty->dug->gor['ikirenklicolor2']));
            echo "\t\t"."<tr bgcolor=\"".$_bgcolor.'"'.' valign="top" '.
         "onclick=\"if(this.style.background=='#eae8bb') this.style.background='".$_bgcolor."'; else this.style.background='#eae8bb';\" ".
         "onmouseover=\"if(this.style.background!='#eae8bb')this.style.background='#e9f3f8'; \" onmouseout=\"if(this.style.background!='#eae8bb')this.style.background='".$_bgcolor."';\"".
          //window.status=this.style.background;
         //"onclick=\"if(this.style.background=='#EAE8BB') this.style.background='".$_bgcolor."'; else this.style.background='#EAE8BB';\" ".
         //"onmouseover=\"window.status=this.style.background; if(this.style.background!='#EAE8BB')this.style.background='#E9F3F8'; \" onmouseout=\"if(this.style.background!='#EAE8BB')this.style.background='".$_bgcolor."';\"".
          //" ondblClick=\"this.style.background='".$_bgcolor."';\"".
        //"onmouseover=\"window.status=this.style.background; \"".
        '>'."\n"; //#BFDCEA#F5F4DE#EAE8BB#DCEBBA#E8D9BD   #E9F3F8#E0EFF5    #EAE8BB
            $this->asil_tablo_ici_duzeltdurumu($duzeltid,$i);
           
            $fetch = $this->vty->db->vty_fetch_row($query);
            for($r=0;$r<$numfields;$r++){
    if($this->vty->ne == "duzelt" and  $duzeltid == $i )
            echo $this->asil_tablo_ici_goruntu_duzelt($fetch[$r],$query,$r,$GidecekPrimaryVar);
    else
            echo $this->asil_tablo_ici_goruntu_normal($fetch[$r],$this->vty->ilk);
            }
           
            $this->asil_tablo_ici_hepsiniduzelt($duzeltid,$i,$numrows);
            echo "\t\t".'</tr>'."\n";
         }
        $this->asil_tablo_ici_satiryoksa($numrows,$numfields);
        $this->asil_tablo_ici_altkisim($numrows,$numfields,$i);
        $this->asil_tablo_alt($numfields);
     
}
     
/*
*
* Duzelt kismi ust menu
*/
function tablo_ust_linkler()
{
        $this->vty->tabloBas('','1','5','','0','#E9EDE9');
        //$this->vty->tabloBas('','0','','0','0','#E9EDE9');
        echo "\t\t\t\t".'&nbsp;<a href="'.$this->vty->urlyap("ne=sqlgoster&".$this->vty->linkler)."\">".$this->vty->dug->dil['Sql'].'</a> '.$this->vty->ara().' '."\n".
     "\t\t\t\t".'<a href="'.$this->vty->urlyap("ne=dumpet&".$this->vty->linkler)."\">".$this->vty->dug->dil['DumpTables'].'</a>'."\n".
     "\t\t\t".'</td>'."\n".
     "\t\t\t".'<td align="right" >'."\n".
     "\t\t\t\t".'<a href="#EnAlt">'.$this->vty->dug->dil['EnAlt'].'</a> '.$this->vty->ara().' <a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['SayfaYnl'].'</a> '.$this->vty->ara().' '."\n".
     "\t\t\t\t"."<a href=\"".$this->vty->urlyap($this->vty->linkler."stb=")."\">".$this->vty->dug->dil['Yukari']."</a>&nbsp;"."\n";
        $this->vty->tabloSonu();
        $this->vty->tabloBas('','1','5','','0','#E9EDE9');
}
     
     
function asil_tablo_ust()
{
        echo "\t".'<table width="'.$this->vty->dug->gor['table_width'].'"  border = "'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'" cellpadding="'.($this->vty->dug->gor['cellpadding']+2).'" nowrap >'."\n".
     "\t".'<form name="dsform" method="post" action="'.$this->vty->urlyap("ne=sectim&".$this->vty->linkler).'" >'."\n".
     "\t\t".'<tr bgcolor="'.$this->vty->dug->gor['ust_bgcolor'].'" height="30" >'."\n".
     "\t\t\t".'<td nowrap width="'.$this->vty->dug->gor['asilTbSagYan'].'" align="center" bgcolor="#efefef" >'."\n";
if($this->vty->ilk=='ki') echo ' <a href="'.$this->vty->urlyap("ilk=uz&".$this->vty->linkler).'">'.$this->vty->dug->dil['Kisalt'].'</a>'."\n";
        else          echo ' <a href="'.$this->vty->urlyap("ilk=ki&".$this->vty->linkler).'">'.$this->vty->dug->dil['Uzat'].'</a>'."\n";
        echo "\t\t\t".'</td>'."\n";
}
           
function asil_tablo_adlari($query,$numfields)
{
        $GidecekPrimaryVar = false;
        for($r=0;$r<$numfields;$r++){
    $field_name = $this->vty->db->vty_field_name($query,$r);
    $fetch_field = $this->vty->db->vty_fetch_field($query,$r);
    if($fetch_field->primary_key == "1")
            $GidecekPrimaryVar = true;
    echo "\t\t\t".'<td nowrap >'. '&nbsp;'.'<a href="'.$this->vty->urlyap($this->vty->linkler."&order=".$field_name."&desc=".$this->vty->desc).'">'."<b>".$field_name."</b>";
    if($this->vty->order == $field_name)
            echo $this->vty->desc_resim;
    echo '</a>'.'&nbsp;'.'</td>'."\n";
        }
        return $GidecekPrimaryVar;
}
           
function asil_tablo_hep_hic($numrows)
{
        if($this->vty->ne <> "duzelt" and $numrows <> '0' )
    echo "\t\t\t".'<td nowrap align ="center"  bgcolor="#efefef" width="'.$this->vty->dug->gor['asilTbSolYan'].'">'."\n".
             "\t\t\t\t".'<input type="checkbox" name="sdscheck[]" onClick="return HepsiniSec(\'dsform\',\'sdscheck[]\');" value=\'budonguburadabitmez\'>'."\n".
             "\t\t\t".'</td>'."\n";
        else
    ;//echo "\t\t\t".'<td nowrap align ="center"  bgcolor="#efefef" width="10">'."\n"."\t\t\t\t".'&nbsp;</td>'."\n";
       
        echo "\t\t".'</tr>'."\n";
}
           
/*
* Asil tablodaki hepsini sec yeri veya sagdaki inputlar
*/
function asil_tablo_ici_hepsiniduzelt($duzeltid,$i,$numrows)
{
    if($this->vty->ne =="duzelt" and $duzeltid == $i )
            echo '<input name="ne" type="hidden" value="sectim" >'."\n".
         '<input name="nebu" type="hidden" value="bunlariduzelt" >'."\n".
         '<input name="sdb" type="hidden" value="'.$this->vty->dbname.'">'."\n".
         '<input name="stb" type="hidden" value="'.$this->vty->tablename.'">'."\n".
         '<input name="duzeltid" type="hidden" value="'.$duzeltid.'">'."\n".
         '<input name="GidecekPrimary" type="hidden" value="'.$this->GidecekPrimary.'">'."\n";
           
    if($this->vty->ne <> "duzelt" and $numrows <> '0')
            echo "\t\t\t"."<td valign=\"top\" align =\"center\" bgcolor=\"#efefef\" width=\"".$this->vty->dug->gor['asilTbSolYan']."\">".
    "<input type=\"checkbox\" name=\"sdscheck[]\" value=\"$i\" onClick=\"sMi();\" >".'</td>'."\n";
    else
            echo "\t\t\t".'<td bgcolor="#efefef" width=\"3\"></td>'."\n";
}
           
/*
* Asil tablodaki bir satir icin duzelt secili oldugunda.
*/
function asil_tablo_ici_duzeltdurumu($duzeltid,$i)
{
        if($this->vty->ne=="duzelt" and $duzeltid == $i)
    echo "\t\t\t".'<td nowrap valign="top" align ="center" bgcolor="#efefef" width="'.$this->vty->dug->gor['asilTbSagYan'].'" >'.
             '<input name="duzelt" type="submit" id="duzelt" value="'.$this->vty->dug->dil['Kaydet'].'"> '.$this->vty->ara().' '.
             '<a href="'.$this->vty->urlyap($this->vty->linkler).'">'.$this->vty->dug->dil['Iptal'].'</a>'.
             '</td>'."\n";
        else
    echo "\t\t\t".'<td nowrap valign="top" align ="center" bgcolor="#efefef" width="'.$this->vty->dug->gor['asilTbSagYan'].'">'.
             '<a href="'.$this->vty->urlyap("ne=duzelt&duzeltid=".$i."&".$this->vty->linkler)."\">".$this->vty->dug->dil['Duzelt'].'</a> '.$this->vty->ara().' '.
             '<a href="'.$this->vty->urlyap("ne=sectim&sdssil=1&sdscheck[]=".$i."&".$this->vty->linkler).'"'.
             'onClick="return silDe();">'.$this->vty->dug->dil['Sil']."</a>".
             '</td>'."\n";
}
           
function asil_tablo_ici_goruntu_duzelt($result,$query,$r,$GidecekPrimaryVar)
{
    $field_name = $this->vty->db->vty_field_name($query,$r);
    $GidecekPrimary = '';
    // primary
    if($GidecekPrimaryVar==true){
            $fetch_field = $this->vty->db->vty_fetch_field($query,$r);
            if($fetch_field->primary_key == "1")
        $GidecekPrimary = "&primary[".$field_name."]=".$result;
    }else{
            $GidecekPrimary = $GidecekPrimary."&primary[".$field_name."]=".$result;
    }
     
    $result = htmlspecialchars($result);
    $alantipi = $this->vty->db->vty_field_type($query,$r);
    $textyeri = $this->vty->AlanTipi($result,$alantipi);
    if(isset($GidecekPrimary))
            $this->GidecekPrimary .= $GidecekPrimary;
    return "\t\t\t"."<td>".$textyeri.'</td>'."\n";
}
           
           
function asil_tablo_ici_goruntu_normal($result,$ilk)
{
//global $iii;
           // $iii++;
        if($ilk == "ki") {
    $result = htmlspecialchars($result);
    $bunuGoster = "\t\t\t"."<td>".$result.'</td>'."\n"; //onmouseover=\"return bcolor('#ffffff',this);\"
        } else{
    $strlen = strlen($result);
    $result =  $this->vty->ilk50($result,$this->vty->dug->gor['StrlenMax']);
    $kisalmismi = ($strlen == strlen($result) ? 'h' : 'e' );
    $result = htmlspecialchars($result);
    $result = ($kisalmismi == 'e' ? $result.'<a href="'.$this->vty->urlyap("ilk=ki&".$this->vty->linkler).'">»</a>': $result);
    $bunuGoster = "\t\t\t".'<td nowrap >'.$result.'</td>'."\n";
        }
        return $bunuGoster;
}
           
function asil_tablo_ici_satiryoksa($numrows,$r)
{
        if($numrows == "0"){
    echo '<tr>'."\n".'<td>&nbsp;</td><td  colspan="'.($r).'" bgcolor="'.$this->vty->dug->gor['bgcolor3'].'" width="'.$this->vty->dug->gor['table_width'].'" height="90" align="center" >'.
             "&nbsp;".$this->vty->dug->uy['SatirYok'].' <br><br> '."\n".'<a href="'.$this->vty->urlyap("ne=satirgir&".$this->vty->linkler).'" >'.
             $this->vty->dug->dil['SatirEkle']."</a>".
             "</td> \n </tr> \n";
        }
}
           
function asil_tablo_ici_altkisim($numrows,$r,$i)
{
        echo    "\t\t"."<tr bgcolor=\"".$this->vty->ikirenkli(($i+1),"#f0f0f0","#f7f7f7").'" border = "'.$this->vty->dug->gor['border'].'" cellspacing="'.$this->vty->dug->gor['cellspacing'].'" cellpadding="'.$this->vty->dug->gor['cellpadding'].'" >'."\n".
            "\t\t\t"."<td colspan=\"".($r+2)."\" >"."\n".
            "\t\t\t\t".'<input type="hidden" name="sdquery_order" value="'.$this->vty->query_order.'">'."\n".
            "\t".'<table width="100%" >'."\n".
            "\t\t".'<tr>'."\n".
            "\t\t\t".'<td align="left" > '."\n"."\t\t\t\t".ereg_replace('@number@',"$numrows",$this->vty->dug->uy['ToplamSatir']).' / '.$this->vty->numrows."\n"."\t\t\t".'</td>'."\n".
            "\t\t\t\t".(($this->vty->ne <> "duzelt" and $numrows <> '0')?
            "\t\t\t".'<td align="right">'."\n"."\t\t\t\t".'<span id="sdsspan" name="sdsspan" >&nbsp;</span>'."\n".
            "\t\t\t\t"."<input name=\"sdsduzelt\" type=\"submit\" value=\"".$this->vty->dug->dil['Duzelt']."\" onClick=\"return sdBiKontrolEt('dsform','sdscheck[]',true,'duzelt','VtyYeniPencere');\" > ".$this->vty->ara()." \n".
            "\t\t\t\t"."<input name=\"sdssil\" type=\"submit\" value=\"".$this->vty->dug->dil['Sil']."\" onClick=\"return sdBiKontrolEt('dsform','sdscheck[]',true,'sil','".$this->vty->dug->uy['EminmisinSil']."');\">&nbsp;&nbsp;\n".
            "\t\t\t"."</td>"."\n":'').
            "\t\t"."</tr>"."\n"."\t"."</table>"."\n".
            "\t\t"."</td>"."\n"."</tr>\n"."</form>"."\n"."</table>"."\n";
}
           
           
function asil_tablo_alt()
{
        $this->vty->tabloBas('','0','10','0','',$this->vty->dug->gor['alt_bgcolor']);
        echo "\t\t\t\t".'<li><a href="'.$this->vty->urlyap("ne=satirgir&".$this->vty->linkler).'">'.$this->vty->dug->dil['SatirEkle'].'</a></li>'."\n".
            "\t\t\t\t".'<li><a href="'.$this->vty->urlyap("ne=tablo_bosalt&".$this->vty->linkler)."\" OnClick=\"return Sileyimmi('".$this->vty->dug->uy['EminmisinBosalt']."');\">".
            "\t\t\t\t".'<font color="red" size="1" >'.$this->vty->dug->dil['TbBosalt']."</font></a></li>"."\n".
            "\t\t\t\t".'<li><a href="'.$this->vty->urlyap("ne=tablo_kaldir&".$this->vty->linkler)."\" OnClick=\"return Sileyimmi('".$this->vty->dug->uy['EminmisinKaldir']."');\">".
            "\t\t\t\t".'<font color="red" size="1" >'.$this->vty->dug->dil['TbKaldir'].'</font></a></li>'."\n".
            "\t\t\t"."</td>"."\n".
            "\t\t\t".'<td valign="top" align="right" >'."\n".
            "\t\t\t\t".'<a href="#EnUst">'.$this->vty->dug->dil['EnUst'].'</a> '.$this->vty->ara().' <a href="'.$this->vty->urlyap($this->vty->linkler).'" >'.$this->vty->dug->dil['SayfaYnl'].'</a> '.$this->vty->ara().' '."\n".
            "\t\t\t\t".'<a href="'.$this->vty->urlyap($this->vty->linkler."stb=").'">'.$this->vty->dug->dil['Yukari'].'</a>'."\n";
        $this->vty->tabloSonu();
        echo '<a name="EnAlt" />'."\n";
}
    }
    ?>
    <?php
     
    /**
    * vtydb
    *
    * Vty database connection class
    *
    * @access public
    */
    class vtydb
    {
var $vtAdi;
var $baglan;
     
function vty_connect($conHost,$conKul,$conSif){
        switch($this->vtAdi){
        case 'mysql': $this->baglan =  @mysql_connect($conHost,$conKul,$conSif); break;
        case 'odbc':  $this->baglan = odbc_connect($conHost,$conKul,$conSif); break;
        case 'mssql': $this->baglan = @mssql_connect($conHost,$conKul,$conSif); break;
        case 'postgresql': $this->baglan = pg_connect($conHost,$conKul,$conSif); break;}
        return $this->baglan;
}
function vty_close($conId=''){
        $conId = $this->baglan;
        switch($this->vtAdi){
        case 'mysql': return mysql_close($conId);  break;
        case 'odbc': return odbc_close($conId); break;
        case 'mssql': return mssql_close($conId); break;
        case 'postgresql': return pg_close($conId); break;}
}
function vty_query($sqlQuery){
        switch($this->vtAdi){
        case 'mysql': return mysql_query($sqlQuery); break;
        case 'odbc': return odbc_exec($sqlQuery); break;
        case 'mssql': /*echo $sqlQuery;*/ $qu = mssql_query($sqlQuery); /*echo mssql_get_last_message($qu); */ return $qu; break;
        case 'postgresql': return pg_exec($sqlQuery); break;}
}
function vty_result($sqlQuery,$i,$tb){
        switch($this->vtAdi){
        case 'mysql': return mysql_result($sqlQuery,$i,$tb); break;
        case 'odbc': return odbc_result($sqlQuery,$i,$tb); break;
        case 'mssql': return mssql_result($sqlQuery,$i,$tb); break;
        case 'postgresql': return pg_result($sqlQuery,$i,$tb); break;}
}
function vty_error(){
        switch($this->vtAdi){
        case 'mysql': return mysql_error(); break;
        case 'odbc': return odbc_errormsg(); break;
        case 'mssql': return mssql_result(mssql_query("select @@error as hata"),0,'hata'); break; //mssql_get_last_message();
        case 'postgresql': return pg_errormessage(); break;}
}
     
function vty_errno(){
        switch($this->vtAdi){
        case 'mysql': return mysql_errno(); break;
        case 'odbc': return odbc_error($sqlQuery); break;
        case 'mssql': return mssql_min_error_severity(); break;
        case 'postgresql': return 0; break;}
}
     
function vty_fetch_object($conId){
        switch($this->vtAdi){
        case 'mysql': return mysql_fetch_object($conId); break;
        //case 'odbc':
        case 'mssql': return mssql_fetch_object($conId); break;
        case 'postgresql': return pg_fetch_object($conId); break;
        }
}
     
function vty_list_dbs($conId){
        switch($this->vtAdi){
        case 'mysql': return mysql_list_dbs($conId); break;
        //case 'odbc':
        case 'mssql': return mssql_query("sp_databases"); break;
        //case 'postgresql':
        }
}
     
function vty_list_dbs_databasename(){
        switch($this->vtAdi){
        case 'mysql': return 'Database'; break;
        //case 'odbc':
        case 'mssql': return 'DATABASE_NAME'; break;
        //case 'postgresql':
        }
}
     
function vty_list_tables($dbName){
        switch($this->vtAdi){
        case 'mysql': return mysql_list_tables($dbName); break;
        case 'odbc': return odbc_tables($dbName); break;
        case 'mssql': return mssql_query("EXEC sp_tables \"%\",\"%\",\"".$dbName."\",\"'TABLE'\""); break;
        case 'postgresql': return pg_list_tbs($dbName); break;
        }
}
     
function vty_num_rows($query){
        switch($this->vtAdi){
        case 'mysql': return mysql_num_rows($query); break;
        case 'odbc': return odbc_num_rows($query); break;
        case 'mssql': return mssql_num_rows($query); break;
        case 'postgresql': return pg_numrows($query); break;
        }
}
     
function vty_select_db($dbName){
        switch($this->vtAdi){
        case 'mysql': return mysql_select_db($dbName); break;
        //case 'odbc':
        case 'mssql': return mssql_select_db($dbName); break;
        //case 'postgresql':
        }
}
     
     
function vty_tablename($gelen,$deger){
        switch($this->vtAdi){
        case 'mysql': return mysql_tablename($gelen,$deger); break;
        //case 'odbc':
        //case 'mssql': return mssql_tablename($gelen); break;
        //case 'postgresql':
        }
}
     
function vty_list_fields($dbname,$temptb){
        switch($this->vtAdi){
        case 'mysql': return mysql_list_fields($dbname,$temptb); break;
        //case 'odbc':
        case 'mssql': return mssql_list_fields($dbname,$temptb); break;
        //case 'postgresql':
        }
}
     
function vty_num_fields($list){
        switch($this->vtAdi){
        case 'mysql': return mysql_num_fields($list); break;
        case 'odbc': return odbc_num_fields($list); break;
        case 'mssql': return mssql_num_fields($list); break;
        case 'postgresql': return pg_numfields($list); break;
        }
}
     
function vty_field_name($list,$i){
        switch($this->vtAdi){
        case 'mysql': return mysql_field_name($list,$i); break;
        case 'odbc': return odbc_field_name($list,$i); break;
        case 'mssql': return mssql_field_name($list,$i); break;
        case 'postgresql': return pg_fieldname($list,$i); break;
        }
}
     
function vty_fetch_field($list,$i){
        switch($this->vtAdi){
        case 'mysql': return mysql_fetch_field($list,$i); break;
        //case 'odbc':
        case 'mssql': return mssql_fetch_field($list,$i); break;
        //case 'postgresql':
        }
}
     
function vty_fetch_row($query){
        switch($this->vtAdi){
        case 'mysql': return mysql_fetch_row($query); break;
        case 'odbc': return odbc_fetch_row($query); break;
        case 'mssql': return mssql_fetch_row($query); break;
        case 'postgresql': pg_fetch_row($query); break;
        }
}
     
function vty_fetch_array($query){
        switch($this->vtAdi){
        case 'mysql': return mysql_fetch_array($query); break;
        case 'odbc': return odbc_fetch_array($query); break;
        case 'mssql': return mssql_fetch_array($query); break;
        case 'postgresql': pg_fetch_array($query); break;
        }
}
     
function vty_field_type($list,$i){
        switch($this->vtAdi){
        case 'mysql': return mysql_field_type($list,$i); break;
        case 'odbc': return odbc_field_type($list,$i); break;
        case 'mssql': return mssql_field_type($list,$i); break;
        case 'postgresql': pg_fieldtype($list,$i); break;
        }
}
     
function vty_field_flags($list,$i){
        switch($this->vtAdi){
        case 'mysql': return mysql_field_flags($list,$i); break;
        //case 'odbc':
        //case 'mssql': return mssql_field_flags($list,$i); break;
        //case 'postgresql':
        }
}
     
function vty_field_len($list,$i){
        switch($this->vtAdi){
        case 'mysql': return mysql_field_len($list,$i); break;
        case 'odbc': return odbc_field_len($list,$i); break;
        case 'mssql': return mssql_field_length($list,$i); break;
        case 'postgresql': pg_field_len($list,$i); break;
        }
}
     
function vty_affected_rows(){
        switch($this->vtAdi){
        case 'mysql': return mysql_affected_rows(); break;
        case 'odbc': return odbc_affected_rows(); break;
        case 'mssql': $fe = mssql_fetch_row(mssql_query("select @@rowcount",$this->baglan));  return ($fe[0]?$fe[0]:0); break;
        case 'postgresql': pg_affected_rows(); break;
        }
}
     
function vty_free_result(){
        switch($this->vtAdi){
        case 'mysql': return mysql_free_result(); break;
        case 'odbc': return odbc_free_result(); break;
        case 'mssql': return mssql_free_result(); break;
        case 'postgresql': pg_freeresult(); break;
        }
}
     
function vt_adi ($gelenVtAdi) {
        $this->vtAdi = $gelenVtAdi;
}
    }//class:db
     
?>
