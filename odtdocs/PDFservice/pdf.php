<?php

        /*
        * Générateur de PDF depuis un ODT fournit en POST    
        */

        @mkdir('./doc/');
        
         if(isset($_POST['f1Data'])) {
                file_put_contents('./doc/'.$_REQUEST['f1'], $_POST['f1Data']);
                $f1 = $_REQUEST['f1'];

        }
        else if(isset($_REQUEST['f1'])) {
                copy($_REQUEST['f1'], './doc/'.basename($_REQUEST['f1']));
                $f1 = basename($_REQUEST['f1']);
        }
        else {
                exit('paramètres incorrects');
        }

// attenbtion /var/www doit être en 777
        $cmd = 'libreoffice  --invisible --norestore --headless --convert-to pdf --outdir '.__DIR__.'/doc/ "'.__DIR__.'/doc/'.$f1.'"';
       // print $cmd.'<br>';
        ob_start();
        $res = system($cmd);
        system('rm -f "'.__DIR__.'/doc/'.$f1.'"');
		ob_get_clean();

		$outname = 'http://'.$_SERVER['HTTP_HOST'].dirname($_SERVER['PHP_SELF']).'/doc/'.substr(basename($f1),0,-4).'.pdf';

		print $outname;