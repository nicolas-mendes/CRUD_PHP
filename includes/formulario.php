<main>
    <section>
        <h1 class="text-center mt-3">Formulário</h1>
        <a href="index.php">
            <button class="btn btn-success">Voltar</button>
        </a>
    </section>
    <h2 class="mt-5"><?= TITLE ?></h2>
    <form method="POST">
        <div class="mb-3 mt-4 form-group">
            <label for="nome" class="form-label">Nome</label>
            <input required type="text" name="nome" id="nome" class="form-control" value="<?= $obUsuario->nome ?>">
        </div>
        <div class="mb-3 form-group">
            <label for="email" class="form-label">E-Mail</label>
            <input required type="email" name="email" id="email" class="form-control" value="<?= $obUsuario->email ?>">
            <label for="senha" class="form-label">Senha</label>
            <input type="password" name="senha" id="senha" class="form-control" <?= !isset($obUsuario->id) ? 'required' : '' ?>>
            <?= isset($obUsuario->id) ? 
            '<div id="passwordHelpBlock" class="form-text text-light">
                    Digite uma nova senha apenas se deseja alterá-la. Deixe em branco para manter a atual.
            </div>' : 
            '<div id="passwordHelpBlock" class="form-text text-light">
                    Sua senha deve ser segura.
            </div>' ?>
        </div>
        <div class="mb-4 form-group">
            <label for="nasc" class="form-label">Data de Nascimento</label>
            <input required type="date" name="nasc" id="nasc" class="form-control" value="<?= $obUsuario->nasc ?>" max="<?= date('Y-m-d') ?>">
        </div>
        <div class="mb-3 form-group">
            <button type="submit" class="btn btn-primary">Cadastrar</button>
        </div>
    </form>
</main>