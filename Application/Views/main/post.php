 <!-- Page Header -->
    <header class="masthead" style="background-image: url('/Public/materials/<?=$data[0]['id'];?>.jpg')">
      <div class="overlay"></div>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
            <div class="post-heading">
              <h1><?=$data[0]['name'];?></h1>
              <h2 class="subheading"><?=$data[0]['description'];?></h2>
              <span class="meta">Posted by
                <a href="#"><?=$data[0]['author'];?></a>
                  <?=$data[0]['datetime'];?></span>
            </div>
          </div>
        </div>
      </div>
    </header>

    <!-- Post Content -->
    <article>
      <div class="container">
        <div class="row">
          <div class="col-lg-8 col-md-10 mx-auto">
              <p><?=$data[0]['text'];?></p>
          </div>
        </div>
      </div>
    </article>
