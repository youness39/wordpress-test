<?php

if (isset($_POST["file_submit"])) {

    $items = [];
    $allowed_extensions = ["csv"];

    if (isset($_FILES['file']) && $_FILES['file']['name'][0] != '') {

        $extension = wp_check_filetype($_FILES["file"]["name"]);
        // Check the file extension
        if (in_array($extension["ext"], $allowed_extensions)) {
            // Upload file
            $upload_overrides = array('test_form' => false);
            $movefile = wp_handle_upload($_FILES['file'], $upload_overrides);
            if ($movefile && !isset($movefile['error'])) {
                // Insert first category
                $first_cat_id = wp_create_category('Marques auto');
                // Read uploaded file
                $file = fopen($movefile["file"], "r");
                $i = 0;
                while ($line = fgetcsv($file)) {
                    // Skip the first line
                    if ($i == 0) {
                        $i++;
                        continue;
                    }
                    foreach ($line as $l) {
                        $parts = explode(";", $l);
                        if ($parts[0] && $parts[1]) {
                            if(strtolower($parts[0]) == strtolower($parts[1])) {
                                $parts[1] .= "!";
                            }
                            // Store data in an array
                            $items[] = [$parts[0] => $parts[1]];
                        }
                    }
                }
                fclose($file);
                //Delete uploaded file after reading it
                unlink($movefile["file"]);
                // Insert data in DB
                foreach ($items as $item) {
                    foreach ($item as $k => $v) {
                        $k = utf8_encode($k);
                        $v = utf8_encode($v);
                        $cat_id = 0;
                        //Insert 'marque'
                        if(!category_exists($k, $first_cat_id)) {
                            $cat_id = wp_create_category($k, $first_cat_id);
                        }
                        if($cat_id == 0) {
                            $cat_id = get_cat_ID($k);
                        }
                        //Insert 'modele"
                        if(!category_exists($v, $cat_id)) {
                            wp_create_category($v, $cat_id);
                        }

                    }
                }
                echo "<div class='notice-success notice is-dismissible' style='margin-left: 0;'><p>Catégories importées avec succès.</p></div>";
            } else {
                echo "<div class='notice-error notice is-dismissible' style='margin-left: 0;'><p>Erreur lors de l'upload du fichier !</p></div>";
            }
        } else {
            echo "<div class='notice-error notice is-dismissible' style='margin-left: 0;'><p>Vous devez insérer un fichier .csv !</p></div>";
        }
    } else {
        echo "<div class='notice-warning notice is-dismissible' style='margin-left: 0;'><p>Aucun fichier inséré !</p></div>";
    }

}
