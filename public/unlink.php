<?php

$storageLink = __DIR__ . '/storage';

if (is_link($storageLink) || is_dir($storageLink)) {
    // supprimer le lien symbolique ou dossier
    if (unlink($storageLink)) {
        echo "? Le lien 'public/storage' a été supprimé.";
    } else {
        echo "? Impossible de supprimer le lien 'public/storage'. Vérifie les permissions.";
    }
} else {
    echo "i Aucun lien 'public/storage' trouvé.";
}
