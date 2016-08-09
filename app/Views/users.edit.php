<!DOCTYPE html>
<html>
<head>
	<title></title>
</head>
<body>
<h2>Edição de Usuário</h2>

<form action="/update" method="post">
    <label for="name">Nome: </label>
    <br>
    <input type="text" name="name" id="name" value="<?php echo $user['name']; ?>">

    <br><br>

    <label for="email">Email: </label>
    <br>
    <input type="text" name="email" id="email" value="<?php echo $user['email']; ?>">

    <br><br>

    Gênero:
    <br>
    <input type="radio" name="gender" id="gener_m" value="m" <?php if ($user['gender'] == 'm'): ?> checked="checked" <?php endif; ?>>
    <label for="gener_m">Masculino </label>
    <input type="radio" name="gender" id="gener_f" value="f" <?php if ($user['gender'] == 'f'): ?> checked="checked" <?php endif; ?>>
    <label for="gener_f">Feminino </label>

    <br><br>

    <label for="birthdate">Data de Nascimento: </label>
    <br>
    <input type="text" name="birthdate" id="birthdate" placeholder="dd/mm/YYYY" value="<?php echo dateConvert($user['birthdate']) ?>">

    <br><br>

    <input type="hidden" name="id" value="<?php echo $user['id'] ?>">
    <input type="hidden" name="_METHOD" value="PUT" />

    <input type="submit" value="Cadastrar">
</form>
</body>
</html>