<?php
require_once 'db.php';

$Users = new Users();
$customers = $Users->countCityUsers(2);
$executors = $Users->countCityUsers(1);
?>

<!DOCTYPE html>
<html lang="ru">
  <head>
    <title>Sprava.mobi</title>
    <meta charset="utf-8"/>
    <meta content="Sprava.mobi" name="description"/>
    <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
    <meta name="HandheldFriendly" content="true"/>
    <meta name="format-detection" content="telephone=no"/>
    <meta content="IE=edge" http-equiv="X-UA-Compatible"/>
    <!-- build:css css/main.css-->
    <link rel="stylesheet" href="css/main.css"/>
    <!-- endbuild-->
  </head>
  <body>
    <main class="main-content" id="main-content">

      <section class="section section-step3" id="sign-up">
        <div class="container">
          <div class="row justify-content-between align-items-center">
            <div class="col-12 col-md-12 col-lg-5">
              <div class="section__title">
                <h2>Регистрация</h2>
              </div>
            </div>
            <div class="col-12 col-md-12 col-lg-7">
              <ul class="list-unstyled list-tabs">
                <li class="active"><a href="#doer-tab">Исполнитель</a></li>
                <li><a href="#customer-tab">Заказчик</a></li>
              </ul>
            </div>
          </div>
          <div class="tab-content">
            <div class="tab-pane fade in active" id="doer-tab">
              <form name="form-doer" method="post">
                <div class="row justify-content-between">
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label class="form-label" for="doer-email">Email</label>
                      <input class="form-control" type="email" id="doer-email" name="doer-email" placeholder="Введите email" required>
                      <div class="form-validator"> Неккоректно введён e-mail</div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label class="form-label" for="doer-tel">Телефон</label>
                      <input class="form-control" type="tel" id="doer-tel" name="doer-tel" placeholder="Введите телефон" required>
                      <div class="form-validator"></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label class="form-label" for="doer-town">Город</label>
                      <select class="form-control" type="text" id="doer-town" name="doer-town" placeholder="Введите город" required></select>
                    
                      <div class="form-validator"></div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="doer-heading">Рубрика</label>
                      <select class="form-select select2" id="doer-heading" name="doer-heading[]" multiple required>
                   
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-12 col-sm-6">
                    <button class="btn d-block register" type="submit">Зарегистрироваться</button>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($executors[21]) && !empty($executors[21])){echo $executors[21];}else{echo 0;}?></div>
                    <div class="descr">Исполнителей из <span class="country">Беларуси</span></div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($executors[0]) && !empty($executors[0])){echo $executors[0];}else{echo 0;}?></div>
                    <div class="descr">Исполнителей из <span class="country">России</span></div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($executors[1]) && !empty($executors[1])){echo $executors[1];}else{echo 0;}?></div>
                    <div class="descr">Исполнителей из <span class="country">Украины</span></div>
                  </div>
                </div>
                <div class="col-12 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($executors[81]) && !empty($executors[81])){echo $executors[81];}else{echo 0;}?></div>
                    <div class="descr">Исполнителей из <span class="country">Казахстана</span></div>
                  </div>
                </div>
              </div>
            </div>
            <div class="tab-pane fade" id="customer-tab">
              <form name="form-customer" method="post">
                <div class="row justify-content-between">
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label class="form-label" for="customer-email">Email</label>
                      <input class="form-control" type="email" id="customer-email" name="customer-email" placeholder="Введите email" required>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label class="form-label" for="customer-tel">Телефон</label>
                      <input class="form-control" type="tel" id="customer-tel" name="customer-tel" placeholder="Введите телефон" required>
                      <div class="form-validator"></div>
                    </div>
                  </div>
                  <div class="col-12 col-md-4">
                    <div class="form-group">
                      <label class="form-label" for="doer-town">Город</label>
                      <select class="form-control" type="text" id="customer-town" name="customer-town" placeholder="Введите город" required></select>
                      <div class="form-validator"></div>
                    </div>
                  </div>
                  <div class="col-12">
                    <div class="form-group">
                      <label class="form-label" for="customer-heading">Рубрика</label>
                      <select class="form-select select2" id="customer-heading" name="customer-heading[]" multiple required>
                   
                      </select>
                    </div>
                  </div>
                </div>
                <div class="row justify-content-center">
                  <div class="col-12 col-sm-6">
                    <button class="btn d-block register" type="submit">Зарегистрироваться</button>
                  </div>
                </div>
              </form>
              <div class="row">
                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($customers[21]) && !empty($customers[21])){echo $customers[21];}else{echo 0;}?></div>
                    <div class="descr">Заказчиков из <span class="country">Беларуси</span></div>
                  </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($customers[0]) && !empty($customers[0])){echo $customers[0];}else{echo 0;}?></div>
                    <div class="descr">Заказчиков из <span class="country">России</span></div>
                  </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($customers[1]) && !empty($customers[1])){echo $customers[1];}else{echo 0;}?></div>
                    <div class="descr">Заказчиков из <span class="country">Украины</span></div>
                  </div>
                </div>
                <div class="col-6 col-sm-6 col-md-6 col-lg-3">
                  <div class="country-block">
                    <div class="count"><?php if(isset($customers[81]) && !empty($customers[81])){echo $customers[81];}else{echo 0;}?></div>
                    <div class="descr">Заказчиков из <span class="country">Казахстана</span></div>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
        <div class="modal fade" id="modal-message" tabindex="-1" role="dialog" aria-label="Сообщение" aria-hidden="true">
          <div class="modal-dialog modal-sm modal-dialog-centered">
            <div class="modal-content">
              <div class="modal-body">
                <p>Регистрация прошла успешно!</p>
              </div>
              <div class="modal-footer">
                <button class="btn" data-dismiss="modal">Закрыть</button>
              </div>
            </div>
          </div>
        </div>
      </section>

    </main>
    <script src="js/jquery-3.3.1.min.js"></script>
    <script src="js/core-dist.js"></script>
    <script src="js/main.js"></script>
  </body>
</html>