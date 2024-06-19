
                            <!-- Tab panes -->
                            <div class="tab-content">
                              <!-- 1ST TAB -->
                                <div class="tab-pane fade in mt-2" id="XSmall">
                                  <div class="row">
                                      <?php  $query = 'SELECT PRODUCT_CODE, NAME, PRICE, PRODUCT_ID, count(QTY_STOCK) as QTY, Fimage, Bimage, p.CATEGORY_ID, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE p.CATEGORY_ID=1 AND p.stats="Active" GROUP BY PRODUCT_CODE';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($product = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-12" style="top:20px;">
                                    <form method="post" action="pos.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                                          <div class="products">
                                              <img src="image/<?php echo $product['Fimage']; ?>" height="200px" width="200px"/>
                                              <hr>
                                              <h6 class="text-info"><?php echo $product['NAME']; ?></h6>
                                              <h6>₱ <?php echo $product['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="code" value="<?php echo $product['PRODUCT_CODE']; ?>" />
                                              <input type="hidden" name="cat" value="<?php echo $product['CATEGORY_ID']; ?>" />
                                              <input type="hidden" name="name" value="<?php echo $product['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $product['PRICE']; ?>" />
                                              <input type="hidden" name="size" value="<?php echo $product['CNAME']; ?>" />
                                              <input type="hidden" name="stock" value="<?php echo $product['QTY']; ?>" />
                                              <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add"><span> STOCKS : <?php echo $product['QTY']; ?>
                                          </div>
                                      </form>
                                  </div>
                                  <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                              <!-- 2ND TAB -->
                                <div class="tab-pane fade in mt-2" id="Small">
                                  <div class="row">
                                      <?php  $query = 'SELECT PRODUCT_CODE, NAME, PRICE, PRODUCT_ID, count(QTY_STOCK) as QTY, Fimage, Bimage, p.CATEGORY_ID, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE p.CATEGORY_ID=2 AND p.stats="Active" GROUP BY PRODUCT_CODE';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($product = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-12" style="top:20px;">
                                    <form method="post" action="pos.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                                          <div class="products">
                                              <img src="image/<?php echo $product['Fimage']; ?>" height="200px" width="200px"/>
                                              <hr>
                                              <h6 class="text-info"><?php echo $product['NAME']; ?></h6>
                                              <h6>₱ <?php echo $product['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="code" value="<?php echo $product['PRODUCT_CODE']; ?>" />
                                              <input type="hidden" name="cat" value="<?php echo $product['CATEGORY_ID']; ?>" />
                                              <input type="hidden" name="name" value="<?php echo $product['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $product['PRICE']; ?>" />
                                              <input type="hidden" name="size" value="<?php echo $product['CNAME']; ?>" />
                                              <input type="hidden" name="stock" value="<?php echo $product['QTY']; ?>" />
                                              <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" /><span> STOCKS : <?php echo $product['QTY']; ?>
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                              <!-- 3rd TAB -->
                                <div class="tab-pane fade in mt-2" id="Medium">
                                  <div class="row">
                                      <?php  $query = 'SELECT PRODUCT_CODE, NAME, PRICE, PRODUCT_ID, count(QTY_STOCK) as QTY, Fimage, Bimage, p.CATEGORY_ID, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE p.CATEGORY_ID=3 AND p.stats="Active" GROUP BY PRODUCT_CODE';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($product = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-12" style="top:20px;">
                                    <form method="post" action="pos.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                                          <div class="products">
                                              <img src="image/<?php echo $product['Fimage']; ?>" height="200px" width="200px"/>
                                              <hr>
                                              <h6 class="text-info"><?php echo $product['NAME']; ?></h6>
                                              <h6>₱ <?php echo $product['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="code" value="<?php echo $product['PRODUCT_CODE']; ?>" />
                                              <input type="hidden" name="cat" value="<?php echo $product['CATEGORY_ID']; ?>" />
                                              <input type="hidden" name="name" value="<?php echo $product['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $product['PRICE']; ?>" />
                                              <input type="hidden" name="size" value="<?php echo $product['CNAME']; ?>" />
                                              <input type="hidden" name="stock" value="<?php echo $product['QTY']; ?>" />
                                              <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" /><span> STOCKS : <?php echo $product['QTY']; ?>
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                              <!-- 4th TAB -->
                                <div class="tab-pane fade in mt-2" id="Large">
                                  <div class="row">
                                      <?php  $query = 'SELECT PRODUCT_CODE, NAME, PRICE, PRODUCT_ID, count(QTY_STOCK) as QTY, Fimage, Bimage, p.CATEGORY_ID, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE p.CATEGORY_ID=4 AND p.stats="Active" GROUP BY PRODUCT_CODE';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($product = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-12" style="top:20px;">
                                    <form method="post" action="pos.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                                          <div class="products">
                                              <img src="image/<?php echo $product['Fimage']; ?>" height="200px" width="200px"/>
                                              <hr>
                                              <h6 class="text-info"><?php echo $product['NAME']; ?></h6>
                                              <h6>₱ <?php echo $product['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="code" value="<?php echo $product['PRODUCT_CODE']; ?>" />
                                              <input type="hidden" name="cat" value="<?php echo $product['CATEGORY_ID']; ?>" />
                                              <input type="hidden" name="name" value="<?php echo $product['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $product['PRICE']; ?>" />
                                              <input type="hidden" name="size" value="<?php echo $product['CNAME']; ?>" />
                                              <input type="hidden" name="stock" value="<?php echo $product['QTY']; ?>" />
                                              <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" /><span> STOCKS : <?php echo $product['QTY']; ?>
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                              <!-- 5th TAB -->
                                <div class="tab-pane fade in mt-2" id="XLarge">
                                  <div class="row">
                                      <?php  $query = 'SELECT PRODUCT_CODE, NAME, PRICE, PRODUCT_ID, count(QTY_STOCK) as QTY, Fimage, Bimage, p.CATEGORY_ID, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE p.CATEGORY_ID=5 AND p.stats="Active" GROUP BY PRODUCT_CODE';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($product = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-12" style="top:20px;">
                                    <form method="post" action="pos.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                                          <div class="products">
                                              <img src="image/<?php echo $product['Fimage']; ?>" height="200px" width="200px"/>
                                              <hr>
                                              <h6 class="text-info"><?php echo $product['NAME']; ?></h6>
                                              <h6>₱ <?php echo $product['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="code" value="<?php echo $product['PRODUCT_CODE']; ?>" />
                                              <input type="hidden" name="cat" value="<?php echo $product['CATEGORY_ID']; ?>" />
                                              <input type="hidden" name="name" value="<?php echo $product['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $product['PRICE']; ?>" />
                                              <input type="hidden" name="size" value="<?php echo $product['CNAME']; ?>" />
                                              <input type="hidden" name="stock" value="<?php echo $product['QTY']; ?>" />
                                              <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" /><span> STOCKS : <?php echo $product['QTY']; ?>
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                              <!-- 6th TAB -->
                                <div class="tab-pane fade in mt-2" id="XXLarge">
                                  <div class="row">
                                      <?php  $query = 'SELECT PRODUCT_CODE, NAME, PRICE, PRODUCT_ID, count(QTY_STOCK) as QTY, Fimage, Bimage,  p.CATEGORY_ID, c.CNAME FROM product p join category c on p.CATEGORY_ID=c.CATEGORY_ID WHERE p.CATEGORY_ID=6 AND p.stats="Active" GROUP BY PRODUCT_CODE';
                                        $result = mysqli_query($db, $query);

                                        if ($result):
                                            if(mysqli_num_rows($result)>0):
                                                while($product = mysqli_fetch_assoc($result)):
                                                //print_r($product);
                                      ?>
                                    <div class="col-sm-4 col-md-12" style="top:20px;">
                                    <form method="post" action="pos.php?action=add&id=<?php echo $product['PRODUCT_ID']; ?>">
                                          <div class="products">
                                              <img src="image/<?php echo $product['Fimage']; ?>" height="200px" width="200px"/>
                                              <hr>
                                              <h6 class="text-info"><?php echo $product['NAME']; ?></h6>
                                              <h6>₱ <?php echo $product['PRICE']; ?></h6>
                                              <input type="text" name="quantity" class="form-control" value="1" />
                                              <input type="hidden" name="code" value="<?php echo $product['PRODUCT_CODE']; ?>" />
                                              <input type="hidden" name="cat" value="<?php echo $product['CATEGORY_ID']; ?>" />
                                              <input type="hidden" name="name" value="<?php echo $product['NAME']; ?>" />
                                              <input type="hidden" name="price" value="<?php echo $product['PRICE']; ?>" />
                                              <input type="hidden" name="size" value="<?php echo $product['CNAME']; ?>" />
                                              <input type="hidden" name="stock" value="<?php echo $product['QTY']; ?>" />
                                              <input type="submit" name="addpos" style="margin-top:5px;" class="btn btn-info"
                                                     value="Add" /><span> STOCKS : <?php echo $product['QTY']; ?>
                                          </div>
                                      </form>
                                  </div>
                                      <?php endwhile;
                                        endif;
                                    endif;   
                                    ?>
                                    </div>
                                </div>
                              </div>
                            </div>
                        </div>
                        <!-- /.panel-body -->
                      </div>
                    </div>
                  </div>