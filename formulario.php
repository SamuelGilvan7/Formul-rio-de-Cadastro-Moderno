<?php
$erros = array();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    
    $nome  = trim(filter_input(INPUT_POST, 'nome', FILTER_SANITIZE_FULL_SPECIAL_CHARS));
    $email = filter_input(INPUT_POST, 'email', FILTER_SANITIZE_EMAIL);
    $idade = filter_input(INPUT_POST, 'idade', FILTER_SANITIZE_NUMBER_INT);

    if (empty($nome)) {
        $erros[] = "O nome é obrigatório.";
    } elseif (strlen($nome) < 3) {
        $erros[] = "O nome deve ter pelo menos 3 caracteres.";
    }

    if (empty($email)) {
        $erros[] = "O email é obrigatório.";
    } elseif (!filter_var($email, FILTER_VALIDATE_EMAIL)) {
        $erros[] = "Por favor, insira um email válido.";
    }

    if (empty($idade)) {
        $erros[] = "A idade é obrigatória.";
    } elseif (!filter_var($idade, FILTER_VALIDATE_INT) || $idade < 1 || $idade > 120) {
        $erros[] = "A idade deve ser um número entre 1 e 120.";
    }

    
    if (empty($erros)) {
        $sucesso = "Cadastro realizado com sucesso!";
    }
}

?>
<!DOCTYPE html>
<html lang="pt-BR">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>Formulário</title>
  <style>
    @import url('https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600&display=swap');

    body {
      font-family: 'Inter', sans-serif;
      background: linear-gradient(135deg, #667eea 0%, #764ba2 100%);
      min-height: 100vh;
      display: flex;
      align-items: center;
      justify-content: center;
      margin: 0;
      padding: 20px;
    }

    .form-container {
      background: white;
      padding: 40px 35px;
      border-radius: 20px;
      box-shadow: 0 20px 40px rgba(0, 0, 0, 0.15);
      width: 100%;
      max-width: 420px;
    }

    h1 {
      text-align: center;
      color: #333;
      margin-bottom: 30px;
      font-weight: 600;
    }

    .form-group {
      margin-bottom: 22px;
    }

    label {
      display: block;
      margin-bottom: 8px;
      color: #555;
      font-weight: 500;
      font-size: 14px;
    }

    input {
      width: 100%;
      padding: 14px 16px;
      border: 2px solid #e1e1e1;
      border-radius: 12px;
      font-size: 16px;
      transition: all 0.3s ease;
      box-sizing: border-box;
    }

    input:focus {
      outline: none;
      border-color: #667eea;
      box-shadow: 0 0 0 3px rgba(102, 126, 234, 0.15);
    }

    button {
      width: 100%;
      padding: 15px;
      background: linear-gradient(135deg, #667eea, #764ba2);
      color: white;
      border: none;
      border-radius: 12px;
      font-size: 16px;
      font-weight: 600;
      cursor: pointer;
      margin-top: 10px;
      transition: transform 0.2s ease;
    }

    button:hover {
      transform: translateY(-2px);
      box-shadow: 0 10px 20px rgba(102, 126, 234, 0.3);
    }

    .input-icon {
      position: relative;
    }

    .input-icon input {
      padding-left: 45px;
    }
  </style>
</head>
<body>
  <div class="form-container">
    <h1>Preencha seus dados</h1>
    <?php if ($_SERVER['REQUEST_METHOD'] == "POST" && !empty($erros)): ?>
        <div style="background-color: #f8d7da; color: #721c24; padding: 10px; border: 1px solid #f5c6cb; border-radius: 5px;">
            <strong>Atenção:</strong>
            <ul>
                <?php foreach ($erros as $erro): ?>
                    <li><?php echo $erro; ?></li>
                <?php endforeach; ?>
            </ul>
        </div>
    <?php elseif ($_SERVER['REQUEST_METHOD'] == "POST" && empty($erros)): ?>
        <div style="background-color: #d4edda; color: #155724; padding: 10px; border: 1px solid #c3e6cb; border-radius: 5px;">
            Cadastro realizado com sucesso!
        </div>
    <?php endif; ?>
    
    <form action="<?php $_SERVER['PHP_SELF'];?>" method="POST">
      <div class="form-group">
        <label for="nome">Nome completo</label>
        <div class="input-icon">
          <input type="text" id="nome" name="nome" placeholder="Digite seu nome" required>
        </div>
      </div>

      <div class="form-group">
        <label for="email">Email</label>
        <div class="input-icon">
          <input type="email" id="email" name="email" placeholder="seu@email.com" required>
        </div>
      </div>

      <div class="form-group">
        <label for="idade">Idade</label>
        <div class="input-icon">
          <input type="number" id="idade" name ="idade" placeholder="Sua idade" min="1" max="120" required>
        </div>
      </div>

      <button type="submit">Enviar</button>
    </form>
  </div>
</body>
</html>