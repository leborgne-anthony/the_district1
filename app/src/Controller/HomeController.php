<?php
namespace App\Controller;

use App\Core\View;
use App\Services\ImageOptimizerService;

class HomeController
{
    public function index()
    {
        $imageOptimizerService = new ImageOptimizerService();

        $images = [
            '/../public/assets/images/categories/pizza_cat.jpg',
            '/../public/assets/images/plats/cheesburger.jpg',
            '/../public/assets/images/plats/Food-Name-3631.jpg',
            '/../public/assets/images/plats/Food-Name-3631.jpg',
            '/../public/assets/images/plats/Food-Name-3631.jpg',
            '/../public/assets/images/plats/Food-Name-3631.jpg',
            '/../public/assets/images/plats/Food-Name-3631.jpg',
        ];

        $optimizedImages = [];

        foreach ($images as $image) {
            try {
                $webpImage = $imageOptimizerService->optimizeImage($image);
                $optimizedImages[] = $webpImage;
            } catch (\Exception $e) {
                throw new \Exception($e->getMessage());
            }
        }

        return View::render("home", [
            'optimizedImages' => $optimizedImages
        ]);
    }
}

