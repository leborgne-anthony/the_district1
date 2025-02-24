<?php
namespace App\Controller;

use App\Core\View;
use Exception;
use App\Services\ContactService;
use App\Core\Session;

class ContactController
{
    public function index()
    {
        return View::render("contact", [
            'success' => Session::getInstance()->get('success'),
            'error' => Session::getInstance()->get('error')
        ]);
    }

    public function store()
    {
        $nom       = filter_input(INPUT_POST, "nom", FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $prenom    = filter_input(INPUT_POST, "prenom", FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $email     = filter_input(INPUT_POST, "email", FILTER_VALIDATE_EMAIL) ?? '';
        $telephone = filter_input(INPUT_POST, "telephone", FILTER_SANITIZE_SPECIAL_CHARS) ?? '';
        $message   = filter_input(INPUT_POST, "message", FILTER_SANITIZE_SPECIAL_CHARS) ?? '';

        if (!$nom || !$prenom || !$email || !$telephone || !$message) {
            Session::getInstance()->set('error', "Tous les champs sont obligatoires et doivent être valides.");
            header("Location: /contact");
            exit();
        }

        try {
            ContactService::saveMessage([
                'nom'       => $nom,
                'prenom'    => $prenom,
                'email'     => $email,
                'telephone' => $telephone,
                'message'   => $message
            ]);

            Session::getInstance()->set('success', "Votre message a bien été envoyé.");
        } catch (Exception $e) {
            Session::getInstance()->set('error', "Une erreur est survenue : " . $e->getMessage());
        }

        header("Location: /contact");
        exit();
    }
}
