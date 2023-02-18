<!-- edit categories brand -->
<div class="modal fade" id="editProductModal" tabindex="-1" role="dialog">
    <div class="modal-dialog">
      <div class="modal-content">
                  
            <div class="modal-header">
              <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
              <h4 class="modal-title"><i class="fa fa-edit"></i> Edit Product</h4>
            </div>
            <div class="modal-body" style="max-height:450px; overflow:auto;">
  
                <div class="div-loading">
                    <i class="fa fa-spinner fa-pulse fa-3x fa-fw"></i>
                          <span class="sr-only">Loading...</span>
                </div>
  
                <div class="div-result">
  
                    <!-- Nav tabs -->
                    <ul class="nav nav-tabs" role="tablist">
                      <li role="presentation" class="active"><a href="#photo" aria-controls="home" role="tab" data-toggle="tab">Photo</a></li>
                      <li role="presentation"><a href="#productInfo" aria-controls="profile" role="tab" data-toggle="tab">Product Info</a></li>    
                    </ul>
  
                    <!-- Tab panes -->
                    <div class="tab-content">
  
                        
                      <div role="tabpanel" class="tab-pane active" id="photo">
                          <form action="php_action/editProductImage.php" method="POST" id="updateProductImageForm" class="form-horizontal" enctype="multipart/form-data">
  
                          <br />
                          <div id="edit-productPhoto-messages"></div>
  
                          <div class="form-group">
                          <label for="editProductImage" class="col-sm-3 control-label">Product Image: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">							    				   
                                <img src="" id="getProductImage" class="thumbnail" style="width:250px; height:250px;" />
                              </div>
                      </div> <!-- /form-group-->	     	           	       
                          
                        <div class="form-group">
                          <label for="editProductImage" class="col-sm-3 control-label">Select Photo: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                  <!-- the avatar markup -->
                                      <div id="kv-avatar-errors-1" class="center-block" style="display:none;"></div>							
                                  <div class="kv-avatar center-block">					        
                                      <input type="file" class="form-control" id="editProductImage" placeholder="Product Name" name="editProductImage" class="file-loading" style="width:auto;"/>
                                  </div>
                                
                              </div>
                      </div> <!-- /form-group-->	     	           	       
  
                      <div class="modal-footer editProductPhotoFooter">
                          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                          
                          <!-- <button type="submit" class="btn btn-success" id="editProductImageBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button> -->
                        </div>
                        <!-- /modal-footer -->
                        </form>
                        <!-- /form -->
                      </div>
                      <!-- product image -->
                      <div role="tabpanel" class="tab-pane" id="productInfo">
                          <form class="form-horizontal" id="editProductForm" action="php_action/editProduct.php" method="POST">				    
                          <br />
  
                          <div id="edit-product-messages"></div>
  
                          <div class="form-group">
                          <label for="editProductName" class="col-sm-3 control-label">Product Name: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="editProductName" placeholder="Product Name" name="editProductName" autocomplete="off">
                              </div>
                      </div> <!-- /form-group-->	    
  
                      <div class="form-group">
                          <label for="editQuantity" class="col-sm-3 control-label">Quantity: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="editQuantity" placeholder="Quantity" name="editQuantity" autocomplete="off">
                              </div>
                      </div> <!-- /form-group-->	        	 
  
                      <div class="form-group">
                          <label for="editRate" class="col-sm-3 control-label">Rate: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <input type="text" class="form-control" id="editRate" placeholder="Rate" name="editRate" autocomplete="off">
                              </div>
                      </div> <!-- /form-group-->	     	        
  
                      <div class="form-group">
                          <label for="editBrandName" class="col-sm-3 control-label">Brand Name: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <select class="form-control" id="editBrandName" name="editBrandName">
                                    <option value="">~~SELECT~~</option>
                                    <?php 
                                    $sql = "SELECT brand_id, brand_name, brand_active, brand_status FROM brands WHERE brand_status = 1 AND brand_active = 1";
                                          $result = $connect->query($sql);
  
                                          while($row = $result->fetch_array()) {
                                              echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                          } // while
                                          
                                    ?>
                                </select>
                              </div>
                      </div> <!-- /form-group-->	
  
                      <div class="form-group">
                          <label for="editCategoryName" class="col-sm-3 control-label">Category Name: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <select type="text" class="form-control" id="editCategoryName" name="editCategoryName" >
                                    <option value="">~~SELECT~~</option>
                                    <?php 
                                    $sql = "SELECT categories_id, categories_name, categories_active, categories_status FROM categories WHERE categories_status = 1 AND categories_active = 1";
                                          $result = $connect->query($sql);
  
                                          while($row = $result->fetch_array()) {
                                              echo "<option value='".$row[0]."'>".$row[1]."</option>";
                                          } // while
                                          
                                    ?>
                                </select>
                              </div>
                      </div> <!-- /form-group-->					        	         	       
  
                      <div class="form-group">
                          <label for="editProductStatus" class="col-sm-3 control-label">Status: </label>
                          <label class="col-sm-1 control-label">: </label>
                              <div class="col-sm-8">
                                <select class="form-control" id="editProductStatus" name="editProductStatus">
                                    <option value="">~~SELECT~~</option>
                                    <option value="1">Available</option>
                                    <option value="2">Not Available</option>
                                </select>
                              </div>
                      </div> <!-- /form-group-->	         	        
  
                      <div class="modal-footer editProductFooter">
                          <button type="button" class="btn btn-default" data-dismiss="modal"> <i class="glyphicon glyphicon-remove-sign"></i> Close</button>
                          
                          <button type="submit" class="btn btn-success" id="editProductBtn" data-loading-text="Loading..."> <i class="glyphicon glyphicon-ok-sign"></i> Save Changes</button>
                        </div> <!-- /modal-footer -->				     
                      </form> <!-- /.form -->				     	
                      </div>    
                      <!-- /product info -->
                    </div>
  
                  </div>
                
            </div> <!-- /modal-body -->
                      
           
      </div>
      <!-- /modal-content -->
    </div>
    <!-- /modal-dailog -->
  </div>