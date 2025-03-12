<?php 
namespace App\Services;

class ImageOptimizerService {

    public function optimizeImage(string $imagePath): string {

        if (is_null($imagePath) || empty($imagePath)) {
            throw new \Exception("Le chemin de l'image est invalide (null ou vide): $imagePath");
        }

        if (!function_exists('imagewebp')) {
            throw new \Exception('GD WebP support is not available.');
        }

        if (!file_exists($imagePath)) {
            throw new \Exception("Le fichier $imagePath n'existe pas");
        }

        $imageInfo = getimagesize($imagePath);
        if (!$imageInfo) {
            throw new \Exception("Le fichier $imagePath n'est pas une image valide");
        }

        $imageExtension = strtolower(pathinfo($imagePath, PATHINFO_EXTENSION));
        $validExtensions = ['jpg', 'jpeg', 'png', 'gif'];
        if (!in_array($imageExtension, $validExtensions)) {
            throw new \Exception("Le fichier $imagePath n'est pas une image valide.");
        }

        // Skip if already WebP
        if ($imageInfo['mime'] === 'image/webp') {
            return $imagePath; // Return the original path if already WebP
        }

        // Generate WebP path
        $webpImagePath = preg_replace("/\.(jpg|jpeg|png|gif)$/", '.webp', $imagePath);

        if ($webpImagePath === $imagePath) {
            throw new \Exception("Le chemin de l'image de destination est identique à celui de l'original.");
        }

        $webpDir = dirname($webpImagePath);
        if (!file_exists($webpDir)) {
            if (!mkdir($webpDir, 0777, true)) {
                throw new \Exception("Impossible de créer le répertoire pour le fichier WebP: $webpDir");
            }
        }

        if (!file_exists($webpImagePath)) {
            $this->convertToWebp($imagePath, $webpImagePath);
        }

        return $webpImagePath; // Return the path of the optimized WebP image
    }

    private function convertToWebp(string $imagePath, string $webpImagePath) {
        $imageInfo = getimagesize($imagePath);
        if (!$imageInfo) {
            throw new \Exception("Impossible de lire l'image $imagePath");
        }

        switch ($imageInfo['mime']) {
            case 'image/jpeg':
                $image = imagecreatefromjpeg($imagePath);
                break;
            case 'image/png':
                $image = imagecreatefrompng($imagePath);
                break;
            case 'image/gif':
                $image = imagecreatefromgif($imagePath);
                break;
            default:
                throw new \Exception("Type d'image non supporté pour $imagePath");
        }

        if (!$image) {
            throw new \Exception("Erreur lors de la création de l'image à partir de $imagePath");
        }

        if (!imagewebp($image, $webpImagePath, 80)) {
            throw new \Exception("Erreur lors de la conversion en WebP pour $imagePath");
        }

        imagedestroy($image);
    }
}
