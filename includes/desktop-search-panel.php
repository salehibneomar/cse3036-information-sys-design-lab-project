<div class="search-and-filter-elements desktop-content">
                <form action="" method="get">

                <div class="left-side-content desktop-content">
                
                    <div class="card side-content-card">
                        <div class="card-header bg-light">
                            <span class="text-muted main-section-top-heading"><small>Sort&ensp;<i class="fas fa-sort"></i></small></span>
                        </div>
                        <div class="card-body">
                            <div class="input-group-sm">
                                <select name="" id="" class="form-control" >
                                    <option value="">Date: Newest</option>
                                    <option value="">Date: Oldest</option>
                                    <option value="">Price: Hight</option>
                                    <option value="">Price: Low</option>
                                </select>
                            </div>
                        </div>
                    </div>
                    <div class="card side-content-card">
                        <div class="card-header bg-light">
                            <span class=" text-muted d-block"><small>Filter&ensp;<i class="fas fa-filter"></i></small></span>
                        </div>
                        <div class="card-body">
                            <div class="input-group-sm mb-2">
                                <label class="text-muted"><small>Residential type:</small></label>
                                <select name="" id="" class="form-control">
                                    <option value="">All</option>
                                    <option value="1">Family</option>
                                    <option value="2">Mess</option>
                                    <option value="3">Hostel</option>
                                    <option value="4">Female Hostel</option>
                                    <option value="5">Sublet</option>
                                </select>
                            </div>
                            <div class="input-group-sm mb-2">
                                <label class="text-muted"><small>Type of poster:</small></label>
                                <select name="" id="" class="form-control" >
                                    <option value="">All</option>
                                    <option value="">Verified</option>
                                    <option value="">Unverified</option>
                                </select>
                            </div>
                            <div class="input-group-sm mb-2">
                                <label class="text-muted"><small>Bed count:</small></label>
                                <select name="" id="" class="form-control" >
                                    <option value="">Any</option>
                                    <option value="">1</option>
                                    <option value="">2</option>
                                    <option value="">3</option>
                                    <option value="">4</option>
                                    <option value="">5</option>
                                    <option value="">Above 5</option>
                                </select>
                            </div>
                            <label class="text-muted"><small>Price:</small></label>
                            <div class="input-group input-group-sm" >
                                <input type="number" min="500" max="100000" class="form-control" placeholder="Min">
                                <input type="number" min="1000" max="300000" class="form-control" placeholder="Max">
                                <div class="input-group-prepend">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-hand-pointer"></i></button>
                                </div>
                            </div>
                        </div>
                    </div>
                
                </div>

                <div class="middle-content card">
                    <div class="card-header bg-light">
                        <span class="d-block text-center font-weight-bold main-section-top-header"><small><?=$getAllAds->num_rows;?>, Ads found.</small></span>
                    </div>
                    <div class="card-body pb-2">
                        
                            <div class="input-group">
                                <select name="" id="" class=" col-sm-2 custom-select">
                                    <option value="">City</option>
                                    <option value="1">Dhaka</option>
                                    <option value="2">Barisal</option>
                                    <option value="3">Chittagong</option>
                                    <option value="4">Khulna </option>
                                    <option value="5">Mymensingh </option>
                                    <option value="6">Rajshahi</option>
                                    <option value="7">Sylhet</option>
                                    <option value="8">Rangpur</option>
                                </select>
                                <input type="text" class="form-control " placeholder="Type area...">
                                <div class="input-group-append">
                                    <button type="submit" class="btn btn-info"><i class="fas fa-search"></i></button>
                                </div>
                            </div>
                        
                    </div>
                </div>

                </form>   

                </div>
