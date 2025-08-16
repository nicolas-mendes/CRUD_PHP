<main>

    <h2 class="mt-5">Excluir Usuário</h2>

    <form method="POST">
        <div class="mb-3 mt-4 form-group">
            <p>Você tem certeza que deseja excluir o Usuário: <strong><?= $obUsuario->nome ?></strong> ?</p>
        </div>


        <div class="mb-3 form-group">
            <button type="button" class="btn btn-success" onclick="location.href='index.php'">Cancelar</button>
            

            <button type="submit" name="excluir" class="btn btn-danger ms-2">Excluir</button>
        </div>

    </form>
</main>