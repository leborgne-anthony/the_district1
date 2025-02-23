<?php
namespace App\Controller;

use App\Core\View;
use Exception;

class ContactController
{
    public function index()
    {
        return View::render("contact");
    }

    public function store()
    {
        if (session_status() === PHP_SESSION_NONE) {
            session_start();
        }

        if ($_SERVER["REQUEST_METHOD"] !== "POST") {
            header("Location: /contact");
            exit();
        }

        $nom       = trim(filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS));
        $prenom    = trim(filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS));
        $email     = trim(filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL));
        $telephone = trim(filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS));
        $message   = trim(filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS));

        if (!$nom || !$prenom || !$email || !$telephone || !$message) {
            $_SESSION['error'] = "Tous les champs sont obligatoires et doivent être valides.";
            header("Location: /contact");
            exit();
        }

        try {
            $uploadDir = __DIR__ . "/../../public/uploads/";
            if (!is_dir($uploadDir) && !mkdir($uploadDir, 0775, true) && !is_dir($uploadDir)) {
                throw new Exception("Impossible de créer le dossier d'upload.");
            }

            $timestamp = date("Y-m-d-H-i-s");
            $filePath  = $uploadDir . "$timestamp.txt";

            $content = <<<TXT
            Nom       : $nom
            Prénom    : $prenom
            Email     : $email
            Téléphone : $telephone
            Message   : $message
            Date      : $timestamp
            TXT;

            if (!file_put_contents($filePath, $content, LOCK_EX)) {
                throw new Exception("Erreur lors de l'enregistrement du message.");
            }

            $_SESSION['success'] = "Votre message a bien été envoyé.";
        } catch (Exception $e) {
            $_SESSION['error'] = "Une erreur est survenue : " . $e->getMessage();
        }

        header("Location: /contact");
        exit();
    }
}
