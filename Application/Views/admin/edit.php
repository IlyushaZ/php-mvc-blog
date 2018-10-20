<div class="content-wrapper">
    <div class="container-fluid">
        <div class="card mb-3">
            <div class="card-header"><?=$title;?></div>
            <div class="card-body">
                <div class="alert alert-danger" role="alert" style="display: none">
                </div>
                <div class="alert alert-success" role="alert" style="display: none">
                </div>
                <div class="row">
                    <div class="col-sm-12">
                        <form action="/admin/edit/<?=$data[0]['id'];?>" method="post" >
                            <div class="form-group">
                                <label>Название</label>
                                <input class="form-control" type="text" value="<?=htmlspecialchars($data[0]['name'], ENT_QUOTES);?>" name="name">
                            </div>
                            <div class="form-group">
                                <label>Описание</label>
                                <input class="form-control" type="text" value="<?=htmlspecialchars($data[0]['description'], ENT_QUOTES);?>" name="description">
                            </div>
                            <div class="form-group">
                                <label>Текст</label>
                                <textarea class="form-control" rows="3" name="text"><?=htmlspecialchars($data[0]['text'], ENT_QUOTES);?></textarea>
                            </div>
                            <div class="form-group">
                                <label>Изображение</label>
                                <input class="form-control" type="file" name="img">
                            </div>
                            <button type="submit" class="btn btn-primary btn-block">Сохранить</button>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>