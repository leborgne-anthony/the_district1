<?php
namespace App\Services;

use Exception;

class ContactService
{
    public static function saveMessage(array $data): bool
    {
        $uploadDir = __DIR__ . "/../../public/uploads/";
       

        $nom       = $data['nom'] ?? '';
        $prenom    = $data['prenom'] ?? '';
        $email     = $data['email'] ?? '';
        $telephone = $data['telephone'] ?? '';
        $message   = $data['message'] ?? '';

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

        return file_put_contents($filePath, $content, LOCK_EX) !== false;
    }
}
