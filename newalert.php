<?php

include('header.php');

?>
 <article class="content forms-page">
<section class="section">
                        <div class="row sameheight-container">
                            <div class="col-md-6">
                                <div class="card card-block sameheight-item">
                                    <div class="title-block">
                                        <h3 class="title">Send New Alert </h3>
                                    </div>
                                    <form>
                                        <div class="form-group"> <label class="control-label">Date / Time</label> <input type="text" class="form-control boxed"> </div>
                                        <div class="form-group"><label class="control-label">Type of Alert</label> <select class="form-control">
							                <option>Tornado</option>
                                            <option>Blizzard</option>
                                            <option>Flood</option>
                                            <option>Hurricane</option>
                                            <option>Tropical Storm</option>
						                </select> </div>
                                        <div class="form-group"> <label class="control-label">Alert Zone</label>
                                        <div> <label>
                                    <input class="checkbox" type="checkbox">
                                    <span>Zone 1</span>
                                </label> </div>
                                        <div> <label>
                                    <input class="checkbox" type="checkbox">
                                    <span>Zone 2</span>
                                </label> </div>
                                <div> <label>
                                    <input class="checkbox" type="checkbox">
                                    <span>Zone 3</span>
                                </label> </div>
                                <div> <label>
                                    <input class="checkbox" type="checkbox">
                                    <span>Zone 4</span>
                                </label> </div>
                                <div> <label>
                                    <input class="checkbox" type="checkbox">
                                    <span>Zone 5</span>
                                </label> </div>
                                    </div>
                                        <div class="form-group"> <label class="control-label">Input PIN</label> <input type="password" class="form-control boxed"> </div>
                                        <div class="form-group"> <label class="control-label">Alert Comments</label> <textarea rows="3" class="form-control boxed"></textarea> </div>
                                        <div class="form-group"> <button type="submit" class="btn btn-primary">Submit</button> </div>
                                    </form>
                                </div>
                            </div>
</section>
</article>

<?php include('footer.php'); ?>