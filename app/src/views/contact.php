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
                <input type="text" id="nom" name="nom" required>
            </div>

            <div class="form-group">
                <label for="prenom">Prénom</label>
                <input type="text" id="prenom" name="prenom" required>
            </div>
        </div>

        <div class="form-row">
            <div class="form-group">
                <label for="email">Email</label>
                <input type="email" id="email" name="email" required>
            </div>

            <div class="form-group">
                <label for="telephone">Téléphone</label>
                <input type="text" id="telephone" name="telephone" required>
            </div>
        </div>

        <div class="form-group form-group--full">
            <label for="message">Message</label>
            <textarea id="message" name="message" required></textarea>
        </div>

        <button type="submit" class="button button--primary">Envoyer</button>
    </form>
</main>


<?php require_once "partials/footer.php" ?>


