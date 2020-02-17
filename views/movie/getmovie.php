<div class="row">
    <div class="col-md-12 d-flex justify-content-center" style="text-align: center; padding-top: 1%;">
        <div class="card mb-3" style="max-height: 800px; max-width: 800px;">
            <img class="card-img-top" src="<?php ROOT_URL ?>/assets/movieImages/<?php echo $viewModel['image_name'] ?>" alt="Card image cap">
            <div class="card-body">
                <h5 class="card-title"><?php echo $viewModel['movie_name'] ?></h5>
                <p class="card-text"><b>Genre:</b> <?php echo $viewModel['genre_id']?></p>
                <p class="card-text"><?php echo $viewModel['movie_description']?></p>
            </div>
        </div>
    </div>
</div>