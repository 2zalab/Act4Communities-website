<?php
// cleanup.php - à placer dans le dossier public/

$link = __DIR__ . '/public/storage-old2';

if (is_link($link)) {
    if (unlink($link)) {
        echo "Lien symbolique supprimé avec succès.";
    } else {
        echo "Échec de la suppression du lien symbolique.";
    }
} elseif (is_dir($link)) {
    echo "C'est un dossier, pas un lien symbolique. Suppression manuelle nécessaire.";
} else {
    echo "Aucun lien ou dossier storage trouvé.";
}