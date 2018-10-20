 <!-- Page Header -->
    <header class="masthead" style="background-image: url('/Public/img/contact-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="page-heading">
              <h1>Обратная связь</h1>
              <span class="subheading">Есть вопросы? У меня есть ответы.</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <p>Хотите задать вопрос или высказать пожелание? Заполните форму, и я постараюсь как можно скорее ответить Вам.</p>
            <div class="alert alert-danger" role="alert" style="display: none">
            </div>
            <div class="alert alert-success" role="alert" style="display: none">
            </div>
          <form name="sentMessage" id="contactForm" method="post" action="/contact" novalidate>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Name</label>
                <input type="text"  class="form-control" name="name" placeholder="Имя" id="name" required data-validation-required-message="Пожалуйста, введите ваше имя">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Email Address</label>
                <input type="email" class="form-control" name="email" placeholder="Почтовый адрес" id="email" required data-validation-required-message="Пожалуйста, введите ваш email">
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <div class="control-group">
              <div class="form-group floating-label-form-group controls">
                <label>Message</label>
                <textarea rows="5" class="form-control" name="message" placeholder="Ваше сообщение" id="message" required data-validation-required-message="Пожалуйста, введите сообщение"></textarea>
                <p class="help-block text-danger"></p>
              </div>
            </div>
            <br>
            <div id="success"></div>
            <div class="form-group">
              <button type="submit" class="btn btn-primary" id="sendMessageButton">Отправить</button>
            </div>
          </form>
        </div>
      </div>
    </div>
