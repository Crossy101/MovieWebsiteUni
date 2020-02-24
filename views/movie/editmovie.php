<div class="row">
    <div style="padding-top: 1%;" class="col-md-12">
        <div class="card" style="margin-left: 40%; margin-right: 40%;">
            <h2 style="text-align: center;">Edit Movie</h2>
            <div class="card-body">
                <form method="post">
                    <input type="hidden" class="form-control" name="movieID" id="movieID" value="<?php echo $viewModel['id'] ?>" required>
                    <div class="form-group">
                        <label for="movieName">Movie Name</label>
                        <input type="text" class="form-control" name="movieName" id="movieName" placeholder="<?php echo $viewModel['movie_name'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="movieDescription">Description</label>
                        <input type="text" class="form-control" name="movieDescription" id="movieDescription" placeholder="<?php echo $viewModel['movie_description'] ?>" required>
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Movie Genre</label>
                        <select class="form-control" name="movieGenre" id="movieGenre" required>
                            <?php foreach ($viewModel['movieGenres'] as $genre) : ?>
                                <option><?php echo $genre['genre_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
        </div>
    </div>