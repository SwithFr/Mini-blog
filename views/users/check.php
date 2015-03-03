<main class="blog__main">
    <form action="<?= $_SERVER['PHP_SELF']; ?>?a=check&e=user" method="POST">
        <div class=" <?= isset($errors['email'])?'has-error':''; ?>">
            <label for="email">Email</label>
            <input type="email" name="email" id="email" value="<?= isset($email)?$email:''; ?>"/>
        </div>

        <div class=" <?= isset($errors['password'])?'has-error':''; ?>">
            <label for="password">Auteur</label>
            <input type="password" name="password" id="password" required="required" value="<?= isset($password)?$password:''; ?>"/>
        </div>
        <input class="btn-add" type="submit" value="S'identifier"/>
    </form>
</main>