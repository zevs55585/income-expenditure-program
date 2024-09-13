<!DOCTYPE html>
<html>
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Auth</title>
   <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC" crossorigin="anonymous">
    <style>
        img{
            width: 100px;
        }
    </style>

</head>
<body>
    <a href="index.php">Главная страница</a>

<?
if (isset($_GET['error'])){
    echo $_GET['error'];
}
?>
    <!--<img src="image\logo.png"  >-->
    <main class="mt-5 col-12 container">
    
        <div class="justify-content-center p-5 box">
            <form action="login.php">
            <div id="entrance">
                <h2 class="text-center">Форма авторизации</h2>
                <div class="p-5 row justify-content-center">
                    <div class="col-7 mb-4">
                        <label  class="mb-1" for="email">Почта</label>
                        <input id="email" name="email" type="text" class="form-control" placeholder="введите почту" />
                    </div>
                    <div class="col-7 mb-4">
                        <label class="mb-1" for="passwd">Пароль</label>
                        <input id="passwd" name="password" type="password" class="form-control" placeholder="введите пароль" />
                    </div>
                    <div class="col-7">
                        <button id="btn" style="margin-right: 20px;" class="btn btn-primary">Войти</button>
                        <a id="register" style="color: blue; cursor:  pointer;">Регистрация</a>

                    </div>

                </div>

            </div>
            </form>
        
    
            <form action="createuser.php">
            <div id="registration" style="display: none;">
                <h2 class="text-center">форма регистрации</h2>
                <div class="p-5 row justify-content-center">
                    <div class="col-7 mb-4">
                        <label class="mb-1" for="name-register">Имя</label>
                        <input id="name-register" type="name" class="form-control" placeholder="Введите имя" name="name"/>
                    </div>
                    <div class="col-7 mb-4">
                        <label class="mb-1" for="email-register">почта</label>
                        <input id="email-register" type="email" class="form-control" placeholder="Введите почту" name="login"/>
                    </div>
                    <div class="col-7 mb-4">
                        <label class="mb-1" for="passwd-register">Пароль</label>
                        <input id="passwd-register" type="password" class="form-control" placeholder="Введите пароль" name="password"/>
                    </div>
                    <div class="col-7">
                        <button style="margin-right: 20px;" id="btn-register" class="btn  btn-primary">Зарегистрироваться</button>
                        <a id="enter" style="color: blue; cursor: pointer;">Вход</a>
                    </div>
                </div>


         
            </div>

            </form>
        </div>
    </main>
<script>
    document.getElementById('register').addEventListener('click', () => {
        document.getElementById('registration').style.display = 'inline';
        document.getElementById('entrance').style.display = 'none';

        });

    document.getElementById('enter').addEventListener('click', () => {
        document.getElementById('entrance').style.display = 'inline';
        document.getElementById('registration').style.display = 'none';

    });
</script>
</body>
</html>

<style>
    .box {
        box-shadow: 0px 2px 20px rgba(0, 74, 172, 0.3);
        border-radius: 6px;
        border: 1px solid blue;
    }

        .box:hover {
            box-shadow: 0px 2px 20px rgba(0, 74, 172, 0.5);
        }
</style>