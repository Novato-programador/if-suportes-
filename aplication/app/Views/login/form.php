<!DOCTYPE html>
<html lang="pt-br">

<head>
    <meta charset="UTF-8">
    <title>Cadastro de Setor</title>
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <style>
        :root {
            --verde-ifpa: #2e7d32;
            --verde-hover: #256428;
            --fundo-claro: #f9f9f9;
            --branco: #ffffff;
        }

        * {
            box-sizing: border-box;
            margin: 0;
            padding: 0;
            font-family: Arial, sans-serif;
        }

        body {
            background-color: var(--fundo-claro);
            display: flex;
            justify-content: center;
            align-items: center;
            padding: 40px 20px;
            min-height: 100vh;
        }

        .form-container {
            background-color: var(--branco);
            padding: 40px;
            border-radius: 12px;
            border: 2px solid var(--verde-ifpa);
            box-shadow: 0 6px 20px rgba(0, 0, 0, 0.1);
            width: 100%;
            max-width: 500px;
        }

        h2 {
            text-align: center;
            color: var(--verde-ifpa);
            margin-bottom: 30px;
        }

        label {
            display: block;
            margin-bottom: 6px;
            font-weight: bold;
            color: #333;
        }

        input[type="tel"] {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        input[type="text"],
        input[type="email"],
        input[type="fone"],
        select {
            width: 100%;
            padding: 12px;
            border: 1px solid #ccc;
            border-radius: 8px;
            margin-bottom: 20px;
            font-size: 15px;
        }

        button {
            width: 100%;
            background-color: var(--verde-ifpa);
            color: white;
            padding: 14px;
            border: none;
            border-radius: 8px;
            font-size: 16px;
            font-weight: bold;
            cursor: pointer;
            transition: background-color 0.3s;
        }

        button:hover {
            background-color: var(--verde-hover);
        }

        #sucesso-mensagem {
            position: fixed;
            top: 0;
            left: 0;
            width: 100%;
            height: 100%;
            background: rgba(0, 128, 0, 0.7);
            z-index: 9999;
            display: none;
            align-items: center;
            justify-content: center;
        }

        .sucesso-box {
            text-align: center;
            color: white;
            font-size: 20px;
            animation: fadeIn 0.5s ease-in-out;
        }

        .checkmark-circle {
            width: 80px;
            height: 80px;
            border-radius: 50%;
            display: inline-block;
            stroke-width: 2;
            stroke: white;
            stroke-miterlimit: 10;
            box-shadow: inset 0px 0px 0px white;
            animation: fill .4s ease-in-out .4s forwards, scale .3s ease-in-out .9s both;
            position: relative;
            margin: 0 auto 20px;
        }

        .checkmark {
            width: 30px;
            height: 60px;
            border-right: 5px solid white;
            border-bottom: 5px solid white;
            transform: rotate(45deg);
            position: absolute;
            top: 12px;
            left: 22px;
            animation: draw 0.5s ease-out 0.5s forwards;
            opacity: 0;
        }

        @keyframes draw {
            100% {
                opacity: 1;
            }
        }

        @keyframes fill {
            100% {
                box-shadow: inset 0px 0px 0px 30px white;
            }
        }

        @keyframes scale {

            0%,
            100% {
                transform: none;
            }

            50% {
                transform: scale(1.1);
            }
        }

        @keyframes fadeIn {
            from {
                opacity: 0;
            }

            to {
                opacity: 1;
            }
        }
    </style>
</head>

<body>

    <div class="form-container">
        <h2>Cadastro de Setor</h2>
        <?php echo form_open("login/store", ["method" => "POST"]); ?>

        <label for="nome">Nome:</label>
        <input type="text" name="nome" id="nome" required>

        <?php $optionSetor = [
            "" => "Selecione",
            "TI" => "TI",
            "Secretaria" => "Secretaria",
            "Estágio" => "Estágio",
            "Direção" => "Direção",
        ];

        ?>
        <label for="setor">Setor</label>
        <?php echo form_dropdown("setor", $optionSetor, "" ??  set_value("setor"), ["id" => "setor", "name" => "setor", "required"]);
        ?>

        <label for="responsavel">Responsável pelo Setor:</label>
        <input type="text" name="responsavel" id="responsavel" required>

        <label for="email">E-mail:</label>
        <input type="email" name="email" id="email" required>

        <label for="fone">Telefone (Whatsapp):</label>
        <input type="tel" name="fone" id="fone" required>

        <label for="siape">SIAPE:</label>
        <input type="text" name="siape" id="siape" maxlength="10" pattern="\d{10}" required placeholder="Ex: 1234567890">

        <button type="submit" id="btnSalvar">Solicitar Registro</button>
        <a href="<?= base_url('login') ?>">Já tem conta? Faça login</a>

        <?php echo form_close(); ?>
    </div>
    <?php if (session()->getFlashdata('success')): ?>
        <script>
            window.addEventListener('DOMContentLoaded', function() {
                document.getElementById('sucesso-mensagem').style.display = 'flex';

                setTimeout(() => {
                    // Redireciona para a tela de login após a animação
                    window.location.href = "<?= base_url('login') ?>";
                }, 3000); // 3 segundos para ver a animação
            });
        </script>
    <?php endif; ?>



    <!-- Animação de Sucesso -->
    <div id="sucesso-mensagem">
        <div class="sucesso-box">
            <div class="checkmark-circle">
                <div class="checkmark draw"></div>
            </div>
            <p>Solicitação enviada com sucesso!</p>
        </div>
    </div>

    <!-- Script para exibir animação -->
    <script>
        document.getElementById('btnSalvar').addEventListener('click', function(e) {
            e.preventDefault(); // Impede o envio imediato
            document.getElementById('sucesso-mensagem').style.display = 'flex';

            // Aguarda 2 segundos para a animação aparecer antes de enviar
            setTimeout(() => {
                document.querySelector('form').submit();
            }, 2000);
        });
    </script>

</body>

</html>