<div class="row" style="padding-top: 1%;">

        <div class="col-md-12 d-flex justify-content-center" ">
            <form method="post">
                <div class="form-group">
                    <label for="movieName">Movie Name</label>
                    <input type="text" class="form-control" name="search_name" id="search_name" placeholder="Enter Movie Name">
                </div>
                <div class="form-group">
                    <label for="exampleFormControlSelect1">Movie Genre</label>
                    <select class="form-control" name="search_genre" id="search_genre">
                        <option value="0">Any</option>
                        <?php foreach ($viewModel['allGenres'] as $curGenre) : ?>
                            <option value="<?php echo $curGenre['id'] ?>"><?php echo $curGenre['genre_name'] ?></option>
                        <?php endforeach; ?>
                    </select>
                </div>
                <button class="btn btn-primary" name="submit" type="submit" value="Submit">Submit</button>
            </form>
        </div>

</div>

<div id="main_MovieRow" class="row" style="padding-top: 1%;">

    <?php if(array_key_exists('allMovies', $viewModel)) : ?>
        <?php foreach ($viewModel['allMovies'] as $item) : ?>
        <div class="col-xl-4 col-lg-6 col-md-12 col-sm-12">
            <div class="card mb-3" style="min-height: 550px;">
                <?php if(isset($item['image_name']) && $item['image_name'] != "") : ?>
                    <img class="card-img-top" src="<?php ROOT_URL ?>/assets/movieImages/<?php echo $item['image_name'] ?>" alt="Card image cap">
                <?php else : ?>
                    <img class="card-img-top" src="<?php ROOT_URL ?>/assets/movieImages/default.png" alt="Card image cap">
                <?php endif; ?>
                <div class="card-body">
                    <h5 class="card-title"><?php echo $item['movie_name'] ?></h5>
                    <p class="card-text"><?php echo $item['movie_description']?></p>
                    <button class="btn"><a href="<?php ROOT_URL ?>/movie/getmovie/<?php echo $item['id'] ?>">View</a></button>
                    <?php if($_SESSION['user_data']['admin'] == true) : ?>
                        <button class="btn"><a href="<?php ROOT_URL ?>/movie/editmovie/<?php echo $item['id'] ?>">Edit</a></button>
                    <?php endif; ?>
                </div>
            </div>
        </div>
        <?php endforeach; ?>
    <?php endif; ?>
</div>
