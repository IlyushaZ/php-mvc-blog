 <!-- Page Header -->
    <header class="masthead" style="background-image: url('/Public/img/home-bg.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="site-heading">
              <h1>Блог</h1>
              <span class="subheading">Ильи Зябирова</span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Main Content -->
    <div class="container">
      <div class="row">
        <div class="col-lg-8 col-md-10 mx-auto">
            <? if (empty($list)): ?>
                <p>Список постов пуст</p>
            <? else: ?>
                <? foreach ($list as $val): ?>
                  <div class="post-preview" id="post-list">
                    <a href="/post/<?= $val['id']; ?>">
                      <h2 class="post-title">
                        <?=htmlspecialchars($val['name'], ENT_QUOTES); ?>
                      </h2>
                      <h3 class="post-subtitle">
                          <?=htmlspecialchars($val['description'], ENT_QUOTES); ?>
                      </h3>
                    </a>
                    <p class="post-meta">Опубликовано:
                      <a href="/about"><?=htmlspecialchars($val['author'], ENT_QUOTES); ?></a>
                        <?=htmlspecialchars($val['datetime'], ENT_QUOTES); ?></p>
                  </div>
                  <hr>
                <? endforeach; ?>
          <!-- Pager -->
<!--              <div class="clearfix">-->
<!--              </div>-->
            <? endif; ?>
        </div>
      </div>
    </div>
