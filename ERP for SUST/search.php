<!-- search -->
<div style="margin-bottom: 8%;">
    <form method="POST" action="<?php echo $this_file_name; ?>" enctype="multipart/form-data" class="card card-body bg-light">
        <div class="form-inline">
            <input type="text" class="form-control mr-sm-4" placeholder="Search" name="search_box" value="<?php echo $search_term; ?>" style="width: 74%;">

            <select class="form-control mr-sm-4" name="filter">
                <option <?php if($filter == 1) echo 'selected'; ?> value="1">All</option>
                <option <?php if($filter == 2) echo 'selected'; ?> value="2">Department</option>
                <option <?php if($filter == 3) echo 'selected'; ?> value="3">Batch</option>
                <option <?php if($filter == 4) echo 'selected'; ?> value="4">Year/Semester</option>
                <option <?php if($filter == 5) echo 'selected'; ?> value="5">Course</option>
            </select>

            <button class="btn btn-primary" type="submit" name="search">Search</button>
        </div>
    </form>
</div>
<!-- search -->