<div class="row">
    <div style="padding-top: 1%;" class="col-md-12">
        <div class="card" style="margin-left: 40%; margin-right: 40%;">
            <h2 style="text-align: center;">Movie Add</h2>
            <div class="card-body">
                <form method="post" enctype="multipart/form-data">
                    <div class="form-group">
                        <label for="movieName">Movie Name</label>
                        <input type="text" class="form-control" name="movieName" id="movieName" placeholder="Enter Movie Name">
                    </div>
                    <div class="form-group">
                        <label for="movieDescription">Description</label>
                        <input type="text" class="form-control" name="movieDescription" id="movieDescription" placeholder="Movie Description">
                    </div>
                    <div class="form-group">
                        <label for="exampleFormControlSelect1">Movie Genre</label>
                        <select class="form-control" name="movieGenre" id="movieGenre">
                            <?php foreach ($viewModel as $genre) : ?>
                                <option><?php echo $genre['genre_name'] ?></option>
                            <?php endforeach; ?>
                        </select>
                    </div>
                    <div class="form-group">
                        <label for="movieImageExample">Image of Movie</label>
                        <input class="form-control-file" type="file" name="fileToUpload" id="fileToUpload">
                    </div>
                    <button type="submit" name="submit" value="Submit" class="btn btn-primary">Submit</button>
                </form>
            </div>
    </div>
</div>
