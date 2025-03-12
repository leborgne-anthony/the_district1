<?php 
    use App\Core\Session;
    $session = Session::getInstance();
?>
<?php require_once "partials/header.php" ?>
    
    <!-- Header -->
    <header class="header"></header>

    <?php if ($session->has('success')): ?>
        <div class="alert alert-success">
            <?= htmlspecialchars($session->get('success')) ?>
        </div>
        <?php $session->remove('success'); ?>
    <?php endif; ?>

    <?php if ($session->has('error')): ?>
        <div class="alert alert-danger">
            <?= htmlspecialchars($session->get('error')) ?>
        </div>
        <?php $session->remove('error'); ?>
    <?php endif; ?>

    <!-- Main -->
    <main class="main">
    <form action="/contact-submit" method="POST" class="contact-form">
        <div class="form-row">
            <div class="form-group">
                <label for="nom">Nom</label>
                <input type="text" id="nom" name="nom" >
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" >
                <span class="error-message"></span>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" >
                <span class="error-message"></span>
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" >
                <span class="error-message"></span>
            </div>
        </div>

        <div class="form-group form-group--full">
            <label for="message">Message</label>
            <textarea id="message" name="message" ></textarea>
            <span class="error-message"></span>
        </div>

        <button type="submit" class="button button--primary">Envoyer</button>
    </form>
</main>

<script src="js/formValidator.js"></script>
<?php require_once "partials/footer.php" ?>


